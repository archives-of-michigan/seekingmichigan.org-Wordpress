<?php
/*
Template Name: Civil War
*/

$curriculum_dates = array();
foreach(get_posts('category_name=civil-war-curriculum&numberposts=5') as $post) {
  $date = new DateTime($post->post_date);
  $date_string = $date->format('F j, Y');
  if(!$curriculum_dates[$date_string]) {
    $curriculum_dates[$date_string] = array();
  }
  $curriculum_dates[$date_string][] = $post;
}


$rss = array('/category/civil-war/feed/' => 'Look');
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
      <? app()->partial('civil_war_events', array()); ?>
    </div>
  </div><!-- end bar -->

  <div id="blog-bar">
    <div class="wrapper">
      <? app()->partial('civil_war_reveille', array()); ?>

      <h2 class="curriculum"><a href="/civil-war-curriculum">Curriculum Support</a></h2>
      <? if(count($curriculum_dates) > 0): ?>
        <? foreach($curriculum_dates as $date => $posts): ?>
          <h3><?= $date; ?></h3>
          <? foreach($posts as $post): ?>
            <? setup_postdata($post); ?>
            <li>
              <h4><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h4>
                <p><? the_excerpt(); ?></p>
            </li>
          <? endforeach; ?>
        <? endforeach; ?>
      <? else: ?>
        <li>No entries posted yet</li>
      <? endif; ?>
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
