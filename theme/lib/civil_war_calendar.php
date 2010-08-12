<?php
class CivilWarCalendar extends HttpClient {
  private $_year;
  private $_month;

  function __construct($year = NULL, $month = NULL) {
    $this->_year = $year or date('%Y');
    $this->_month = $month or date('%n');
  }

  public function display() {
    return $this->http_fetch('civil-war-calendar',
      "http://seeking-mi-civil-war-events.heroku.com/calendars/$this->_year/$this->_month");
  }
}
