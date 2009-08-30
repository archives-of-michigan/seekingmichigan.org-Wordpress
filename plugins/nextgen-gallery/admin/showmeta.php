<?php

// look up for the path
require_once( dirname( dirname(__FILE__) ) . '/ngg-config.php');

require_once(NGGALLERY_ABSPATH.'/lib/meta.php');
require_once(NGGALLERY_ABSPATH.'/lib/image.php');

if ( !is_user_logged_in() )
	die(__('Cheatin&#8217; uh?'));
	
if ( !current_user_can('NextGEN Manage gallery') ) 
	die(__('Cheatin&#8217; uh?'));

function get_out_now() { exit; }
add_action( 'shutdown', 'get_out_now', -1 );

global $wpdb;

$id = (int) $_GET['id'];
// let's get the image data
$picture = nggdb::find_image($id);
// let's get the meta data'
$meta = new nggMeta($picture->imagePath);
$exifdata = $meta->get_EXIF();
$iptcdata = $meta->get_IPTC();
$xmpdata = $meta->get_XMP();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo get_option( 'siteurl' ) ?>/wp-admin/wp-admin.css?version=<?php bloginfo('version'); ?>" type="text/css" />
<style type="text/css">
	#TB_title{
		background-color:#222222;
		color:#CFCFCF;
	}
</style>
</head>
<body class="wp-admin">

	<!-- EXIF DATA -->
	<fieldset class="options nggallery">
	<h3><?php _e('EXIF Data','nggallery'); ?></h3>
	<?php if ($exifdata) { ?>
		<table id="the-list-x" width="100%" cellspacing="3" cellpadding="3">
			<thead>
				<tr>
					<th scope="col"><?php _e('Tag','nggallery'); ?></th>
					<th scope="col"><?php _e('Value','nggallery'); ?></th>
				</tr>
			</thead>
	<?php 
			foreach ($exifdata as $key => $value){
				$class = ( $class == 'class="alternate"' ) ? '' : 'class="alternate"';
				echo '<tr '.$class.'>	
						<td style="width:230px">'.$meta->i8n_name($key).'</td>
						<td>'.$value.'</td>
					</tr>';
			}
	?>
		</table>
	<?php  } else echo "<strong>". __('No exif data','nggallery'). "</strong>"; ?>
	</fieldset>

	<!-- IPTC DATA -->
	<?php if ($iptcdata) { ?>
	<fieldset class="options nggallery">
	<h3><?php _e('IPTC Data','nggallery'); ?></h3>
		<table id="the-list-x" width="100%" cellspacing="3" cellpadding="3">
			<thead>
				<tr>
					<th scope="col"><?php _e('Tag','nggallery'); ?></th>
					<th scope="col"><?php _e('Value','nggallery'); ?></th>
				</tr>
			</thead>
	<?php 
			foreach ($iptcdata as $key => $value){
				$class = ( $class == 'class="alternate"' ) ? '' : 'class="alternate"';
				echo '<tr '.$class.'>	
						<td style="width:230px">'.$meta->i8n_name($key).'</td>
						<td>'.$value.'</td>
					</tr>';
			}
	?>
		</table>
	</fieldset>
	<?php  } ?>

	<!-- XMP DATA -->
	<?php if ($xmpdata) { ?>
	<fieldset class="options nggallery">
	<h3><?php _e('XMP Data','nggallery'); ?></h3>
		<table id="the-list-x" width="100%" cellspacing="3" cellpadding="3">
			<thead>
				<tr>
					<th scope="col"><?php _e('Tag','nggallery'); ?></th>
					<th scope="col"><?php _e('Value','nggallery'); ?></th>
				</tr>
			</thead>
	<?php 
			foreach ($xmpdata as $key => $value){
				$class = ( $class == 'class="alternate"' ) ? '' : 'class="alternate"';
				echo '<tr '.$class.'>	
						<td style="width:230px">'.$meta->i8n_name($key).'</td>
						<td>'.$value.'</td>
					</tr>';
			}
	?>
		</table>
	</fieldset>
	<?php  } ?>

</body>
</html>