<?php  

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {	die('You are not allowed to call this page directly.');}

function nggallery_picturelist() {
// *** show picture list
	global $wpdb, $nggdb, $user_ID, $ngg;
	
	// GET variables
	$act_gid    = $ngg->manage_page->gid;
	$showTags   = $ngg->manage_page->showTags;
	$hideThumbs = $ngg->manage_page->hideThumbs;
	
	// Load the gallery metadata
	$gallery = $nggdb->find_gallery($act_gid);

	if (!$gallery) {
		nggGallery::show_error(__('Gallery not found.', 'nggallery'));
		return;
	}
	
	// look for pagination	
	if ( ! isset( $_GET['paged'] ) || $_GET['paged'] < 1 )
		$_GET['paged'] = 1;
	
	$start = ( $_GET['paged'] - 1 ) * 50;
	
	// get picture values
	$picturelist = $nggdb->get_gallery($act_gid, $ngg->options['galSort'], $ngg->options['galSortDir'], false, 50, $start );
	
	// build pagination
	$page_links = paginate_links( array(
		'base' => add_query_arg( 'paged', '%#%' ),
		'format' => '',
		'prev_text' => __('&laquo;'),
		'next_text' => __('&raquo;'),
		'total' => $nggdb->paged['max_objects_per_page'],
		'current' => $_GET['paged']
	));
	
	// get the current author
	$act_author_user    = get_userdata( (int) $gallery->author );
	
	// list all galleries
	$gallerylist = $nggdb->find_all_galleries();
	
	//get the columns
	$gallery_columns = ngg_manage_gallery_columns();
	$hidden_columns  = get_hidden_columns('nggallery-manage-images');
	$num_columns     = count($gallery_columns) - count($hidden_columns);
?>

<script type="text/javascript"> 
<!--

function showDialog( windowId ) {
	var form = document.getElementById('updategallery');
	var elementlist = "";
	for (i = 0, n = form.elements.length; i < n; i++) {
		if(form.elements[i].type == "checkbox") {
			if(form.elements[i].name == "doaction[]")
				if(form.elements[i].checked == true)
					if (elementlist == "")
						elementlist = form.elements[i].value
					else
						elementlist += "," + form.elements[i].value ;
		}
	}
	jQuery("#" + windowId + "_bulkaction").val(jQuery("#bulkaction").val());
	jQuery("#" + windowId + "_imagelist").val(elementlist);
	// console.log (jQuery("#TB_imagelist").val());
	tb_show("", "#TB_inline?width=640&height=120&inlineId=" + windowId + "&modal=true", false);
}

function checkAll(form)
{
	for (i = 0, n = form.elements.length; i < n; i++) {
		if(form.elements[i].type == "checkbox") {
			if(form.elements[i].name == "doaction[]") {
				if(form.elements[i].checked == true)
					form.elements[i].checked = false;
				else
					form.elements[i].checked = true;
			}
		}
	}
}

function getNumChecked(form)
{
	var num = 0;
	for (i = 0, n = form.elements.length; i < n; i++) {
		if(form.elements[i].type == "checkbox") {
			if(form.elements[i].name == "doaction[]")
				if(form.elements[i].checked == true)
					num++;
		}
	}
	return num;
}

// this function check for a the number of selected images, sumbmit false when no one selected
function checkSelected() {

	var numchecked = getNumChecked(document.getElementById('updategallery'));
	 
	if(numchecked < 1) { 
		alert('<?php echo js_escape(__("No images selected",'nggallery')); ?>');
		return false; 
	} 
	
	actionId = jQuery('#bulkaction').val();
	
	switch (actionId) {
		case "copy_to":
		case "move_to":
			showDialog('selectgallery');
			return false;
			break;
		case "add_tags":
		case "delete_tags":
		case "overwrite_tags":
			showDialog('entertags');
			return false;
			break;
	}
	
	return confirm('<?php echo sprintf(js_escape(__("You are about to start the bulk edit for %s images \n \n 'Cancel' to stop, 'OK' to proceed.",'nggallery')), "' + numchecked + '") ; ?>');
}

jQuery(document).ready( function() {
	// close postboxes that should be closed
	jQuery('.if-js-closed').removeClass('if-js-closed').addClass('closed');

	if (typeof postboxes != "undefined")
		postboxes.add_postbox_toggles('ngg-manage-gallery'); // WP 2.7
	else
		add_postbox_toggles('ngg-manage-gallery'); 	// WP 2.6

});

//-->
</script>

<div class="wrap">

<h2><?php echo __ngettext( 'Gallery', 'Galleries', 1, 'nggallery' ); ?> : <?php echo $gallery->title; ?></h2>

<br style="clear: both;" />

<form id="updategallery" class="nggform" method="POST" action="<?php echo $ngg->manage_page->base_page . '&amp;mode=edit&amp;gid=' . $act_gid . '&amp;paged=' . $_GET['paged']; ?>" accept-charset="utf-8">
<?php wp_nonce_field('ngg_updategallery') ?>

<div id="poststuff">
	<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
	<div id="gallerydiv" class="postbox <?php echo postbox_classes('gallerydiv', 'ngg-manage-gallery'); ?>" >
		<h3><?php _e('Gallery settings', 'nggallery') ?><small> (<?php _e('Click here for more settings', 'nggallery') ?>)</small></h3>
		<div class="inside">
			<table class="form-table" >
				<tr>
					<th align="left"><?php _e('Title') ?>:</th>
					<th align="left"><input type="text" size="50" name="title" value="<?php echo $gallery->title; ?>"  /></th>
					<th align="right"><?php _e('Page Link to', 'nggallery') ?>:</th>
					<th align="left">
					<select name="pageid" style="width:95%">
						<option value="0" ><?php _e('Not linked', 'nggallery') ?></option>
						<?php parent_dropdown($gallery->pageid); ?>
					</select>
					</th>
				</tr>
				<tr>
					<th align="left"><?php _e('Description') ?>:</th> 
					<th align="left"><textarea name="gallerydesc" cols="30" rows="3" style="width: 95%" ><?php echo $gallery->galdesc; ?></textarea></th>
					<th align="right"><?php _e('Preview image', 'nggallery') ?>:</th>
					<th align="left">
						<select name="previewpic" style="width:95%" >
							<option value="0" ><?php _e('No Picture', 'nggallery') ?></option>
							<?php
								if(is_array($picturelist)) {
									foreach($picturelist as $picture) {
										$selected = ($picture->pid == $gallery->previewpic) ? 'selected="selected" ' : '';
										echo '<option value="'.$picture->pid.'" '.$selected.'>'.$picture->pid.' - '.$picture->filename.'</option>'."\n";
									}
								}
							?>
						</select>
					</th>
				</tr>
				<tr>
					<th align="left"><?php _e('Path', 'nggallery') ?>:</th> 
					<th align="left"><input <?php if (IS_WPMU) echo 'readonly = "readonly"'; ?> type="text" size="50" name="path" value="<?php echo $gallery->path; ?>"  /></th>
					<th align="right"><?php _e('Author', 'nggallery'); ?>:</th>
					<th align="left"> 
					<?php
						$editable_ids = $ngg->manage_page->get_editable_user_ids( $user_ID );
						if ( $editable_ids && count( $editable_ids ) > 1 )
							wp_dropdown_users( array('include' => $editable_ids, 'name' => 'author', 'selected' => empty( $gallery->author ) ? 0 : $gallery->author ) ); 
						else
							echo $act_author_user->display_name;
					?>
					</th>
				</tr>
				<tr>
					<th align="left">&nbsp;</th>
					<th align="left">&nbsp;</th>				
					<th align="right"><?php _e('Create new page', 'nggallery') ?>:</th>
					<th align="left"> 
					<select name="parent_id" style="width:95%">
						<option value="0"><?php _e ('Main page (No parent)', 'nggallery'); ?></option>
						<?php parent_dropdown (); ?>
					</select>
					<input class="button-secondary action" type="submit" name="addnewpage" value="<?php _e ('Add page', 'nggallery'); ?>" id="group"/>
					</th>
				</tr>
			</table>
			
			<div class="submit">
				<input type="submit" class="button-secondary" name="scanfolder" value="<?php _e("Scan Folder for new images",'nggallery')?> " />
				<input type="submit" class="button-primary action" name="updatepictures" value="<?php _e("Save Changes",'nggallery')?>" />
			</div>

		</div>
	</div>
</div> <!-- poststuff -->

<div class="tablenav ngg-tablenav">
	<?php if ( $page_links ) : ?>
	<div class="tablenav-pages"><?php $page_links_text = sprintf( '<span class="displaying-num">' . __( 'Displaying %s&#8211;%s of %s' ) . '</span>%s',
		number_format_i18n( ( $_GET['paged'] - 1 ) * $nggdb->paged['objects_per_page'] + 1 ),
		number_format_i18n( min( $_GET['paged'] * $nggdb->paged['objects_per_page'], $nggdb->paged['total_objects'] ) ),
		number_format_i18n( $nggdb->paged['total_objects'] ),
		$page_links
	); echo $page_links_text; ?></div>
	<?php endif; ?>
	<div class="alignleft actions">
	<select id="bulkaction" name="bulkaction">
		<option value="no_action" ><?php _e("No action",'nggallery')?></option>
		<option value="set_watermark" ><?php _e("Set watermark",'nggallery')?></option>
		<option value="new_thumbnail" ><?php _e("Create new thumbnails",'nggallery')?></option>
		<option value="resize_images" ><?php _e("Resize images",'nggallery')?></option>
		<option value="delete_images" ><?php _e("Delete images",'nggallery')?></option>
		<option value="import_meta" ><?php _e("Import metadata",'nggallery')?></option>
		<option value="copy_to" ><?php _e("Copy to...",'nggallery')?></option>
		<option value="move_to"><?php _e("Move to...",'nggallery')?></option>
		<option value="add_tags" ><?php _e("Add tags",'nggallery')?></option>
		<option value="delete_tags" ><?php _e("Delete tags",'nggallery')?></option>
		<option value="overwrite_tags" ><?php _e("Overwrite tags",'nggallery')?></option>
	</select>
	<input class="button-secondary" type="submit" name="showThickbox" value="<?php _e("OK",'nggallery')?>" onclick="if ( !checkSelected() ) return false;" />
	
	<?php if ($ngg->options['galSort'] == "sortorder") { ?>
		<input class="button-secondary" type="submit" name="sortGallery" value="<?php _e("Sort gallery",'nggallery')?>" />
	<?php } ?>
	
	<input type="submit" name="updatepictures" class="button-primary action"  value="<?php _e("Save Changes",'nggallery')?>" />
	</div>
</div>

<table id="ngg-listimages" class="widefat fixed" cellspacing="0" >

	<thead>
	<tr>
<?php print_column_headers('nggallery-manage-images'); ?>
	</tr>
	</thead>
	<tfoot>
	<tr>
<?php print_column_headers('nggallery-manage-images', false); ?>
	</tr>
	</tfoot>
	<tbody>
<?php
if($picturelist) {
	
	$thumbsize = '';
	if ($ngg->options['thumbfix']) {
		$thumbsize = 'width="'.$ngg->options['thumbwidth'].'" height="'.$ngg->options['thumbheight'].'"';
	}
	
	if ($ngg->options['thumbcrop']) {
		$thumbsize = 'width="'.$ngg->options['thumbwidth'].'" height="'.$ngg->options['thumbwidth'].'"';
	}
		
	foreach($picturelist as $picture) {

		$pid       = (int) $picture->pid;
		$alternate = ( $alternate == 'alternate' ) ? '' : 'alternate';	
		$exclude   = ( $picture->exclude ) ? 'checked="checked"' : '';
		$date = mysql2date(get_option('date_format'), $picture->imagedate);
		$time = mysql2date(get_option('time_format'), $picture->imagedate);
		
		?>
		<tr id="picture-<?php echo $pid ?>" class="<?php echo $alternate ?> iedit"  valign="top">
			<?php
			foreach($gallery_columns as $gallery_column_key => $column_display_name) {
				$class = "class=\"$gallery_column_key column-$gallery_column_key\"";
		
				$style = '';
				if ( in_array($gallery_column_key, $hidden_columns) )
					$style = ' style="display:none;"';
		
				$attributes = "$class$style";
				
				switch ($gallery_column_key) {
					case 'cb' :
						?> 
						<th <?php echo $attributes ?> scope="row"><input name="doaction[]" type="checkbox" value="<?php echo $pid ?>" /></th>
						<?php
					break;
					case 'id' :
						?>
						<td <?php echo $attributes ?> scope="row" style=""><?php echo $pid ?></td>
						<?php
					break;
					case 'filename' :
						?>
						<td <?php echo $attributes ?>>
							<strong><a href="<?php echo $picture->imageURL; ?>" class="thickbox" title="<?php echo $picture->filename ?>">
								<?php echo ( empty($picture->alttext) ) ? $picture->filename : stripslashes($picture->alttext); ?>
							</a></strong>
							<br /><?php echo $date?>
							<p>
							<?php
							$actions = array();
							//TODO:Add a JS edit option
							//$actions['edit']   = '<a class="editinline" href="#">' . __('Edit') . '</a>';
							$actions['view']   = '<a class="thickbox" href="' . $picture->imageURL . '" title="' . attribute_escape(sprintf(__('View "%s"'), $picture->filename)) . '">' . __('View', 'nggallery') . '</a>';
							$actions['meta']   = '<a class="thickbox" href="' . NGGALLERY_URLPATH . 'admin/showmeta.php?id=' . $pid . '" title="' . __('Show Meta data','nggallery') . '">' . __('Meta', 'nggallery') . '</a>';
							$actions['delete'] = '<a class="submitdelete" href="' . wp_nonce_url("admin.php?page=nggallery-manage-gallery&amp;mode=delpic&amp;gid=".$act_gid."&amp;pid=".$pid, 'ngg_delpicture'). '" class="delete column-delete" onclick="javascript:check=confirm( \'' . attribute_escape(sprintf(__('Delete "%s"' , 'nggallery'), $picture->filename)). '\');if(check==false) return false;">' . __('Delete') . '</a>';
							$action_count = count($actions);
							$i = 0;
							echo '<div class="row-actions">';
							foreach ( $actions as $action => $link ) {
								++$i;
								( $i == $action_count ) ? $sep = '' : $sep = ' | ';
								echo "<span class='$action'>$link$sep</span>";
							}
							echo '</div>';
							?></p>
						</td>
						<?php						
					break;
					case 'thumbnail' :
						?>
						<td <?php echo $attributes ?>><a href="<?php echo $picture->imageURL; ?>" class="thickbox" title="<?php echo $picture->filename ?>">
								<img class="thumb" src="<?php echo $picture->thumbURL; ?>" <?php echo $thumbsize ?> />
							</a>
						</td>
						<?php						
					break;
					case 'alt_title_desc' :
						?>
						<td <?php echo $attributes ?>>
							<input name="alttext[<?php echo $pid ?>]" type="text" style="width:95%; margin-bottom: 2px;" value="<?php echo stripslashes($picture->alttext) ?>" /><br/>
							<textarea name="description[<?php echo $pid ?>]" style="width:95%; margin-top: 2px;" rows="2" ><?php echo stripslashes($picture->description) ?></textarea>
						</td>
						<?php						
					break;
					case 'exclude' :
						?>
						<td <?php echo $attributes ?>><input name="exclude[<?php echo $pid ?>]" type="checkbox" value="1" <?php echo $exclude ?> /></td>
						<?php						
					break;
					case 'tags' :
						$picture->tags = wp_get_object_terms($pid, 'ngg_tag', 'fields=names');
						if (is_array ($picture->tags) ) $picture->tags = implode(', ', $picture->tags); 
						?>
						<td <?php echo $attributes ?>><textarea name="tags[<?php echo $pid ?>]" style="width:95%;" rows="2"><?php echo $picture->tags ?></textarea></td>
						<?php						
					break;
					default : 
						?>
						<td <?php echo $attributes ?>><?php do_action('ngg_manage_gallery_custom_column', $gallery_column_key, $pid); ?></td>
						<?php
					break;
				}
			?>
			<?php } ?>
		</tr>
		<?php
	}
} else {
	echo '<tr><td colspan="' . $num_columns . '" align="center"><strong>'.__('No entries found','nggallery').'</strong></td></tr>';
}
?>
	
		</tbody>
	</table>
	<p class="submit"><input type="submit" class="button-primary action" name="updatepictures" value="<?php _e("Save Changes",'nggallery')?>" /></p>
	</form>	
	<br class="clear"/>
	</div><!-- /#wrap -->

	<!-- #entertags -->
	<div id="entertags" style="display: none;" >
		<form id="form-tags" method="POST" accept-charset="utf-8">
		<?php wp_nonce_field('ngg_thickbox_form') ?>
		<input type="hidden" id="entertags_imagelist" name="TB_imagelist" value="" />
		<input type="hidden" id="entertags_bulkaction" name="TB_bulkaction" value="" />
		<table width="100%" border="0" cellspacing="3" cellpadding="3" >
		  	<tr>
		    	<th><?php _e("Enter the tags",'nggallery')?> : <input name="taglist" type="text" style="width:90%" value="" /></th>
		  	</tr>
		  	<tr align="right">
		    	<td class="submit">
		    		<input class="button-primary" type="submit" name="TB_EditTags" value="<?php _e("OK",'nggallery')?>" />
		    		&nbsp;
		    		<input class="button-secondary" type="reset" value="&nbsp;<?php _e("Cancel",'nggallery')?>&nbsp;" onclick="tb_remove()"/>
		    	</td>
			</tr>
		</table>
		</form>
	</div>
	<!-- /#entertags -->

	<!-- #selectgallery -->
	<div id="selectgallery" style="display: none;" >
		<form id="form-select-gallery" method="POST" accept-charset="utf-8">
		<?php wp_nonce_field('ngg_thickbox_form') ?>
		<input type="hidden" id="selectgallery_imagelist" name="TB_imagelist" value="" />
		<input type="hidden" id="selectgallery_bulkaction" name="TB_bulkaction" value="" />
		<table width="100%" border="0" cellspacing="3" cellpadding="3" >
		  	<tr>
		    	<th>
		    		<?php _e('Select the destination gallery:', 'nggallery'); ?>&nbsp;
		    		<select name="dest_gid" style="width:90%" >
		    			<?php 
		    				foreach ($gallerylist as $gallery) { 
		    					if ($gallery->gid != $act_gid) { 
		    			?>
						<option value="<?php echo $gallery->gid; ?>" ><?php echo $gallery->gid; ?> - <?php echo stripslashes($gallery->title); ?></option>
						<?php 
		    					} 
		    				}
		    			?>
		    		</select>
		    	</th>
		  	</tr>
		  	<tr align="right">
		    	<td class="submit">
		    		<input type="submit" class="button-primary" name="TB_SelectGallery" value="<?php _e("OK",'nggallery')?>" />
		    		&nbsp;
		    		<input class="button-secondary" type="reset" value="<?php _e("Cancel",'nggallery')?>" onclick="tb_remove()"/>
		    	</td>
			</tr>
		</table>
		</form>
	</div>
	<!-- /#selectgallery -->

	<script type="text/javascript">
	/* <![CDATA[ */
	columns.init('nggallery-manage-images');
	/* ]]> */
	</script>
	<?php
}

// define the columns to display, the syntax is 'internal name' => 'display name'
function ngg_manage_gallery_columns() {
	global $ngg;
	
	$gallery_columns = array();
	
	$gallery_columns['cb'] = '<input name="checkall" type="checkbox" onclick="checkAll(document.getElementById(\'updategallery\'));" />';
	$gallery_columns['id'] = __('ID');
	$gallery_columns['thumbnail'] = __('Thumbnail', 'nggallery');
	
	$gallery_columns['filename'] = __('Filename', 'nggallery');
	
	$gallery_columns['alt_title_desc'] = __('Alt &amp; Title Text', 'nggallery') . ' / ' . __('Description', 'nggallery');
	$gallery_columns['tags'] = __('Tags (comma separated list)', 'nggallery');

	$gallery_columns['exclude'] = __('exclude', 'nggallery');
	
	$gallery_columns = apply_filters('ngg_manage_gallery_columns', $gallery_columns);

	return $gallery_columns;
}

?>
