<?php

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

/**
 * nggShowSlideshow()
 * 
 * @access public 
 * @param integer $galleryID
 * @param integer $irWidth
 * @param integer $irHeight
 * @return the content
 */
function nggShowSlideshow($galleryID, $width, $height) {
	
	require_once (dirname (__FILE__).'/lib/swfobject.php');

	$ngg_options = nggGallery::get_option('ngg_options');

	// remove media file from RSS feed
	if ( is_feed() ) {
		$out = '[' . $ngg_options['galTextSlide'] . ']'; 
		return $out;
	}
	
	// If the Imagerotator didn't exist, skip the output
	if ( NGGALLERY_IREXIST == false ) 
		return;	
		
	if (empty($width) ) $width  = (int) $ngg_options['irWidth'];
	if (empty($height)) $height = (int) $ngg_options['irHeight'];

	// init the flash output
	$swfobject = new swfobject( $ngg_options['irURL'] , 'so' . $galleryID, $width, $height, '7.0.0', 'false');

	$swfobject->message = '<p>'. __('The <a href="http://www.macromedia.com/go/getflashplayer">Flash Player</a> and <a href="http://www.mozilla.com/firefox/">a browser with Javascript support</a> are needed..', 'nggallery').'</p>';
	$swfobject->add_params('wmode', 'opaque');
	$swfobject->add_params('allowfullscreen', 'true');
	$swfobject->add_params('bgcolor', $ngg_options['irScreencolor'], '000000', 'string', '#');
	$swfobject->add_attributes('styleclass', 'slideshow');
	$swfobject->add_attributes('name', 'so' . $galleryID);

	// adding the flash parameter	
	$swfobject->add_flashvars( 'file', NGGALLERY_URLPATH.'xml/imagerotator.php?gid=' . $galleryID );
	$swfobject->add_flashvars( 'shuffle', $ngg_options['irShuffle'], 'true', 'bool');
	$swfobject->add_flashvars( 'linkfromdisplay', $ngg_options['irLinkfromdisplay'], 'false', 'bool');
	$swfobject->add_flashvars( 'shownavigation', $ngg_options['irShownavigation'], 'true', 'bool');
	$swfobject->add_flashvars( 'showicons', $ngg_options['irShowicons'], 'true', 'bool');
	$swfobject->add_flashvars( 'kenburns', $ngg_options['irKenburns'], 'false', 'bool');
	$swfobject->add_flashvars( 'overstretch', $ngg_options['irOverstretch'], 'false', 'string');
	$swfobject->add_flashvars( 'rotatetime', $ngg_options['irRotatetime'], 5, 'int');
	$swfobject->add_flashvars( 'transition', $ngg_options['irTransition'], 'random', 'string');
	$swfobject->add_flashvars( 'backcolor', $ngg_options['irBackcolor'], 'FFFFFF', 'string', '0x');
	$swfobject->add_flashvars( 'frontcolor', $ngg_options['irFrontcolor'], '000000', 'string', '0x');
	$swfobject->add_flashvars( 'lightcolor', $ngg_options['irLightcolor'], '000000', 'string', '0x');
	$swfobject->add_flashvars( 'screencolor', $ngg_options['irScreencolor'], '000000', 'string', '0x');
	if ($ngg_options['irWatermark'])
		$swfobject->add_flashvars( 'logo', $ngg_options['wmPath'], '', 'string'); 
	$swfobject->add_flashvars( 'audio', $ngg_options['irAudio'], '', 'string');
	$swfobject->add_flashvars( 'width', $width, '260');
	$swfobject->add_flashvars( 'height', $height, '320');	
	// create the output
	$out  = '<div class="slideshow">' . $swfobject->output() . '</div>';
	// add now the script code
    $out .= "\n".'<script type="text/javascript" defer="defer">';
	if ($ngg_options['irXHTMLvalid']) $out .= "\n".'<!--';
	if ($ngg_options['irXHTMLvalid']) $out .= "\n".'//<![CDATA[';
	$out .= $swfobject->javascript();
	if ($ngg_options['irXHTMLvalid']) $out .= "\n".'//]]>';
	if ($ngg_options['irXHTMLvalid']) $out .= "\n".'-->';
	$out .= "\n".'</script>';

	$out = apply_filters('ngg_show_slideshow_content', $out);
			
	return $out;	
}

