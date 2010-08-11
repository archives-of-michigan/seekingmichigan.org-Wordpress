<?php
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__));
require('Zend/Cache.php');

class CivilWarCalendar {
  private $_year;
  private $_month;
  private $_frontend_options = array('lifetime' => 300, 'automatic_serialization' => true);
  private $_backend_options = array('cache_dir' => '/tmp/');
  private $_cache;

  function __construct($year = NULL, $month = NULL) {
    $this->_year = $year or date('%Y');
    $this->_month = $month or date('%n');
  }

  public function display() {
    $response = $this->cache()->load('civil_war_calendar');
    if(!$response || !$response->isSuccessful()) {
      $url = "http://seeking-mi-civil-war-events.heroku.com/calendar.json?year=$this->_year&month=$this->_month";
      $http = new Zend_Http_Client($url);
      $response = $http->get();
      $cache->save($response, 'civil_war_calendar');
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
