<?php
add_action('init', 'e404_slideshow_taxonomy_init');
function e404_slideshow_taxonomy_init() {
	$labels = array(
					'name' => __('Slideshows', 'shiny'),
					'singular_name' => __('Slideshows', 'shiny'),
					'all_items' => __('Slideshows', 'shiny'),
					'edit_item' => __('Edit Slideshow', 'shiny'),
					'update_item' => __('Update Slideshow', 'shiny'),
					'add_new_item' => __('Add New Slideshow', 'shiny'),
					'new_item_name' => __('New Slideshow Name', 'shiny'),
					'search_items' => __('Search Slideshows', 'shiny'),
					'parent_item' => __('Parent Slideshow', 'shiny')
	);
	register_taxonomy('e404_slideshow', 'e404_slide',
		array(
			'labels' => $labels,
			'hierarchical' => true,
			'sort' => true,
			'args' => array('orderby' => 'term_order')
		)
	);
}

add_action('init', 'e404_slide_post_type_init');
function e404_slide_post_type_init() {
	$labels = array(
					'name' => __('Slides', 'shiny'),
					'singular_name' => __('Slide', 'shiny'),
					'add_new_item' => __('Add New Slide', 'shiny'),
					'edit_item' => __('Edit Slide', 'shiny'),
					'new_item' => __('New Slide', 'shiny'),
					'view_item' => __('View Slide', 'shiny'),
					'search_items' => __('Search Slides', 'shiny'),
					'not_found' => __('No slides found', 'shiny')
	);
	register_post_type('e404_slide',
		array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'has_archive' => false,
			'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
			'taxonomies' => array('e404_slideshow'),
			'rewrite' => array('slug' => 'slide')
		)
	);
}

function e404_custom_featured_image_text($content) {
	global $post;
	if($post->post_type == 'e404_slide') {
		$content = str_replace(__('Set featured image'), __('Set slide image', 'shiny'), $content);
		$content = str_replace(__('Remove featured image'), __('Remove slide image', 'shiny'), $content);
	}
	return $content;
}
add_filter('admin_post_thumbnail_html', 'e404_custom_featured_image_text');

function e404_remove_preview_button() {
	global $post_type;
	if($post_type == 'e404_slide') {
		echo '<style type="text/css">#view-post-btn, #post-preview { display: none; }</style>';
	}
}
add_action('admin_head', 'e404_remove_preview_button');

add_action('init', 'e404_portfolio_post_type_init');
function e404_portfolio_post_type_init() {
	$labels = array(
					'name' => __('Portfolio', 'shiny'),
					'singular_name' => __('Portfolio', 'shiny'),
					'add_new_item' => __('Add New Portfolio Item', 'shiny'),
					'edit_item' => __('Edit Portfolio Item', 'shiny'),
					'new_item' => __('New Portfolio Item', 'shiny'),
					'view_item' => __('View Portfolio Item', 'shiny'),
					'search_items' => __('Search Portfolio', 'shiny'),
					'not_found' => __('No portfolio items found', 'shiny')
	);
	$slug = get_option('e404_portfolio_slug');
	if(!$slug)
		$slug = 'portfolio';
	register_post_type('portfolio',
		array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => false,
			'supports' => array('title', 'editor', 'excerpt', 'page-attributes', 'thumbnail'),
			'taxonomies' => array('portfolio-category', 'portfolio-tag'),
			'rewrite' => array('slug' => $slug)
		)
	);
	
	// add custom rewrite rule to avoid taxonomy, custom post types and page slug conflict
	$page_id = get_option('e404_portfolio_page');
	if($page_id != 0) {
		$page = get_page($page_id);
		if($page->post_name == $slug) {
			add_rewrite_rule($page->post_name.'/page/([0-9]+)/?$', 'index.php?pagename='.$page->post_name.'&paged=$matches[1]', 'top');
			$child_pages = get_pages(array('child_of' => $page_id));
			foreach($child_pages as $child_page) {
				add_rewrite_rule($page->post_name.'/'.$child_page->post_name.'/?$', 'index.php?pagename='.$page->post_name.'/'.$child_page->post_name, 'top');
				add_rewrite_rule($page->post_name.'/'.$child_page->post_name.'/page/([0-9]+)/?$', 'index.php?pagename='.$page->post_name.'/'.$child_page->post_name.'&paged=$matches[1]', 'top');
			}
		}
	}
}

