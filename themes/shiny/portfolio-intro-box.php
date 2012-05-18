<?php
/**
 * Portfolio Intro Box
 *
 */
if($e404_options['portfolio_intro_type'] != 'none') :
	if($e404_options['portfolio_intro_type'] == 'twitter')
		$e404_options['portfolio_intro_text'] = '<p>'.$e404_options['portfolio_intro_text'].'</p>';
?>
	<div id="intro" class="<?php if($e404_options['portfolio_intro_type'] == 'twitter') echo 'twitter'; else echo 'text'; ?>-intro">
		<?php if($e404_options['portfolio_intro_type'] == 'title') : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php rewind_posts(); ?>
		<?php elseif($e404_options['portfolio_intro_type'] == 'title-excerpt') : the_post(); ?>
		<?php
		if(is_tax()) {
			$obj = $wp_query->get_queried_object();
			echo '<h1>'.$obj->name.'</h1>';
		} else { ?>
			<h1><?php the_title(); ?></h1>
			<?php $excerpt = e404_get_excerpt($post, $e404_options['excerpt_length']);
			if($excerpt) : ?>
			<p><?php echo $excerpt; ?></p>
			<?php endif;
		}
		rewind_posts(); ?>
		<?php else : ?>
		<?php echo $e404_options['portfolio_intro_text']; ?>
		<?php endif; ?>
		<hr class="divider divider-bbottom">
	</div>
<?php endif; ?>
