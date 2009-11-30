<?php
require_once dirname(__FILE__).'/../../../theme/lib/application.php';

class ApplicationTest extends PHPUnit_Framework_TestCase {
  public function testCamelize() {
    $app = new Application;
    $this->assertEquals('CamelCase',$app->camelize('camel_case'));
    $this->assertEquals('Camelicious',$app->camelize('camelicious'));
  }
}
