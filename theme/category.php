<?
include('lib/pagination.php');
$match = preg_match('/category\/([^\/]+)/',$_SERVER['REQUEST_URI'], $path);
if(!$match) {
  preg_match('/([^\/\?]+)/',$_SERVER['REQUEST_URI'], $path);
}

switch($path[1]) {
case 'look':
  $paginator = new Pagination($wp_query, 'look');
  include('category_look.php');
  break;
case 'teach':
  $paginator = new Pagination($wp_query, 'teach');
  include('category_teach.php');
  break;
default:
  include('archive.php');
}
?>
