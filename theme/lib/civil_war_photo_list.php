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
    $this->_num;
  }

  public function photos() {
    return ($this->_photos) ?
      $this->_photos :
      $this->_photos = $this->flickr()->
        groups_pools_getPhotos('1362691@N20', NULL, NULL, NULL, $this->_num, 1);
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
