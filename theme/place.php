<?
/*
Template Name: Place
*/

$breadcrumbs = array('Teach' => '/teach');
define('BODY_CLASS','teach landing sub');
define('TEACH_PAGE', true);
include('header.php');
?>
<div id="lead-in">
  <p>Ideas for teaching kids to Seek, Discover, and Look at Michigan’s Stories.</p>
  <div class="search">
    <form id="teach-search" action="http://seekingmichigan.org" method="get" >
      <label for="search-top" class="hidden">Seek: </label>
      <input type="text" name="s" id="s" placeholder="Enter text " />
      <label for="search-button" class="hidden">Search </label>
      <input type="submit" value=" " id="search-button" name="search-button" />
    </form>
  </div>
</div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div id="main-bars">
    <div id="bar-wide">
      <h2><?php the_title(); ?></h2>
      <?php the_content(); ?>
    </div>
    <div id="bar-thin">
      <h2>Events</h2>
      <div id="bar-three">
        <?= app()->partial('event_list', array('category' => the_title('','',false), 'show_description' => false)); ?>
      </div>
    </div>
  </div>
<?php endwhile; endif; ?>
<? include('footer.php'); ?>