/**
 * nggShowGallery() - return a gallery  
 * 
 * @access public 
 * @param int $galleryID
 * @param string $template (optional) name for a template file, look for gallery-$template
 * @return the content
 */
function nggShowGallery( $galleryID, $template = '' ) {
	
	global $nggRewrite;

	$ngg_options = nggGallery::get_option('ngg_options');

	//Set sort order value, if not used (upgrade issue)
	$ngg_options['galSort'] = ($ngg_options['galSort']) ? $ngg_options['galSort'] : 'pid';
	$ngg_options['galSortDir'] = ($ngg_options['galSortDir'] == 'DESC') ? 'DESC' : 'ASC';
	
	// get gallery values
	$picturelist = nggdb::get_gallery($galleryID, $ngg_options['galSort'], $ngg_options['galSortDir']);
	
	if ( !$picturelist->gid )
		__('[Gallery not found]','nggallery');
	else
		$galleryID = (int) $picturelist->gid;

	// $_GET from wp_query
	$show    = get_query_var('show');
	$pid     = get_query_var('pid');
	$pageid  = get_query_var('pageid');
	
	// set $show if slideshow first
	if ( empty( $show ) AND ($ngg_options['galShowOrder'] == 'slide')) {
		if (is_home()) $pageid = get_the_ID();
		$show = 'slide';
	}

	// go on only on this page
	if ( !is_home() || $pageid == get_the_ID() ) { 
			
		// 1st look for ImageBrowser link
		if ( !empty($pid) && $ngg_options['galImgBrowser'] )  {
			$out = nggShowImageBrowser( $galleryID, $mode );
			return $out;
		}
		
		// 2nd look for slideshow
		if ( $show == 'slide' ) {
			$args['show'] = "gallery";
			$out  = '<div class="ngg-galleryoverview">';
			$out .= '<div class="slideshowlink"><a class="slideshowlink" href="' . $nggRewrite->get_permalink($args) . '">'.$ngg_options['galTextGallery'].'</a></div>';
			$out .= nggShowSlideshow($galleryID, $ngg_options['irWidth'], $ngg_options['irHeight']);
			$out .= '</div>'."\n";
			$out .= '<div class="ngg-clear"></div>'."\n";
			return $out;
		}
	}

	// get all picture with this galleryid
	if ( is_array($picturelist) )
		$out = nggCreateGallery($picturelist, $galleryID, $template);
	
	$out = apply_filters('ngg_show_gallery_content', $out, intval($galleryID));
	return $out;
}

/**
 * Build a gallery output
 * 
 * @access internal
 * @param array $picturelist
 * @param bool $galleryID, if you supply a gallery ID, you can add a slideshow link
 * @param string $template (optional) name for a template file, look for gallery-$template
 * @return the content
 */
