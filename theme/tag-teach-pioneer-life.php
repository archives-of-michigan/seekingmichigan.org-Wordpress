<?
$js_includes = array('teach','widgets','http://s7.addthis.com/js/152/addthis_widget.js');
$breadcrumbs = array('Teach' => '');
$rss = array('/category/teach/feed/' => 'Teach');
$title = 'Teach: Programs';


define("BODY_CLASS",'teach landing');

include('header.php');

if($_GET['all'] == 'true') {
  query_posts(array('posts_per_page' => -1));
}
?>

<?= app()->partial('teach_search'); ?>

<div id="main-content">
  <div id="left-main-content">
	<? while (have_posts()) : the_post(); ?>
		<div class="post">
			<h2 id="post-<? the_ID(); ?>"><a href="<? the_permalink(); ?>" rel="bookmark" title="Permanent Link to <? the_title(); ?>"><? the_title(); ?></a></h2>
			<?= the_excerpt(); ?>
			<div class="post-meta">
				<ul>
					<li class="comment-count"><a href="<? comments_link(); ?>"><?= comments_number('No comments', 'One comment', '% comments'); ?></a></li>
					<li class="share-link"><? share_this(get_permalink(), the_title('','',FALSE)); ?></li>
				</ul>
			</div>
		</div>
	<? endwhile ?>
    <?= app()->partial('pagination'); ?>
  </div>
  <?= app()->partial('sidebar_teach_lessons'); ?>
</div>



<div id="main-whitebox-left"></div>
<div id="main-whitebox-right"></div>

<?
include('footer.php');
?>
