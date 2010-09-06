<? 
$js_includes = array('teach','widgets','http://s7.addthis.com/js/152/addthis_widget.js');
$breadcrumbs = array('Teach' => '');
$rss = array('/category/teach/feed/' => 'Teach');
define('BODY_CLASS','teach landing');  # use 'teach sidebar' for list
$title = 'Teach';

if(is_paged()) {
  define("BODY_CLASS",'teach');
} else {
  define('BODY_CLASS','teach landing');
}

include('header.php'); 

if(is_paged()) {
  app()->partial('teach_posts', array());
} else {
  app()->partial('teach_landing', array());
}

include('footer.php');
?>