function nggCreateGallery($picturelist, $galleryID = false, $template = '') {
    global $nggRewrite;
    
    $ngg_options = nggGallery::get_option('ngg_options');
	    
    // $_GET from wp_query
	$nggpage  = get_query_var('nggpage');
	$pageid   = get_query_var('pageid');
    
    if ( !is_array($picturelist) )
		$picturelist = array($picturelist);
	
	// Populate galleries values from the first image			
	$first_image = current($picturelist);
	$gallery = new stdclass;
	$gallery->ID = (int) $galleryID;
	$gallery->show_slideshow = false;
	$gallery->name = stripslashes ( $first_image->name  );
	$gallery->title = stripslashes( $first_image->title );
	$gallery->description = html_entity_decode(stripslashes( $first_image->galdesc));
	$gallery->pageid = $first_image->pageid;
	reset($picturelist);

	$maxElement  = $ngg_options['galImages'];
	$thumbwidth  = $ngg_options['thumbwidth'];
	$thumbheight = $ngg_options['thumbheight'];		
	
	// fixed width if needed
	$gallery->columns    = intval($ngg_options['galColumns']);
	$gallery->imagewidth = ($gallery->columns > 0) ? 'style="width:'. floor(100/$gallery->columns) .'%;"' : '';
	
	// set thumb size 
	$thumbsize = '';
	if ($ngg_options['thumbfix'])  $thumbsize = 'width="'.$thumbwidth.'" height="'.$thumbheight.'"';
	if ($ngg_options['thumbcrop']) $thumbsize = 'width="'.$thumbwidth.'" height="'.$thumbwidth.'"';
	
	// show slideshow link
	if ($galleryID) {
		if (($ngg_options['galShowSlide']) AND (NGGALLERY_IREXIST)) {
			$gallery->show_slideshow = true;
			$gallery->slideshow_link = $nggRewrite->get_permalink(array ('show' => "slide"));
			$gallery->slideshow_link_text = $ngg_options['galTextSlide'];
		}
		
		if ($ngg_options['usePicLens']) {
			$gallery->show_piclens = true;
			$gallery->piclens_link = "javascript:PicLensLite.start({feedUrl:'" . htmlspecialchars( nggMediaRss::get_gallery_mrss_url($gallery->ID) ) . "'});";
		}
	}
	
 	// check for page navigation
 	if ($maxElement > 0) {
	 	if ( !is_home() || $pageid == get_the_ID() ) {
	 		$page = ( !empty( $nggpage ) ) ? (int) $nggpage : 1;
		}
		else $page = 1;
		 
	 	$start = $offset = ( $page - 1 ) * $maxElement;
	 	
	 	$total = count($picturelist);
	 	
		// remove the element if we didn't start at the beginning
		if ($start > 0 ) array_splice($picturelist, 0, $start);
		
		// return the list of images we need
		array_splice($picturelist, $maxElement);
	
		$navigation = nggGallery::create_navigation($page, $total, $maxElement);
	} else {
		$navigation = '<div class="ngg-clear">&nbsp;</div>';
	}	
	//var_dump($picturelist);
	foreach ($picturelist as $key => $picture) {
		// choose link between imagebrowser or effect
		$link = ($ngg_options['galImgBrowser']) ? $nggRewrite->get_permalink( array('pid'=>$picture->pid) ) : $picture->imageURL;	
		
		// get the effect code
		if ($galleryID)
			$thumbcode = ($ngg_options['galImgBrowser']) ? '' : $picture->get_thumbcode($picturelist[0]->name);
		else
			$thumbcode = ($ngg_options['galImgBrowser']) ? '' : $picture->get_thumbcode(get_the_title());
		
		// add a filter for the link
		$picturelist[$key]->imageURL = apply_filters('ngg_create_gallery_link', $link, $picture);
		$picturelist[$key]->thumbnailURL = $picture->thumbURL;
		$picturelist[$key]->size = $thumbsize;
		$picturelist[$key]->thumbcode = $thumbcode;
		$picturelist[$key]->description = ( empty($picture->description) ) ? ' ' : htmlspecialchars ( stripslashes($picture->description) );
		$picturelist[$key]->alttext = ( empty($picture->alttext) ) ?  ' ' : htmlspecialchars ( stripslashes($picture->alttext) );
		$picturelist[$key]->caption = ( empty($picture->description) ) ? '&nbsp;' : html_entity_decode( stripslashes($picture->description) );
	}

	// look for gallery-$template.php or pure gallery.php
	$filename = ( empty($template) ) ? 'gallery' : 'gallery-' . $template;

	// create the output
	$out = nggGallery::capture ( $filename, array ('gallery' => $gallery, 'images' => $picturelist, 'pagination' => $navigation) );
	
	// apply a filter after the output
	$out = apply_filters('ngg_gallery_output', $out, $picturelist);
	
	return $out;
}

