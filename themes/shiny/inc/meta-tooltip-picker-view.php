<?php
$wp_load = "../wp-load.php";
$i = 0;
while(!file_exists($wp_load) && $i++ < 10) {
	$wp_load = "../".$wp_load;
}
require($wp_load);

$e404_options = get_option('of_options');
$slider_height = (int)$e404_options['e404_home_slider_height'];
if($slider_height == 0)
	$slider_height = 300;
$slider_width = $e404_all_options['e404_slider_width'];
unset($e404_options);

$template_dir = get_bloginfo('template_directory');
$image = wp_get_attachment_image_src(get_post_thumbnail_id($_GET['id']), 'full');
$eid = $_GET['eid'];

if(!is_user_logged_in() || !current_user_can('edit_posts'))
	wp_die(__("You are not allowed to be here"));

echo "<script type='text/javascript' src='".site_url()."/wp-includes/js/jquery/jquery.js'></script>";

?>
<script type="text/javascript">
    function insertCoords(x, y) {
        var coords_x = window.parent.document.getElementsByName("e404_awkward_options[tooltips]["+<?php echo $eid; ?>+"][coords_x]");
        var coords_y = window.parent.document.getElementsByName("e404_awkward_options[tooltips]["+<?php echo $eid; ?>+"][coords_y]");
		coords_x[0].value = x;
		coords_y[0].value = y;
		jQuery('#marker').css('left', x - 16).css('top', y + 16).show();
    }
    function showCoords() {
        var coords_x = window.parent.document.getElementsByName("e404_awkward_options[tooltips]["+<?php echo $eid; ?>+"][coords_x]");
        var coords_y = window.parent.document.getElementsByName("e404_awkward_options[tooltips]["+<?php echo $eid; ?>+"][coords_y]");
		x = parseInt(coords_x[0].value);
		y = parseInt(coords_y[0].value);
		if(x > 0 && y > 0) {
			jQuery('#marker').css('left', x - 16).css('top', y + 16).show();
		}
    }
	function showOther() {
		var i = 0;
		jQuery('input[name*="[coords_x]"]').each(function() {
			if(jQuery(this).attr('name') != "e404_awkward_options[tooltips]["+<?php echo $eid; ?>+"][coords_x]" && jQuery(this).val() > 0) {
				i++;
				var x = parseInt(jQuery(this).val());
				var y = parseInt(jQuery(this).next('input').val());
				jQuery('#imgwrapper').append('<div id="img'+i+'" style="background-image: url(\'<?php echo $template_dir; ?>/images/aw-showcase/plus.png\'); width: 32px; height: 32px; position: absolute;"></div>');
				jQuery('#img'+i).css('left', x - 16).css('top', y + 16);
			}
		});
	}
	function window_resize() {
	    jQuery('#TB_window').css({'marginLeft': -(<?php echo $slider_width; ?> / 2)})
        jQuery('#TB_window, #TB_iframeContent').width(<?php echo $slider_width; ?>).height(<?php echo $slider_height; ?>);
		jQuery('#TB_ajaxContent').css('padding', '0');
	}
    jQuery(document).ready(function() {
		jQuery('#image').click(function(e) {
			var offset = jQuery(this).offset();
			var x = Math.floor(e.pageX - offset.left);
			var y = Math.floor(e.pageY - offset.top);
			insertCoords(x, y);
		});
		jQuery(window).bind('resize', window_resize);
		window_resize();
		showCoords();
		showOther();
    });
</script>

<div id="imgwrapper">
<div style="background-image: url('<?php echo $template_dir; ?>/images/aw-showcase/plus-curr.png'); display: none; width: 32px; height: 32px; position: absolute;" id="marker"></div>

<?php
if($image) :
?>
<img src="<?php echo e404_img_scale($image[0], $slider_width, $slider_height); ?>" id="image" />
<?php
else :
?>
<div style="text-align: center;">You should set a slide image (featured image) first</div>
<?php
endif;
?>
</div>
