<?php
require_once(OF_FILEPATH.'/lib/meta-box.php');

$meta_boxes = array();

// Slide meta box
$meta_boxes[] = array(
	'id' => 'e404_slide',
	'title' => __('Slide options', 'shiny'),
	'pages' => array('e404_slide'),

	'fields' => array(
		array(
			'name' => __('Target URL (optional)', 'shiny'),
			'id' => 'e404_slide_target_url',
			'type' => 'text'
		)
	)
);

$meta_sidebars = array();
foreach($e404_custom_sidebars as $sidebar) {
	$meta_sidebars[$sidebar] = $sidebar;
}

$meta_boxes[] = array(
	'id' => 'e404_blog_custom_sidebar',
	'title' => __('Custom Sidebar', 'shiny'),
	'pages' => array('page', 'post'),
	'context' => 'side',

	'fields' => array(
		array(
			'name' => __('Sidebar', 'shiny'),
			'id' => 'e404_custom_sidebar',
			'type' => 'select',
			'options' => $meta_sidebars
		)
	)
);

$meta_boxes[] = array(
	'id' => 'e404_blog_thumbnail_settings',
	'title' => __('Thumbnail Settings', 'shiny'),
	'pages' => array('post'),

	'fields' => array(
		array(
			'name' => __('PrettyPhoto (Lightbox)', 'shiny'),
			'id' => 'e404_thumbnail_prettyphoto',
			'type' => 'select',
			'options' => array('default' => '-- default --',
							   'true' => 'Enabled',
							   'false' => 'Disabled')
		)
	)
);

foreach ($meta_boxes as $meta_box) {
	$my_box = new RW_Meta_Box($meta_box);
}

add_action('do_meta_boxes', 'e404_slide_image_box');
function e404_slide_image_box() {
	remove_meta_box('postimagediv', 'e404_slide', 'side');
	add_meta_box('postimagediv', __('Slide Image', 'shiny'), 'post_thumbnail_meta_box', 'e404_slide', 'normal', 'high');
}

require_once(OF_FILEPATH.'/lib/MetaBox.php');
require_once(OF_FILEPATH.'/lib/MediaAccess.php');

$wpalchemy_media_access = new WPAlchemy_MediaAccess();

$e404_awkward_options = new WPAlchemy_MetaBox(array
(
	'id' => 'e404_awkward_options',
	'title' => 'Awkward Showcase Options',
	'types' => array('e404_slide'),
	'context' => 'normal',
	'template' => OF_FILEPATH.'/inc/meta-awkward-options.php'
));

$e404_portfolio_preview_options = new WPAlchemy_MetaBox(array
(
	'id' => 'e404_portfolio_preview_options',
	'title' => 'Portfolio Preview Options',
	'types' => array('portfolio'),
	'context' => 'normal',
	'template' => OF_FILEPATH.'/inc/meta-portfolio-preview-options.php'
));

function e404_set_coords_button_js() {
?>
<script type="text/javascript">
	function refreshButtons() {
		jQuery('.set_coords_button').each(function() {
			var prev_name = jQuery(this).attr('name');
			prev_name = prev_name.replace('e404_awkward_options[tooltips][', '');
			prev_name = prev_name.replace('][coords_button]', '');
			jQuery(this).attr('alt', jQuery(this).attr('alt').replace(/eid=[0-9]{1,}/, 'eid=' + prev_name));
		});
	}
    jQuery(document).ready(function() {
		jQuery('.set_coords_button').attr('alt', jQuery('.set_coords_button').attr('alt') + jQuery('#post_ID').val());
		jQuery('[class*=docopy-]').click(function(e) {
			refreshButtons();
		});
		refreshButtons();
    });
</script>	
<?php
}
if(is_admin()) {
	add_action('admin_head', 'e404_set_coords_button_js');
	add_action('init', 'add_metabox_css');
	function add_metabox_css() {
		wp_enqueue_style('metabox', OF_DIRECTORY.'/css/meta.css');
	}
}

?>