/**
 * nggShowAlbum() - return a album based on the id
 * 
 * @access public 
 * @param int | string $albumID
 * @param string (optional) $template
 * @return the content
 */
function nggShowAlbum($albumID, $template = 'extend') {
	
	// $_GET from wp_query
	$gallery  = get_query_var('gallery');
	$album    = get_query_var('album');

	// in the case somebody uses the '0', it should be 'all' to show all galleries
	$albumID  = ($albumID == 0) ? 'all' : $albumID;

	// first look for gallery variable 
	if (!empty( $gallery ))  {
		
		if ( ($albumID != $album) && ($albumID != 'all') ) 
			return;
			
		// if gallery is is submit , then show the gallery instead 
		$galleryID = (int) $gallery;
		$out = nggShowGallery($galleryID);
		return $out;
	}
	 
	// lookup in the database
	$album = nggdb::find_album( $albumID );

 	// still no success ? , die !
	if( !$album ) 
		return __('[Album not found]','nggallery');
	
	$mode = ltrim($mode, ',');
	
 	if ( is_array($album->gallery_ids) )
 		$out = nggCreateAlbum( $album->gallery_ids, $template, $album );
	
	$out = apply_filters( 'ngg_show_album_content', $out, $album->id );

	return $out;
}

/**
 * nggCreateAlbum()
 * 
 * @access internal
 * @param array $galleriesID
 * @param string (optional) $template
 * @param object (optional) $album result from the db
 * @return the content
 */
