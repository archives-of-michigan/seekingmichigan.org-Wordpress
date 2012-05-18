<?php
/*-----------------------------------------------------------------------------------*/
/* Theme Header Output - wp_head() */
/*-----------------------------------------------------------------------------------*/

// This sets up the layouts and styles selected from the options panel

if (!function_exists('optionsframework_wp_head')) {
	function optionsframework_wp_head() {
		global $e404_all_options, $e404_default_logos, $e404_options, $e404_social_icons_variants;
		
		$shortname =  get_option('of_shortname');
	    
		//Styles
		if(!isset($_REQUEST['style']))
			if(isset($_COOKIE['shiny_style']))
				$style = $_COOKIE['shiny_style'];
			else
				$style = '';
		else 
	     	$style = $_REQUEST['style'];
			
	    if ($style != '') {
			$GLOBALS['stylesheet'] = $style;
			echo '<link href="'. OF_DIRECTORY .'/styles/'. $GLOBALS['stylesheet'] . '.css" rel="stylesheet" type="text/css" />'."\n"; 
	    } else { 
	        $GLOBALS['stylesheet'] = get_option($shortname.'_theme_style');
	        if($GLOBALS['stylesheet'] != '')
	            echo '<link href="'. OF_DIRECTORY .'/styles/'. $GLOBALS['stylesheet'] .'" rel="stylesheet" type="text/css" />'."\n";         
	        else
	            echo '<link href="'. OF_DIRECTORY .'/styles/style_01.css" rel="stylesheet" type="text/css" />'."\n";         		  
	    }       
			
		if(empty($e404_all_options['e404_logo']))
			$e404_all_options['e404_logo'] = $e404_options['logo_url'] = OF_DIRECTORY.'/images/'.$e404_default_logos[str_replace('.css', '', $GLOBALS['stylesheet'])].'.png';

		// This prints out the custom css and specific styling options
		of_head_css();
	}
}
add_action('wp_head', 'optionsframework_wp_head');

function of_set_style_cookie() {
	if(isset($_REQUEST['style']) && !is_admin())
		setcookie('shiny_style', $_REQUEST['style'], time() + 3600, '/');
}
add_action('init', 'of_set_style_cookie');

/*-----------------------------------------------------------------------------------*/
/* Output CSS from standarized options */
/*-----------------------------------------------------------------------------------*/

function of_head_css() {
	$shortname =  get_option('of_shortname'); 
	$output = '';
		
	$custom_css = get_option($shortname.'_custom_css');
		
	if ($custom_css != '') {
		$output .= $custom_css . "\n";
	}
		
	// Output styles
	if ($output <> '') {
		$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
		echo $output;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function childtheme_favicon() {
	$shortname =  get_option('of_shortname'); 
	if (get_option($shortname . '_custom_favicon') != '') {
        echo '<link rel="shortcut icon" href="'.  get_option($shortname.'_custom_favicon')  .'"/>'."\n";
    }
	else { ?>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/admin/images/favicon.ico" />
<?php }
}
add_action('wp_head', 'childtheme_favicon');

/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function childtheme_analytics(){
	$shortname =  get_option('of_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output != "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer', 'childtheme_analytics');

?>
