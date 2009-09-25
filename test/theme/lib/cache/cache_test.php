<?php
require_once dirname(__FILE__).'/../../../../theme/lib/cache.php';

class CacheTest extends PHPUnit_Framework_TestCase {
  // public function testInitializeMemcache() {
  //   $cache = new Cache('memcache');
  //   $this->assertEquals('memcache', $cache->$type);
  // }
  public function testInitializeCacheLite() {
    $cache = new Cache('lite');
    $this->assertEquals('lite', $cache->$type);
  }
}