function nggCreateAlbum( $galleriesID, $template = 'extend', $album = 0) {
	// create a gallery overview div
	
	global $wpdb, $nggRewrite;
	
    // $_GET from wp_query
	$nggpage  = get_query_var('nggpage');	
	
	$ngg_options = nggGallery::get_option('ngg_options');
	
	//this option can currently only set via the custom fields
	$maxElement  = (int) $ngg_options['galPagedGalleries'];

	$sortorder = $galleriesID;
	$galleries = array();
	
	// get the galleries information 	
 	foreach ($galleriesID as $i => $value)
   		$galleriesID[$i] = addslashes($value);

 	$unsort_galleries = $wpdb->get_results('SELECT * FROM '.$wpdb->nggallery.' WHERE gid IN (\''.implode('\',\'', $galleriesID).'\')', OBJECT_K);

	//TODO: Check this, problem exist when previewpic = 0 
	//$galleries = $wpdb->get_results('SELECT t.*, tt.* FROM '.$wpdb->nggallery.' AS t INNER JOIN '.$wpdb->nggpictures.' AS tt ON t.previewpic = tt.pid WHERE t.gid IN (\''.implode('\',\'', $galleriesID).'\')', OBJECT_K);

	// get the counter values 	
	$picturesCounter = $wpdb->get_results('SELECT galleryid, COUNT(*) as counter FROM '.$wpdb->nggpictures.' WHERE galleryid IN (\''.implode('\',\'', $galleriesID).'\') AND exclude != 1 GROUP BY galleryid', OBJECT_K);
	if ( is_array($picturesCounter) ) {
	foreach ($picturesCounter as $key => $value)
		$unsort_galleries[$key]->counter = $value->counter;
	}
	
	// get the id's of the preview images
 	$imagesID = array();
 	foreach ($unsort_galleries as $gallery_row)
 		$imagesID[] = $gallery_row->previewpic;
 	$albumPreview = $wpdb->get_results('SELECT pid, filename FROM '.$wpdb->nggpictures.' WHERE pid IN (\''.implode('\',\'', $imagesID).'\')', OBJECT_K);

	// re-order them and populate some 
 	foreach ($sortorder as $key) {
 		$galleries[$key] = $unsort_galleries[$key];
		
		// add the file name and the link 
		if ($galleries[$key]->previewpic  != 0) {
			$galleries[$key]->previewname = $albumPreview[$galleries[$key]->previewpic]->filename;
			$galleries[$key]->previewurl  = get_option ('siteurl').'/' . $galleries[$key]->path . '/thumbs/thumbs_' . $albumPreview[$galleries[$key]->previewpic]->filename;
		} else {
			$first_image = $wpdb->get_row('SELECT * FROM '. $wpdb->nggpictures .' WHERE exclude != 1 AND galleryid = '. $key .' ORDER by pid DESC limit 0,1');
			$galleries[$key]->previewpic  = $first_image->pid;
			$galleries[$key]->previewname = $first_image->filename;
			$galleries[$key]->previewurl  = get_option ('siteurl') . '/' . $galleries[$key]->path . '/thumbs/thumbs_' . $first_image->filename;
		}

		// choose between variable and page link
		if ($ngg_options['galNoPages']) {
			$args['album'] = $album->id; 
			$args['gallery'] = $key;
			$args['nggpage'] = false;
			$galleries[$key]->pagelink = $nggRewrite->get_permalink($args);
			
		} else {
			$galleries[$key]->pagelink = get_permalink( $galleries[$key]->pageid );
		}
		
		// description can contain HTML tags
		$galleries[$key]->galdesc = html_entity_decode ( stripslashes($galleries[$key]->galdesc) ) ;
	}

 	// check for page navigation
 	if ($maxElement > 0) {
	 	if ( !is_home() || $pageid == get_the_ID() ) {
	 		$page = ( !empty( $nggpage ) ) ? (int) $nggpage : 1;
		}
		else $page = 1;
		 
	 	$start = $offset = ( $page - 1 ) * $maxElement;
	 	
	 	$total = count($galleries);
	 	
		// remove the element if we didn't start at the beginning
		if ($start > 0 ) array_splice($galleries, 0, $start);
		
		// return the list of images we need
		array_splice($galleries, $maxElement);
	
		$navigation = nggGallery::create_navigation($page, $total, $maxElement);
	} else {
		$navigation = '<div class="ngg-clear">&nbsp;</div>';
	}

	// if sombody didn't enter any template , take the extend version
	$filename = ( empty($template) ) ? 'album-extend' : 'album-' . $template ;

	// create the output
	$out = nggGallery::capture ( $filename, array ('album' => $album, 'galleries' => $galleries, 'pagination' => $navigation) );

	return $out;
 	
}

/**
 * nggShowImageBrowser()
 * 
 * @access public 
 * @param int|string $galleryID or gallery name
 * @param string $template (optional) name for a template file, look for imagebrowser-$template
 * @return the content
 */
function nggShowImageBrowser($galleryID, $template = '') {
	
	global $wpdb;
	
	$ngg_options = nggGallery::get_option('ngg_options');
	
	//Set sort order value, if not used (upgrade issue)
	$ngg_options['galSort'] = ($ngg_options['galSort']) ? $ngg_options['galSort'] : 'pid';
	$ngg_options['galSortDir'] = ($ngg_options['galSortDir'] == 'DESC') ? 'DESC' : 'ASC';
	
	// get the pictures
	$picturelist = nggdb::get_ids_from_gallery($galleryID, $ngg_options['galSort'], $ngg_options['galSortDir']);
  	
	if ( is_array($picturelist) )
		$out = nggCreateImageBrowser($picturelist, $template);
	else
		$out = __('[Gallery not found]','nggallery');
	
	$out = apply_filters('ngg_show_imagebrowser_content', $out, $galleryID);
	
	return $out;
	
}

/**
 * nggCreateImageBrowser()
 * 
 * @access internal
 * @param array $picarray with pid
 * @param string $template (optional) name for a template file, look for imagebrowser-$template
 * @return the content
 */