function e404_get_taxonomy_name($taxonomy) {
	$name = '';
	switch ($taxonomy) {
		case 'categories':
			$name = get_option('e404_portfolio_categories_name');
			if(!$name || empty($name))
				$name = __('Portfolio Categories', 'shiny');
			break;
		case 'tags':
			$name = get_option('e404_portfolio_tags_name');
			if(!$name || empty($name))
				$name = __('Portfolio Tags', 'shiny');
			break;	
	}
	return $name;
}

add_action('init', 'e404_portfolio_category_taxonomy_init');
function e404_portfolio_category_taxonomy_init() {
	$categories_name = e404_get_taxonomy_name('categories');
	$labels = array(
					'name' => $categories_name
	);
	$slug = get_option('e404_portfolio_slug');
	if(!$slug)
		$slug = 'portfolio';
	$category_slug = get_option('e404_portfolio_category_slug');
	if(!$category_slug)
		$category_slug = 'category';
	register_taxonomy('portfolio-category', 'portfolio',
		array(
			'labels' => $labels,
			'hierarchical' => true,
			'sort' => true,
			'args' => array('orderby' => 'term_order'),
			'rewrite' => array('slug' => $slug.'/'.$category_slug))
	);
	add_rewrite_rule($slug.'/'.$category_slug.'/page/([0-9]+)/?$', 'index.php?portfolio-category=$matches[1]&paged=$matches[2]', 'top');
	add_rewrite_rule($slug.'/'.$category_slug.'/([^/]+)/?$', 'index.php?portfolio-category=$matches[1]', 'top');
}

add_action('init', 'e404_portfolio_tag_taxonomy_init');
function e404_portfolio_tag_taxonomy_init() {
	$tags_name = e404_get_taxonomy_name('tags');
	$labels = array(
					'name' => $tags_name
	);
	$slug = get_option('e404_portfolio_slug');
	if(!$slug)
		$slug = 'portfolio';
	$tag_slug = get_option('e404_portfolio_tag_slug');
	if(!$tag_slug)
		$tag_slug = 'tag';
	register_taxonomy('portfolio-tag', 'portfolio',
		array(
			'labels' => $labels,
			'hierarchical' => false,
			'sort' => true,
			'args' => array('orderby' => 'term_order'),
			'rewrite' => array('slug' => $slug.'/'.$tag_slug))
	);
	add_rewrite_rule($slug.'/'.$tag_slug.'/page/([0-9]+)/?$', 'index.php?portfolio-tag=$matches[1]&paged=$matches[2]', 'top');
	add_rewrite_rule($slug.'/'.$tag_slug.'/([^/]+)/?$', 'index.php?portfolio-tag=$matches[1]', 'top');
}

add_filter('manage_e404_slide_posts_columns', 'e404_slideshow_columns');
function e404_slideshow_columns($defaults) {
	$defaults['e404_slideshow'] = __('Slideshow', 'shiny');
	unset($defaults['e404_likes']);
	return $defaults;
}

add_action('manage_e404_slide_posts_custom_column', 'e404_slideshow_column', 10, 2);
add_action('manage_portfolio_posts_custom_column', 'e404_slideshow_column', 10, 2);
function e404_slideshow_column($column_name, $post_id) {
	if($column_name == 'e404_likes')
		return;
	$post_type = get_post_type($post_id);
	$terms = get_the_terms($post_id, $column_name);
	if (!empty($terms)) {
		foreach ($terms as $term)
			$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$column_name}={$term->slug}'> " . esc_html($term->name) . "</a>";
		echo join( ', ', $post_terms );
	} else {
		echo '<i>'.__('None', 'shiny').'</i>';
	}
}

