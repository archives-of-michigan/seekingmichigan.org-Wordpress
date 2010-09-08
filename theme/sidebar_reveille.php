<div id="resource-bar">
  <div class="wrapper">
    <? if(!is_category('reveille')): ?>
      <? app()->partial('civil_war_reveille'); ?>
    <? endif; ?>

    <? if(!is_category('civil-war-events')): ?>
      <? app()->partial('civil_war_events'); ?>
    <? endif; ?>

    <? app()->partial('civil_war_links'); ?>

    <? if(!is_category('civil-war-curriculum')): ?>
      <? app()->partial('civil_war_artifact_exhibits'); ?>
    <? endif; ?>

    <? app()->partial('civil_war_photos', array('num' => 3)); ?>

    <? app()->partial('civil_war_videos', array('num' => 2)); ?>
	</div>
</div>
