<?php
/**
 * Template name: Civil War Events
 *
 */

get_header(); ?>

<div id="wrapper" class="sidebar-right-wrapper">
		<div id="wrapper_inner">
	
	<div id="wrapper">
	<div id="civilwar-intro">
		<div id="intro" class="text-intro">
		</div>
	</div>
	
		<div id="page-content" class="two_third">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php if($e404_options['page_titles']) : ?><h2 class="fancy-header"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2><?php endif; ?>
			<div id="post-<?php the_ID(); ?>" class="page-layout">
				<?php the_content(); ?>

				<?php if(!is_attachment() && $e404_options['page_comments']) {
					comments_template('', true);
				} ?>
			</div>
<?php endwhile; ?>
			
			<?php get_template_part('navigation'); ?>

		</div>
		<div id="sidebar" class="one_third last sidebar-right">
			<?php get_sidebar('page'); ?>
		</div>
		<br class="clear" />
		</div>
	</div>

<?php get_footer(); ?>
