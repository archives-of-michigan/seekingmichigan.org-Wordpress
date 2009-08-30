<?
$breadcrumbs = array('Search' => '');
define("BODY_CLASS","seek");
?>
<? include('header.php'); ?>

<div id="section-header">
	<h1><a href="/seek">Seek</a></h1>
</div>
<div id="main-content">
	<div class="wrapper">
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
			<h2 class="center">No posts found. Try a different search?</h2>
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		<?php endif; ?>
	</div>
</div>
	<? include('footer.php'); ?>