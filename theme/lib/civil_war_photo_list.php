<?php
include('phpFlickr/phpFlickr.php');

class CivilWarPhotoList {
  private $_num;
  private $_photos;
  private $_flickr;

  function __construct($num) {
    $this->_num = $num;
  }

  public function num() {
    return $this->_num;
  }

  public function photos() {
    if(!$this->_photos) {
      $result = $this->flickr()->
        groups_pools_getPhotos('1362691@N20', NULL, NULL, NULL, $this->num(), 1);
      $this->_photos = $result['photo'];
    }
    return $this->_photos;
  }

  public function thumbnail_for($photo) {
    return $this->flickr()->buildPhotoURL($photo, 'thumbnail');
  }

  private function ini($key = NULL) {
    ($this->_ini) ? 
      $this->_ini :
      $this->_ini = parse_ini_file('seekingmichigan.ini');

    return $key ? $this->_ini[$key] : $this->_ini;
  }

  private function flickr() {
    return ($this->_flickr) ? 
      $this->_flickr :
      $this->_flickr = new phpFlickr($this->ini('flickr_api_key'));
  }
}