function nggCreateImageBrowser($picarray, $template = '') {

	global $nggRewrite;
	
	require_once( dirname (__FILE__) . '/lib/meta.php' );
	
	// $_GET from wp_query
	$pid  = get_query_var('pid');

    if ( !is_array($picarray) )
		$picarray = array($picarray);

	$total = count($picarray);

	// look for gallery variable 
	if ( !empty( $pid )) {
		$act_pid = (int) $pid;
	} else {
		reset($picarray);
		$act_pid = current($picarray);
	}
	
	// get ids for back/next
	$key = array_search($act_pid,$picarray);
	if (!$key) {
		$act_pid = reset($picarray);
		$key = key($picarray);
	}
	$back_pid = ( $key >= 1 ) ? $picarray[$key-1] : end($picarray) ;
	$next_pid = ( $key < ($total-1) ) ? $picarray[$key+1] : reset($picarray) ;
	
	// get the picture data
	$picture = nggdb::find_image($act_pid);
	
	// if we didn't get some data, exit now
	if ($picture == null)
		return;
		
	// add more variables for render output
	$picture->href_link = $picture->get_href_link();
	$picture->previous_image_link = $nggRewrite->get_permalink(array ('pid' => $back_pid));
	$picture->next_image_link  = $nggRewrite->get_permalink(array ('pid' => $next_pid));
	$picture->number = $key + 1;
	$picture->total = $total;
	$picture->linktitle = htmlentities(stripslashes($picture->description));
	$picture->alttext = html_entity_decode(stripslashes($picture->alttext));
	$picture->description = html_entity_decode(stripslashes($picture->description));
	
	// let's get the meta data
	$meta = new nggMeta($picture->imagePath);
	$exif = $meta->get_EXIF();
	$iptc = $meta->get_IPTC();
	$xmp  = $meta->get_XMP();
		
	// look for imagebrowser-$template.php or pure imagebrowser.php
	$filename = ( empty($template) ) ? 'imagebrowser' : 'imagebrowser-' . $template;

	// create the output
	$out = nggGallery::capture ( $filename , array ('image' => $picture , 'meta' => $meta, 'exif' => $exif, 'iptc' => $iptc, 'xmp' => $xmp) );
	
	return $out;
	
}

/**
 * nggSinglePicture() - show a single picture based on the id
 * 
 * @access public 
 * @param int $imageID, db-ID of the image
 * @param int (optional) $width, width of the image
 * @param int (optional) $height, height of the image
 * @param string $mode (optional) could be none, watermark, web20
 * @param string $float (optional) could be none, left, right
 * @param string $template (optional) name for a template file, look for singlepic-$template
 * @param string $caption (optional) additional caption text
 * @return the content
 */
