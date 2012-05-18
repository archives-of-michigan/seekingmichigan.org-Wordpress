<?php
$e404_all_options = get_option('of_options');

function e404_strip_raw($content) {
	return str_replace(array('[raw]', '[/raw]'), '', $content);
}

// main options
$e404_options['theme_style'] = $e404_all_options['e404_theme_style'];
$e404_options['timthumb_path'] = OF_DIRECTORY.'/lib/timthumb.php';
$logo_url = get_option('e404_logo');
$e404_options['logo_url'] = ($logo_url) ? $logo_url : OF_DIRECTORY.'/images/logo.png';
$e404_options['breadcrumbs'] = ($e404_all_options['e404_breadcrumbs'] == 'true') ? true : false;
$e404_options['page_titles'] = ($e404_all_options['e404_page_titles'] == 'true') ? true : false;
$e404_options['excerpt_length'] = $e404_all_options['e404_excerpt_length'];

// header options
$e404_options['remove_search_form'] = ($e404_all_options['e404_remove_search_form'] == 'true') ? true : false;
$e404_options['remove_top_contact_box'] = ($e404_all_options['e404_remove_top_contact_box'] == 'true') ? true : false;
$e404_options['top_contact_box'] = $e404_all_options['e404_top_contact_box'];

// footer options
$e404_options['footer_below_left'] = stripslashes($e404_all_options['e404_footer_below_left']);
$e404_options['footer_below_right'] = stripslashes($e404_all_options['e404_footer_below_right']);

// Twitter options
$twitter_username = $e404_all_options['e404_twitter'];
$e404_options['twitter'] = ($twitter_username) ? 'http://twitter.com/'.$twitter_username : false;

if($e404_all_options['e404_twitter']) {
	$tweet = e404_get_tweets($e404_all_options['e404_twitter'], 1);
	$tweet[0]['text'] = twitter_users(twitter_hyperlinks($tweet[0]['text']));
}

// main intro box options
$e404_options['intro_text'] = '';
$intro_type = $e404_options['main_intro_type'] = $e404_all_options['e404_intro_type'];
if($intro_type == 'html')
	$e404_options['intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_intro_text'])));
elseif($intro_type == 'twitter' && $e404_all_options['e404_twitter']) {
	$e404_options['intro_text'] = $tweet[0]['text'];
}

// home page options
$e404_options['home_slider'] = (empty($e404_all_options['e404_home_slider'])) ? false : true;

// blog options
$blog_intro_type = $e404_options['blog_intro_type'] = $e404_all_options['e404_blog_intro_type'];
$e404_options['blog_intro_text'] = '';
if($blog_intro_type == 'main') {
	$e404_options['blog_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_intro_text'])));
	$e404_options['blog_intro_type'] = $intro_type;
}
if($blog_intro_type == 'html')
	$e404_options['blog_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_blog_intro_text'])));
if($blog_intro_type == 'twitter' && $e404_all_options['e404_twitter'])
	$e404_options['blog_intro_text'] = $tweet[0]['text'];

$e404_options['blog_use_thumbnail'] = ($e404_all_options['e404_blog_use_thumbnail'] == 'true') ? true : false;
$e404_options['blog_use_excerpt'] = ($e404_all_options['e404_blog_use_excerpt'] == 'true') ? true : false;
$e404_options['blog_prettyphoto'] = ($e404_all_options['e404_blog_prettyphoto'] == 'true') ? true : false;
$e404_options['blog_thumbnails_prettyphoto'] = ($e404_all_options['e404_blog_thumbnails_prettyphoto'] == 'true') ? true : false;
$e404_options['blog_share_it'] = ($e404_all_options['e404_blog_share_it'] == 'true') ? true : false;
$e404_options['blog_read_more'] = ($e404_all_options['e404_blog_read_more'] == 'true') ? true : false;
$e404_options['blog_read_more_text'] = $e404_all_options['e404_blog_read_more_text'];
$e404_options['blog_layout'] = $e404_all_options['e404_blog_layout'];
if(empty($e404_options['blog_layout']))
	$e404_options['blog_layout'] = 'sidebar-right';
$e404_options['blog_post_author'] = ($e404_all_options['e404_blog_post_author'] == 'true') ? true : false;
$e404_options['blog_post_categories'] = ($e404_all_options['e404_blog_post_categories'] == 'true') ? true : false;
$e404_options['blog_post_tags'] = ($e404_all_options['e404_blog_post_tags'] == 'true') ? true : false;
$e404_options['blog_author_bio'] = ($e404_all_options['e404_blog_author_bio'] == 'true') ? true : false;
$e404_options['blog_thumbnails_height'] = $e404_all_options['e404_blog_thumbnails_height'];

