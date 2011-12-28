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

<?= app()->partial('teach_search'); ?>

<div id="main-content">
	<div id="left-main-content">
		<? if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">
			       	<h2 id="post-<?= the_ID(); ?>"><a href="<? the_permalink(); ?>" rel="bookmark" title="Permanent Link to <? the_title(); ?>"><? the_title() ?></a></h2>
				<?= the_content(); ?>
				<div class="program-info">
					<ul>
					<li class="share-link"><a class="addthis" href="http://www.addthis.com/bookmark.php" rel="" title="">Share This</a></li>
					<?php if( get_post_meta($post->ID, 'registration', true)) : ?>
						<li class="registration"><a href="<?php echo get_post_meta($post->ID, 'registration', true); ?>"><span class="hidden">Register</span></a></li>
					<?php endif; ?>
					</ul>
				</div>
				<div class="post-meta">
					<ul>
						<li class="rating"><span class="hidden">Rate This</span></li>
					</ul>
				</div>
			</div>
			<?php comments_template(); ?>
		<?php endwhile; else: ?>
			<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>
	</div>
	<?= app()->partial('sidebar_teach_events'); ?>
</div>


<div id="main-whitebox-left"></div>
<div id="main-whitebox-right"></div>

<? include('footer.php'); ?>