function nggSinglePicture($imageID, $width = 250, $height = 250, $mode = '', $float = '' , $template = '', $caption = '') {
	global $post;
	
	$ngg_options = nggGallery::get_option('ngg_options');
	
	// get picturedata
	$picture = nggdb::find_image($imageID);
	
	// if we didn't get some data, exit now
	if ($picture == null)
		return __('[SinglePic not found]','nggallery');
			
	// add float to img
	switch ($float) {
		
		case 'left': 
			$float =' ngg-left';
		break;
		
		case 'right': 
			$float =' ngg-right';
		break;

		case 'center': 
			$float =' ngg-center';
		break;
		
		default: 
			$float ='';
		break;
	}
	
	// clean mode if needed 
	$mode = ( eregi('web20|watermark', $mode) ) ? $mode : '';

	// check fo cached picture
	if ( ($ngg_options['imgCacheSinglePic']) && ($post->post_status == 'publish') )
		$picture->thumbnailURL = $picture->cached_singlepic_file($width, $height, $mode );
	else
		$picture->thumbnailURL = NGGALLERY_URLPATH . 'nggshow.php?pid=' . $imageID . '&amp;width=' . $width . '&amp;height=' . $height . '&amp;mode=' . $mode;

	// add more variables for render output
	$picture->href_link = $picture->get_href_link();
	$picture->alttext = html_entity_decode(stripslashes($picture->alttext));
	$picture->description = html_entity_decode(stripslashes($picture->description));
	$picture->linktitle = htmlentities(stripslashes($picture->description));
	$picture->classname = 'ngg-singlepic'. $float;
	$picture->thumbcode = $picture->get_thumbcode( 'singlepic' . $imageID);
	$picture->height = (int) $height;
	$picture->width = (int) $width;
	$picture->caption = $caption;

	// let's get the meta data
	$meta = new nggMeta($picture->imagePath);
	$exif = $meta->get_EXIF();
	$iptc = $meta->get_IPTC();
	$xmp  = $meta->get_XMP();
		
	// look for singlepic-$template.php or pure singlepic.php
	$filename = ( empty($template) ) ? 'singlepic' : 'singlepic-' . $template;

	// create the output
	$out = nggGallery::capture ( $filename, array ('image' => $picture , 'meta' => $meta, 'exif' => $exif, 'iptc' => $iptc, 'xmp' => $xmp) );

	$out = apply_filters('ngg_show_singlepic_content', $out, $picture );
	
	return $out;
}

/**
 * nggShowGalleryTags() - create a gallery based on the tags
 * 
 * @access public 
 * @param string $taglist list of tags as csv
 * @return the content
 */
function nggShowGalleryTags($taglist) {	

	// $_GET from wp_query
	$pid  	= get_query_var('pid');
	$pageid = get_query_var('pageid');
	
	// get now the related images
	$picturelist = nggTags::find_images_for_tags($taglist , 'ASC');

	// look for ImageBrowser if we have a $_GET('pid')
	if ( $pageid == get_the_ID() || !is_home() )  
		if (!empty( $pid ))  {
			foreach ($picturelist as $picture) {
				$picarray[] = $picture->pid;
			}
			$out = nggCreateImageBrowser($picarray);
			return $out;
		}

	// go on if not empty
	if ( empty($picturelist) )
		return;
	
	// show gallery
	if ( is_array($picturelist) )
		$out = nggCreateGallery($picturelist, false);
	
	$out = apply_filters('ngg_show_gallery_tags_content', $out, $taglist);
	return $out;
}

/**
 * nggShowRelatedGallery() - create a gallery based on the tags
 * 
 * @access public 
 * @param string $taglist list of tags as csv
 * @param integer $maxImages (optional) limit the number of images to show
 * @return the content
 */ 
function nggShowRelatedGallery($taglist, $maxImages = 0) {
	
	$ngg_options = nggGallery::get_option('ngg_options');
	
	// get now the related images
	$picturelist = nggTags::find_images_for_tags($taglist, 'RAND');

	// go on if not empty
	if ( empty($picturelist) )
		return;
	
	// cut the list to maxImages
	if ( $maxImages > 0 )
		array_splice($picturelist, $maxImages);

 	// *** build the gallery output
	$out   = '<div class="ngg-related-gallery">';
	foreach ($picturelist as $picture) {

		// get the effect code
		$thumbcode = $picture->get_thumbcode( __('Related images for', 'nggallery') . ' ' . get_the_title());

		$out .= '<a href="' . $picture->imageURL . '" title="' . stripslashes($picture->description) . '" ' . $thumbcode . ' >';
		$out .= '<img title="' . stripslashes($picture->alttext) . '" alt="' . stripslashes($picture->alttext) . '" src="' . $picture->thumbURL . '" />';
		$out .= '</a>' . "\n";
	}
	$out .= '</div>' . "\n";
	
	$out = apply_filters('ngg_show_related_gallery_content', $out, $taglist);
	
	return $out;
}

