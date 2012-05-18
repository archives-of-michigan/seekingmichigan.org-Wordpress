<?php
/**
 * Template name: Civil War
 *
 */

get_header(); ?>

	
	<div id="wrapper">
	<div id="civilwar-intro">
		<div id="intro" class="text-intro">
		</div>
	</div>
		
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="page-layout">
				<?php the_content(); ?>

				<?php if(!is_attachment() && $e404_options['page_comments']) {
					comments_template('', true);
				} ?>
			</div>
<?php endwhile; ?>
			
			<?php get_template_part('navigation'); ?>

		<br class="clear" />

	</div>

<?php get_footer(); ?>
