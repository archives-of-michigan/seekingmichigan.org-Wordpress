<?
if(is_category()) {
  $breadcrumbs = array('Categories' => '/archive', single_cat_title('',FALSE) => '');
} elseif(is_tag()) {
  $breadcrumbs = array('Tags' => '/archive', single_tag_title('',FALSE) => '');
} elseif(is_day()) {
  $ymd = explode('-',get_the_time('Y-m-d'));
  $breadcrumbs = array($ymd[0] => '/'.$ymd[0],
                       $ymd[1] => '/'.$ymd[0].'/'.$ymd[1],
                       $ymd[2] => '');
} elseif(is_month()) {
  $ymd = explode('-',get_the_time('Y-m-d'));
  $breadcrumbs = array($ymd[0] => '/'.$ymd[0],
                       $ymd[1] => '');
} elseif(is_year()) {
  $ymd = explode('-',get_the_time('Y-m-d'));
  $breadcrumbs = array($ymd[0] => '');
} elseif(is_author()) {
  $breadcrumbs = array('Authors' => '');
} else {
  $breadcrumbs = array('Look' => '');
}

define("BODY_CLASS","look sidebar");
$title = 'Look &mdash; Archive';
$js_includes = array('widgets','http://s7.addthis.com/js/152/addthis_widget.js');
include('header.php');
?>

<div id="section-header">
	<h1><a href="/look">Look</a></h1>
	<p>A leisurely Look at Michigan’s stories and traditions from yesterday to yesteryear.</p>
</div>
<div id="main-content">
  <? if (have_posts()) : ?>
    <? $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    <? if(is_category()): ?>
      <h2 class="pagetitle">Category <? single_cat_title(); ?></h2>
    <? elseif(is_tag()): ?>
      <h2 class="pagetitle">Posts Tagged &#8216;<? single_tag_title(); ?>&#8217;</h2>
    <? elseif(is_day()): ?>
      <h2 class="pagetitle">Archive for <? the_time('F jS, Y'); ?></h2>
    <? elseif(is_month()): ?>
      <h2 class="pagetitle">Archive for <? the_time('F, Y'); ?></h2>
    <? elseif(is_year()): ?>
      <h2 class="pagetitle">Archive for <? the_time('Y'); ?></h2>
    <? elseif(is_author()): ?>
      <h2 class="pagetitle">Author Archive</h2>
    <? endif; ?>
      <? while (have_posts()) : the_post(); ?>
        <div class="post">
          <h2 id="post-<?= the_ID(); ?>"><a href="<?= the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?= the_title(); ?>"><?= the_title(); ?></a></h2>
          <p class="byline vcard">By <a href="<?= the_author_url(); ?>" title="View Author" class="fn url name"><?= the_author() ?></a> | <span class="date"> <?= the_date('F j, Y'); ?></span></p>
          <?= the_excerpt(); ?>
          <div class="post-meta">
            <ul>
              <li class="comment-count"><a href="<?= comments_link(); ?>"><?= comments_number('No comments', 'One comment', '% comments'); ?></a></li>
              <li class="share-link"><? share_this(get_permalink(), the_title('','',FALSE)); ?></li>
            </ul>
          </div>
        </div>
      <? endwhile ?>
      <? include('include/pagination.php'); ?>
  <? else : ?>
    <? get_header(); ?>
    <p>
      There are no articles for  
      <?
        if (is_category()) { 
          echo "category ".single_cat_title();
        } elseif(is_tag()) {
          echo "tag ".single_tag_title();
        } elseif(is_day()) {
          the_time('F jS, Y');
        } elseif(is_month()) {
          the_time('F, Y');
        } elseif(is_year()) {
          the_time('Y');
        } elseif(is_author()) {
          echo "the chosen author";
        }
      ?>
    </p>
    <p>Search for more results:</p>
    <? include (TEMPLATEPATH . '/searchform.php'); ?>
  <? endif; ?>
</div>
<? include('sidebar_look.php'); ?>
<div id="main-whitebox-left"></div>
<div id="main-whitebox-right"></div>
<?php get_footer(); ?>

