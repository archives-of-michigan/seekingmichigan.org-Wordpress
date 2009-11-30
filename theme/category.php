<?
switch(app()->category()) {
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
