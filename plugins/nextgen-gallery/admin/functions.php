<?php

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

class nggAdmin{

	// **************************************************************
	function create_gallery($gallerytitle, $defaultpath) {
		// create a new gallery & folder
		global $wpdb, $user_ID;
 
		// get the current user ID
		get_currentuserinfo();

		//cleanup pathname
		$galleryname = apply_filters('ngg_gallery_name', $gallerytitle);
		$nggpath = $defaultpath.$galleryname;
		$nggRoot = WINABSPATH.$defaultpath;
		$txt = '';
		
		// No gallery name ?
		if (empty($galleryname)) {	
			nggGallery::show_error( __('No valid gallery name!', 'nggallery') );
			return false;
		}
		
		// check for main folder
		if ( !is_dir($nggRoot) ) {
			if ( !wp_mkdir_p($nggRoot) ) {
				$txt  = __('Directory', 'nggallery').' <strong>'.$defaultpath.'</strong> '.__('didn\'t exist. Please create first the main gallery folder ', 'nggallery').'!<br />';
				$txt .= __('Check this link, if you didn\'t know how to set the permission :', 'nggallery').' <a href="http://codex.wordpress.org/Changing_File_Permissions">http://codex.wordpress.org/Changing_File_Permissions</a> ';
				nggGallery::show_error($txt);
				return false;
			}
		}

		// check for permission settings, Safe mode limitations are not taken into account. 
		if ( !is_writeable($nggRoot ) ) {
			$txt  = __('Directory', 'nggallery').' <strong>'.$defaultpath.'</strong> '.__('is not writeable !', 'nggallery').'<br />';
			$txt .= __('Check this link, if you didn\'t know how to set the permission :', 'nggallery').' <a href="http://codex.wordpress.org/Changing_File_Permissions">http://codex.wordpress.org/Changing_File_Permissions</a> ';
			nggGallery::show_error($txt);
			return false;
		}
		
		// 1. Create new gallery folder
		if ( !is_dir(WINABSPATH.$nggpath) ) {
			if ( !wp_mkdir_p (WINABSPATH.$nggpath) ) 
				$txt  = __('Unable to create directory ', 'nggallery').$nggpath.'!<br />';
		}
		
		// 2. Check folder permission
		if ( !is_writeable(WINABSPATH.$nggpath ) )
			$txt .= __('Directory', 'nggallery').' <strong>'.$nggpath.'</strong> '.__('is not writeable !', 'nggallery').'<br />';

		// 3. Now create "thumbs" folder inside
		if ( !is_dir(WINABSPATH.$nggpath.'/thumbs') ) {				
			if ( !wp_mkdir_p ( WINABSPATH.$nggpath.'/thumbs') ) 
				$txt .= __('Unable to create directory ', 'nggallery').' <strong>'.$nggpath.'/thumbs !</strong>';
		}
		
		if (SAFE_MODE) {
			$help  = __('The server setting Safe-Mode is on !', 'nggallery');	
			$help .= '<br />'.__('If you have problems, please create directory', 'nggallery').' <strong>'.$nggpath.'</strong> ';	
			$help .= __('and the thumbnails directory', 'nggallery').' <strong>'.$nggpath.'/thumbs</strong> '.__('with permission 777 manually !', 'nggallery');
			nggGallery::show_message($help);
		}
		
		// show a error message			
		if ( !empty($txt) ) {
			if (SAFE_MODE) {
			// for safe_mode , better delete folder, both folder must be created manually
				@rmdir(WINABSPATH.$nggpath.'/thumbs');
				@rmdir(WINABSPATH.$nggpath);
			}
			nggGallery::show_error($txt);
			return false;
		}
		
		$result=$wpdb->get_var("SELECT name FROM $wpdb->nggallery WHERE name = '$galleryname' ");
		if ($result) {
			nggGallery::show_error( __ngettext( 'Gallery', 'Galleries', 1, 'nggallery' ) .' <strong>'.$galleryname.'</strong> '.__('already exists', 'nggallery'));
			return false;			
		} else { 
			$result = $wpdb->query("INSERT INTO $wpdb->nggallery (name, path, title, author) VALUES ('$galleryname', '$nggpath', '$gallerytitle' , '$user_ID') ");
			if ($result) {
				$message  = __('Gallery %1$s successfully created.<br/>You can show this gallery with the tag %2$s.<br/>','nggallery');
				$message  = sprintf($message, $galleryname, '[gallery id=' . $wpdb->insert_id . ']');
				$message .= '<a href="' . admin_url() . 'admin.php?page=nggallery-manage-gallery&mode=edit&gid=' . $wpdb->insert_id . '" >';
				$message .= __('Edit gallery','nggallery');
				$message .= '</a>';
				
				nggGallery::show_message($message); 
			}
			return true;
		} 
	}
	
