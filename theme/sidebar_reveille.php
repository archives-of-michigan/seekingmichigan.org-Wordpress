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
      <h2 class="curriculum">
        <a href="/civil-war-curriculum">Curriculum Support</a>
      </h2>
      <ul>
        <li><h4><a href="#">Link goes here</a></h4></li>
      </ul>
    <? endif; ?>

    <? app()->partial('civil_war_photos', array('num' => 3)); ?>

    <? app()->partial('civil_war_videos', array('num' => 2)); ?>
	</div>
</div>
