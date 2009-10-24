<?
$path = preg_split('/\//',trim($_SERVER['REQUEST_URI'],'/?'));

switch($path[sizeof($path) - 1]) {
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