	// **************************************************************
	function import_gallery($galleryfolder) {
		// ** $galleryfolder contains relative path
		
		//TODO: Check permission of existing thumb folder & images
		
		global $wpdb, $user_ID;

		// get the current user ID
		get_currentuserinfo();
		
		$created_msg = '';
		
		// remove trailing slash at the end, if somebody use it
		if (substr($galleryfolder, -1) == '/') $galleryfolder = substr($galleryfolder, 0, -1);
		$gallerypath = WINABSPATH . $galleryfolder;
		
		if (!is_dir($gallerypath)) {
			nggGallery::show_error(__('Directory', 'nggallery').' <strong>'.$gallerypath.'</strong> '.__('doesn&#96;t exist!', 'nggallery'));
			return ;
		}
		
		// read list of images
		$new_imageslist = nggAdmin::scandir($gallerypath);
		if (empty($new_imageslist)) {
			nggGallery::show_message(__('Directory', 'nggallery').' <strong>'.$gallerypath.'</strong> '.__('contains no pictures', 'nggallery'));
			return;
		}
		// check & create thumbnail folder
		if ( !nggGallery::get_thumbnail_folder($gallerypath) )
			return;
		
		// take folder name as gallery name		
		$galleryname = basename($galleryfolder);
		
		// check for existing gallery folder
		$gallery_id = $wpdb->get_var("SELECT gid FROM $wpdb->nggallery WHERE path = '$galleryfolder' ");

		if (!$gallery_id) {
			$result = $wpdb->query("INSERT INTO $wpdb->nggallery (name, path, title, author) VALUES ('$galleryname', '$galleryfolder', '$galleryname', '$user_ID') ");
			if (!$result) {
				nggGallery::show_error(__('Database error. Could not add gallery!','nggallery'));
				return;
			}
			$created_msg = __ngettext( 'Gallery', 'Galleries', 1, 'nggallery' ) . ' <strong>'.$galleryname.'</strong> '.__('successfully created!','nggallery').'<br />';
			$gallery_id  = $wpdb->insert_id;  // get index_id
		}
		
		// Look for existing image list
		$old_imageslist = $wpdb->get_col("SELECT filename FROM $wpdb->nggpictures WHERE galleryid = '$gallery_id' ");
		// if no images are there, create empty array
		if ($old_imageslist == NULL) 
			$old_imageslist = array();
		// check difference
		$new_images = array_diff($new_imageslist, $old_imageslist);
		
		// add images to database		
		$image_ids = nggAdmin::add_Images($gallery_id, $new_images);
		
		//add the preview image if needed
		nggAdmin::set_gallery_preview ( $gallery_id );

		// now create thumbnails
		nggAdmin::do_ajax_operation( 'create_thumbnail' , $image_ids, __('Create new thumbnails','nggallery') );
		
		//TODO:Message will not shown, because AJAX routine require more time, message should be passed to AJAX
		nggGallery::show_message( $created_msg . count($image_ids) .__(' picture(s) successfully added','nggallery') );
		
		return;

	}
	// **************************************************************
	function scandir($dirname = '.') { 
		// thx to php.net :-)
		$ext = array("jpeg", "jpg", "png", "gif"); 
		$files = array(); 
		if($handle = opendir($dirname)) { 
		   while(false !== ($file = readdir($handle))) 
		       for($i=0;$i<sizeof($ext);$i++) 
		           if(stristr($file, '.' . $ext[$i])) 
		               $files[] = utf8_encode($file); 
		   closedir($handle); 
		} 
		sort($files);
		return ($files); 
	} 
	
