<? 
$js_includes = array('teach','widgets','http://s7.addthis.com/js/152/addthis_widget.js');
$breadcrumbs = array('Teach' => '');
$rss = array('/category/teach/feed/' => 'Teach');
$title = 'Teach';
$is_paged = preg_match('/teach\/page/', $_SERVER['REQUEST_URI']);

if($is_paged) {
  define("BODY_CLASS",'teach sidebar');
} else {
  define('BODY_CLASS','teach landing');
}

include('header.php'); 

if($is_paged) {
  app()->partial('teach_posts');
} else {
  app()->partial('teach_landing');
}

include('footer.php');
?>
