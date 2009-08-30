<?php

/**
 * @author Alex Rabe
 * @copyright 2008
 */

add_action('wp_ajax_ngg_ajax_operation', 'ngg_ajax_operation' );

function ngg_ajax_operation() {
		
		global $wpdb;

		// if nonce is not correct it returns -1
		check_ajax_referer( "ngg-ajax" );
		
		// check for correct capability
		if ( !is_user_logged_in() )
			die('-1');
		
		// check for correct NextGEN capability
		if ( !current_user_can('NextGEN Upload images') || !current_user_can('NextGEN Manage gallery') ) 
			die('-1');	
		
		// include the ngg function
		include_once (dirname (__FILE__). '/functions.php');

		// Get the image id
		if ( isset($_POST['image'])) {
			$id = (int) $_POST['image'];
			// let's get the image data
			$picture = nggdb::find_image($id);
			// what do you want to do ?		
			switch ( $_POST['operation'] ) {
				case 'create_thumbnail' :
					$result = nggAdmin::create_thumbnail($picture);
				break;
				case 'resize_image' :
					$result = nggAdmin::resize_image($picture);
				break;
				case 'set_watermark' :
					$result = nggAdmin::set_watermark($picture);
				break;
				default :
					die('-1');	
				break;		
			}
			// A success should retun a '1'
			die ($result);
		}
		
		// The script should never stop here
		die('0');
}
?>