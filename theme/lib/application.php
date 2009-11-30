<?php
require_once('helpers.php');

class Application {
  private $helpers = array();

  public function helper($name) {
    return $this->helper_object($name.'_helper');
  }

  public function helper_object($name) {
    if(!$helpers[$name]) {
      $helpers[$name] = eval("return new ".$this->camelize($name).';');
    }

    return $helpers[$name];
  }

  public function partial($name) {
    include(dirname(__FILE__).'/../include/partials/'.$name.'.php');
  }

  public function camelize($str) {
    return preg_replace('/(?:^|_)(.?)/e',"strtoupper('$1')",$str);
  }

  public function category() {
    preg_match('/category\/([^\/]+)/',$_SERVER['REQUEST_URI'], $path);
    if(!$match) {
      preg_match('/([^\/\?]+)/',$_SERVER['REQUEST_URI'], $path);
    }

    return $path[1];
  }
}