	/**
	 * nggAdmin::createThumbnail() - function to create or recreate a thumbnail
	 * 
	 * @param object | int $image contain all information about the image or the id
	 * @return string result code
	 * @since v1.0.0
	 */
	function create_thumbnail($image) {
		
		global $ngg;
		
		if(! class_exists('ngg_Thumbnail'))
			require_once( nggGallery::graphic_library() );
		
		if ( is_numeric($image) )
			$image = nggdb::find_image( $image );

		if ( !is_object($image) ) 
			return __('Object didn\'t contain correct data','nggallery');
		
		// check for existing thumbnail
		if (file_exists($image->thumbPath))
			if (!is_writable($image->thumbPath))
				return $image->filename . __(' is not writeable ','nggallery');

		$thumb = new ngg_Thumbnail($image->imagePath, TRUE);

		// skip if file is not there
		if (!$thumb->error) {
			if ($ngg->options['thumbcrop']) {
				
				// THX to Kees de Bruin, better thumbnails if portrait format
				$width = $ngg->options['thumbwidth'];
				$height = $ngg->options['thumbheight'];
				$curwidth = $thumb->currentDimensions['width'];
				$curheight = $thumb->currentDimensions['height'];
				if ($curwidth > $curheight) {
					$aspect = (100 * $curwidth) / $curheight;
				} else {
					$aspect = (100 * $curheight) / $curwidth;
				}
				$width = round(($width * $aspect) / 100);
				$height = round(($height * $aspect) / 100);

				$thumb->resize($width,$height);
				$thumb->cropFromCenter($width);
			} 
			elseif ($ngg->options['thumbfix'])  {
				// check for portrait format
				if ($thumb->currentDimensions['height'] > $thumb->currentDimensions['width']) {
					$thumb->resize($ngg->options['thumbwidth'], 0);
					// get optimal y startpos
					$ypos = ($thumb->currentDimensions['height'] - $ngg->options['thumbheight']) / 2;
					$thumb->crop(0, $ypos, $ngg->options['thumbwidth'],$ngg->options['thumbheight']);	
				} else {
					$thumb->resize(0,$ngg->options['thumbheight']);	
					// get optimal x startpos
					$xpos = ($thumb->currentDimensions['width'] - $ngg->options['thumbwidth']) / 2;
					$thumb->crop($xpos, 0, $ngg->options['thumbwidth'],$ngg->options['thumbheight']);	
				}
			} else {
				$thumb->resize($ngg->options['thumbwidth'],$ngg->options['thumbheight']);	
			}
			
			// save the new thumbnail
			$thumb->save($image->thumbPath, $ngg->options['thumbquality']);
			nggAdmin::chmod ($image->thumbPath); 
		} 
				
		$thumb->destruct();
		
		if ( !empty($thumb->errmsg) )
			return ' <strong>' . $image->filename . ' (Error : '.$thumb->errmsg .')</strong>';
		
		// success
		return '1'; 
	}
	
	/**
	 * nggAdmin::resize_image() - create a new image, based on the height /width
	 * 
	 * @param object | int $image contain all information about the image or the id
	 * @param integer $width optional 
	 * @param integer $height optional
	 * @return string result code
	 */
	function resize_image($image, $width = 0, $height = 0) {
		
		global $ngg;
		
		if(! class_exists('ngg_Thumbnail'))
			require_once( nggGallery::graphic_library() );

		if ( is_numeric($image) )
			$image = nggdb::find_image( $image );
		
		if ( !is_object($image) ) 
			return __('Object didn\'t contain correct data','nggallery');	

		// if no parameter is set, take global settings
		$width  = ($width  == 0) ? $ngg->options['imgWidth']  : $width;
		$height = ($height == 0) ? $ngg->options['imgHeight'] : $height;
		
		if (!is_writable($image->imagePath))
			return ' <strong>' . $image->filename . __(' is not writeable','nggallery') . '</strong>';
		
		$file = new ngg_Thumbnail($image->imagePath, TRUE);

		// skip if file is not there
		if (!$file->error) {
			$file->resize($width, $height, 4);
			$file->save($image->imagePath, $ngg->options['imgQuality']);
			$file->destruct();
		} else {
            $file->destruct();
			return ' <strong>' . $image->filename . ' (Error : ' . $file->errmsg . ')</strong>';
		}

		return '1';
	}

