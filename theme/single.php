<?
$path = explode('/',trim($_SERVER['REQUEST_URI'],'/?'));

switch($path[0]) {
case 'look':
    include('single_look.php');
    break;
case 'teach':
    include('single_teach.php');
    break;
case 'civil-war':
    include('single_civil_war.php');
    break;
case 'events':
    include('single_events.php');
    break;
 
default:
    include('single_look.php');
}
?>
