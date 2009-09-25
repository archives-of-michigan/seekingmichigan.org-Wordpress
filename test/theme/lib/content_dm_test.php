<?php
require_once dirname(__FILE__).'/../../../theme/lib/content_dm.php';

class TestHarness extends ContentDMResult {
  public function __construct() { }
  
  public function sanitize_json_facade($data) {
    return parent::sanitize_json($data);
  }
}

class ContentDMTest extends PHPUnit_Framework_TestCase {
  public function testSanitizeJsonWithComments() {
    $harness = new TestHarness;
    $json = <<<EOT
<!-- http://localhost:15147/!/search?query=n2%3A%221%22 (za:f3 or 98.209.39.62)&sort=&display=<ITEM><DB>\$\$DM_pa\$\$</DB><KEY>\$\$DM_ci\$\$</KEY></ITEM>&collection=/p129401coll15/&suggest=1&rankboost=&proximity=strict&priority=normal&unanchoredphrases=1&maxres=50&firstres=0&rform=/!/null.htm //-->
* Closing connection #0
{"json":"rocks"}
EOT;
    $this->assertEquals("\n\n{\"json\":\"rocks\"}", $harness->sanitize_json_facade($json));
  }
  public function testSanitizeJsonWithoutComments() {
    $harness = new TestHarness;
    $this->assertEquals('{"json":"rocks"}', $harness->sanitize_json_facade('{"json":"rocks"}'));
  }
}