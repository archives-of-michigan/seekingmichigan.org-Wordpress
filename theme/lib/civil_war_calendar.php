<?php
require_once(dirname(__FILE__).'/http_client.php');

class CivilWarCalendar extends HttpClient {
  private $_year;
  private $_month;

  function __construct($year = NULL, $month = NULL) {
    $this->_year = $year ? $year : date('Y');
    $this->_month = $month ? $month : date('n');
  }

  public function display() {
    return $this->http_fetch('civil_war_calendar',
      "http://seekingmichigan.org/calendars/$this->_year/$this->_month");
  }
}
