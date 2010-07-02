<?php
# require_once('lib/civil_war_event_list.php');
$calendar_events = array(); # new CivilWarEventList();
?>

<? if(false and count($calendar_events->getDates()) > 0): ?>
  <? foreach($calendar_events->getDates() as $date => $events): ?>
    <h3><?= $date; ?></h3>
    <ul>
      <? foreach($events as $event): ?>
        <li>
          <h4><a href="<?= $event->entryLink; ?>"><?= $event->title->text; ?></a></h4>
          <p><?= $event->content->text; ?></p>
        </li>
      <? endforeach; ?>
    </ul>
  <? endforeach; ?>
<? else: ?>
  No upcoming events
<? endif; ?>
