<?
require_once(dirname(__FILE__).'/../include/cache_lite.php');

class Cache {
  public function __construct($type) {
    $this->type = $type;
    
    $connected = FALSE;
    if($this->type == 'memcache') {
      $memcache = new Memcache;
      $connected = $memcache->connect('localhost', 11211);
    } 
    
    if($this->type == 'lite' || $connected === FALSE) {
      $this->type = 'lite';
      $this->cache = new Cache_Lite(array(
        'cacheDir' => '/tmp/',
        'lifeTime' => 3600
      ));
    }
  }
  
  public $type;
  private $cache_lite_options;
  private $memcache_options;
  private $cache;
  
  public function get($key) {
    $this->cache->get($key);
  }
  
  public function put($key, $value) {
    if($type == 'memcache') {
      $this->cache->set($key, $value);
    } else {
      $this->cache->save($value, $key);
    }
  }
}
?>