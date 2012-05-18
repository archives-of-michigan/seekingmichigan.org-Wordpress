<?php
/**
 * Template name: Discover
 *
 */

get_header(); 

?>	
	<div id="wrapper" class="portfolio-sortable">
	
	<?php if($e404_options['portfolio_intro_type'] != 'none' || $e404_options['breadcrumbs']) echo '<div id="head_intro">'; ?>
		<?php include(OF_FILEPATH.'/portfolio-intro-box.php'); ?>
		<?php if($e404_options['breadcrumbs']) : ?><div id="breadcrumb"><?php e404_breadcrumbs(); ?></div><?php endif; ?>
	<?php if($e404_options['portfolio_intro_type'] != 'none' || $e404_options['breadcrumbs']) echo '</div>'; ?>
	
		<div class="nav-wrap">
			<ul id="pcats" class="group">
				<li class="current_page_item_li"><a href="#" rel="all"><?php _e('All', 'shiny'); ?></a></li>
<?php
		$params = 'title_li=&taxonomy=portfolio-category';
		$params .= '&hierarchical=0';
		$categories = get_categories($params);
		
		foreach($categories as $category) {
			?>
			<li><a href="#" rel="<?php echo $category->slug; ?>" class="pcat"><?php echo $category->name; ?></a></li>
			<?php
		}
?>
			</ul>
		</div>
	
		<ul id="items" class="portfolio portfolio-columns">
<?php
$query = "paged=".$paged."&post_type=portfolio&orderby=menu_order date&nopaging=true";
if(isset($taxonomy))
	$query .= "&taxonomy=".$taxonomy;
if(isset($term))
	$query .= "&term=".$term;
$i = 0;
$custom_query = new WP_Query($query);
if($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); $i; $i++;
	$item_categories = get_the_terms($post->ID, 'portfolio-category');
	$cats = '';
	if(is_array($item_categories)) {
		foreach($item_categories as $item_category)
			$cats .= ' '.$item_category->slug;
	}
	?>
<?php
	if($i < 3) { // starts the section for the first two portfolio items
?>
	<div class="one_half<?php if($i % 2 == 0) echo ' last'; ?>">
		<div class="portfolio-item" id="post-<?php the_ID(); ?>">
			<?php
			$preview_url = e404_get_portfolio_preview_url($post->ID);
			if (has_post_thumbnail()) {
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
				$img_shortcode = '[image align="none" title="'.the_title_attribute('echo=0').'" width="428"';
				if(!empty($e404_options['portfolio_thumbnails_height']) && $e404_options['portfolio_thumbnails_height'] > 0)
					$img_shortcode .= ' height="'.$e404_options['portfolio_thumbnails_height'].'"';				else
					$img_shortcode .= ' height="248"';
				$img_shortcode .= ']'.$large_image_url[0].'[/image]';
				echo do_shortcode($img_shortcode);
			} ?>
			<?php if($e404_options['portfolio_titles']) : ?><div class="portfolio_item_header"><h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3></div><?php endif; ?>
			<?php if($e404_options['portfolio_item_categories']) : ?>
			<div class="portfolio-meta">
				<div class="posted-meta"><?php the_terms($post->ID, 'portfolio-category', '', ', '); ?></div>
			</div>
			<?php endif; ?>
						
			<div class="fancy_meta">
				<ul>
					<li><a class="tiptip fancy_icon fancy_details" href="<?php the_permalink(); ?>" title="<?php _e('More Details', 'shiny'); ?>"><?php _e('More Details', 'shiny'); ?></a></li>
					<li><a class="tiptip fancy_icon fancy_preview" rel="prettyphoto" href="<?php echo $preview_url; ?>" title="<?php _e('Preview', 'shiny'); ?>"><?php _e('Preview', 'shiny'); ?></a></li>
			<?php if($e404_all_options['e404_portfolio_like_this'] == 'true') : $like_class = e404_liked($post->ID) ? 'fancy_likes_you_like' : 'fancy_likes'; ?>
					<li><a class="tiptip fancy_icon like_this <?php echo $like_class; ?>" href="#" id="like-<?php the_ID(); ?>" title="<?php echo e404_likes_text(e404_like_this($post->ID), false); ?>"><?php e404_likes_text(e404_like_this($post->ID), false); ?></a></li>
			<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php if($i % 2 == 0) echo '<br class="clear" /> <hr class="divider-dotted">'; ?>
	<?php } else { ?>
				<li class="one_fourth portfolio-item-li<?php if($i % 4 == 0) echo ' last'; echo $cats; ?>" id="post-<?php the_ID(); ?>">
					<div class="portfolio-item">
						<?php
						$preview_url = e404_get_portfolio_preview_url($post->ID);
						if (has_post_thumbnail()) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
							$img_shortcode = '[image align="none" title="'.the_title_attribute('echo=0').'" width="188" height="108"';
							$img_shortcode .= ']'.$large_image_url[0].'[/image]';
							echo do_shortcode($img_shortcode);
						} ?>
						<?php if($e404_options['portfolio_titles']) : ?><div class="portfolio_item_header"><h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3></div><?php endif; ?>
						
						<div class="fancy_meta">
							<ul>
								<li><a class="tiptip fancy_icon fancy_details" href="<?php the_permalink(); ?>" title="<?php _e('More Details', 'shiny'); ?>"><?php _e('More Details', 'shiny'); ?></a></li>
								<li><a class="tiptip fancy_icon fancy_preview" rel="prettyphoto" href="<?php echo $preview_url; ?>" title="<?php _e('Preview', 'shiny'); ?>"><?php _e('Preview', 'shiny'); ?></a></li>
						<?php if($e404_all_options['e404_portfolio_like_this'] == 'true') : $like_class = e404_liked($post->ID) ? 'fancy_likes_you_like' : 'fancy_likes'; ?>
								<li><a class="tiptip fancy_icon like_this <?php echo $like_class; ?>" href="#" id="like-<?php the_ID(); ?>" title="<?php echo e404_likes_text(e404_like_this($post->ID), false); ?>"><?php e404_likes_text(e404_like_this($post->ID), false); ?></a></li>
						<?php endif; ?>
							</ul>
						</div>
					</div>
					<?php the_excerpt(''); ?>
				</li>
	<?php } // ends the section for all portfolio items after the first two
	?>
<?php endwhile; wp_reset_query(); ?>
<?php else :
			_e('Nothing Found', 'shiny');
endif; ?>
			
			<?php get_template_part('navigation', 'portfolio'); ?>

		</div>
		<br class="clear" />
	</div>

<?php get_footer(); ?>
