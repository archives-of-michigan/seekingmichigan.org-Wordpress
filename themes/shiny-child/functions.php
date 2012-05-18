<?php
if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_template_directory_uri());
} else {
	define('OF_FILEPATH', STYLESHEETPATH);
	define('OF_DIRECTORY', get_stylesheet_directory_uri());
}

if(!isset($content_width))
	$content_width = 930;

load_theme_textdomain('shiny', OF_FILEPATH.'/languages/');

require_once(OF_FILEPATH.'/inc/theme-defaults.php');
require_once(OF_FILEPATH.'/inc/dashboard-widget.php');

require_once(OF_FILEPATH.'/admin/admin-functions.php');
require_once(OF_FILEPATH.'/admin/admin-interface.php');

require_once(OF_FILEPATH.'/inc/custom-sidebars.php');
require_once(OF_FILEPATH.'/inc/custom-post-types.php');

if(is_admin())
	require_once (OF_FILEPATH.'/admin/theme-options.php');
require_once (OF_FILEPATH.'/admin/theme-functions.php');

require_once(OF_FILEPATH.'/inc/shortcodes.php');
require_once(OF_FILEPATH.'/inc/tools.php');
require_once(OF_FILEPATH.'/inc/widgets.php');

require_once(OF_FILEPATH.'/inc/theme-options.php');

require_once(OF_FILEPATH.'/inc/meta-boxes.php');

require_once(OF_FILEPATH.'/inc/shortcode-manager.php');

// theme settings
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');

