<?php
add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options() {
	
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = "Theme Options";
$shortname = "e404";

global $of_options, $e404_options, $social_options, $background_textures, $header_pictures;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

// Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
$alt_stylesheets = array();
if(is_dir($alt_stylesheet_path)) {
    if($alt_stylesheet_dir = opendir($alt_stylesheet_path)) { 
        while(($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}
sort($alt_stylesheets);
$alt_styles = array();
foreach($alt_stylesheets as $alt_style) {
	$alt_styles[$alt_style] = OF_DIRECTORY.'/styles/'.str_replace('.css', '.png', $alt_style);
}

// More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');

// Slider options
$slider_options = array('' => 'None (disabled)', 'showcase' => 'Awkward Showcase', 'nivo' => 'Nivo Slider', 'liteaccordion' => 'liteAccordion', 'accordion' => 'Accordion Slider', 'anything' => 'Anything Slider');
$slideshows = get_terms('e404_slideshow');
$slideshow_options[-1] = 'Blog Posts (predefined slideshow)';
$slideshow_options[0] = 'All';
foreach($slideshows as $slideshow)
	$slideshow_options[$slideshow->term_id] = $slideshow->name;

// Nivo options
$nivo_effects = array('random', 'sliceDown', 'sliceDownLeft', 'sliceUp', 'sliceUpLeft', 'sliceUpDown', 'sliceUpDownLeft', 'fold', 'fade', 'slideInRight', 'slideInLeft', 'boxRandom', 'boxRain', 'boxRainReverse');

// Accordion options
$easing_effects = array('none', 'swing', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 'easeOutQuart', 'easeInOutQuart', 'easeInQuint', 'easeOutQuint', 'easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine', 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic', 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce');

// Intro text options
$intro_main_options = array('none' => 'Disabled', 'title' => 'Page Title', 'title-excerpt' => 'Page Title & Excerpt (if available)', 'html' => 'HTML/Text', 'twitter' => 'Last Twitter status');
$intro_options = array_merge($intro_main_options, array('main' => 'The same as defined in the main setting'));

// Pages
$a_pages = get_pages();
$all_pages = array();
$all_pages[0] = '-- none --';
foreach($a_pages as $a_page) {
	$all_pages[$a_page->ID] = $a_page->post_title;
}

// Blog categories
$a_categories = get_categories();
$all_categories = array();
$all_categories[0] = '-- all --';
foreach($a_categories as $a_category) {
	$all_categories[$a_category->term_id] = $a_category->name;
}

// Google Web Fonts
include(OF_FILEPATH.'/inc/google_fonts_list.php');

$options = array();

$options[] = array( "name" => "General Settings",
                    "type" => "heading");

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px png/gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 

$options[] = array( "name" => "Show Breadcrumbs",
					"desc" => "Show the breadcrumb trail navigation.",
					"id" => $shortname."_breadcrumbs",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show Page Titles",
					"desc" => "Show page titles above the page content.",
					"id" => $shortname."_page_titles",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Disable Search Form",
					"desc" => "Remove the search form from the right side of the page.",
					"id" => $shortname."_remove_search_form",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Enable PrettyPhoto",
					"desc" => "Enable PrettyPhoto (Lightbox clone) support for images.",
					"id" => $shortname."_gallery_prettyphoto",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Allow Page Comments",
					"desc" => "Enable comments on pages.",
					"id" => $shortname."_page_comments",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");                                                    
    
$options[] = array( "name" => "Background Settings",
                    "type" => "heading");

$options[] = array( "name" => "Background Texture",
					"desc" => "Select a background texture.",
					"id" => $shortname."_background_texture",
					"std" => "",
					"type" => "images",
					"options" => $background_textures);

$options[] = array( "name" => "Custom Background Texture",
					"desc" => "Upload your own background texture (above selection will be ignored).",
					"id" => $shortname."_custom_background_texture",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Header Texture",
					"desc" => "Select a header texture.",
					"id" => $shortname."_header_texture",
					"std" => "",
					"type" => "images",
					"options" => $background_textures);

$options[] = array( "name" => "Custom Header Texture",
					"desc" => "Upload your own header texture (above selection will be ignored).",
					"id" => $shortname."_custom_header_texture",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Header Picture",
					"desc" => "Select a header picture (header texture will be disabled).",
					"id" => $shortname."_header_picture",
					"std" => "",
					"type" => "images",
					"options" => $header_pictures);

$options[] = array( "name" => "Custom Header Picture",
					"desc" => "Upload your own header picture (above selection will be ignored).",
					"id" => $shortname."_custom_header_picture",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Header Texture for Home Page (optional)",
					"desc" => "Select a header texture for the home page.",
					"id" => $shortname."_header_texture_home",
					"std" => "",
					"type" => "images",
					"options" => $background_textures);

$options[] = array( "name" => "Custom Header Texture for Home Page (optional)",
					"desc" => "Upload your own header texture for the home page (above selection will be ignored).",
					"id" => $shortname."_custom_header_texture_home",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Header Picture for Home Page (optional)",
					"desc" => "Select a header picture for the home page (header texture will be disabled).",
					"id" => $shortname."_header_picture_home",
					"std" => "",
					"type" => "images",
					"options" => $header_pictures);

$options[] = array( "name" => "Custom Header Picture for Home Page (optional)",
					"desc" => "Upload your own header picture for the home page (above selection will be ignored).",
					"id" => $shortname."_custom_header_picture_home",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Header Options",
					"type" => "heading");
					
$options[] = array( "name" => "Top Contact Box",
                    "desc" => "Text/HTML to display in the top contact box.",
                    "id" => $shortname."_top_contact_box",
                    "std" => "Call us Free: <strong>+01 555 55 55</strong> | contact@johndoe.com</span>",
                    "type" => "textarea");

$options[] = array( "name" => "Disable Top Contact Box",
					"desc" => "Remove the contact box from the header.",
					"id" => $shortname."_remove_top_contact_box",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Header Bar Style",
					"desc" => "Select a style of header bar.",
					"id" => $shortname."_header_bar_style",
					"std" => "",
					"type" => "select2",
					"options" => array('' => 'theme default', 'none' => 'none',
									   'header-bg1b' => 'style 1 black', 'header-bg1bt' => 'style 1 black transparent', 'header-bg1w' => 'style 1 white', 'header-bg1wt' => 'style 1 white transparent',
									   'header-bg2' => 'style 2 (universal)', 'header-bg3' => 'style 3 (universal)',
									   'header-bg4b' => 'style 4 black', 'header-bg4bt' => 'style 4 black transparent', 'header-bg4w' => 'style 4 white', 'header-bg4wt' => 'style 4 white transparent'
									   ));

$options[] = array( "name" => "Header Bar Texture",
					"desc" => "Select a header bar texture.",
					"id" => $shortname."_header_bar_background_image",
					"std" => "",
					"type" => "images",
					"options" => $background_textures);

$options[] = array( "name" => "Custom Header Bar Texture",
					"desc" => "Upload your own header bar texture (above selection will be ignored).",
					"id" => $shortname."_custom_header_bar_background_image",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Styling Options",
					"type" => "heading");

$options[] = array( "name" => "Theme Variations",
					"desc" => "Select a theme color variation. You can change the color of specific elements below.",
					"id" => $shortname."_theme_style",
					"std" => "style_01.css",
					"type" => "images",
					"options" => $alt_styles);

$options[] = array( "name" => "Enable Theme Customization",
					"desc" => "Enable the theme customization (see options below).",
					"id" => $shortname."_custom_style",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => "Footer Effect",
					"desc" => "Select a type of footer background effect.",
					"id" => $shortname."_footer_effect",
					"std" => "",
					"type" => "select2",
					"options" => array('' => 'theme default', 'none' => 'disabled', 'light' => 'centered light'));

$options[] = array( "name" => "Background Color",
					"desc" => "Set background color.",
					"id" => $shortname."_color_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Main Text Color",
					"desc" => "Set main text color.",
					"id" => $shortname."_color_main",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Forms Text Color",
					"desc" => "Set forms text color.",
					"id" => $shortname."_color_forms",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Link Color",
					"desc" => "Set links color.",
					"id" => $shortname."_color_links",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Link Hover Color",
					"desc" => "Set links hover color.",
					"id" => $shortname."_color_links_hover",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Headers Text Color",
					"desc" => "Set headers (h1 - h6) text color.",
					"id" => $shortname."_color_headers",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Headers Link Color",
					"desc" => "Set headers (h1 - h6) links color.",
					"id" => $shortname."_color_headers_links",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Headers Link Hover Color",
					"desc" => "Set headers (h1 - h6) links hover color.",
					"id" => $shortname."_color_headers_links_hover",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Code Text Color",
					"desc" => "Set code tag text color.",
					"id" => $shortname."_color_code",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Blockquote Text Color",
					"desc" => "Set blockquote tag text color.",
					"id" => $shortname."_color_blockquote",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Header Contact Box Text Color",
					"desc" => "Set header contact box text color.",
					"id" => $shortname."_header_contact_text",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Header Bar Background Color",
					"desc" => "Set header bar background color.",
					"id" => $shortname."_header_bar_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Header Bar Bottom Line Color",
					"desc" => "Set header bar bottom line color.",
					"id" => $shortname."_header_bar_bottom_line",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Header Contact Box Strong Text Color",
					"desc" => "Set header contact box strong text color.",
					"id" => $shortname."_header_contact_text_strong",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Header Contact Box Span Text Color",
					"desc" => "Set header contact box span text color.",
					"id" => $shortname."_header_contact_text_span",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Intro Box Text Color",
					"desc" => "Set intro box text color.",
					"id" => $shortname."_color_intro",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Intro Box Strong Text Color",
					"desc" => htmlspecialchars("Set intro box <strong> text color."),
					"id" => $shortname."_color_intro_strong",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Intro Box Links Color",
					"desc" => "Set intro box links color.",
					"id" => $shortname."_color_intro_links",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Twitter Box Text Color",
					"desc" => "Set the text color for the Twitter box ([tweet] shortcode).",
					"id" => $shortname."_twitter_box_text",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Twitter Box Links Color",
					"desc" => "Set the links color for the Twitter box ([tweet] shortcode).",
					"id" => $shortname."_twitter_box_links",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Twitter Box Background Color",
					"desc" => "Set the background color for the Twitter box ([tweet] shortcode).",
					"id" => $shortname."_twitter_box_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Footer Background Color",
					"desc" => "Set footer background color.",
					"id" => $shortname."_background_footer",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Footer Top Line",
					"desc" => "Set footer top line color.",
					"id" => $shortname."_top_line_footer",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Footer Headers Color",
					"desc" => "Set footer headers (h1 - h6) color.",
					"id" => $shortname."_color_footer_headers",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Footer Text Color",
					"desc" => "Set footer text color.",
					"id" => $shortname."_color_footer",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Footer Links Color",
					"desc" => "Set footer links color.",
					"id" => $shortname."_color_footer_links",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Footer Header Lines",
					"desc" => "Select a type of footer header lines.",
					"id" => $shortname."_footer_header_lines",
					"std" => "",
					"type" => "select2",
					"options" => array('' => 'theme default', 'images/hr1.png' => 'dark', 'images/hr2.png' => 'light'));

$options[] = array( "name" => "Footer Menu Links Divider",
					"desc" => "Set footer menu links divider.",
					"id" => $shortname."_nav_divider_footer",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Copyright Text Color",
					"desc" => "Set copyright text color.",
					"id" => $shortname."_color_copyright_text",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Copyright Links Color",
					"desc" => "Set copyright text color.",
					"id" => $shortname."_color_copyright_links",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Submit Button Text Color",
					"desc" => "Set submit buttons text color.",
					"id" => $shortname."_submit_text",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Submit Button Background Color",
					"desc" => "Set submit buttons background color.",
					"id" => $shortname."_submit_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Submit Button Text Color (footer)",
					"desc" => "Set submit buttons text color (in footer).",
					"id" => $shortname."_submit_text_footer",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Submit Button Background Color (footer)",
					"desc" => "Set submit buttons background color (in footer).",
					"id" => $shortname."_submit_background_footer",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Menu Links Color",
					"desc" => "Set menu links color.",
					"id" => $shortname."_menu_links",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Menu Links Hover & Current Page Text Color",
					"desc" => "Set menu links hover and current page text color.",
					"id" => $shortname."_menu_current_text",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Menu Links Hover & Current Page Background Color",
					"desc" => "Set menu links hover and current page background color.",
					"id" => $shortname."_menu_current_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Submenu Background Color",
					"desc" => "Set submenu background color.",
					"id" => $shortname."_menu_submenu_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Submenu Background Opacity",
					"desc" => "Set the opacity of the submenu background (in percents); you have also set the menu background color.",
					"id" => $shortname."_menu_submenu_background_opacity",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Submenu Links Color",
					"desc" => "Set submenu links color.",
					"id" => $shortname."_menu_submenu_links",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Submenu Links Hover Color",
					"desc" => "Set submenu links hover color.",
					"id" => $shortname."_menu_submenu_hover",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Submenu Links Hover Background Color",
					"desc" => "Set submenu links hover background color.",
					"id" => $shortname."_menu_submenu_hover_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Pricebox - Featured Box Border Color",
					"desc" => "Set featured box border color.",
					"id" => $shortname."_pricebox_featured_border",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Pricebox - Featured Box Header Text Color",
					"desc" => "Set featured box header text color.",
					"id" => $shortname."_pricebox_featured_header_text",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Pricebox - Featured Box Header Background Color",
					"desc" => "Set featured box header background color.",
					"id" => $shortname."_pricebox_featured_header_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Pricebox - Featured Box Price Text Color",
					"desc" => "Set featured box price text color.",
					"id" => $shortname."_pricebox_featured_price",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Pricebox - Border Hover Color",
					"desc" => "Set pricebox border hover color.",
					"id" => $shortname."_pricebox_border_hover",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Pricebox - Header Hover Text Color",
					"desc" => "Set pricebox header hover text color.",
					"id" => $shortname."_pricebox_header_text_hover",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Pricebox - Header Background Hover Color",
					"desc" => "Set pricebox header background hover color.",
					"id" => $shortname."_pricebox_header_background_hover",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Sortable Portfolio Current Category Color",
					"desc" => "Set sortable portfolio current category text color.",
					"id" => $shortname."_portfolio_nav_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Sortable Portfolio Navigation Underlin Color",
					"desc" => "Set sortable portfolio navigation underline color.",
					"id" => $shortname."_portfolio_nav_underline",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Breadcrumbs Text Color",
					"desc" => "Set breadcrums navigation text color.",
					"id" => $shortname."_breadcrumbs_text",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Breadcrumbs Links Color",
					"desc" => "Set breadcrums navigation links color.",
					"id" => $shortname."_breadcrumbs_links",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Lines",
					"desc" => "Select a type of horizontal lines.",
					"id" => $shortname."_horizontal_lines",
					"std" => "",
					"type" => "select2",
					"options" => array('' => 'theme default', 'images/hr1.png' => 'dark', 'images/hr2.png' => 'light'));

$options[] = array( "name" => "Lines Color",
					"desc" => "Set lines color.",
					"id" => $shortname."_dividers_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "'Go to Top' Link Color",
					"desc" => "Set 'Go to Top' link color.",
					"id" => $shortname."_go_to_top_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "'Go to Top' Link Hover Color",
					"desc" => "Set 'Go to Top' link hover color.",
					"id" => $shortname."_go_to_top_hover_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Blog Content - Text Color",
					"desc" => "Set text color for the blog content.",
					"id" => $shortname."_blog_text_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Blog Content - Links Color",
					"desc" => "Set links color for the blog content.",
					"id" => $shortname."_blog_links_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Blog Content - Links Hover Color",
					"desc" => "Set links hover color for the blog content.",
					"id" => $shortname."_blog_links_hover_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Blog Content - Headers Color",
					"desc" => "Set headers color for the blog content.",
					"id" => $shortname."_blog_headers_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Blog Content - Headers Links Color",
					"desc" => "Set headers links color for the blog content.",
					"id" => $shortname."_blog_headers_links_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Blog Content - Headers Links Hover Color",
					"desc" => "Set headers links hover color for the blog content.",
					"id" => $shortname."_blog_headers_links_hover_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Tabs - Links Color",
					"desc" => "Set links color for tabs.",
					"id" => $shortname."_tabs_links_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Tabs - Links Hover Color",
					"desc" => "Set links hover color for tabs.",
					"id" => $shortname."_tabs_links_hover_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Tabs - Current Tab Text Color",
					"desc" => "Set text color for the current tab.",
					"id" => $shortname."_tabs_current_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Tabs - Current Tab Background Color",
					"desc" => "Set background color for the current tab.",
					"id" => $shortname."_tabs_current_background_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Tabs - Current Tab Border Color",
					"desc" => "Set border color for the current tab.",
					"id" => $shortname."_tabs_current_border_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array( "name" => "Fonts Options",
					"type" => "heading");

$options[] = array( "name" => "Enable Fonts Replacement",
					"desc" => "Enable the fonts replacement with Google Web Fonts.<br />Go to the <a href='http://www.google.com/webfonts'>Google Font Directory</a> for a preview of available fonts.",
					"id" => $shortname."_google_web_fonts",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => "body Font",
					"desc" => "Select a font to assign to 'body' tag.",
					"id" => $shortname."_gwf_body",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "p (paragraph) Font",
					"desc" => "Select a font to assign to 'p' tag.",
					"id" => $shortname."_gwf_p",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "h1 Font",
					"desc" => "Select a font to assign to 'h1' tag.",
					"id" => $shortname."_gwf_h1",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "h2 Font",
					"desc" => "Select a font to assign to 'h2' tag.",
					"id" => $shortname."_gwf_h2",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "h3 Font",
					"desc" => "Select a font to assign to 'h3' tag.",
					"id" => $shortname."_gwf_h3",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "h4 Font",
					"desc" => "Select a font to assign to 'h4' tag.",
					"id" => $shortname."_gwf_h4",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "h5 Font",
					"desc" => "Select a font to assign to 'h5' tag.",
					"id" => $shortname."_gwf_h5",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "h6 Font",
					"desc" => "Select a font to assign to 'h6' tag.",
					"id" => $shortname."_gwf_h6",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "blockquote Font",
					"desc" => "Select a font to assign to 'blockquote' tag.",
					"id" => $shortname."_gwf_blockquote",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "li Font",
					"desc" => "Select a font to assign to 'li' tag (lists).",
					"id" => $shortname."_gwf_li",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "Menu Font",
					"desc" => "Select a font to assign to the dropdown menu.",
					"id" => $shortname."_gwf_menu",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "Submenu Font",
					"desc" => "Select a font to assign to the dropdown menu (submenus).",
					"id" => $shortname."_gwf_submenu",
					"std" => "",
					"type" => "select2",
					"options" => $google_web_fonts);

$options[] = array( "name" => "Intro Text Box",
					"type" => "heading");

$options[] = array( "name" => "Intro Text Box",
					"desc" => "Select a content to display in the intro text box. You can choose other settings for different page types below.",
					"id" => $shortname."_intro_type",
					"std" => "title-excerpt",
					"type" => "select2",
					"options" => $intro_main_options);

$options[] = array( "name" => "HTML/Text",
					"desc" => "HTML/Text to display in the intro text box.",
					"id" => $shortname."_intro_text",
					"std" => "<p><strong>Welcome to Shiny Theme: The ultimate all-in-one template.</strong><br />\nCreate outstanding website or blog in minutes!</p>",
					"type" => "textarea");                                                    

$options[] = array( "name" => "Intro Text Box for Blog Pages",
					"desc" => "Select a content to display in the intro text box on Blog Pages.",
					"id" => $shortname."_blog_intro_type",
					"std" => "main",
					"type" => "select2",
					"options" => $intro_options);

$options[] = array( "name" => "HTML/Text",
					"desc" => "HTML/Text to display in the intro text box on Blog Pages.",
					"id" => $shortname."_blog_intro_text",
					"std" => "<h1>Blog</h1>\n<p>You can enter your own text here!</p>",
					"type" => "textarea"); 

$options[] = array( "name" => "Intro Text Box for Civil War Pages",
					"desc" => "Select a content to display in the intro text box on Civil War Pages.",
					"id" => $shortname."_civilwar_intro_type",
					"std" => "main",
					"type" => "select2",
					"options" => $intro_options);

$options[] = array( "name" => "HTML/Text",
					"desc" => "HTML/Text to display in the intro text box on Civil War Pages.",
					"id" => $shortname."_blog_intro_text",
					"std" => "<h1>Blog</h1>\n<p>You can enter your own text here!</p>",
					"type" => "textarea");

$options[] = array( "name" => "Intro Text Box for Teach Pages",
					"desc" => "Select a content to display in the intro text box on Teach Pages.",
					"id" => $shortname."_teach_intro_type",
					"std" => "main",
					"type" => "select2",
					"options" => $intro_options);

$options[] = array( "name" => "HTML/Text",
					"desc" => "HTML/Text to display in the intro text box on Teach Pages.",
					"id" => $shortname."_blog_intro_text",
					"std" => "<h1>Teach</h1>\n<p>You can enter your own text here!</p>",
					"type" => "textarea");

$options[] = array( "name" => "Intro Text Box for Portfolio Pages",
					"desc" => "Select a content to display in the intro text box on Portfolio Pages.",
					"id" => $shortname."_portfolio_intro_type",
					"std" => "main",
					"type" => "select2",
					"options" => $intro_options);

$options[] = array( "name" => "HTML/Text",
					"desc" => "HTML/Text to display in the intro text box on Portfolio Pages.",
					"id" => $shortname."_portfolio_intro_text",
					"std" => "<h1>Portfolio</h1>\n<p>Show your best projects in several different ways.</p>",
					"type" => "textarea");                                                    

$options[] = array( "name" => "Intro Text Box for Gallery Pages",
					"desc" => "Select a content to display in the intro text box on Gallery Pages.",
					"id" => $shortname."_gallery_intro_type",
					"std" => "main",
					"type" => "select2",
					"options" => $intro_options);

$options[] = array( "name" => "HTML/Text",
					"desc" => "HTML/Text to display in the intro text box on Gallery Pages.",
					"id" => $shortname."_gallery_intro_text",
					"std" => "<h1>Gallery</h1>\n<p>Show your pictures with WordPress built-in gallery or Galleria slideshow.</p>",
					"type" => "textarea");                                                    

$options[] = array( "name" => "Post Excerpt Length",
					"desc" => "Define the maximum length of a post excerpt.",
					"id" => $shortname."_excerpt_length",
					"std" => "100",
					"type" => "text");

$options[] = array( "name" => "Footer Options",
					"type" => "heading");

$options[] = array( "name" => "Footer Columns",
					"desc" => "Pick the number of footer columns.",
					"id" => $shortname."_footer_columns",
					"std" => "4",
					"type" => "select",
					"options" => array('1', '2', '3', '4'));

$options[] = array( "name" => "Text Below Footer - Left",
                    "desc" => "Text/HTML to display on the left side below the footer.",
                    "id" => $shortname."_footer_below_left",
                    "std" => "Copyright &copy; 2012 <a href=\"http://e404themes.com\">e404 Themes</a>. All rights reserved.",
                    "type" => "textarea");

$options[] = array( "name" => "Text Below Footer - Right",
                    "desc" => "Text/HTML to display on the left side below the footer.",
                    "id" => $shortname."_footer_below_right",
                    "std" => "Powered by: <a href=\"http://wordpress.org\">WordPress</a>.",
                    "type" => "textarea");

$options[] = array( "name" => "Home Page Options",
					"type" => "heading");

$options[] = array( "name" => "Home Page Slider",
					"desc" => "Select a slider for the home page.",
					"id" => $shortname."_home_slider",
					"std" => "0",
					"type" => "select2",
					"options" => $slider_options);

$options[] = array( "name" => "Slideshow to display in slider",
					"desc" => "Select a slideshow for the slider. Slideshows are defined <a href='edit.php?post_type=e404_slide'>here</a>.",
					"id" => $shortname."_home_slideshow",
					"std" => "0",
					"type" => "select2",
					"options" => $slideshow_options);

$options[] = array( "name" => "Blog Category",
					"desc" => "Select a blog category to show in the slider  (only for the 'Blog Posts' slideshow).",
					"id" => $shortname."_home_slider_category",
					"std" => "0",
					"type" => "select2",
					"options" => $all_categories);

$options[] = array( "name" => "Number of Blog Posts",
					"desc" => "Define the number of blog posts to display in the slider (only for the 'Blog Posts' slideshow).",
					"id" => $shortname."_home_slider_number",
					"std" => "5",
					"type" => "text");

$options[] = array( "name" => "Slider Height",
					"desc" => "Define the height of the slider (in pixels).",
					"id" => $shortname."_home_slider_height",
					"std" => "350",
					"type" => "text");

$options[] = array( "name" => "Blog Options",
					"type" => "heading");

$options[] = array( "name" => "Blog Layout",
					"desc" => "Select blog layout.",
					"id" => $shortname."_blog_layout",
					"std" => "sidebar-right",
					"type" => "images",
					"options" => array(
						'no-sidebar' => OF_DIRECTORY.'/admin/images/1col.png',
						'sidebar-right' => OF_DIRECTORY.'/admin/images/2cr.png',
						'sidebar-left' => OF_DIRECTORY.'/admin/images/2cl.png')
					);

$options[] = array( "name" => "Display 'Like' button",
					"desc" => "Display the 'Like' button next to each blog post.",
					"id" => $shortname."_blog_like_this",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Use Post Thumbnails",
					"desc" => "Use post thumbnails on the posts list.",
					"id" => $shortname."_blog_use_thumbnail",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Use PrettyPhoto for Thumbnails",
					"desc" => "Use PrettyPhoto (Lightbox clone) for post thumbnails (can be overridden for individual posts).",
					"id" => $shortname."_blog_thumbnails_prettyphoto",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Thumbnails Height",
					"desc" => "The height of post thumbnails on the posts list (in pixels; empty for default).",
					"id" => $shortname."_blog_thumbnails_height",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Use Post Excerpts",
					"desc" => htmlentities("Show excerpts on the posts list instead of the content before <!--more--> tag."),
					"id" => $shortname."_blog_use_excerpt",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Enable PrettyPhoto",
					"desc" => "Enable PrettyPhoto (Lightbox clone) support for images in WordPress built-in galleries.",
					"id" => $shortname."_blog_prettyphoto",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show Share Icons",
					"desc" => "Show social networks sharing links on blog post pages.",
					"id" => $shortname."_blog_share_it",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show 'Read more' links",
					"desc" => "Show 'Read more' links on the blog page.",
					"id" => $shortname."_blog_read_more",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "'Read more' link text",
					"desc" => "Text to display in 'Read more' links.",
					"id" => $shortname."_blog_read_more_text",
					"std" => "Read more",
					"type" => "text");

$options[] = array( "name" => "Show Post Author",
					"desc" => "Show the post author.",
					"id" => $shortname."_blog_post_author",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show Post Categories",
					"desc" => "Show post categories.",
					"id" => $shortname."_blog_post_categories",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show Post Tags",
					"desc" => "Show post tags.",
					"id" => $shortname."_blog_post_tags",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show Author Bio",
					"desc" => "Show the box with informations about post author (taken from author profile).",
					"id" => $shortname."_blog_author_bio",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Portfolio Options",
					"type" => "heading");

$options[] = array( "name" => "Portfolio Items List Layout",
					"desc" => "Select a layout for portfolio items list (only for templates with sidebar).",
					"id" => $shortname."_portfolio_layout",
					"std" => "sidebar-right",
					"type" => "images",
					"options" => array(
						'sidebar-right' => OF_DIRECTORY.'/admin/images/2cr.png',
						'sidebar-left' => OF_DIRECTORY.'/admin/images/2cl.png')
					);

$options[] = array( "name" => "Display 'Like' button",
					"desc" => "Display the 'Like' button next to each portfolio item.",
					"id" => $shortname."_portfolio_like_this",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Portfolio Page",
					"desc" => "Select your portfolio page.",
					"id" => $shortname."_portfolio_page",
					"std" => "0",
					"type" => "select2",
					"options" => $all_pages);

$options[] = array( "name" => "Portfolio Items Per Page",
					"desc" => "Number of portfolio items to show on a portfolio page.",
					"id" => $shortname."_portfolio_posts_per_page",
					"std" => "10",
					"type" => "text");

$options[] = array( "name" => "Portfolio Thumbnails Height",
					"desc" => "Define the height of portfolio item thumbnails on the portfolio page (in pixels; empty for default).",
					"id" => $shortname."_portfolio_thumbnails_height",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Portfolio Slug",
					"desc" => "Slug for portfolio pages.",
					"id" => $shortname."_portfolio_slug",
					"std" => "portfolio",
					"type" => "text");

$options[] = array( "name" => "Portfolio Categories Slug",
					"desc" => "Slug for portfolio categories.",
					"id" => $shortname."_portfolio_category_slug",
					"std" => "category",
					"type" => "text");

$options[] = array( "name" => "Portfolio Categories Name",
					"desc" => "Name for portfolio categories (for example 'Work type').",
					"id" => $shortname."_portfolio_categories_name",
					"std" => "Portfolio Categories",
					"type" => "text");

$options[] = array( "name" => "Portfolio Tags Slug",
					"desc" => "Slug for portfolio tags.",
					"id" => $shortname."_portfolio_tag_slug",
					"std" => "tag",
					"type" => "text");

$options[] = array( "name" => "Portfolio Tags Name",
					"desc" => "Name for portfolio tags (for example 'Media' or 'Used technologies').",
					"id" => $shortname."_portfolio_tags_name",
					"std" => "Portfolio Tags",
					"type" => "text");

$options[] = array( "name" => "PrettyPhoto Support",
					"desc" => "Add PrettyPhoto (Lightbox clone) support for portfolio items featured images.",
					"id" => $shortname."_portfolio_prettyphoto",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show 'View project' (aka 'Read more') button",
					"desc" => "Enable 'View project' buttons on the portfolio page.",
					"id" => $shortname."_portfolio_read_more",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "'View project' (aka 'Read more') button text",
					"desc" => "Text to display in 'View project' buttons.",
					"id" => $shortname."_portfolio_read_more_text",
					"std" => "View project",
					"type" => "text");

$options[] = array( "name" => "Show Titles",
					"desc" => "Show portfolio items titles (only in column portfolio templates).",
					"id" => $shortname."_portfolio_titles",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show Titles on Single Page",
					"desc" => "Show a portfolio item title on a single item portfolio page.",
					"id" => $shortname."_portfolio_single_titles",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show Categories",
					"desc" => "Show portfolio items categories.",
					"id" => $shortname."_portfolio_item_categories",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Show Tags",
					"desc" => "Show tags on portfolio item pages.",
					"id" => $shortname."_portfolio_item_tags",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Nivo Slider Options",
					"type" => "heading"); 	   

$options[] = array( "name" => "Transition Effect",
					"desc" => "Select an effect to use on slideshow.",
					"id" => $shortname."_nivo_effect",
					"std" => "random",
					"type" => "select",
					"options" => $nivo_effects);

$options[] = array( "name" => "Slices",
					"desc" => "Define a number of elements in which the image will be sliced.",
					"id" => $shortname."_nivo_slices",
					"std" => "10",
					"type" => "text");

$options[] = array( "name" => "Animation Speed",
					"desc" => "Define the animation speed (in miliseconds).",
					"id" => $shortname."_nivo_animspeed",
					"std" => "600",
					"type" => "text");

$options[] = array( "name" => "Pause Time",
					"desc" => "Define the delay between slides (in miliseconds).",
					"id" => $shortname."_nivo_pausetime",
					"std" => "4000",
					"type" => "text");

$options[] = array( "name" => "Slide Titles",
					"desc" => "Enable or disable slide titles.",
					"id" => $shortname."_nivo_title",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Next & Prev Buttons",
					"desc" => "Enable or disable navigation buttons (Next & Prev).",
					"id" => $shortname."_nivo_directionnav",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Control Navigation",
					"desc" => "Enable or disable Control Navigation (bubbles below a slider).",
					"id" => $shortname."_nivo_controlnav",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Keyboard Navigation",
					"desc" => "Enable or disable Keyboard Navigation.",
					"id" => $shortname."_nivo_keyboardnav",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Pause on Hover",
					"desc" => "Enable or disable pausing slideshow on mouse hover.",
					"id" => $shortname."_nivo_pauseonhover",
					"std" => "0",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Stop At End",
					"desc" => "When enabled the slideshow will stop on last slide.",
					"id" => $shortname."_nivo_stopatend",
					"std" => "0",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Accordion Slider Options",
					"type" => "heading"); 	   

$options[] = array( "name" => "Max Width",
					"desc" => "Define the width of expanded slider (in pixels).",
					"id" => $shortname."_accordion_max_width",
					"std" => "700",
					"type" => "text");

$options[] = array( "name" => "Transition Effect",
					"desc" => "Select an effect to use on slideshow.",
					"id" => $shortname."_accordion_effect",
					"std" => "swing",
					"type" => "select",
					"options" => $easing_effects);

$options[] = array( "name" => "Animation Speed",
					"desc" => "Define the animation speed (in miliseconds).",
					"id" => $shortname."_accordion_effect_duration",
					"std" => "600",
					"type" => "text");

$options[] = array( "name" => "Slide Titles",
					"desc" => "Enable or disable slide titles.",
					"id" => $shortname."_accordion_title",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Anything Slider Options",
					"type" => "heading"); 	   

$options[] = array( "name" => "Transition Effect",
					"desc" => "Select an effect to use on slideshow.",
					"id" => $shortname."_anything_effect",
					"std" => "swing",
					"type" => "select",
					"options" => $easing_effects);

$options[] = array( "name" => "Animation Time",
					"desc" => "Define the animation time (in miliseconds).",
					"id" => $shortname."_anything_animationtime",
					"std" => "600",
					"type" => "text");

$options[] = array( "name" => "Pause Time",
					"desc" => "Define the delay between slides (in miliseconds).",
					"id" => $shortname."_anything_delay",
					"std" => "4000",
					"type" => "text");

$options[] = array( "name" => "Next & Prev Buttons",
					"desc" => "Enable or disable navigation buttons (Next & Prev).",
					"id" => $shortname."_anything_buildarrows",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Auto-hide Next & Prev Buttons",
					"desc" => "Enable or disable auto-hiding navigation buttons (Next & Prev).",
					"id" => $shortname."_anything_togglearrows",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Control Navigation",
					"desc" => "Enable or disable Control Navigation (bubbles below a slider).",
					"id" => $shortname."_anything_buildnavigation",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Keyboard Navigation",
					"desc" => "Enable or disable Keyboard Navigation.",
					"id" => $shortname."_anything_enablekeyboard",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Pause on Hover",
					"desc" => "Enable or disable pausing slideshow on mouse hover.",
					"id" => $shortname."_anything_pauseonhover",
					"std" => "0",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Stop At End",
					"desc" => "When enabled the slideshow will stop on last slide.",
					"id" => $shortname."_anything_stopatend",
					"std" => "0",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Enable Video Extension",
					"desc" => "Use the Anything Slider video extension.",
					"id" => $shortname."_anything_video_extension",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Awkward Showcase Options",
					"type" => "heading");

$options[] = array( "name" => "Transition Effect",
					"desc" => "Select an effect to use on slideshow.",
					"id" => $shortname."_showcase_transition",
					"std" => "vslide",
					"type" => "select",
					"options" => array('vslide', 'hslide', 'fade'));

$options[] = array( "name" => "Animation Time",
					"desc" => "Define the animation time (in miliseconds).",
					"id" => $shortname."_showcase_transition_speed",
					"std" => "500",
					"type" => "text");

$options[] = array( "name" => "Auto start",
					"desc" => "Enable or disable the slideshow auto start.",
					"id" => $shortname."_showcase_autostart",
					"std" => "true",
					"type" => "select2",
					"options" => array('false' => 'disabled', 'true' => 'enabled'));

$options[] = array( "name" => "Pause Time",
					"desc" => "Define the pause between slides (in miliseconds).",
					"id" => $shortname."_showcase_interval",
					"std" => "3000",
					"type" => "text");

$options[] = array( "name" => "Thumbnails",
					"desc" => "Define thumbnails type.",
					"id" => $shortname."_showcase_thumbnails",
					"std" => "disabled",
					"type" => "select",
					"options" => array('disabled', 'horizontal', 'vertical'));

$options[] = array( "name" => "Thumbnail Captions",
					"desc" => "Enable or disable thumbnail captions.",
					"id" => $shortname."_showcase_thumbnail_captions",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Slide captions",
					"desc" => "Enable or disable slide captions.",
					"id" => $shortname."_showcase_captions",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Thumbnails Background Color",
					"desc" => "Set thumbnails container background color (empty for default).",
					"id" => $shortname."_showcase_thumbnails_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Tooltips Text Color",
					"desc" => "Set tooltips text color (empty for default).",
					"id" => $shortname."_showcase_tooltips_text",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Tooltips Background Color",
					"desc" => "Set tooltips background color (empty for default).",
					"id" => $shortname."_showcase_tooltips_background",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "liteAccordion Options",
					"type" => "heading");

$options[] = array( "name" => "Header Width",
					"desc" => "Define the slide header width (in pixels).",
					"id" => $shortname."_liteaccordion_header_width",
					"std" => "48",
					"type" => "text");

$options[] = array( "name" => "Slide Captions",
					"desc" => "Enable or disable slide captions.",
					"id" => $shortname."_liteaccordion_captions",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Transition Effect",
					"desc" => "Select an effect to use on slideshow.",
					"id" => $shortname."_liteaccordion_transition",
					"std" => "swing",
					"type" => "select",
					"options" => array_slice($easing_effects, 1, count($easing_effects) - 1));

$options[] = array( "name" => "Pause",
					"desc" => "Define the pause time (in miliseconds).",
					"id" => $shortname."_liteaccordion_cyclespeed",
					"std" => "5000",
					"type" => "text");

$options[] = array( "name" => "Slide Speed",
					"desc" => "Define the slide animation speed (in miliseconds).",
					"id" => $shortname."_liteaccordion_slidespeed",
					"std" => "800",
					"type" => "text");

$options[] = array( "name" => "Activation",
					"desc" => "Select an action to activate the slider.",
					"id" => $shortname."_liteaccordion_activateon",
					"std" => "click",
					"type" => "select",
					"options" => array('click', 'mouseover'));

$options[] = array( "name" => "First Slide",
					"desc" => "Define the slide which will be opened on page load (use a slide number).",
					"id" => $shortname."_liteaccordion_firstslide",
					"std" => "1",
					"type" => "text");

$options[] = array( "name" => "Auto Start",
					"desc" => "Enable or disable the slideshow auto start.",
					"id" => $shortname."_liteaccordion_autostart",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Pause on Hover",
					"desc" => "Enable or disable pausing slideshow on mouse hover.",
					"id" => $shortname."_liteaccordion_pauseonhover",
					"std" => "1",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));

$options[] = array( "name" => "Show Slide Numbers",
					"desc" => "Enable or disable slide numbers.",
					"id" => $shortname."_liteaccordion_enumerateslides",
					"std" => "0",
					"type" => "select2",
					"options" => array(0 => 'disabled', 1 => 'enabled'));
					
$options[] = array( "name" => "Title Text Color",
					"desc" => "Set title text color (empty for default).",
					"id" => $shortname."_liteaccordion_title_text_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Title Background Color",
					"desc" => "Set title background color (empty for default).",
					"id" => $shortname."_liteaccordion_title_background_color",
					"std" => "",
					"type" => "color"); 

$options[] = array( "name" => "Social Networks & RSS",
					"type" => "heading"); 	   

$options[] = array( "name" => "Share Buttons",
					"desc" => "Choose sites to show in the Share This field.",
					"id" => $shortname."_share_this_sites",
					"std" => "facebook",
					"type" => "multicheck",
					"options" => $social_options);

$options[] = array( "name" => "Social Icons Color Variant",
					"desc" => "Select the color variant of header social icons. Empty for theme default.",
					"id" => $shortname."_social_icons_variant",
					"std" => "",
					"type" => "select2",
					"options" => array('' => 'Theme Default', 'silver' => 'Silver', 'color' => 'Color'));

$options[] = array( "name" => "Open share links in new window",
					"desc" => "Check to open sharing links in a new browser window.",
					"id" => $shortname."_share_buttons_target",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Open header social links in new window",
					"desc" => "Check to open header social icons links in a new browser window.",
					"id" => $shortname."_header_social_icons_target",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "RSS Channel",
					"desc" => "URL address of your RSS channel.",
					"id" => $shortname."_rss",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Contact Page",
					"desc" => "URL address of your contact page.",
					"id" => $shortname."_contact",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Twitter username",
					"desc" => "Your Twitter username.",
					"id" => $shortname."_twitter",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Twitter cache expiration time",
					"desc" => "Define a life time of Twitter cache (in seconds).",
					"id" => $shortname."_twitter_expire",
					"std" => "3600",
					"type" => "text"); 

$options[] = array( "name" => "Facebook profile/page URL",
					"desc" => "Full URL address of your Facebook profile or page.",
					"id" => $shortname."_facebook",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Flickr profile URL",
					"desc" => "Full URL address of your Flickr profile.",
					"id" => $shortname."_flickr",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Flickr cache expiration time",
					"desc" => "Define a life time of Flickr cache (in seconds).",
					"id" => $shortname."_flickr_expire",
					"std" => "3600",
					"type" => "text"); 

$options[] = array( "name" => "Google+ profile URL",
					"desc" => "Full URL address of your Google+ profile.",
					"id" => $shortname."_plus",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Behance profile URL",
					"desc" => "Full URL address of your Behance profile.",
					"id" => $shortname."_behance",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Delicious profile URL",
					"desc" => "Full URL address of your Delicious profile.",
					"id" => $shortname."_delicious",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Digg profile URL",
					"desc" => "Full URL address of your Digg profile.",
					"id" => $shortname."_digg",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Dribbble profile URL",
					"desc" => "Full URL address of your Dribbble profile.",
					"id" => $shortname."_dribbble",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "DropBox profile URL",
					"desc" => "Full URL address of your DropBox profile.",
					"id" => $shortname."_dropbox",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Foursquare profile URL",
					"desc" => "Full URL address of your Foursquare profile.",
					"id" => $shortname."_foursquare",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Google Buzz profile URL",
					"desc" => "Full URL address of your Google Buzz profile.",
					"id" => $shortname."_buzz",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "iChat URL",
					"desc" => "Full URL address of your iChat connection.",
					"id" => $shortname."_ichat",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Last.fm profile URL",
					"desc" => "Full URL address of your Last.fm profile.",
					"id" => $shortname."_lastfm",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "LinkedIn profile URL",
					"desc" => "Full URL address of your LinkedIn profile.",
					"id" => $shortname."_linkedin",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "MobyPicture profile URL",
					"desc" => "Full URL address of your MobyPicture profile.",
					"id" => $shortname."_mobypicture",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "MySpace profile URL",
					"desc" => "Full URL address of your MySpace profile.",
					"id" => $shortname."_myspace",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Pinterest profile URL",
					"desc" => "Full URL address of your Pinterest profile.",
					"id" => $shortname."_pinterest",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Skype URL",
					"desc" => "Full URL address of your Skype connection.",
					"id" => $shortname."_skype",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "StumbleUpon profile URL",
					"desc" => "Full URL address of your StumbleUpon profile.",
					"id" => $shortname."_stumbleupon",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Tumblr URL",
					"desc" => "Full URL address of your Tumblr blog/profile.",
					"id" => $shortname."_tumblr",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Vimeo profile URL",
					"desc" => "Full URL address of your Vimeo profile.",
					"id" => $shortname."_vimeo",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "YouTube profile URL",
					"desc" => "Full URL address of your YouTube profile.",
					"id" => $shortname."_youtube",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Xing profile URL",
					"desc" => "Full URL address of your Xing profile.",
					"id" => $shortname."_xing",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Tweaks",
					"type" => "heading");

$options[] = array( "name" => "Disable Galleria Shortcode",
					"desc" => "Disable the <code>[galleria]</code> shortcode if you don't want to use it (the Galleria script will not be loaded). This setting doesn't affect slider options.",
					"id" => $shortname."_disable_galleria",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Disable Nivo Shortcode",
					"desc" => "Disable the <code>[nivo]</code> shortcode if you don't want to use it (the Nivo script will not be loaded). This setting doesn't affect slider options.",
					"id" => $shortname."_disable_nivo",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Disable Video Shortcode",
					"desc" => "Disable the <code>[video]</code> shortcode if you don't want to use it (the FlowPlayer script will not be loaded).",
					"id" => $shortname."_disable_video_shortcode",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Disable Media Shortcodes",
					"desc" => "Disable the <code>[youtube]</code>, <code>[vimeo]</code> and <code>[dailymotion]</code> shortcodes (if you prefer to use different embedding shortcodes).",
					"id" => $shortname."_disable_media_shortcodes",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Remove 'generator' Meta Tag",
					"desc" => "Remove the 'generator' meta tag from the 'head' section.",
					"id" => $shortname."_remove_generator",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Remove 'index', 'next' and 'prev' Links",
					"desc" => "Remove 'index', 'next' and 'prev' links from the 'head' section.",
					"id" => $shortname."_remove_nav_links",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Remove Feeds Links",
					"desc" => "Remove links to post and comment feeds from the 'head' section.",
					"id" => $shortname."_remove_feeds",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Remove Extra Feeds Links",
					"desc" => "Remove links to the extra feeds (category feed etc.) from the 'head' section.",
					"id" => $shortname."_remove_extra_feeds",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Remove RSD Link",
					"desc" => "Remove links to the <a href='http://en.wikipedia.org/wiki/Really_Simple_Discovery' target='_blank'>Really Simple Discovery</a> service endpoint from the 'head' section.",
					"id" => $shortname."_remove_rsd",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Remove WLW Manifest",
					"desc" => "Remove links to the Windows Live Writer manifest file from the 'head' section.",
					"id" => $shortname."_remove_wlw",
					"std" => "false",
					"type" => "checkbox"); 

$options[] = array( "name" => "Enable Shortcodes Preview",
					"desc" => "Enable the shortcodes code preview in the Shortcode Manager. Useful for testing or educational purposes.",
					"id" => $shortname."_shortcodes_preview",
					"std" => "false",
					"type" => "checkbox"); 

update_option('of_template', $options); 					  
update_option('of_themename', $themename);   
update_option('of_shortname', $shortname);

}
}
?>
