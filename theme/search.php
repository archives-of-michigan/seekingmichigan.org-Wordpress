<?
$breadcrumbs = array('Search' => '');
if(is_category('teach') || app()->category() == 'Teach') {
  define("BODY_CLASS","teach landing");
} elseif(is_category('civil-war') || app()->category() == 'Civil War') {
  define("BODY_CLASS","civilwar sub");
} else {
  define("BODY_CLASS","look");
}
?>
<? include('header.php'); ?>

<? if(is_category('lessons') || $_GET['cat'] == get_cat_ID('lessons')): ?>
  <?= app()->partial('teach_search'); ?>
  <div id="main-content">
    <div id="left-main-content">
<? elseif(is_category('programs') || $_GET['cat'] == get_cat_ID('programs')): ?>
  <?= app()->partial('teach_search'); ?>
  <div id="main-content">
    <div id="left-main-content">
<? elseif(is_category('resources') || $_GET['cat'] == get_cat_ID('resources')): ?>
  <?= app()->partial('teach_search'); ?>
  <div id="main-content">
    <div id="left-main-content">
<? elseif(is_category('events') || $_GET['cat'] == get_cat_ID('events')): ?>
  <?= app()->partial('teach_search'); ?>
  <div id="main-content">
    <div id="left-main-content">
<? elseif(is_category('civil-war') || $_GET['cat'] == get_cat_ID('Civil War')): ?>
  <div id="main-content">
    <div id="viewer">
<? else: ?>
  <div id="section-header">
    <? if(is_category('look') || $_GET['cat'] == get_cat_ID('look')): ?>
      <h1><a href="/look">Look</a></h1>
    <? else: ?>
      <h1><a href="/seek">Seek</a></h1>
    <? endif; ?>
  </div>
<? endif; ?>
<h1>Search Results:</h1>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <div class="post">
      <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
      <small><?php the_time('l, F jS, Y') ?></small>
      <? the_excerpt(); ?>
      <p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
    </div>
  <?php endwhile; ?>
<?php else : ?>
  <h2 class="center">No posts found</h2>
<?php endif; ?>
<? if(is_category('lessons') || $_GET['cat'] == get_cat_ID('lessons')): ?>
  </div>
  <?= app()->partial('sidebar_teach_lessons'); ?>
</div>
<? elseif(is_category('programs') || $_GET['cat'] == get_cat_ID('programs')): ?>
  </div>
  <?= app()->partial('sidebar_teach_programs'); ?>
</div>
<? elseif(is_category('resources') || $_GET['cat'] == get_cat_ID('resources')): ?>
  </div>
  <?= app()->partial('sidebar_teach_resources'); ?>
</div>
<? elseif(is_category('events') || $_GET['cat'] == get_cat_ID('events')): ?>
  </div>
  <?= app()->partial('sidebar_teach_events'); ?>
</div>
<? elseif(is_category('civil-war') || $_GET['cat'] == get_cat_ID('Civil War')): ?>
  </div>
</div>
<? endif; ?>

<? include('footer.php'); ?>
