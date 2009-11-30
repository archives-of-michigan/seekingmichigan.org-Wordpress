<?php
require_once dirname(__FILE__).'/../../../theme/lib/helpers/header_helper.php';

class HeaderHelperTest extends PHPUnit_Framework_TestCase {
  public function testWinter() {
    $helper = $this->getMock('HeaderHelper');
    $helper->expects($this->any())
           ->method('getdate')
           ->will($this->returnValue(array('mon' => 12));
    $helper->expects($this->any())
           ->method('pick_scene')
           ->with(array('ice','snow-trees'));

    $scene = $helper->banner_scene();
  }
  public function testSpring() {
    $helper = $this->getMock('HeaderHelper');
    $helper->expects($this->any())
           ->method('getdate')
           ->will($this->returnValue(array('summer-fern'));
    $helper->expects($this->any())
           ->method('pick_scene')
           ->with(array('ice','snow-trees'));

    $scene = $helper->banner_scene();
  }
  public function testSummer() {
    $helper = $this->getMock('HeaderHelper');
    $helper->expects($this->any())
           ->method('getdate')
           ->will($this->returnValue(array('mon' => 7));
    $helper->expects($this->any())
           ->method('pick_scene')
           ->with(array('ship','summer-fern','summer-treeline','wheatgrass'));

    $scene = $helper->banner_scene();
  }
  public function testFall() {
    $helper = $this->getMock('HeaderHelper');
    $helper->expects($this->any())
           ->method('getdate')
           ->will($this->returnValue(array('mon' => 10));
    $helper->expects($this->any())
           ->method('pick_scene')
           ->with(array('fall-treeline','ship','snow-sun'));

    $scene = $helper->banner_scene();
  }
}
