<?php

/**
 * @author Alex Rabe
 * @copyright 2008
 */

function nggallery_sortorder($galleryID = 0){
	global $wpdb, $ngg;
	
	if ($galleryID == 0) return;

	$galleryID = (int) $galleryID;
	
	if (isset ($_POST['updateSortorder']))  {
		check_admin_referer('ngg_updatesortorder');
		// get variable new sortorder 
		parse_str($_POST['sortorder']);
		if (is_array($sortArray)){ 
			$neworder = array();
			foreach($sortArray as $pid) {		
				$pid = substr($pid, 4); // get id from "pid-x"
				$neworder[] = (int) $pid;
			}
			$sortindex = 1;
			foreach($neworder as $pic_id) {
				$wpdb->query("UPDATE $wpdb->nggpictures SET sortorder = '$sortindex' WHERE pid = $pic_id");
				$sortindex++;
			}
			nggGallery::show_message(__('Sort order changed','nggallery'));
		} 
	}
	
	//TODO:A unique gallery call must provide me with this information, like $gallery  = new nggGallery($id);
	
	// get gallery values
	$act_gallery = $wpdb->get_row("SELECT * FROM $wpdb->nggallery WHERE gid = '$galleryID' ");

	// set gallery url
	$act_gallery_url 	= get_option ('siteurl')."/".$act_gallery->path."/";
	$act_thumbnail_url 	= get_option ('siteurl')."/".$act_gallery->path.nggGallery::get_thumbnail_folder($act_gallery->path, FALSE);

	// look for presort args	
	$presort = $_GET['presort'];
	$dir = ( $_GET['dir'] == 'DESC' ) ? 'DESC' : 'ASC';
	$sortitems = array('pid', 'filename', 'alttext', 'imagedate');
	// ensure that nobody added some evil sorting :-)
	if (in_array( $presort, $sortitems) )
		$picturelist = $wpdb->get_results("SELECT * FROM $wpdb->nggpictures WHERE galleryid = '$galleryID' ORDER BY {$presort} {$dir}");
	else	
		$picturelist = $wpdb->get_results("SELECT * FROM $wpdb->nggpictures WHERE galleryid = '$galleryID' ORDER BY sortorder {$dir}");

	//this is the url without any presort variable
	$clean_url = 'admin.php?page=nggallery-manage-gallery&amp;mode=sort&amp;gid=' . $galleryID;
	// In the case somebody presort, then we take this url
	if ( isset($_GET['dir']) || isset($_GET['presort']) )
		$base_url = $_SERVER['REQUEST_URI'];
	else		
		$base_url = $clean_url;
	
?>
	<script type='text/javascript' src='<?php echo NGGALLERY_URLPATH ?>admin/js/sorter.js'></script>
	<div class="wrap">
		<form id="sortGallery" method="POST" action="<?php echo $clean_url ?>" onsubmit="saveImageOrder()" accept-charset="utf-8">
			<h2><?php _e('Sort Gallery', 'nggallery') ?></h2>
			<div class="tablenav">
				<div class="alignleft actions">
					<?php wp_nonce_field('ngg_updatesortorder') ?>
					<input class="button-primary action" type="submit" name="updateSortorder" onclick="saveImageOrder()" value="<?php _e('Update Sort Order', 'nggallery') ?>" />
				</div>
				<div class="alignright actions">
					<input class="button-secondary action" type="submit" name="backToGallery" value="<?php _e('Back to gallery', 'nggallery') ?>" />
				</div>
			</div>	
			<input name="sortorder" type="hidden" />
			<ul class="subsubsub">
				<li><?php _e('Presort', 'nggallery') ?> :</li>
				<li><a href="<?php echo attribute_escape(remove_query_arg('presort', $base_url)); ?>" <?php if ($presort == '') echo 'class="current"'; ?>><?php _e('Unsorted', 'nggallery') ?></a> |</li>
				<li><a href="<?php echo attribute_escape(add_query_arg('presort', 'pid', $base_url)); ?>" <?php if ($presort == 'pid') echo 'class="current"'; ?>><?php _e('Image ID', 'nggallery') ?></a> |</li>
				<li><a href="<?php echo attribute_escape(add_query_arg('presort', 'filename', $base_url)); ?>" <?php if ($presort == 'filename') echo 'class="current"'; ?>><?php _e('Filename', 'nggallery') ?></a> |</li>
				<li><a href="<?php echo attribute_escape(add_query_arg('presort', 'alttext', $base_url)); ?>" <?php if ($presort == 'alttext') echo 'class="current"'; ?>><?php _e('Alt/Title text', 'nggallery') ?></a> |</li>
				<li><a href="<?php echo attribute_escape(add_query_arg('presort', 'imagedate', $base_url)); ?>" <?php if ($presort == 'imagedate') echo 'class="current"'; ?>><?php _e('Date/Time', 'nggallery') ?></a> |</li>
				<li><a href="<?php echo attribute_escape(add_query_arg('dir', 'ASC', $base_url)); ?>" <?php if ($dir == 'ASC') echo 'class="current"'; ?>><?php _e('Ascending', 'nggallery') ?></a> |</li>
				<li><a href="<?php echo attribute_escape(add_query_arg('dir', 'DESC', $base_url)); ?>" <?php if ($dir == 'DESC') echo 'class="current"'; ?>><?php _e('Descending', 'nggallery') ?></a></li>
			</ul>
		</form>
		<div id="debug" style="clear:both"></div>
		<?php 
		if($picturelist) {
			foreach($picturelist as $picture) {
				?>
				<div class="imageBox" id="pid-<?php echo $picture->pid ?>">
					<div class="imageBox_theImage" style="background-image:url('<?php echo $act_thumbnail_url ."thumbs_" .$picture->filename ?>')"></div>	
					<div class="imageBox_label"><span><?php echo stripslashes($picture->alttext) ?></span></div>
				</div>
				<?php
			}
		}
		?>
		<div id="insertionMarker">
			<img src="<?php echo NGGALLERY_URLPATH ?>admin/images/marker_top.gif"/>
			<img src="<?php echo NGGALLERY_URLPATH ?>admin/images/marker_middle.gif" id="insertionMarkerLine"/>
			<img src="<?php echo NGGALLERY_URLPATH ?>admin/images/marker_bottom.gif"/>
		</div>
		<div id="dragDropContent"></div>
	</div>
	
<?php
}
?>