<?
$breadcrumbs = array('Search' => '');
if(is_category('look') || $_GET['cat'] == get_cat_ID('look')) {
  define("BODY_CLASS","look");
} elseif(is_category('teach') || $_GET['cat'] == get_cat_ID('teach')) {
  define("BODY_CLASS","teach landing sub page");
} else {
  define("BODY_CLASS","seek");
}
?>
<? include('header.php'); ?>

<? if(is_category('teach') || $_GET['cat'] == get_cat_ID('teach')): ?>
<div id="main-bars">
  <div id="bar-wide">
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
<? if(is_category('teach') || $_GET['cat'] == get_cat_ID('teach')): ?>
  </div>
</div>
<? endif; ?>

<? include('footer.php'); ?>
