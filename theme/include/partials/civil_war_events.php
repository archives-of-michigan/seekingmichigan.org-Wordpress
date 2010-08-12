<?php
require_once(dirname(__FILE__).'/../../lib/civil_war_event_list.php');
$event_list = new CivilWarEventList();
?>

<? if(count($event_list) > 0): ?>
  <? foreach($event_list as $date => $events): ?>
    <h3><?= $date; ?></h3>
    <ul>
      <? foreach($events as $title => $event): ?>
        <li>
          <h4><a href="<?= $event['link']; ?>"><?= $title; ?></a></h4>
          <p><?= $event['description']; ?></p>
        </li>
      <? endforeach; ?>
    </ul>
  <? endforeach; ?>
<? else: ?>
  No upcoming events
<? endif; ?>
