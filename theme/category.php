<?
preg_match('/category\/([^\/]+)/',$_SERVER['REQUEST_URI'], $path);

switch($path[1]) {
case 'look':
    include('category_look.php');
    break;
case 'teach':
    include('category_teach.php');
    break;
default:
    include('archive.php');
}
?>