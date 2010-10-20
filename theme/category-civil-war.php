<?php
/*
Template Name: Civil War
*/

$js_includes = array('civil_war_search');
$rss = array('/category/civil-war/feed/' => 'Civil War');
$breadcrumbs = array('Civil War' => '');
define("BODY_CLASS","civilwar");
include('header.php');
?>
<div id="lead-in">
  <h3>Curriculum, Research &amp; Events</h3>
  <p>Seek, discover and look at Michigan's Civil War in documents, photographs and maps at SeekingMichigan.org</p>
</div>
<div id="civil-war-search">
    <form action="http://seekingmichigan.org" method="get">
      <input name="s" id="s" type="text" class="text" value="Enter text"/>
      <input type="hidden" name="cat" value="<?= get_cat_ID('Civil War'); ?>" />
      <input type="image" src="/images/search-button.png" id="search-button" name="search-button" value=" " />
    </form>
  </div>
  <div id="main-bars">
    <div id="event-bar">
      <div class="wrapper">
        <h2 class="events"><a href="#">Events &amp; Dates</a></h2>
        <div class="calendar-grid">
        </div>
        <? app()->partial('civil_war_calendar'); ?>
        <p class="more">
          <a href="/event_manager/categories/Civil war/events/new" class="addyours">Add Yours</a>
        </p>
        <? app()->partial('event_list', array('category' => 'Civil war', 'limit' => 10)); ?>
    </div>
  </div><!-- end bar -->

  <div id="blog-bar">
    <div class="wrapper">
      <? app()->partial('civil_war_reveille'); ?>
      <p class="more">
        <a href="/reveille-form" class="addyours">Add Yours</a>
      </p>

      <? app()->partial('civil_war_artifact_exhibits'); ?>
    </div>
  </div><!-- end bar -->

  <div id="resource-bar">
    <div class="wrapper">
      <? app()->partial('civil_war_links'); ?>
  
      <? app()->partial('civil_war_photos', array('num' => 3)); ?>

      <? app()->partial('civil_war_videos', array('num' => 2)); ?>
    </div>
  </div><!-- end bar -->
  <div class="sponsor-plug">
    <p>Sponsored by the Michigan Sequicentennial of the Civil War Commission</p>
  </div>
</div>
<div id="main-whitebox-left"></div>
<div id="main-whitebox-top"></div>
<div id="main-whitebox-right"></div>
<? include('footer.php'); ?>
