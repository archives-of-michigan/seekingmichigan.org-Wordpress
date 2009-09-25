<?php
require_once dirname(__FILE__).'/test_helper.php';
require_once 'PHPUnit/Framework.php';
// require_once dirname(__FILE__).'/theme/lib/cache/cache_test.php';
require_once dirname(__FILE__).'/theme/lib/content_dm_test.php';
 
class AllTests {
    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite;
        // $suite->addTestSuite('CacheTest');
        $suite->addTestSuite('ContentDMTest');

        return $suite;
    }
}
?>