	/**
	 * nggAdmin::set_watermark() - set the watermarl for the image
	 * 
	 * @param object | int $image contain all information about the image or the id
	 * @return string result code
	 */
	function set_watermark($image) {
		
		global $ngg;

		if(! class_exists('ngg_Thumbnail'))
			require_once( nggGallery::graphic_library() );
		
		if ( is_numeric($image) )
			$image = nggdb::find_image( $image );
		
		if ( !is_object($image) ) 
			return __('Object didn\'t contain correct data','nggallery');		
	
		if (!is_writable($image->imagePath))
			return ' <strong>' . $image->filename . __(' is not writeable','nggallery') . '</strong>';
		
		$file = new ngg_Thumbnail( $image->imagePath, TRUE );

		// skip if file is not there
		if (!$file->error) {
			if ($ngg->options['wmType'] == 'image') {
				$file->watermarkImgPath = $ngg->options['wmPath'];
				$file->watermarkImage($ngg->options['wmPos'], $ngg->options['wmXpos'], $ngg->options['wmYpos']); 
			}
			if ($ngg->options['wmType'] == 'text') {
				$file->watermarkText = $ngg->options['wmText'];
				$file->watermarkCreateText($ngg->options['wmColor'], $ngg->options['wmFont'], $ngg->options['wmSize'], $ngg->options['wmOpaque']);
				$file->watermarkImage($ngg->options['wmPos'], $ngg->options['wmXpos'], $ngg->options['wmYpos']);  
			}
			$file->save($image->imagePath, $ngg->options['imgQuality']);
		}
		
		$file->destruct();

		if ( !empty($file->errmsg) )
			return ' <strong>' . $image->filename . ' (Error : '.$file->errmsg .')</strong>';		

		return '1';
	}

	// **************************************************************
	function add_Images($galleryID, $imageslist) {
		// add images to database		
		global $wpdb;
		
		$image_ids = array();
		
		if ( is_array($imageslist) ) {
			foreach($imageslist as $picture) {
				$result = $wpdb->query("INSERT INTO $wpdb->nggpictures (galleryid, filename, alttext, exclude) VALUES ('$galleryID', '$picture', '$picture', 0) ");
				$pic_id = (int) $wpdb->insert_id;
				if ($result) 
					$image_ids[] = $pic_id;

				// add the metadata
				nggAdmin::import_MetaData($pic_id);
				
				// action hook for post process after the image is added to the database
				$image = array( 'id' => $pic_id, 'filename' => $picture, 'galleryID' => $galleryID);
				do_action('ngg_added_new_image', $image);
									
			} 
		} // is_array
		
		return $image_ids;
		
	}

	// **************************************************************
	function import_MetaData($imagesIds) {
		// add images to database		
		global $wpdb;
		
		require_once(NGGALLERY_ABSPATH.'/lib/image.php');
		
		if (!is_array($imagesIds))
			$imagesIds = array($imagesIds);
		
		foreach($imagesIds as $pic_id) {
			$picture = nggdb::find_image($pic_id);
			if (!$picture->error) {

				$meta = nggAdmin::get_MetaData($picture->imagePath);
				
				// get the title
				if (!$alttext = $meta['title'])
					$alttext = $picture->alttext;
				// get the caption / description field
				if (!$description = $meta['caption'])
					$description = $picture->description;
				// get the file date/time from exif
				$timestamp = $meta['timestamp'];
				// update database
				$result=$wpdb->query( "UPDATE $wpdb->nggpictures SET alttext = '$alttext', description = '$description', imagedate = '$timestamp'  WHERE pid = $pic_id");
				// add the tags
				if ($meta['keywords']) {
					$taglist = explode(",", $meta['keywords']);
					wp_set_object_terms($pic_id, $taglist, 'ngg_tag');
				} // add tags
			}// error check
		} // foreach
		
		return true;
		
	}

	// **************************************************************
	function get_MetaData($picPath) {
		// must be Gallery absPath + filename
		
		require_once(NGGALLERY_ABSPATH.'/lib/meta.php');
		
		$meta = array();

		$pdata = new nggMeta($picPath);
		$meta['title'] = $pdata->get_META('title');		
		$meta['caption'] = $pdata->get_META('caption');	
		$meta['keywords'] = $pdata->get_META('keywords');
		$meta['timestamp'] = $pdata->get_date_time();	
		
		return $meta;
		
	}

	// **************************************************************
	function unzip($dir, $file) {
		
		if(! class_exists('PclZip'))
			require_once(ABSPATH . 'wp-admin/includes/class-pclzip.php');
				
		$archive = new PclZip($file);

		// extract all files in one folder
		if ($archive->extract(PCLZIP_OPT_PATH, $dir, PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_CB_PRE_EXTRACT, 'ngg_getOnlyImages') == 0) {
			nggGallery::show_error( 'Error : ' . $archive->errorInfo(true) );
			return false;
		}

		return true;
	}
 
	// **************************************************************
	function getOnlyImages($p_event, $p_header)	{
		$info = pathinfo($p_header['filename']);
		// check for extension
		$ext = array('jpeg', 'jpg', 'png', 'gif'); 
		if (in_array( strtolower($info['extension']), $ext)) {
			// For MAC skip the ".image" files
			if ($info['basename']{0} ==  '.' ) 
				return 0;
			else 
				return 1;
		}
		// ----- all other files are skipped
		else {
		  return 0;
		}
	}

