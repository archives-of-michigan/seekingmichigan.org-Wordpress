<?php
require_once(dirname(__FILE__).'/../../lib/civil_war_calendar.php');
$calendar = new CivilWarCalendar();
?>

<?= $calendar->display(); ?>
