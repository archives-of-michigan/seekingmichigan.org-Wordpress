<?php
/**
 * Template Name: Home Page
 *
 */

get_header();

?>


<?php if($e404_options['home_slider']) : ?>
	<div id="featured">
		<div id="featured_border">
			<div id="featured_inner">
				<?php e404_show_slider(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<div id="content_wrapper">
<div id="wrapper">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; ?>

</div>

<?php get_footer(); ?>
