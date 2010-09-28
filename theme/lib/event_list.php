<?php
require_once(dirname(__FILE__).'/http_client.php');
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__));
require_once('Zend/Json.php');

class EventList extends HttpClient {
  function __construct() {
  }

  public function event_list($category, $limit = NULL) {
    $url = 'http://seekingmichigan.org/event_manager/categories/'.rawurlencode($category).'/events';
    if($limit) {
      $url = $url.'?limit='.$limit;
    }
    $json = $this->http_fetch($this->cache_key($category), $url, 'application/json');
    return Zend_Json::decode($json);
  }

  public function cache_key($category) {
    return preg_replace('/\s+/','_', $category).'_events';
  }
}
