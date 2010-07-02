<?php

class CivilWarCurriculumList {
  private $_dates;
  private $_allCurriculum;

  function __construct() {
    $this->_allCurriculum = $this->fetchData();
    $this->setDates();
  }

  public function getDates() {
    $this->_dates;
  }

  public function itemsForDate($date) {
    $this->_dates[$date];
  }

  private function setDates() {
    $this->_dates = array();
    foreach($this->_allCurriculum as $item) {
      $daykey = $this->dayKey($item->post_date);
      $this->_dates[$daykey] = $this->_dates[$daykey] || array();
      $this->_dates[$daykey][$item->title] = $item;
    }
  }

  public function dayKey($date) {
    $date->format('F j, Y');
  }

  private function fetchData() {
    $curriculum = get_posts('category_name=civil-war-curriculum&numberposts=5');
    return $curriculum;
  }
}
