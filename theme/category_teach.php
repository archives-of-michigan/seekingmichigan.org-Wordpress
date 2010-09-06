<? 
$js_includes = array('teach','widgets','http://s7.addthis.com/js/152/addthis_widget.js');
$breadcrumbs = array('Teach' => '');
$rss = array('/category/teach/feed/' => 'Teach');
define('BODY_CLASS','teach landing');  # use 'teach sidebar' for list
$title = 'Teach';
include('header.php'); 

var_dump($_GET);

include('footer.php');
?>
