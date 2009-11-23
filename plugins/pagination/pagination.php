<?php
/*
Plugin Name: pagination
Plugin URI: http://github.com/dkastner/pagination
Description: Customizable pagination.
Version: 1.0
Author: Derek Kastner
Author URI: http://plusrw.wordpress.com
*/


/*  
	This plugin is a modification to Lester Chan's WP-PageNavi plugin 
		(http://lesterchan.net/wordpress/readme/pagination.html)

	Copyright 2008  Derek Kastner  (email : dkastner@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


// Use WordPress 2.6 Constants
if (!defined('WP_CONTENT_DIR')) {
	define( 'WP_CONTENT_DIR', ABSPATH.'wp-content');
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
}
if (!defined('WP_PLUGIN_DIR')) {
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');
}
if (!defined('WP_PLUGIN_URL')) {
	define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
}

// Create Text Domain For Translations
add_action('init', 'pagination_textdomain');
function pagination_textdomain() {
	if (!function_exists('wp_print_styles')) {
		load_plugin_textdomain('pagination', 'wp-content/plugins/pagination');
	} else {
		load_plugin_textdomain('pagination', false, 'pagination');
	}
}


// Page Navigation Option Menu
add_action('admin_menu', 'pagination_menu');
function pagination_menu() {
	if (function_exists('add_options_page')) {
		add_options_page(__('Pagination', 'pagination'), __('Pagination', 'pagination'), 'manage_options', 'pagination/pagination-options.php') ;
	}
}

// Function: Page Navigation Options
add_action('activate_pagination/pagination.php', 'pagination_init');
function pagination_init() {
	$pagination_options = array();
	$pagination_options['num_pages'] = 5;
	$pagination_options['always_show'] = 0;
	add_option('pagination_options', $pagination_options, 'Pagination Options');
}
?>
