<?php 
/*
Template Name: Teach Page
*/

while (have_posts()) {
  the_post();
  $title = the_title('','',false);
  $content = get_the_content();
}

$breadcrumbs = array('Teach' => '/teach', $title => '');
define('BODY_CLASS','teach landing sub page');
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

<div id="main-content">
  <div class="wrapper">
    <h2><?= $title; ?></h2>
    <?= $content; ?>
  </div>
</div>
<? include('footer.php'); ?>
