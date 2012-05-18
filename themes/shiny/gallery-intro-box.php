<?php
/**
 * Gallery Intro Box
 *
 */
if($e404_options['gallery_intro_type'] != 'none') :
	if($e404_options['gallery_intro_type'] == 'twitter')
		$e404_options['gallery_intro_text'] = '<p>'.$e404_options['gallery_intro_text'].'</p>';
?>
	<div id="intro" class="<?php if($e404_options['gallery_intro_type'] == 'twitter') echo 'twitter'; else echo 'text'; ?>-intro">
		<?php if($e404_options['gallery_intro_type'] == 'title') : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php rewind_posts(); ?>
		<?php elseif($e404_options['gallery_intro_type'] == 'title-excerpt') : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php $excerpt = e404_get_excerpt($post, $e404_options['excerpt_length']);
		if($excerpt) : ?>
		<p><?php echo $excerpt; ?></p>
		<?php endif; ?>
		<?php rewind_posts(); ?>
		<?php else : ?>
		<?php echo $e404_options['gallery_intro_text']; ?>
		<?php endif; ?>
		<hr class="divider divider-bbottom">
	</div>
<?php endif; ?>