// register sidebars
register_sidebar(array(	'id' => 'e404_blog_sidebar',
						'name' => 'Blog Sidebar',
						'before_widget' => '<div id="%1$s" class="widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

register_sidebar(array(	'id' => 'e404_page_sidebar',
						'name' => 'Page Sidebar',
						'before_widget' => '<div id="%1$s" class="widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

register_sidebar(array(	'id' => 'e404_portfolio_sidebar',
						'name' => 'Portfolio Sidebar',
						'before_widget' => '<div id="%1$s" class="widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

register_sidebar(array(	'id' => 'e404_gallery_sidebar',
						'name' => 'Gallery Sidebar',
						'before_widget' => '<div id="%1$s" class="widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

register_sidebar(array(	'id' => 'e404_civilwar_sidebar',
						'name' => 'Civil War Sidebar',
						'before_widget' => '<div id="%1$s" class="widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

if($e404_all_options['e404_footer_columns'] == '1')
	$footer_class = 'full_page';
elseif($e404_all_options['e404_footer_columns'] == '2')
	$footer_class = 'one_half';
elseif($e404_all_options['e404_footer_columns'] == '3')
	$footer_class = 'one_third';
elseif($e404_all_options['e404_footer_columns'] == '4')
	$footer_class = 'one_fourth';
else
	$footer_class = 'one_fourth';

register_sidebar(array(	'id' => 'e404_footer_sidebar',
						'name' => 'Footer Sidebar',
						'before_widget' => '<div id="%1$s" class="'.$footer_class.' widgets %2$s">',
						'after_widget' => "</div>\n",
						'before_title' => '<h3>',
						'after_title' => "</h3>\n"));

// register menus
function e404_register_menus() {
	register_nav_menus(array('header-menu' => __('Header Menu', 'shiny')));
	register_nav_menus(array('footer-menu' => __('Footer Menu', 'shiny')));
}
add_action('init', 'e404_register_menus');

if(!is_admin()) {
	add_action('wp_header', 'e404_custom_colors_css');
	
	require_once(OF_FILEPATH.'/inc/tweaks.php');
	require_once(OF_FILEPATH.'/inc/sliders.php');

	add_action('init', 'e404_enqueue_scripts_and_styles');

	function e404_enqueue_scripts_and_styles() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('preloader', OF_DIRECTORY.'/js/preloader.js');
	
		$disabled = get_option('e404_disable_galleria');
		if($disabled != 'true') {
			wp_enqueue_script('galleria', OF_DIRECTORY.'/js/galleria.min.js', '', '', true);
			wp_enqueue_script('galleria-classic', OF_DIRECTORY.'/js/galleria.classic.min.js', '', '', true);
			wp_enqueue_style('galleria', OF_DIRECTORY.'/css/galleria.classic.css');
		}
	
		$disabled = get_option('e404_disable_video_shortcode');
		if($disabled != 'true') {
			wp_enqueue_script('flowplayer', OF_DIRECTORY.'/js/flowplayer.min.js', '', '', true);
		}
	
		// menu 
		wp_enqueue_script('hoverintent', OF_DIRECTORY.'/js/hoverIntent.js');
		wp_enqueue_script('superfish', OF_DIRECTORY.'/js/superfish.js');
		wp_enqueue_style('superfish', OF_DIRECTORY.'/css/menu.css');
	
		// tipsy 
		wp_enqueue_script('tipsy', OF_DIRECTORY.'/js/jquery.tipsy.js', '', '', true);
		wp_enqueue_style('tipsy', OF_DIRECTORY.'/css/tipsy.css');
		
		// sortable portfolio
		function e404_sortable_scripts() {
			$sortable_templates = array('portfolio-3columns-sortable.php', 'portfolio-4columns-sortable.php');
			if(in_array(e404_get_current_template(), $sortable_templates)) {
				wp_enqueue_script('quicksand', OF_DIRECTORY.'/js/jquery.quicksand.js', '', '', true);
				wp_enqueue_script('sortable', OF_DIRECTORY.'/js/sortable.js', '', '', true);
			}
		}
		add_action('get_header', 'e404_sortable_scripts');
	
		// scrollable
		$disabled = get_option('e404_disable_scrollable');
		if($disabled != 'true') {
			wp_enqueue_script('scrollable', OF_DIRECTORY.'/js/scrollable.min.js');
			wp_enqueue_style('scrollable', OF_DIRECTORY.'/css/scrollable.css');
		}
	
		// Nivo shortcode
		$disabled = get_option('e404_disable_nivo');
		if($disabled != 'true') {
			wp_enqueue_script('nivo', OF_DIRECTORY.'/js/jquery.nivo.slider.pack.js', '', '', true);
			wp_enqueue_style('nivo', OF_DIRECTORY.'/css/nivo-slider.css');
		}	
	
		wp_enqueue_script('prettyphoto', OF_DIRECTORY.'/js/jquery.prettyphoto.js');
		wp_enqueue_script('prettyphoto-init', OF_DIRECTORY.'/js/prettyphoto_init.js');
		wp_enqueue_style('prettyphoto', OF_DIRECTORY.'/css/prettyphoto.css');
	
		// custom JS scripts
		wp_enqueue_script('shiny-custom', OF_DIRECTORY.'/js/shiny_custom.js', '', '', true);
	}
	
	$gwf = get_option('e404_google_web_fonts');
	if($gwf == 'true') {
		add_action('init', 'e404_google_web_fonts');
		add_action('wp_head', 'e404_google_web_fonts_css');
	}
}

// add Google Web Fonts scripts to page header
function e404_google_web_fonts() {
	$gwf_fonts[] = $gwf['body,.icon-box span,.icon-button span'] = get_option('e404_gwf_body');
	$gwf_fonts[] = $gwf['h1'] = get_option('e404_gwf_h1');
	$gwf_fonts[] = $gwf['h2'] = get_option('e404_gwf_h2');
	$gwf_fonts[] = $gwf['h3'] = get_option('e404_gwf_h3');
	$gwf_fonts[] = $gwf['h4'] = get_option('e404_gwf_h4');
	$gwf_fonts[] = $gwf['h5'] = get_option('e404_gwf_h5');
	$gwf_fonts[] = $gwf['h6'] = get_option('e404_gwf_h6');
	$gwf_fonts[] = $gwf['p'] = get_option('e404_gwf_p');
	$gwf_fonts[] = $gwf['blockquote'] = get_option('e404_gwf_blockquote');
	$gwf_fonts[] = $gwf['li'] = get_option('e404_gwf_li');
	$gwf_fonts[] = $gwf['.sf-menu li'] = get_option('e404_gwf_menu');
	$gwf_fonts[] = $gwf['.sf-menu li li'] = get_option('e404_gwf_submenu');
	
	$gwf_fonts = array_unique($gwf_fonts);
	wp_cache_add('e404_gwf', $gwf);
	foreach($gwf_fonts as $font) {
		if($font != '') {
			wp_enqueue_style(str_replace(array(':', '+'), '-', $font), 'http://fonts.googleapis.com/css?family='.$font);
		}
	}
}

// generate Google Web Fonts custom CSS
function e404_google_web_fonts_css() {
	$output = '<style type="text/css">';
	$gwf = wp_cache_get('e404_gwf');
	foreach($gwf as $tag => $font) {
		if($font != '') {
			$font = explode(':', $font);
			$output .= $tag." { font-family: '".str_replace('+', ' ', $font[0])."', arial, serif; }\n";
		}
	}
	$output .= '</style>';
	echo $output;
}

// generate custom colors CSS
function e404_custom_colors_css() {
	global $e404_all_options, $background_textures, $header_pictures;
	
	$css = '<style type="text/css">'."\n";

	if(!empty($e404_all_options['e404_custom_background_texture'])) {
		$css .= "html {\n";
		$css .= "    background-image: url('".$e404_all_options['e404_custom_background_texture']."');\n";
		$css .= "    background-repeat: repeat;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_background_texture'])) {
		$css .= "html  {\n";
		$css .= "    background-image: url('".str_replace('/mini', '', $background_textures[$e404_all_options['e404_background_texture']])."');\n";
		$css .= "    background-repeat: repeat;\n";
		$css .= "}\n";
	}

	if(!empty($e404_all_options['e404_custom_header_texture'])) {
		$css .= "#header_wrapper, .body_slider #header_wrapper {\n";
		$css .= "    background-image: url('".$e404_all_options['e404_custom_header_texture']."');\n";
		$css .= "    background-repeat: repeat;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_header_texture'])) {
		$css .= "#header_wrapper, .body_slider #header_wrapper  {\n";
		$css .= "    background-image: url('".str_replace('/mini', '', $background_textures[$e404_all_options['e404_header_texture']])."');\n";
		$css .= "    background-repeat: repeat;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_custom_header_picture'])) {
		$css .= "#header_wrapper, .body_slider #header_wrapper {\n";
		$css .= "    background-image: url('".$e404_all_options['e404_custom_header_picture']."');\n";
		$css .= "    background-repeat: no-repeat;\n";
		$css .= "    background-position: 50% 0;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_header_picture'])) {
		$css .= "#header_wrapper, .body_slider #header_wrapper  {\n";
		$css .= "    background-image: url('".str_replace('/mini', '', $header_pictures[$e404_all_options['e404_header_picture']])."');\n";
		$css .= "    background-repeat: no-repeat;\n";
		$css .= "    background-position: 50% 0;\n";
		$css .= "}\n";
	}

	if(!empty($e404_all_options['e404_custom_header_texture_home'])) {
		$css .= ".body_slider #header_wrapper {\n";
		$css .= "    background-image: url('".$e404_all_options['e404_custom_header_texture_home']."');\n";
		$css .= "    background-repeat: repeat;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_header_texture_home'])) {
		$css .= ".body_slider #header_wrapper  {\n";
		$css .= "    background-image: url('".str_replace('/mini', '', $background_textures[$e404_all_options['e404_header_texture_home']])."');\n";
		$css .= "    background-repeat: repeat;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_custom_header_picture_home'])) {
		$css .= ".body_slider #header_wrapper {\n";
		$css .= "    background-image: url('".$e404_all_options['e404_custom_header_picture_home']."');\n";
		$css .= "    background-repeat: no-repeat;\n";
		$css .= "    background-position: 50% 0;\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_header_picture_home'])) {
		$css .= ".body_slider #header_wrapper  {\n";
		$css .= "    background-image: url('".str_replace('/mini', '', $header_pictures[$e404_all_options['e404_header_picture_home']])."');\n";
		$css .= "    background-repeat: no-repeat;\n";
		$css .= "    background-position: 50% 0;\n";
		$css .= "}\n";
	}

	if(!empty($e404_all_options['e404_custom_header_bar_background_image'])) {
		$css .= "#header_bar_wrapper {\n";
		$css .= "    background-image: url('".$e404_all_options['e404_custom_header_bar_background_image']."');\n";
		$css .= "}\n";
	}
	elseif(!empty($e404_all_options['e404_header_bar_background_image'])) {
		$css .= "#header_bar_wrapper  {\n";
		$css .= "    background-image: url('".str_replace('/mini', '', $background_textures[$e404_all_options['e404_header_bar_background_image']])."');\n";
		$css .= "}\n";
	}

	if(!empty($e404_all_options['e404_header_bar_style'])) {
		$css .= "#header_bar {\n";
		if($e404_all_options['e404_header_bar_style'] == 'none')
			$css .= "    background-image: none;\n";
		else
			$css .= "    background-image: url('".OF_DIRECTORY."/images/".$e404_all_options['e404_header_bar_style'].".png');\n";
		$css .= "}\n";
	}
	
	if($e404_all_options['e404_footer_effect'] == 'none') {
		$css .= "#footer  {\n";
		$css .= "    background-image: none;\n";
		$css .= "}\n";
	}
	elseif($e404_all_options['e404_footer_effect'] == 'light') {
		$css .= "#footer  {\n";
		$css .= "    background-image: url('".OF_DIRECTORY."/images/light-footer.png');\n";
		$css .= "    background-repeat: no-repeat;\n";
		$css .= "    background-position: 50% 100%;\n";
		$css .= "}\n";
	}

	if(!empty($e404_all_options['e404_showcase_thumbnails_background'])) {
		$css .= ".showcase-thumbnail-container {\n    background-color: ".$e404_all_options['e404_showcase_thumbnails_background'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_showcase_tooltips_text'])) {
		$css .= ".showcase-tooltip {\n    color: ".$e404_all_options['e404_showcase_tooltips_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_showcase_tooltips_background'])) {
		$css .= ".showcase-tooltip {\n    background-color: ".$e404_all_options['e404_showcase_tooltips_background'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_liteaccordion_title_text_color'])) {
		$css .= ".accordion .slide > h2 {\n    color: ".$e404_all_options['e404_liteaccordion_title_text_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_liteaccordion_title_background_color'])) {
		$css .= ".accordion .slide > h2 {\n    background-color: ".$e404_all_options['e404_liteaccordion_title_background_color'].";\n}\n";
	}

	if($e404_all_options['e404_custom_style'] != 'true') {
		$css .= "</style>\n";
		echo $css;
		return;
	}

	if(!empty($e404_all_options['e404_color_background'])) {
		$css .= "html {\n    background-color: ".$e404_all_options['e404_color_background'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_main'])) {
		$css .= "html, body, form {\n    color: ".$e404_all_options['e404_color_main'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_forms'])) {
		$css .= "input, textarea, button, select, option {\n    color: ".$e404_all_options['e404_color_forms'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_links'])) {
		$css .= "a, .icon-box span a, .icon-button span a {\n    color: ".$e404_all_options['e404_color_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_links_hover'])) {
		$css .= "a:hover, .icon-box span a:hover, .icon-button span a:hover {\n    color: ".$e404_all_options['e404_color_links_hover'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_headers'])) {
		$css .= "h1, h2, h3, h4, h5, h6 {\n    color: ".$e404_all_options['e404_color_headers'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_headers_links'])) {
		$css .= "h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {\n    color: ".$e404_all_options['e404_color_headers_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_headers_links_hover'])) {
		$css .= "h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {\n    color: ".$e404_all_options['e404_color_headers_links_hover'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_code'])) {
		$css .= "code {\n    color: ".$e404_all_options['e404_color_code'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_blockquote'])) {
		$css .= "blockquote {\n    color: ".$e404_all_options['e404_color_blockquote'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_intro'])) {
		$css .= "#intro, .slogan {\n    color: ".$e404_all_options['e404_color_intro'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_intro_strong'])) {
		$css .= "#intro strong, .slogan strong {\n    color: ".$e404_all_options['e404_color_intro_strong'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_intro_links'])) {
		$css .= "#intro a, .slogan a {\n    color: ".$e404_all_options['e404_color_intro_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_footer'])) {
		$css .= "#footer, #footer form {\n    color: ".$e404_all_options['e404_color_footer'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_footer_links'])) {
		$css .= "#footer a {\n    color: ".$e404_all_options['e404_color_footer_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_footer_headers'])) {
		$css .= "#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6 {\n    color: ".$e404_all_options['e404_color_footer_headers'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_background_footer']) || !empty($e404_all_options['e404_top_line_footer'])) {
		$css .= "#footer_wrapper {\n";
		if(!empty($e404_all_options['e404_background_footer']))
			$css .= "    background-color: ".$e404_all_options['e404_background_footer'].";\n";
		if(!empty($e404_all_options['e404_top_line_footer']))
			$css .= "    border-top-color: ".$e404_all_options['e404_top_line_footer'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_nav_divider_footer'])) {
		$css .= "#footer_nav li {\n    border-right-color: ".$e404_all_options['e404_nav_divider_footer'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_footer_header_lines'])) {
		$css .= "#footer h3 {\n    background-image: url('".OF_DIRECTORY.'/'.$e404_all_options['e404_footer_header_lines']."');\n}\n";
	}
	if(!empty($e404_all_options['e404_color_copyright_text'])) {
		$css .= "#copyright {\n    color: ".$e404_all_options['e404_color_copyright_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_color_copyright_links'])) {
		$css .= "#copyright a {\n    color: ".$e404_all_options['e404_color_copyright_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_submit_background']) || !empty($e404_all_options['e404_submit_text'])) {
		$css .= "form input[type=\"submit\"] {\n";
		if(!empty($e404_all_options['e404_submit_background']))
			$css .= "    background-color: ".$e404_all_options['e404_submit_background'].";\n";
		if(!empty($e404_all_options['e404_submit_text']))
			$css .= "    color: ".$e404_all_options['e404_submit_text'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_submit_background_footer']) || !empty($e404_all_options['e404_submit_text_footer'])) {
		$css .= "#footer form input[type=\"submit\"] {\n";
		if(!empty($e404_all_options['e404_submit_background_footer']))
			$css .= "    background-color: ".$e404_all_options['e404_submit_background_footer'].";\n";
		if(!empty($e404_all_options['e404_submit_text_footer']))
			$css .= "    color: ".$e404_all_options['e404_submit_text_footer'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_menu_links'])) {
		$css .= ".sf-menu a {\n    color: ".$e404_all_options['e404_menu_links']."; }\n";
	}
	if(!empty($e404_all_options['e404_menu_current_text']) || !empty($e404_all_options['e404_menu_current_background'])) {
		$css .= ".sf-menu li:hover a, .sf-menu li.current-menu-item a, .sf-menu li.current-page-parent a, .sf-menu li.current-page-ancestor a, .sf-menu li.current_page_parent a {\n";
		if(!empty($e404_all_options['e404_menu_current_text']))
			$css .= "    color: ".$e404_all_options['e404_menu_current_text'].";\n";
		if(!empty($e404_all_options['e404_menu_current_background']))
			$css .= "    background-color: ".$e404_all_options['e404_menu_current_background'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_menu_current_border_bottom'])) {
		$css .= ".sf-menu li:hover li a:hover, .sf-menu li li.current-menu-item a {\n    background: ".$e404_all_options['e404_menu_current_border_bottom'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_menu_submenu_background'])) {
		$bgcolor = hex2RGB($e404_all_options['e404_menu_submenu_background']);
		$bgopacity = $e404_all_options['e404_menu_submenu_background_opacity'] / 100;
		$css .= ".sf-menu li ul {\n    background: rgb(".$bgcolor.");\n    background: rgba(".$bgcolor.", ".$bgopacity.");\n}\n";
	}
	if(!empty($e404_all_options['e404_menu_submenu_links'])) {
		$css .= ".sf-menu li:hover li a, .sf-menu li li a, .sf-menu li.current-menu-item li a, .sf-menu li.current-page-parent li a, .sf-menu li.current-page-ancestor li a, .sf-menu li.current-menu-parent li a, .sf-menu li.current-menu-ancestor li a {\n    color: ".$e404_all_options['e404_menu_submenu_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_menu_submenu_hover']) || !empty($e404_all_options['e404_menu_submenu_hover_background'])) {
		$css .= ".sf-menu li:hover li a:hover, .sf-menu li li.current-menu-item a {\n";
		if(!empty($e404_all_options['e404_menu_submenu_hover']))
			$css .= "    color: ".$e404_all_options['e404_menu_submenu_hover'].";\n";
		if(!empty($e404_all_options['e404_menu_submenu_hover_background']))
			$css .= "    background: ".$e404_all_options['e404_menu_submenu_hover_background'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_pricebox_featured_border'])) {
		$css .= ".featured-box {\n    border-color: ".$e404_all_options['e404_pricebox_featured_border']." !important;\n}\n";
	}
	if(!empty($e404_all_options['e404_pricebox_featured_price'])) {
		$css .= ".featured-box strong {\n    color: ".$e404_all_options['e404_pricebox_featured_price']." !important;\n}\n";
	}
	if(!empty($e404_all_options['e404_pricebox_border_hover'])) {
		$css .= ".pricebox:hover, .featured-box:hover {\n    border-color: ".$e404_all_options['e404_pricebox_border_hover']." !important;\n}\n";
	}
	if(!empty($e404_all_options['e404_pricebox_header_text_hover'])) {
		$css .= ".pricebox:hover h3, #wrapper .featured-box:hover h3 {\n    background-color: ".$e404_all_options['e404_pricebox_header_text_hover']." !important;\n}\n";
	}
	if(!empty($e404_all_options['e404_pricebox_header_background_hover'])) {
		$css .= ".pricebox:hover strong, #wrapper .featured-box:hover strong  {\n    color: ".$e404_all_options['e404_pricebox_header_background_hover']." !important;\n}\n";
	}
	if(!empty($e404_all_options['e404_pricebox_featured_header_text']) || !empty($e404_all_options['e404_pricebox_featured_header_background'])) {
		$css .= ".featured-box h3 {\n";
		if(!empty($e404_all_options['e404_pricebox_featured_header_text']))
			$css .= "    color: ".$e404_all_options['e404_pricebox_featured_header_text']." !important;\n";
		if(!empty($e404_all_options['e404_pricebox_featured_header_background']))
			$css .= "    background: ".$e404_all_options['e404_pricebox_featured_header_background']." !important;\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_color_slider_title']) || !empty($e404_all_options['e404_color_slider_title_background'])) {
		$css .= ".nivo-caption, .kwicks.horizontal p.title {\n";
		if(!empty($e404_all_options['e404_color_slider_title']))
			$css .= "    color: ".$e404_all_options['e404_color_slider_title']." !important;\n";
		if(!empty($e404_all_options['e404_color_slider_title_background']))
			$css .= "    background: ".$e404_all_options['e404_color_slider_title_background']." !important;\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_breadcrumbs_text'])) {
		$css .= "#breadcrumb {\n    color: ".$e404_all_options['e404_breadcrumbs_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_breadcrumbs_links'])) {
		$css .= "#breadcrumb a {\n    color: ".$e404_all_options['e404_breadcrumbs_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_twitter_box_text'])) {
		$css .= ".twitter-box {\n    color: ".$e404_all_options['e404_twitter_box_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_twitter_box_background'])) {
		$css .= ".twitter-box {\n    background: ".$e404_all_options['e404_twitter_box_background'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_twitter_box_links'])) {
		$css .= ".twitter-box a {\n    color: ".$e404_all_options['e404_twitter_box_links'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_header_contact_text'])) {
		$css .= "#header_info {\n    color: ".$e404_all_options['e404_header_contact_text'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_header_contact_text_strong'])) {
		$css .= "#header_info strong {\n    color: ".$e404_all_options['e404_header_contact_text_strong'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_header_contact_text_span'])) {
		$css .= "#header_info span {\n    color: ".$e404_all_options['e404_header_contact_text_span'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_header_bar_background']) || !empty($e404_all_options['e404_header_bar_bottom_line'])) {
		$css .= "#header_bar_wrapper {\n";
		if(!empty($e404_all_options['e404_header_bar_background']))
			$css .= "    background-color: ".$e404_all_options['e404_header_bar_background'].";\n";
		if(!empty($e404_all_options['e404_header_bar_bottom_line']))
			$css .= "    border-bottom-color: ".$e404_all_options['e404_header_bar_bottom_line'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_portfolio_nav_color'])) {
		$css .= ".current_page_item_li a, #pcats li a:hover {\n    color: ".$e404_all_options['e404_portfolio_nav_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_portfolio_nav_underline'])) {
		$css .= "#magic-line {\n    background: ".$e404_all_options['e404_portfolio_nav_underline'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_horizontal_lines'])) {
		$css .= "#sidebar h3, .widgets h3, .fancy-header, .divider-dotted, .fancy_list, .portfolio .tags-meta, .price-body .dotted, #wrapper .latest-comments li, #wrapper .post-list li {\n    background-image: url('".OF_DIRECTORY.'/'.$e404_all_options['e404_horizontal_lines']."');\n}\n";
	}
	if(!empty($e404_all_options['e404_dividers_color'])) {
		$css .= "hr, .divider-top, .divider-full, blockquote, .comment-text, .person-text {\n    border-color: ".$e404_all_options['e404_dividers_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_go_to_top_color'])) {
		$css .= ".divider-top a {\n    color: ".$e404_all_options['e404_go_to_top_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_go_to_top_hover_color'])) {
		$css .= ".divider-top a:hover {\n    color: ".$e404_all_options['e404_go_to_top_hover_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_blog_text_color'])) {
		$css .= ".light-box {\n    color: ".$e404_all_options['e404_blog_text_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_blog_links_color'])) {
		$css .= ".light-box a {\n    color: ".$e404_all_options['e404_blog_links_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_blog_links_hover_color'])) {
		$css .= ".light-box a:hover {\n    color: ".$e404_all_options['e404_blog_links_hover_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_blog_headers_color'])) {
		$css .= ".light-box h1, .light-box h2, .light-box h3, .light-box h4, .light-box h5, .light-box h6, .post-header h2 {\n    color: ".$e404_all_options['e404_blog_headers_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_blog_headers_links_color'])) {
		$css .= ".light-box h1 a, .light-box h2 a, .light-box h3 a, .light-box h4 a, .light-box h5 a, .light-box h6 a, .post-header h2 a {\n    color: ".$e404_all_options['e404_blog_headers_links_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_blog_headers_links_hover_color'])) {
		$css .= ".light-box h1 a:hover, .light-box h2 a:hover, .light-box h3 a:hover, .light-box h4 a:hover, .light-box h5 a:hover, .light-box h6 a:hover, .post-header h2 a:hover {\n    color: ".$e404_all_options['e404_blog_headers_links_hover_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_tabs_current_color']) || !empty($e404_all_options['e404_tabs_current_background_color']) || !empty($e404_all_options['e404_tabs_current_border_color'])) {
		$css .= ".tabs li.current a {\n";
		if(!empty($e404_all_options['e404_tabs_current_color']))
			$css .= "    color: ".$e404_all_options['e404_tabs_current_color'].";\n";
		if(!empty($e404_all_options['e404_tabs_current_background_color']))
			$css .= "    background-color: ".$e404_all_options['e404_tabs_current_background_color'].";\n";
		if(!empty($e404_all_options['e404_tabs_current_border_color']))
			$css .= "    border: 1px solid ".$e404_all_options['e404_tabs_current_border_color'].";\n";
		$css .= "}\n";
	}
	if(!empty($e404_all_options['e404_tabs_links_color'])) {
		$css .= ".tabs a {\n    color: ".$e404_all_options['e404_tabs_links_color'].";\n}\n";
	}
	if(!empty($e404_all_options['e404_tabs_links_hover_color'])) {
		$css .= ".tabs a:hover {\n    color: ".$e404_all_options['e404_tabs_links_hover_color'].";\n}\n";
	}

	$css .= "</style>\n";
	
	echo $css;
}
add_action('wp_head', 'e404_custom_colors_css');

// display header social icons
function e404_show_header_social_icons() {
	global $e404_all_options, $e404_default_social_icons;

	$stylesheet = str_replace('.css', '', $GLOBALS['stylesheet']);
	if(!isset($e404_all_options['e404_social_icons_variant']) || (isset($e404_all_options['e404_social_icons_variant']) && empty($e404_all_options['e404_social_icons_variant'])))
		$e404_all_options['e404_social_icons_variant'] = $e404_default_social_icons[$stylesheet];

	$sites = array('Contact', 'RSS', 'Twitter', 'Facebook', 'Flickr', 'Pinterest', 'Behance', 'Buzz', 'Google+', 'Delicious', 'Digg', 'Dribbble', 'DropBox', 'Foursquare', 'iChat', 'LastFM', 'LinkedIn', 'MobyPicture', 'MySpace', 'Skype', 'StumbleUpon', 'Tumblr', 'Vimeo', 'YouTube', 'Xing');
	
	$color = (isset($e404_all_options['e404_social_icons_variant']) && $e404_all_options['e404_social_icons_variant'] == 'color') ? 'color/' : '';
	$social_media = array();

	$i = 0;
	foreach($sites as $site) {
		$name = $site;
		$site = strtolower($site);
		if($site == 'google+')
			$site = 'plus';
		if(isset($e404_all_options['e404_'.$site]) && trim($e404_all_options['e404_'.$site]) != '') {
			$social_media[$i]['name'] = $name;
			if($site == 'twitter')
				$social_media[$i]['url'] = 'http://twitter.com/'.$e404_all_options['e404_twitter'];
			else
				$social_media[$i]['url'] = $e404_all_options['e404_'.$site];
			$social_media[$i]['icon'] = OF_DIRECTORY.'/images/socialmedia/'.$color.$site.'.png';
			$i++;
		}
	}
	$output = '';
	if($e404_all_options['e404_header_social_icons_target'] == 'true')
		$target = ' target="_blank"';
	else
		$target = '';
	foreach($social_media as $site) {
		$output .= '<a href="'.$site['url'].'"'.$target.' title="'.$site['name'].'" class="tiptip"><img src="'.$site['icon'].'" alt="'.$site['name'].'" /></a>'."\n";
	}
	echo $output;
}

// template redirects for portfolio sections
function e404_portfolio_template($templates) {
	$page_id = get_option('e404_portfolio_page');
	$template_name = get_post_meta($page_id, '_wp_page_template', true);
	$template = OF_FILEPATH.'/'.$template_name;
	if(!is_file($template)) {
		echo 'Portfolio page not found. Please choose your portfolio page in Appearance -> Theme Options -> Portfolio Options.';
		exit();
	}
	return $template;
}
add_filter('taxonomy_template', 'e404_portfolio_template');

// excerpt customization
function e404_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'e404_excerpt_more');
function e404_excerpt_length($length) {
	return 9999;
}
add_filter('excerpt_length', 'e404_excerpt_length');

// current templates magic
function e404_template_include($template) {
    $GLOBALS['e404_current_template'] = basename($template);
    return $template;
}
add_filter('template_include', 'e404_template_include', 1000);

function e404_get_current_template() {
    if(!isset($GLOBALS['e404_current_template']))
        return false;
    else
        return $GLOBALS['e404_current_template'];
}

add_filter('gallery_style', 
	create_function(
		'$css',
		'return preg_replace("#<style type=\'text/css\'>(.*?)</style>#s", "", $css);'
		)
	);

// shortcodes in sidebars
add_filter('widget_text', 'do_shortcode');

// comment form
function e404_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li id="li-comment-<?php comment_ID(); ?>">
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-box">
			<div class="border-img leftside avatar-box"><?php echo get_avatar($comment, 40, OF_DIRECTORY.'/images/avatar.png'); ?></div>
			<div class="comment-text">
			<?php printf( __( sprintf('<cite class="comment-author">%s</cite>', get_comment_author_link() ), 'shiny')); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e('Your comment is awaiting moderation.', 'shiny'); ?></em>
				<br />
			<?php endif; ?>
				<span class="comment-date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __('%1$s at %2$s', 'shiny'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link(__('(Edit)', 'shiny'), ' '); ?>
				</span>
				<p><?php comment_text(); ?></p>
				<div class="comment-reply">
					<span><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
				</div>
			</div>
		</div>
	</div>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'shiny'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'shiny'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

?>