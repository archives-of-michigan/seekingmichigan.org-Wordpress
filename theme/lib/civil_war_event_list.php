<?php
$path = dirname(__FILE__);
set_include_path(get_include_path().PATH_SEPARATOR.$path);

require_once('Zend/Loader.php');
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_Calendar');

class CivilWarEventList {
  private $_dates;
  private $_gdataCal;
  private $_query;
  private $_allEvents;

  function __construct() {
    $this->_allEvents = $this->fetchData();
    $this->setDates();
  }

  public function getDates() {
    $this->_dates;
  }

  public function eventsForDate($date) {
    $this->_dates[$date];
  }

  private function setDates() {
    $this->_dates = array();
    foreach($this->_allEvents as $event) {
      $daykey = $this->dayKey($event->when->startTime);
      $this->_dates[$daykey] = $this->_dates[$daykey] || array();
      $this->_dates[$daykey][$event->title->text] = $event;
    }
  }

  public function dayKey($date) {
    strftime('%B %e, %Y', $date);
  }

  private function fetchData() {
    $this->_gdataCal = new Zend_Gdata_Calendar();
    $this->_query = $this->_gdataCal->newEventQuery();
    $this->_query->setUser('archivesmich@gmail.com');
    $this->_query->setOrderby('starttime');
    $startDate = strftime('%Y-%m-%d');
    $this->_query->setStartMin($startDate);
    $events = $this->_gdataCal->getCalendarEventFeed($this->_query);
    return $events;
  }
}
