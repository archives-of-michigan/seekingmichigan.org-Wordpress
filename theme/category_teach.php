<? 
$js_includes = array('teach','widgets','http://s7.addthis.com/js/152/addthis_widget.js');
$breadcrumbs = array('Teach' => '');
$rss = array('/category/teach/feed/' => 'Teach');
define("BODY_CLASS","teach sidebar");
$title = "Teach";
include('header.php'); 
?>

<div id="section-header">
	<h1><a href="/teach">Teach</a></h1>
	<p>Ideas for teaching kids to Seek, Discover, and Look at Michigan’s Stories.</p>
</div>

<? query_posts(array('category__and' => array(4), 'category__not_in' => array(15))); ?>
<div id="main-content">
	<? while (have_posts()) : the_post(); ?>
		<div class="post">
			<h2 id="post-<? the_ID(); ?>"><a href="<? the_permalink(); ?>" rel="bookmark" title="Permanent Link to <? the_title(); ?>"><? the_title(); ?></a></h2>
			<p class="byline vcard">By <a href="<? the_author_url(); ?>" title="View Author" class="fn url name"><? the_author() ?></a> | <span class="date"> <? the_date('F j, Y'); ?></span></p>
			<?= the_excerpt(); ?>
			<div class="post-meta">
				<ul>
					<li class="comment-count"><a href="<? comments_link(); ?>"><?= comments_number('No comments', 'One comment', '% comments'); ?></a></li>
					<li class="share-link"><? share_this(get_permalink(), the_title('','',FALSE)); ?></li>
				</ul>
			</div>
		</div>
	<? endwhile ?>
	<? include('include/pagination.php'); ?>
</div>

<? include('sidebar_teach.php'); ?>

<div id="main-whitebox-left"></div>
<div id="main-whitebox-right"></div>

<?php get_footer(); ?>