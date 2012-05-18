<?php
/**
 * Blog Intro Box
 *
 */
if($e404_options['blog_intro_type'] != 'none') : 
	if($e404_options['blog_intro_type'] == 'twitter')
		$e404_options['blog_intro_text'] = '<p>'.$e404_options['blog_intro_text'].'</p>';
?>
	<div id="intro" class="<?php if($e404_options['blog_intro_type'] == 'twitter') echo 'twitter'; else echo 'text'; ?>-intro">
		<?php if(is_singular()) : ?>
			<?php if($e404_options['blog_intro_type'] == 'title') : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<?php rewind_posts(); ?>
			<?php elseif($e404_options['blog_intro_type'] == 'title-excerpt') : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<?php $excerpt = e404_get_excerpt($post, $e404_options['excerpt_length']);
			if($excerpt) : ?>
			<p><?php echo $excerpt; ?></p>
			<?php endif; ?>
			<?php rewind_posts(); ?>
			<?php else : ?>
			<?php echo $e404_options['blog_intro_text']; ?>
			<?php endif; ?>
		<?php else :
			if($e404_options['blog_intro_type'] == 'title' || $e404_options['blog_intro_type'] == 'title-excerpt') {
				the_post();
				if (is_day())
					printf('<h1>'.__('Daily Archives: <span>%s</span>', 'shiny').'</h1>', get_the_date());
				elseif(is_month())
					printf('<h1>'.__('Monthly Archives: <span>%s</span>', 'shiny').'</h1>', get_the_date('F Y'));
				elseif(is_year())
					printf('<h1>'.__('Yearly Archives: <span>%s</span>', 'shiny').'</h1>', get_the_date('Y'));
				elseif(is_tag())
					echo '<h1>'.single_tag_title('', false).'</h1>';
				elseif(is_category()) {
					$category = get_the_category();
					echo '<h1>'.$category[0]->cat_name.'</h1>';
				}
				else {
					$page_data = get_page(get_option('page_for_posts'));
					echo '<h1>'.$page_data->post_title.'</h1>';
				}
			}
			else
				echo $e404_options['blog_intro_text'];
			rewind_posts();
		?>
		<?php endif; ?>
		<hr class="divider divider-bbottom">
	</div>
<?php endif; ?>
