<?php
$frontendOptions = array('lifetime' => 300, 'automatic_serialization' => true);
$backendOptions = array('cache_dir' => '/tmp/');
$cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);

$response = $cache->load('civil-war-events')
if(!$response || !$response->isSuccessful()) {
    $http = new Zend_Http_Client('http://seeking-mi-civil-war-events.heroku.com/events.json');
    $response = $http->get();
    $cache->save($response, 'civil-war-events');
}
$calendar_events = Zend_Json::decode($response->getBody());
?>

<? if(count($calendar_events) > 0): ?>
  <? foreach($calendar_events as $date => $events): ?>
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