	// **************************************************************
	function import_zipfile($galleryID) {

		global $ngg, $wpdb;
		
		if (nggAdmin::check_quota())
			return false;

		$defaultpath = $ngg->options['gallerypath'];		
		$temp_zipfile = $_FILES['zipfile']['tmp_name'];
		$filename = $_FILES['zipfile']['name']; 
					
		// check if file is a zip file
		if (!eregi('zip|download|octet-stream', $_FILES['zipfile']['type'])) {
			@unlink($temp_zipfile); // del temp file
			nggGallery::show_error(__('Uploaded file was no or a faulty zip file ! The server recognize : ','nggallery').$_FILES['zipfile']['type']);
			return false; 
		}

		// should this unpacked into a new folder ?		
		if ( $galleryID == '0' ) {	
			//cleanup and take the zipfile name as folder name
			$foldername = sanitize_title(strtok ($filename, '.'));
			$foldername = $defaultpath . $foldername;
		} else {
			// get foldername if selected
			$foldername = $wpdb->get_var("SELECT path FROM $wpdb->nggallery WHERE gid = '$galleryID' ");
		}

		if ( empty($foldername) ) {
			nggGallery::show_error( __('Could not get a valid foldername', 'nggallery') );
			return false;
		}

		// set complete folder path
		$newfolder = WINABSPATH . $foldername;

		// check first if the traget folder exist
		if (!is_dir($newfolder)) {
			// create new directories
			if (!wp_mkdir_p ($newfolder)) {
				$message = sprintf(__('Unable to create directory %s. Is its parent directory writable by the server?', 'nggallery'), $newfolder);
				nggGallery::show_error($message);
				return false;
			}
			if (!wp_mkdir_p ($newfolder.'/thumbs')) {
				nggGallery::show_error(__('Unable to create directory ', 'nggallery') . $newfolder . '/thumbs !');
				return false;
			}
		} 
		
		// unzip and del temp file		
		$result = nggAdmin::unzip($newfolder, $temp_zipfile);
		@unlink($temp_zipfile);		

		if ($result) {
			$message = __('Zip-File successfully unpacked','nggallery').'<br />';		

			// parse now the folder and add to database
			$message .= nggAdmin::import_gallery( $foldername);
			nggGallery::show_message($message);
		}
		
		return true;
	}

	// **************************************************************
	function upload_images() {
	// upload of pictures
		
		global $wpdb;
		
		// WPMU action
		if (nggAdmin::check_quota())
			return;

		// Images must be an array
		$imageslist = array();

		// get selected gallery
		$galleryID = (int) $_POST['galleryselect'];

		if ($galleryID == 0) {
			nggGallery::show_error(__('No gallery selected !','nggallery'));
			return;	
		}

		// get the path to the gallery	
		$gallerypath = $wpdb->get_var("SELECT path FROM $wpdb->nggallery WHERE gid = '$galleryID' ");

		if (!$gallerypath){
			nggGallery::show_error(__('Failure in database, no gallery path set !','nggallery'));
			return;
		} 
				
		// read list of images
		$dirlist = nggAdmin::scandir(WINABSPATH.$gallerypath);
		
		foreach ($_FILES as $key => $value) {
			
			// look only for uploded files
			if ($_FILES[$key]['error'] == 0) {
				$temp_file = $_FILES[$key]['tmp_name'];
				$filepart = pathinfo ( strtolower($_FILES[$key]['name']) );
				// required until PHP 5.2.0
				$filepart['filename'] = substr($filepart["basename"],0 ,strlen($filepart["basename"]) - (strlen($filepart["extension"]) + 1) );
				
				$filename = sanitize_title($filepart['filename']) . '.' . $filepart['extension'];

				// check for allowed extension
				$ext = array('jpeg', 'jpg', 'png', 'gif'); 
				if (!in_array($filepart['extension'],$ext)){ 
					nggGallery::show_error('<strong>'.$_FILES[$key]['name'].' </strong>'.__('is no valid image file!','nggallery'));
					continue;
				}

				// check if this filename already exist in the folder
				$i = 0;
				while (in_array($filename,$dirlist)) {
					$filename = sanitize_title($filepart['filename']) . '_' . $i++ . '.' .$filepart['extension'];
				}
				
				$dest_file = WINABSPATH . $gallerypath . '/' . $filename;
				
				//check for folder permission
				if (!is_writeable(WINABSPATH.$gallerypath)) {
					$message = sprintf(__('Unable to write to directory %s. Is this directory writable by the server?', 'nggallery'), WINABSPATH.$gallerypath);
					nggGallery::show_error($message);
					return;				
				}
				
				// save temp file to gallery
				if (!@move_uploaded_file($_FILES[$key]['tmp_name'], $dest_file)){
					nggGallery::show_error(__('Error, the file could not moved to : ','nggallery').$dest_file);
					nggAdmin::check_safemode(WINABSPATH.$gallerypath);		
					continue;
				} 
				if (!nggAdmin::chmod ($dest_file)) {
					nggGallery::show_error(__('Error, the file permissions could not set','nggallery'));
					continue;
				}
				
				// add to imagelist & dirlist
				$imageslist[] = $filename;
				$dirlist[] = $filename;

			}
		}
		
		if (count($imageslist) > 0) {
			
			// add images to database		
			$image_ids = nggAdmin::add_Images($galleryID, $imageslist);

			//create thumbnails
			nggAdmin::do_ajax_operation( 'create_thumbnail' , $image_ids, __('Create new thumbnails','nggallery') );
			//add the preview image if needed
			nggAdmin::set_gallery_preview ( $galleryID );
			
			nggGallery::show_message( count($image_ids) . __(' Image(s) successfully added','nggallery'));
		}
		
		return;

	} // end function
	
