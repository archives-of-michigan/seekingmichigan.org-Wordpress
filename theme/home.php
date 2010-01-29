<? 
define("BODY_CLASS","home");
$rss = array('/category/teach/feed/' => 'Teach', '/category/look/feed/' => 'Look');
get_header(); 
?>

<div id="main-bars">
  <div id="seek-bar">
    <h2><a href="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_advanced.php" title="Search more">Seek <em></em></a></h2>
    <div class="wrapper">
      <form method="get" action="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_results.php">
      <h3><label for="search-text">Start with a Search.</label></h3>
      <p>Search for photographs, maps, spoken histories, and documents. 
        You can narrow your search by checking the checkboxes next to each type of media.</p>
      <input type="text" name="s" id="search-text" value="" />
      <!--[if lt IE 7]><br /><![endif]-->
      <input type="checkbox" id="search-photos" name="media-types[]" value="image" /> <label for="search-photos">Photo</label>
      <input type="checkbox" id="search-audio" name="media-types[]" value="audio" /> <label for="search-audio">Audio</label>
      <input type="checkbox" id="search-maps" name="document-types[]" value="map" /> <label for="search-video">Map</label>
      <input type="checkbox" id="search-documents" name="media-types[]" value="docs" /> <label for="search-documents">Document</label>
      <label for="search-button" class="hidden">Search</label>
      <input type="image" src="/images/search-button.png" id="search-button" name="search-button" value=" " />
      </form>
    </div>
  </div>
  <div id="discover-bar">
    <h2><a href="/discover" title="Discover more">Discover <em></em></a></h2>
    <div class="wrapper">
      <? include('include/home_collection.php'); ?>
    </div>
  </div>
  <div id="look-bar">
    <h2><a href="/look" title="Look more">Look <em></em></a></h2>
    <? query_posts('category_name=look&showposts=1'); ?>
    <div class="wrapper hentry">
      <? while (have_posts()) : the_post(); ?>
        <h3 class="entry-title"><a href="<? the_permalink(); ?>" title="Read more"><? the_title(); ?></a></h3>
        <? the_excerpt(); ?>
        <p><a href="<? the_permalink(); ?>" title="Read more">Continue reading &raquo;</a></p>
      <? endwhile; ?>
    </div>
  </div>
</div>

<div id="main-whitebox-left"></div>
<div id="main-whitebox-top"></div>
<div id="main-whitebox-right"></div>

<?php get_footer(); ?>
