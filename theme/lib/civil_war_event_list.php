<?php
require_once(dirname(__FILE__).'/http_client.php');
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__));
require_once('Zend/Json.php');

class CivilWarEventList extends HttpClient {
  function __construct() {
  }

  public function event_list() {
    $json = $this->http_fetch('civil_war_events',
      'http://seekingmichigan.org/events.json');
    return Zend_Json::decode($json);
  }
}
