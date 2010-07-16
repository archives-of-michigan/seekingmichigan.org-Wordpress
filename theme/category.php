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
case 'civil-war':
  $paginator = new Pagination($wp_query, 'civil-war');
  include('category_civil-war.php');
  break;
case 'civil-war-curriculum':
  $paginator = new Pagination($wp_query, 'civil-war-curriculum');
  include('category_civil-war-curriculum.php');
  break;
case 'reveille':
  $paginator = new Pagination($wp_query, 'reveille');
  include('category_reveille.php');
  break;
default:
  $paginator = new Pagination($wp_query, 'look');
  include('archive.php');
}
?>