// civil war intro box options
$e404_options['civilwar_intro_text'] = '';
$civilwar_intro_type = $e404_options['civilwar_intro_type'] = $e404_all_options['e404_civilwar_intro_type'];
if($civilwar_intro_type == 'main') {
	$e404_options['civilwar_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_intro_text'])));
	$e404_options['civilwar_intro_type'] = $intro_type;
}
elseif($civilwar_intro_type == 'html')
	$e404_options['civilwar_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_civilwar_intro_text'])));
elseif($civilwar_intro_type == 'twitter' && $e404_all_options['e404_twitter'])
	$e404_options['civilwar_intro_text'] = $tweet[0]['text'];

// teach intro box options
$e404_options['teach_intro_text'] = '';
$teach_intro_type = $e404_options['teach_intro_type'] = $e404_all_options['e404_teach_intro_type'];
if($teach_intro_type == 'main') {
	$e404_options['teach_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_intro_text'])));
	$e404_options['teach_intro_type'] = $intro_type;
}
elseif($teach_intro_type == 'html')
	$e404_options['teach_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_teach_intro_text'])));
elseif($teach_intro_type == 'twitter' && $e404_all_options['e404_twitter'])
	$e404_options['teach_intro_text'] = $tweet[0]['text'];

// portfolio options
$e404_options['portfolio_intro_text'] = '';
$portfolio_intro_type = $e404_options['portfolio_intro_type'] = $e404_all_options['e404_portfolio_intro_type'];
if($portfolio_intro_type == 'main') {
	$e404_options['portfolio_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_intro_text'])));
	$e404_options['portfolio_intro_type'] = $intro_type;
}
elseif($portfolio_intro_type == 'html')
	$e404_options['portfolio_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_portfolio_intro_text'])));
elseif($portfolio_intro_type == 'twitter' && $e404_all_options['e404_twitter'])
	$e404_options['portfolio_intro_text'] = $tweet[0]['text'];

$e404_options['portfolio_layout'] = $e404_all_options['e404_portfolio_layout'];
$e404_options['portfolio_read_more'] = ($e404_all_options['e404_portfolio_read_more'] == 'true') ? true : false;
$e404_options['portfolio_read_more_text'] = $e404_all_options['e404_portfolio_read_more_text'];
$e404_options['portfolio_prettyphoto'] = ($e404_all_options['e404_portfolio_prettyphoto'] == 'true') ? true : false;
$e404_options['portfolio_titles'] = ($e404_all_options['e404_portfolio_titles'] == 'true') ? true : false;
$e404_options['portfolio_single_titles'] = ($e404_all_options['e404_portfolio_single_titles'] == 'true') ? true : false;
$e404_options['portfolio_item_tags'] = ($e404_all_options['e404_portfolio_item_tags'] == 'true') ? true : false;
$e404_options['portfolio_item_categories'] = ($e404_all_options['e404_portfolio_item_categories'] == 'true') ? true : false;
$e404_options['portfolio_thumbnails_height'] = $e404_all_options['e404_portfolio_thumbnails_height'];
$e404_options['portfolio_posts_per_page'] = (int)$e404_all_options['e404_portfolio_posts_per_page'];
if($e404_options['portfolio_posts_per_page'] == 0)
	$e404_options['portfolio_posts_per_page'] = 10;

// pages options
$e404_options['page_comments'] = ($e404_all_options['e404_page_comments'] == 'true') ? true : false;

// gallery options
$e404_options['gallery_intro_text'] = '';
$gallery_intro_type = $e404_options['gallery_intro_type'] = $e404_all_options['e404_gallery_intro_type'];
if($gallery_intro_type == 'main') {
	$e404_options['gallery_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_intro_text'])));
	$e404_options['gallery_intro_type'] = $intro_type;
}
elseif($gallery_intro_type == 'html')
	$e404_options['gallery_intro_text'] = e404_strip_raw(do_shortcode(stripslashes($e404_all_options['e404_gallery_intro_text'])));
elseif($gallery_intro_type == 'twitter' && $e404_all_options['e404_twitter'])
	$e404_options['gallery_intro_text'] = $tweet[0]['text'];

