<?
require_once(dirname(__FILE__).'/../include/JSON.php');

class ContentDM {
  protected $url;
  private $hostname;
  private $root_path;

  public function __construct($hostname, $root_path, $ajax_path) {
    $this->hostname = $hostname;
    $this->root_path = $root_path;
    $this->url = 'http://'.$hostname.$root_path.$ajax_path;
  }

  protected function call_method($method, $params, $cache_key = FALSE) {
    if($cache_key == FALSE) {
      $cache_key = $method;
      if($params) {
        $cache_key = $cache_key.'_'.implode('_', $params);
      }
    }
    
    $params = $params ? $params : array();
    
    if($data = wp_cache_get($cache_key, 'contentdm')) {
      $result = new ContentDMResult($data, 200);
      return $result->data;
    } else {
      $json = new Services_JSON();
      $encoded_params = $json->encode($params);
      
      $curl_handle = curl_init($this->url);
      curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl_handle, CURLOPT_POST, 1);
      curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "command=$method&params=$encoded_params");
      $body = curl_exec($curl_handle);
      $status = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
      curl_close($curl_handle);
      
      $result = new ContentDMResult($body, $status);

      wp_cache_add($cache_key, $body, 'contentdm', 86400);

      return $result->data;
    }
  }
  
  public function query($params) {
    return $this->call_method('dmQuery', $params);
  }
  
  public function collection_list() {
    $results =  $this->call_method('dmGetCollectionList', null, '/collection_list');
    return $results == array(FALSE) ? array() : $results;
  }
  
  public function getCollectionsWithMetaData() {
    return $this->call_method('get_collections_with_meta_data', null, '/get_collections_with_meta_data');
  }
  
  public function collectionInfo($alias) {
    return $this->call_method('collection_info', array('alias' => $alias), '/collection_info/'.$alias);
  }
  
  public function featured_items_for_collection($alias) {
    $decoded_data = $this->call_method('featured_items_for_collection',array('alias' => $alias), '/featured_items_for_collection/'.$alias);
    return $decoded_data;
  }
  
  public function url_for_collection_alias($alias) {
    return 'http://seekingmichigan.cdmhost.com/seeking_michigan/seek_results.php?CISOROOT='.$alias;
  }
  
  public function url_for_item($id) {
    return '/discover-item?item='.$id;
  }
}

class ContentDMResult {
  public $data, $status;
  
  public function __construct($json_data, $status) {
    $json_data = $this->sanitize_json($json_data);
    
    $this->status = $status;
    
    $json = new Services_JSON();
    $decoded_data = $json->decode($json_data);
    
    $this->data = $decoded_data;
  }
  
  protected function sanitize_json($data) {
    $data = preg_replace('/<!--.*-->/','',$data);
    $data = preg_replace('/\* Closing connection #\d+/','',$data);
    return $data;
  }
}
?>
