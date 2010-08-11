<?php
class CivilWarEventList {
  private $_dates;
  private $_gdataCal;
  private $_query;
  private $_allEvents;

  function __construct() {
    $this->_allEvents = $this->fetch_data();
    $this->set_dates();
  }

  public function dates() {
    return $this->_dates;
  }

  public function events_for_date($date) {
    return $this->_dates[$date];
  }

  private function set_dates() {
    $this->_dates = array();
    foreach($this->_allEvents as $event) {
      $daykey = $this->date_key($event);
      $this->_dates[$daykey] = $this->_dates[$daykey] || array();
      $this->_dates[$daykey][$event->post_title] = $event;
    }
  }

  public function date_key($event) {
    return the_event_start_date($event->ID, false, 'F j, Y');
  }

  private function fetch_data() {
    $events = get_posts('category_name=events&eventDisplay=upcoming');
    return $events;
  }
}
