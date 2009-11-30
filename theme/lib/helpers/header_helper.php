<?php

class HeaderHelper {
  public function banner_scene() {
    $month = $this->getdate();
    $month = $month['mon'];
    if($month == 12 || ($month >= 1 && $month < 3)) { // winter
      $scenes = array('ice','snow-trees');
    } elseif($month == 3 || $month == 4) {
      $scenes = array('summer-fern');
    } elseif($month > 4 && $month <= 6) {  // spring, summer
      $scenes = array('ship','summer-fern','summer-treeline','wheatgrass');
    } else {  // fall
      $scenes = array('fall-treeline','ship','snow-sun');
    }

    $scene = $this->pick_scene($scenes);
    return $scene;
  }

  # proxy for PHP's getdate - makes testing easier
  private function getdate() {
    getdate();
  }

  private function pick_scene($scenes) {
    return $scenes[rand(0,count($scenes) - 1)];
  }

  public function show_search() {
    $disabled = array('discover','discover-collection','seek');
    foreach($disabled as $page) { 
      if(is_page($page)) { return false; }
    }
    return true;
  }
}