	// **************************************************************
	function swfupload_image($galleryID = 0) {
		// This function is called by the swfupload
		global $wpdb;
		
		if ($galleryID == 0) {
			@unlink($temp_file);		
			return __('No gallery selected !','nggallery');;
		}

		// WPMU action
		if (nggAdmin::check_quota())
			return '0';

		// Check the upload
		if (!isset($_FILES['Filedata']) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) 
			return __('Invalid upload. Error Code : ','nggallery') . $_FILES["Filedata"]["error"];

		// get the filename and extension
		$temp_file = $_FILES["Filedata"]['tmp_name'];
		$filepart = pathinfo ( strtolower($_FILES['Filedata']['name']) );
		// required until PHP 5.2.0
		$filepart['filename'] = substr($filepart['basename'],0 ,strlen($filepart['basename']) - (strlen($filepart["extension"]) + 1) );
		$filename = sanitize_title($filepart['filename']) . '.' . $filepart['extension'];

		// check for allowed extension
		$ext = array('jpeg', 'jpg', 'png', 'gif'); 
		if (!in_array($filepart['extension'], $ext))
			return $_FILES[$key]['name'] . __('is no valid image file!','nggallery');

		// get the path to the gallery	
		$gallerypath = $wpdb->get_var("SELECT path FROM $wpdb->nggallery WHERE gid = '$galleryID' ");
		if (!$gallerypath){
			@unlink($temp_file);		
			return __('Failure in database, no gallery path set !','nggallery');
		} 

		// read list of images
		$imageslist = nggAdmin::scandir( WINABSPATH.$gallerypath );

		// check if this filename already exist
		$i = 0;
		while (in_array($filename,$imageslist)) {
			$filename = sanitize_title($filepart['filename']) . '_' . $i++ . '.' . $filepart['extension'];
		}
		
		$dest_file = WINABSPATH . $gallerypath . '/' . $filename;
				
		// save temp file to gallery
		if ( !@move_uploaded_file($_FILES["Filedata"]['tmp_name'], $dest_file) ){
			nggAdmin::check_safemode(WINABSPATH.$gallerypath);	
			return __('Error, the file could not moved to : ','nggallery').$dest_file;
		} 
		
		if ( !nggAdmin::chmod($dest_file) )
			return __('Error, the file permissions could not set','nggallery');
		
		return '0';
	}	
	
	// **************************************************************
	function check_quota() {
		// Only for WPMU
			if ( (IS_WPMU) && wpmu_enable_function('wpmuQuotaCheck'))
				if( $error = upload_is_user_over_quota( false ) ) {
					nggGallery::show_error( __( 'Sorry, you have used your space allocation. Please delete some files to upload more files.','nggallery' ) );
					return true;
				}
			return false;
	}
	
	// **************************************************************
	function chmod($filename = '') {
		// Set correct file permissions (taken from wp core)
		$stat = @ stat(dirname($filename));
		$perms = $stat['mode'] & 0007777;
		$perms = $perms & 0000666;
		if ( @chmod($filename, $perms) )
			return true;
			
		return false;
	}
	
