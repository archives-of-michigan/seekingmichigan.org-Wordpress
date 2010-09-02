<?php
require_once(dirname(__FILE__).'/../../lib/event_list.php');
$event_list = new EventList();
$limit = ($limit) ? $limit : NULL;
$calendar_days = $event_list->event_list($category, $limit);
$show_description = ($show_description === false) ? false : true;
?>

<? if(count($calendar_days) > 0): ?>
  <? foreach($calendar_days as $date => $events): ?>
    <h3><?= $date; ?></h3>
    <ul>
      <? foreach($events as $event): ?>
        <li>
          <h4><a href="/event_manager/events/<?= $event['id']; ?>"><?= $event['name']; ?></a></h4>
          <? if($show_description): ?>
            <p><?= $event['description']; ?></p>
          <? endif; ?>
          <p class="meta-text">Time: <strong><?= $event['time'] ?></strong></p>
          <? if($event['location'] && $show_location !== false): ?>
            <p class="meta-text">Location: <strong><?= $event['location'] ?></strong></p>
          <? endif; ?>
          <p class="readmore">
            <a href="<?= $event['url']; ?>">Read More &raquo;</a> 
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
