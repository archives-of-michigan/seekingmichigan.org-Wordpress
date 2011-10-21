<?
if (have_posts()) {
	while (have_posts()) {
		the_post();
		$ymd = explode('-',the_date('Y-m-d','','',FALSE));
		$breadcrumbs = array('Teach' => '/teach', 
												 $ymd[0] => '/teach/'.$ymd[0],
												 $ymd[1] => '/teach/'.$ymd[0].'/'.$ymd[1],
												 $ymd[2] => '/teach/'.$ymd[0].'/'.$ymd[1].'/'.$ymd[2],
												 the_title('','',FALSE) => '');
	}
}
define('BODY_CLASS','teach landing');
$js_includes = array('http://s7.addthis.com/js/152/addthis_widget.js');
include('header.php'); ?>

<div id="main-content">
	<div id="left-main-content">
		<? if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">
				<h2 id="post-<?= the_ID(); ?>"><a href="<? the_permalink(); ?>" rel="bookmark" title="Permanent Link to <? the_title(); ?>"><? the_title() ?></a></h2>
				<p class="byline vcard">By <a href="<? the_author_url(); ?>" title="View Author" class="fn url name"><? the_author() ?></a> | <span class="date"> <? the_date('F j, Y'); ?></span></p>
				<?= the_content(); ?>
				<div class="post-meta">
					<ul>
						<li class="comment-count"><a href="#post-comments"><?= comments_number('No comments', 'One comment', '% comments'); ?></a></li>
						<li class="share-link"><? share_this(get_permalink(), the_title('','',FALSE)); ?></li>
					</ul>
				</div>
			</div>
			<?php comments_template(); ?>
		<?php endwhile; else: ?>
			<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>
	</div>
	<?= app()->partial('sidebar_teach_programs'); ?>
</div>



<div id="main-whitebox-left"></div>
<div id="main-whitebox-right"></div>

<? include('footer.php'); ?>