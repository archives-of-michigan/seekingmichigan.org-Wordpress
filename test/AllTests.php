<?php
require_once dirname(__FILE__).'/test_helper.php';
require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__).'/cdm/lib/Search/SearchFromParamsTest.php';
require_once dirname(__FILE__).'/cdm/lib/Search/SearchFromParamStringTest.php';
require_once dirname(__FILE__).'/cdm/lib/Search/SearchGenerateContentTypeSearchStringTest.php';
require_once dirname(__FILE__).'/cdm/lib/Search/SearchGenerateSearchStringTest.php';
require_once dirname(__FILE__).'/cdm/lib/Search/SearchTermsTest.php';
require_once dirname(__FILE__).'/cdm/lib/Search/SearchTermSearchStringTest.php';
require_once dirname(__FILE__).'/cdm/lib/SearchStatus/SearchStatusInitialize.php';
 
class AllTests {
    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite;
        $suite->addTestSuite('SearchFromParamsTest');
        $suite->addTestSuite('SearchFromParamStringTest');
        $suite->addTestSuite('SearchGenerateContentTypeSearchStringTest');
        $suite->addTestSuite('SearchGenerateSearchStringTest');
        $suite->addTestSuite('SearchTermsTest');
        $suite->addTestSuite('SearchTermSearchStringTest');
        $suite->addTestSuite('SearchStatusInitialize');

        return $suite;
    }
}
?>