	function check_safemode($foldername) {
		// Check UID in folder and Script
		// Read http://www.php.net/manual/en/features.safe-mode.php to understand safe_mode
		if ( SAFE_MODE ) {
			
			$script_uid = ( ini_get('safe_mode_gid') ) ? getmygid() : getmyuid();
			$folder_uid = fileowner($foldername);

			if ($script_uid != $folder_uid) {
				$message  = sprintf(__('SAFE MODE Restriction in effect! You need to create the folder <strong>%s</strong> manually','nggallery'), $foldername);
				$message .= '<br />' . sprintf(__('When safe_mode is on, PHP checks to see if the owner (%s) of the current script matches the owner (%s) of the file to be operated on by a file function or its directory','nggallery'), $script_uid, $folder_uid );
				nggGallery::show_error($message);
				return false;
			}
		}
		
		return true;
	}
	
	function can_manage_this_gallery($check_ID) {
		// check is the ID fit's to the user_ID'
		global $user_ID, $wp_roles;
		
		// get the current user ID
		get_currentuserinfo();
		
		if ( !current_user_can('NextGEN Manage others gallery') )
			if ( $user_ID != $check_ID)
				return false;
		
		return true;
	
	}
	
	function move_images($pic_ids, $dest_gid) {

		$errors = '';
		$count = 0;

		if (!is_array($pic_ids))
			$pic_ids = array($pic_ids);
		
		// Get destination gallery
		$destination  = nggdb::find_gallery( $dest_gid );
		$dest_abspath = WINABSPATH . $destination->path;
		
		if ( $destination == null ) {
			nggGallery::show_error(__('The destination gallery does not exist','nggallery'));
			return;
		}
		
		// Check for folder permission
		if ( !is_writeable( $dest_abspath ) ) {
			$message = sprintf(__('Unable to write to directory %s. Is this directory writable by the server?', 'nggallery'), $dest_abspath );
			nggGallery::show_error($message);
			return;				
		}
				
		// Get pictures
		$images = nggdb::find_images_in_list($pic_ids);

		foreach ($images as $image) {		
			
			$i = 0;
			$tmp_prefix = '';
			
			$destination_file_name = $image->filename;
			// check if the filename already exist, then we add a copy_ prefix
			while (file_exists( $dest_abspath . '/' . $destination_file_name)) {
				$tmp_prefix = 'copy_' . ($i++) . '_';
				$destination_file_name = $tmp_prefix . $image->filename;
			}
			
			$destination_path = $dest_abspath . '/' . $destination_file_name;
			$destination_thumbnail = $dest_abspath . '/thumbs/thumbs_' . $destination_file_name;

			// Move files
			if ( !@rename($image->imagePath, $destination_path) ) {
				$errors .= sprintf(__('Failed to move image %1$s to %2$s','nggallery'), 
					'<strong>' . $image->filename . '</strong>', $destination_path) . '<br />';
				continue;				
			}
			
			// Move the thumbnail, if possible
			!@rename($image->thumbPath, $destination_thumbnail);
			
			// Change the gallery id in the database , maybe the filename
			if ( nggdb::update_image($image->pid, $dest_gid, $destination_file_name) )
				$count++;

		}

		if ( $errors != '' )
			nggGallery::show_error($errors);

		$link = '<a href="' . admin_url() . 'admin.php?page=nggallery-manage-gallery&mode=edit&gid=' . $destination->gid . '" >' . $destination->title . '</a>';
		$messages  = sprintf(__('Moved %1$s picture(s) to gallery : %2$s .','nggallery'), $count, $link);
		nggGallery::show_message($messages);

		return;
	}
	