add_filter('manage_portfolio_posts_columns', 'e404_portfolio_columns');
function e404_portfolio_columns($defaults) {
	global $e404_all_options;
	$defaults['portfolio-category'] = __('Category', 'shiny');
	$defaults['portfolio-tag'] = __('Tags', 'shiny');
	if(isset($defaults['e404_likes'])) {
		unset($defaults['e404_likes']);
	}
	if($e404_all_options['e404_portfolio_like_this'] == 'true') {
		$defaults['e404_likes'] = __('Likes', 'shiny');
	}
	return $defaults;
}

add_filter('manage_posts_columns', 'e404_posts_columns');
function e404_posts_columns($defaults) {
	global $e404_all_options;
	if($e404_all_options['e404_blog_like_this'] == 'true') {
		$defaults['e404_likes'] = __('Likes', 'shiny');
	}
	return $defaults;
}

add_filter('manage_posts_custom_column', 'e404_posts_custom_column');
function e404_posts_custom_column($column_name) {
	global $post;
	if($column_name == 'e404_likes') {
		echo e404_get_likes($post->ID);
	}
}

add_filter('manage_edit-portfolio_sortable_columns', 'e404_like_sortable_column');
add_filter('manage_edit-post_sortable_columns', 'e404_like_sortable_column');
function e404_like_sortable_column($columns) {
	$columns['e404_likes'] = 'e404_likes';
	return $columns;
}

add_action('load-edit.php', 'e404_edit_sort_load');
function e404_edit_sort_load() {
	add_filter('request', 'e404_sort_portfolio');
	add_filter('request', 'e404_sort_posts');
}
function e404_sort_portfolio($vars) {
	if(isset($vars['post_type']) && 'portfolio' == $vars['post_type']) {
		if(isset($vars['orderby']) && 'e404_likes' == $vars['orderby']) {
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => '_likes',
					'orderby' => 'meta_value_num'
				)
			);
		}
	}
	return $vars;
}

function e404_sort_posts($vars) {
	if(isset($vars['post_type']) && 'post' == $vars['post_type']) {
		if(isset($vars['orderby']) && 'e404_likes' == $vars['orderby']) {
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => '_likes',
					'orderby' => 'meta_value_num'
				)
			);
		}
	}
	return $vars;
}

add_action('init', 'e404_flush_rules', 99);
function e404_flush_rules() {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}

function e404_get_front() {
	global $wp_rewrite;
	return substr($wp_rewrite->front, 1, strlen($wp_rewrite->front) - 1);
}

function remove_parent($var) {
	if ($var == 'current_page_item' || $var == 'current_page_parent' || $var == 'current_page_ancestor'  || $var == 'current-menu-item')
		return false;
	return true;
}

function add_class_to_cpt_menu($classes) {
	global $wpdb;
	if (get_post_type() == 'portfolio') {
		$page_id = get_option('e404_portfolio_page');
		$menu_id = $wpdb->get_var('SELECT post_id FROM '.$wpdb->postmeta.' WHERE meta_key = "_menu_item_object_id" AND meta_value = "'.$page_id.'"');
		$classes = array_filter($classes, "remove_parent");
		if (in_array('menu-item-'.$menu_id, $classes))
			$classes[] = 'current_page_parent current-page-ancestor current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor';
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_class_to_cpt_menu');

// source: http://themeforest.net/forums/thread/wordpress-custom-page-type-taxonomy-pagination/43010?page=2#401663
$option_posts_per_page = get_option('posts_per_page');
add_action('init', 'e404_portfolio_per_page', 0);
function e404_portfolio_per_page() {
	add_filter('option_posts_per_page', 'e404_option_portfolio_per_page');
}
function e404_option_portfolio_per_page($value) {
	global $option_posts_per_page;
	if(is_tax('portfolio-category')) {
		return get_option('e404_portfolio_posts_per_page');
	} else {
		return $option_posts_per_page;
	}
}

?>