<?php
/**
 * The main template file.
 *
 */

get_header(); ?>
	
	<div id="wrapper"<?php if($e404_options['blog_layout'] == 'sidebar-left') : ?> class="sidebar-left-wrapper"<?php elseif($e404_options['blog_layout'] == 'sidebar-right') : ?> class="sidebar-right-wrapper"<?php endif; ?>>
		<div id="wrapper_inner">
	
	<?php if($e404_options['blog_intro_type'] != 'none' || $e404_options['breadcrumbs']) echo '<div id="head_intro">'; ?>
		<?php include(OF_FILEPATH.'/blog-intro-box.php'); ?>
		<?php if($e404_options['breadcrumbs']) : ?><div id="breadcrumb"><?php e404_breadcrumbs(); ?></div><?php endif; ?>
	<?php if($e404_options['blog_intro_type'] != 'none' || $e404_options['breadcrumbs']) echo '</div>'; ?>
	
	<?php if($e404_options['blog_layout'] == 'sidebar-left') : ?>
		<div id="sidebar" class="one_third sidebar-left">
	<?php get_sidebar('blog'); ?>
		</div>
	<?php endif; ?>

	<?php if($e404_options['blog_layout'] == 'no-sidebar') : ?>
		<div id="page-content" class="full_page">
	<?php else: ?>
		<div id="page-content" class="two_third<?php if($e404_options['blog_layout'] == 'sidebar-left') echo ' last'; ?>">
	<?php endif; ?>

	<?php
		if (have_posts())
			the_post();
		if (is_day())
			printf('<div class="full_page"><h1 class="page-title">'.__('Daily Archives: <span>%s</span>', 'shiny').'</h1></div>', get_the_date());
		elseif(is_month())
			printf('<div class="full_page"><h1 class="page-title">'.__('Monthly Archives: <span>%s</span>', 'shiny').'</h1></div>', get_the_date('F Y'));
		elseif(is_year())
			printf('<div class="full_page"><h1 class="page-title">'.__('Yearly Archives: <span>%s</span>', 'shiny').'</h1></div>', get_the_date('Y'));
		elseif(is_tag())
			printf('<div class="full_page"><h1 class="page-title">'.__('Tag Archives: <span>%s</span>', 'shiny').'</h1></div>', single_tag_title('', false));
		rewind_posts();
	?>

<?php
while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if(!is_attachment()) : ?>
				<?php
				if (has_post_thumbnail()) {
					$custom_prettyphoto = get_post_meta($post->ID, 'e404_thumbnail_prettyphoto', true);
					if($custom_prettyphoto === false || empty($custom_prettyphoto) || $custom_prettyphoto == 'default')
						$custom_prettyphoto = $e404_options['blog_thumbnails_prettyphoto'];
					else
						$custom_prettyphoto = ($custom_prettyphoto == 'true') ? true : false;
					if($e404_options['blog_layout'] == 'no-sidebar')
						$custom_size = 'full';
					else
						$custom_size = 'huge';
					$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
					$img_shortcode = '<div class="thumbnail_wrapper">[image align="center" title="'.the_title_attribute('echo=0').'" size="'.$custom_size.'"';
					if($custom_prettyphoto)
						$img_shortcode .= ' lightbox="true"';
					else
						$img_shortcode .= ' href="'.get_permalink().'"';
					if(!empty($e404_options['blog_thumbnails_height']) && $e404_options['blog_thumbnails_height'] > 0)
						$img_shortcode .= ' height="'.$e404_options['blog_thumbnails_height'].'"';
					$img_shortcode .= ']'.$large_image_url[0].'[/image]</div>';
					echo do_shortcode($img_shortcode);
				}
				?>
				<div class="post-header">
					<div class="meta-date">
					   	<span class="meta-month"><?php the_time('M'); ?></span>
						<span class="meta-day"><?php the_time('d'); ?></span>
						<span class="meta-year"><?php the_time('Y'); ?></span>
					 </div>
					 <div class="post-meta light-box">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<div class="meta posted-meta">
							<?php if($e404_options['blog_post_author']) { echo '<span class="blog-author">', the_author_link(), '</span> '; } ?>
							<?php if($e404_options['blog_post_categories']) { echo '<span class="blog-categories">', the_category(', '), '</span> '; } ?>
							<?php if(!is_attachment() && comments_open($post->ID)) : ?><span class="blog-comments"><a href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a></span><?php endif; ?>
						<?php if($e404_all_options['e404_blog_like_this'] == 'true') : $like_class = e404_liked($post->ID) ? ' fancy_likes_you_like' : ''; ?>
							<span class="blog-likes"><a href="#" id="like-<?php the_ID(); ?>" class="like_this<?php echo $like_class; ?>" title="<?php echo e404_likes_text(e404_like_this($post->ID), false); ?>"><?php echo e404_like_this($post->ID); ?></a></span>
						<?php endif; ?>
							<?php edit_post_link(__('Edit', 'shiny'), '<span class="edit-link">', '</span>'); ?>
						</div>
						<br class="clear" />
					</div>
				</div>
				<div class="post_wrapper light-box">
			<?php endif; ?>
			<?php
			if($e404_options['blog_use_thumbnail'] && !is_single()) {
				if($e404_options['blog_use_excerpt']) the_excerpt(); else the_content(''); 
			}
			else {
				if($e404_options['blog_use_excerpt'] && !is_single()) the_excerpt(); else the_content(''); 
				?>
				<br class="clear" />
				<?php
			}
			?>

			<?php if(!is_single() && $e404_options['blog_read_more']) : ?>
				<p class="more"><span><a href="<?php the_permalink(); ?>"><?php echo($e404_options['blog_read_more_text']); ?></a></span></p>
			<?php endif; ?>
			
			<?php if(is_single() && $e404_options['blog_post_tags']) : ?><div class="meta tags-meta"><?php the_tags('', ' '); ?></div><?php endif; ?>
			</div>
			
				</div>

			<?php if(is_single() && !is_attachment() && $e404_options['blog_share_it']) : ?>
				<div class="share-this">
					<?php e404_share_this(); ?>
				</div>
			<?php endif; ?>
				
			<?php if(is_single() && $e404_options['blog_author_bio'] && !is_attachment()) : ?>
				<?php $user = get_user_by('id', $post->post_author);
				if($user->description) : ?>
				<h3><?php _e('About the Author', 'shiny'); ?></h3>
				<div id="post-author" class="light-box">
					<div class="border-img alignleft"><?php echo get_avatar($post->post_author, 80, OF_DIRECTORY.'/images/avatar.png'); ?></div>
					<div class="author-desc">
						<h4><?php _e('Written by', 'shiny'); ?> <?php echo the_author_link(); ?></h4>
						<p><?php echo $user->description; ?></p>
					</div>
					<br class="clear" />
				</div>
				<?php endif; ?>
			<?php endif; ?>

				<?php if(is_single() && !is_attachment() && comments_open($post->ID)) {
					comments_template( '', true );
				} ?>
<?php endwhile; ?>
			
			<?php get_template_part('navigation'); ?>

		</div>
	<?php if($e404_options['blog_layout'] == 'sidebar-right') : ?>
		<div id="sidebar" class="one_third last sidebar-right">
	<?php get_sidebar('blog'); ?>
		</div>
	<?php endif; ?>
		<br class="clear" />
		</div>
	</div>

<?php get_footer(); ?>
