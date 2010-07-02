<div id="resource-bar">
  <div class="wrapper">
    <? if(app()->category() != 'reveille'): ?>
      <? app()->partial('civil_war_reveille', array(); ?>
    <? endif; ?>

    <? if(app()->category() != 'civil-war-events'): ?>
      <? app()->partial('civil_war_events', array()); ?>
    <? endif; ?>

    <? app()->partial('civil_war_links', array()); ?>

    <? if(app()->category() != 'civil-war-curriculum'): ?>
      <? app()->partial('civil_war_curriculum', array('curriculum_dates' => $curriculum_list->getDates())); ?>
    <? endif; ?>

    <? app()->partial('civil_war_photos', array('num' => 3)); ?>

    <? app()->partial('civil_war_videos', array('num' => 2)); ?>
	</div>
</div>
