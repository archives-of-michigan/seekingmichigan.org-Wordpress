<?php
/**
 * Theme Header
 *
 */

global $e404_options;
if($post) {
	$e404_options['post_id'] = $post->ID;
	$e404_options['post_parent'] = $post->post_parent;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
</head>

<body
<?php if(substr(e404_get_current_template(), 0, 9) == 'home-page') {
	echo ' class="body_slider"';
} elseif(substr(e404_get_current_template(), 0, 9) == 'civil-war') {
	echo ' class="civilwar"';
} elseif(substr(e404_get_current_template(), 0, 5) == 'teach') {
	echo ' class="teach"';
} elseif(is_category( '2101' )) {
	echo ' class="civilwar"';
}
?>>

<?php do_action('after_body'); ?>
<div id="main_wrapper">
<div id="header_wrapper">
	<div id="header_bar_wrapper">
		<div id="header_bar">
			<div id="header_bar_inner">
				<?php if(!$e404_options['remove_top_contact_box']) : ?>
				<div id="header_info" class="leftside">
					<?php echo $e404_options['top_contact_box']; ?>
				</div>
				<?php endif; ?>
				
				<div id="social_icons" class="leftside">
					<?php e404_show_header_social_icons(); ?>
				</div>
			
				<div class="rightside">
					<?php if(!$e404_options['remove_search_form']) : ?>
					<div id="search" class="leftside">
						<form action="<?php echo home_url(); ?>" method="get">
							<input type="text" name="s" value="<?php _e('Search...', 'shiny'); ?>" onfocus="if (this.value == '<?php _e('Search...', 'shiny'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search...', 'shiny'); ?>';}" />
							<input type="submit" value="<?php _e('Go', 'lunar'); ?>" />
						</form>
					</div>
					<?php endif; ?>
				</div>
				<br class="clear" />
			</div>
		</div>
	</div>


</div>
<div id="header">
	<div id="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo $e404_options['logo_url']; ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" /></a></div>
	<div id="navigation" class="rightside">
		<?php wp_nav_menu(array('theme_location' => 'header-menu', 'container' => false, 'menu_class' => 'sf-menu', 'link_before' => '<span class="menu-btn">', 'link_after' => '</span>')); ?>
		<br class="clear" />
	</div>
	<br class="clear" />
</div>