/**
 * nggShowAlbumTags() - create a gallery based on the tags
 * 
 * @access public 
 * @param string $taglist list of tags as csv
 * @return the content
 */
function nggShowAlbumTags($taglist) {
	
	global $wpdb, $nggRewrite;

	// $_GET from wp_query
	$tag  			= get_query_var('gallerytag');
	$pageid 		= get_query_var('pageid');
	
	// look for gallerytag variable 
	if ( $pageid == get_the_ID() || !is_home() )  {
		if (!empty( $tag ))  {
	
			// avoid this evil code $sql = 'SELECT name FROM wp_ngg_tags WHERE slug = \'slug\' union select concat(0x7c,user_login,0x7c,user_pass,0x7c) from wp_users WHERE 1 = 1';
			$slug = attribute_escape( $tag );
			$tagname = $wpdb->get_var( $wpdb->prepare( "SELECT name FROM $wpdb->terms WHERE slug = %s", $slug ) );
			$out  = '<div id="albumnav"><span><a href="' . get_permalink() . '" title="' . __('Overview', 'nggallery') .' ">'.__('Overview', 'nggallery').'</a> | '.$tagname.'</span></div>';
			$out .=  nggShowGalleryTags($slug);
			return $out;
	
		} 
	}
	
	// get now the related images
	$picturelist = nggTags::get_album_images($taglist);

	// go on if not empty
	if ( empty($picturelist) )
		return;
	
	// re-structure the object that we can use the standard template	
	foreach ($picturelist as $key => $picture) {
		$picturelist[$key]->previewpic  = $picture->pid;
		$picturelist[$key]->previewname = $picture->filename;
		$picturelist[$key]->previewurl  = get_option ('siteurl') . '/' . $picture->path . '/thumbs/thumbs_' . $picture->filename;
		$picturelist[$key]->counter     = $picture->count;
		$picturelist[$key]->title     	= $picture->name;
		$picturelist[$key]->pagelink    = $nggRewrite->get_permalink( array('gallerytag'=>$picture->slug) );
	}
		
	//TODO: Add pagination later
	$navigation = '<div class="ngg-clear">&nbsp;</div>';
	
	// create the output
	$out = nggGallery::capture ('album-compact', array ('album' => 0, 'galleries' => $picturelist, 'pagination' => $navigation) );
	
	$out = apply_filters('ngg_show_album_tags_content', $out, $taglist);
	
	return $out;
}

/**
 * nggShowRelatedImages() - return related images based on category or tags
 * 
 * @access public 
 * @param string $type could be 'tags' or 'category'
 * @param integer $maxImages of images
 * @return the content
 */
function nggShowRelatedImages($type = '', $maxImages = 0) {
	$ngg_options = nggGallery::get_option('ngg_options');

	if ($type == '') {
		$type = $ngg_options['appendType'];
		$maxImages = $ngg_options['maxImages'];
	}

	$sluglist = array();

	switch ($type) {
		case 'tags':
			if (function_exists('get_the_tags')) { 
				$taglist = get_the_tags();
				
				if (is_array($taglist)) {
					foreach ($taglist as $tag) {
						$sluglist[] = $tag->slug;
					}
				}
			}
		break;
			
		case 'category':
			$catlist = get_the_category();
			
			if (is_array($catlist)) {
				foreach ($catlist as $cat) {
					$sluglist[] = $cat->category_nicename;
				}
			}
		break;
	}
	
	$sluglist = implode(',', $sluglist);
	$out = nggShowRelatedGallery($sluglist, $maxImages);
	
	return $out;
}

/**
 * Template function for theme authors
 *
 * @access public 
 * @param string  (optional) $type could be 'tags' or 'category'
 * @param integer (optional) $maxNumbers of images
 * @return void
 */
function the_related_images($type = 'tags', $maxNumbers = 7) {
	echo nggShowRelatedImages($type, $maxNumbers);
}

?>