	/**
	 * Copy images to another gallery
	 */
	function copy_images($pic_ids, $dest_gid) {
		
		$errors = $messages = '';
		
		if (!is_array($pic_ids))
			$pic_ids = array($pic_ids);
		
		// Get destination gallery
		$destination = nggdb::find_gallery( $dest_gid );
		if ( $destination == null ) {
			nggGallery::show_error(__('The destination gallery does not exist','nggallery'));
			return;
		}
		
		// Check for folder permission
		if (!is_writeable(WINABSPATH.$destination->path)) {
			$message = sprintf(__('Unable to write to directory %s. Is this directory writable by the server?', 'nggallery'), WINABSPATH.$destination->path);
			nggGallery::show_error($message);
			return;				
		}
				
		// Get pictures
		$images = nggdb::find_images_in_list($pic_ids);
		$destination_path = WINABSPATH . $destination->path;
		
		foreach ($images as $image) {		
			// WPMU action
			if (nggAdmin::check_quota())
				return;
			
			$i = 0;
			$tmp_prefix = ''; 
			$destination_file_name = $image->filename;
			while (file_exists($destination_path . '/' . $destination_file_name)) {
				$tmp_prefix = 'copy_' . ($i++) . '_';
				$destination_file_name = $tmp_prefix . $image->filename;
			}
			
			$destination_file_path = $destination_path . '/' . $destination_file_name;
			$destination_thumb_file_path = $destination_path . '/' . $image->thumbFolder . $image->thumbPrefix . $destination_file_name;

			// Copy files
			if ( !@copy($image->imagePath, $destination_file_path) ) {
				$errors .= sprintf(__('Failed to copy image %1$s to %2$s','nggallery'), 
					$image->filename, $destination_file_path) . '<br />';
				continue;				
			}
			
			// Copy the thumbnail if possible
			!@copy($image->thumbPath, $destination_thumb_file_path);
			
			// Create new database entry for the image
			$new_pid = nggdb::insert_image( $destination->gid, $destination_file_name, $image->alttext, $image->description, $image->exclude);

			if (!isset($new_pid)) {				
				$errors .= sprintf(__('Failed to copy database row for picture %s','nggallery'), $image->pid) . '<br />';
				continue;				
			}
				
			// Copy tags
			nggTags::copy_tags($image->pid, $new_pid);
			
			if ( $tmp_prefix != '' ) {
				$messages .= sprintf(__('Image %1$s (%2$s) copied as image %3$s (%4$s) &raquo; The file already existed in the destination gallery.','nggallery'),
					 $image->pid, $image->filename, $new_pid, $destination_file_name) . '<br />';
			} else {
				$messages .= sprintf(__('Image %1$s (%2$s) copied as image %3$s (%4$s)','nggallery'),
					 $image->pid, $image->filename, $new_pid, $destination_file_name) . '<br />';
			}

		}
		
		// Finish by showing errors or success
		if ( $errors == '' ) {
			$link = '<a href="' . admin_url() . 'admin.php?page=nggallery-manage-gallery&mode=edit&gid=' . $destination->gid . '" >' . $destination->title . '</a>';
			$messages .= '<hr />' . sprintf(__('Copied %1$s picture(s) to gallery: %2$s .','nggallery'), count($images), $link);
		} 

		if ( $messages != '' )
			nggGallery::show_message($messages);

		if ( $errors != '' )
			nggGallery::show_error($errors);

		return;
	}
	
	function do_ajax_operation( $operation, $image_array, $title = '' ) {
		
		if ( !is_array($image_array) || empty($image_array) )
			return;

		$js_array  = implode('","', $image_array);
		
		// send out some JavaScript, which initate the ajax operation
		?>
		<script type="text/javascript">

			Images = new Array("<?php echo $js_array; ?>");

			nggAjaxOptions = {
				operation: "<?php echo $operation; ?>",
				ids: Images,		
			  	header: "<?php echo $title; ?>",
			  	maxStep: Images.length
			};
			
			jQuery(document).ready( function(){ 
				nggProgressBar.init( nggAjaxOptions );
				nggAjax.init( nggAjaxOptions );
			} );
		</script>
		
		<div id="progressbar_container" class="wrap"></div>
		
		<?php	
	}
	
	/**
	 * nggAdmin::set_gallery_preview() - define a preview pic after the first upload, can be changed in the gallery settings
	 * 
	 * @param int $galleryID
	 * @return
	 */
	function set_gallery_preview( $galleryID ) {
		
		global $wpdb;
		
		$imageID = $wpdb->get_var("SELECT previewpic FROM $wpdb->nggallery WHERE gid = '$galleryID' ");
		
		// in the case no preview image is setup, we do this now
		if ($imageID == 0) {
			$firstImage = $wpdb->get_var("SELECT pid FROM $wpdb->nggpictures WHERE exclude != 1 AND galleryid = '$galleryID' ORDER by pid DESC limit 0,1");
			if ($firstImage)
				$wpdb->query("UPDATE $wpdb->nggallery SET previewpic = '$firstImage' WHERE gid = '$galleryID'");
		}
		
		return;
	}

} // END class nggAdmin

// **************************************************************
//TODO: Cannot be member of a class ? Check PCLZIP later...
function ngg_getOnlyImages($p_event, $p_header)	{
	
	return nggAdmin::getOnlyImages($p_event, $p_header);
	
}
?>