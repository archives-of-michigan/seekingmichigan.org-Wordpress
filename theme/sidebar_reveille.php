<div id="resource-bar">
  <div class="wrapper">
    <? if(!is_category('reveille')): ?>
      <? app()->partial('civil_war_reveille'); ?>
    <? endif; ?>

    <? app()->partial('event_list', array('category' => 'Civil war', 'limit' => 2)); ?>

    <? app()->partial('civil_war_links'); ?>

    <? if(!is_category('civil-war-curriculum')): ?>
      <? app()->partial('civil_war_artifact_exhibits'); ?>
    <? endif; ?>

    <? app()->partial('civil_war_photos', array('num' => 3)); ?>

    <? app()->partial('civil_war_videos', array('num' => 2)); ?>
	</div>
</div>
