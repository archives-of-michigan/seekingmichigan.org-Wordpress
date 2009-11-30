<?php

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
    include('../include/partials/'.$name.'.php');
  }

  public function camelize($str) {
    $str = ucwords($str);
    return preg_replace('/_/','',$str);
  }
}
