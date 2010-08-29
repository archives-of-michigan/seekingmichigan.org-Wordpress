<?php
/*
Template Name: Civil War
*/

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
    <form>
      <input type="text" class="text" value="Enter text"/>
      <input type="image" src="/images/search-button.png" id="search-button" name="search-button" value=" " />
    </form>
  </div>
  <div id="main-bars">
    <div id="event-bar">
      <div class="wrapper">
        <h2 class="events"><a href="#">Events &amp; Dates</a></h2>
        <div class="calendar-grid">
        </div>
        <? app()->partial('civil_war_calendar', array()); ?>
        <p class="more">
          <a href="/events/new" class="addyours">Add Yours</a>
        </p>
        <? app()->partial('civil_war_events', array()); ?>
    </div>
  </div><!-- end bar -->

  <div id="blog-bar">
    <div class="wrapper">
      <? app()->partial('civil_war_reveille', array()); ?>

      <? app()->partial('civil_war_curriculum', array()); ?>
    </div>
  </div><!-- end bar -->

  <div id="resource-bar">
    <div class="wrapper">
      <? app()->partial('civil_war_links', array()); ?>
  
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
