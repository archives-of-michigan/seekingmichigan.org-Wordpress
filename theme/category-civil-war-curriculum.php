<?php 
$breadcrumbs = array('Civil War' => '/civil-war', 'Curriculum' => '');
$rss = array('/category/civil-war-curriculum/feed/' => '');
define("BODY_CLASS","civilwar sub");
$title = 'Civil War Curriculum Support';
$js_includes = array('widgets','http://s7.addthis.com/js/152/addthis_widget.js');
include('header.php');

if($_GET['all'] == 'true') {
  query_posts(array('posts_per_page' => -1));
}
?>
<div id="main-content">
  <div id="viewer">
    <h2 class="curriculum-support">Curriculum Support</h2>
    <p>
      Curriculum support for K-12 educators teaching on subjects related to the Civil War.
    </p>
    <ul>
      <? while (have_posts()) : the_post(); ?>
        <li>
          <h4><a href="<?= the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?= the_title(); ?>"><?= the_title(); ?></a></h2>
          <p><?= the_excerpt(); ?></p>
        </li>
      <? endwhile ?>
    </ul>
    <? include('include/pagination.php'); ?>
  </div>

  <div id="main-whitebox-left"></div>
  <div id="main-whitebox-right"></div>

  <? include('sidebar_reveille.php'); ?>
</div>

<div class="sponsor-plug">
  <p>Sponsored by the Michigan Sequicentennial of the Civil War Commission</p>
</div>

<?php get_footer(); ?>
