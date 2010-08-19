<?php
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__));
require_once('Zend/Cache.php');
require_once('Zend/Http/Client.php');

class HttpClient {
  private $_frontend_options = array('lifetime' => 300, 'automatic_serialization' => true);
  private $_backend_options = array('cache_dir' => '/tmp/');
  private $_cache;

  protected function http_fetch($cache_key, $url, $format = 'text/html') {
    $response = $this->cache()->load($cache_key);
    if(!$response || !$response->isSuccessful()) {
      $http = new Zend_Http_Client($url, array('timeout' => 30));
      $http->setHeaders('accept', $format);
      $response = $http->request();
      $this->cache()->save($response, $cache_key);
    }
    return $response->getBody();
  }

  private function cache() {
    $this->_cache = $this->_cache ? 
      $this->_cache :
      Zend_Cache::factory('Core', 'File', $this->_frontend_options, $this->_backend_options);
    return $this->_cache;
  }
}
