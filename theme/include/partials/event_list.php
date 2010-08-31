<?php
require_once(dirname(__FILE__).'/../../lib/event_list.php');
$event_list = new EventList();
$calendar_days = $event_list->event_list($category);
?>

<? if(count($calendar_days) > 0): ?>
  <? foreach($calendar_days as $date => $events): ?>
    <h3><?= $date; ?></h3>
    <ul>
      <? foreach($events as $index => $event_record): ?>
        <? $event = $event_record['event']; ?>
        <li>
          <h4><a href="<?= $event['url']; ?>"><?= $event['name']; ?></a></h4>
          <p><?= $event['description']; ?></p>
          <p class="meta-text">Time: <strong><?= $event['time'] ?></strong></p>
          <? if($event['location']): ?>
            <p class="meta-text">Location: <strong><?= $event['location'] ?></strong></p>
          <? endif; ?>
          <p class="readmore">
            <a href="/event_manager<?= $event['url']; ?>">Read More &raquo;</a> 
            |
            <a href="http://www.addthis.com/bookmark.php" rel="<?= $event['url']; ?>" title="<?= $event['name'] ?>">Share This</a>
          </p>
        </li>
      <? endforeach; ?>
    </ul>
  <? endforeach; ?>
<? else: ?>
  No events for <?= $category ?>
<? endif; ?>