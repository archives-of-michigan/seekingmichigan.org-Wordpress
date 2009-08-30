<?php
/*
* NextGEN Gallery Widget
*/

// Adding Media RSS Widget as well
require_once(dirname (__FILE__) . '/media-rss-widget.php');

/**
 * nggSlideshowWidget - The slideshow widget control for NextGEN Gallery ( require WP2.5 or higher)
 *
 * @package NextGEN Gallery
 * @author Alex Rabe
 * @copyright 2008
 * @version 1.00
 * @since 1.00
 * @access public
 */
if (!class_exists('nggSlideshowWidget')) { 
class nggSlideshowWidget {
	
	function nggSlideshowWidget() {
		add_action('widgets_init', array(&$this, 'register_widget')) ;
	}		

	function register_widget() {

		$widget_ops = array('classname' => 'widget_slideshow', 'description' => __( 'Show a NextGEN Gallery Slideshow', 'nggallery') );
		wp_register_sidebar_widget('slideshow', __('NextGEN Slideshow', 'nggallery'), array(&$this, 'widget_output'), $widget_ops );
		wp_register_widget_control('slideshow', __('NextGEN Slideshow', 'nggallery'), array(&$this, 'widget_control') );
	}	
		
	function render_slideshow($galleryID, $irWidth = '', $irHeight = '') {
		
		require_once (dirname (__FILE__).'/../lib/swfobject.php');
		
		global $wpdb;
	
		$ngg_options = get_option('ngg_options');
		
		// remove media file from RSS feed
		if ( is_feed() ) {
			$out = '[' . $ngg_options['galTextSlide'] . ']'; 
			return $out;
		}
	
		if (empty($irWidth) ) $irWidth = (int) $ngg_options['irWidth'];
		if (empty($irHeight)) $irHeight = (int) $ngg_options['irHeight'];
	
		// init the flash output
		$swfobject = new swfobject( $ngg_options['irURL'], 'sbsl' . $galleryID, $irWidth, $irHeight, '7.0.0', 'false');
		
		$swfobject->classname = 'ngg-widget-slideshow';
		$swfobject->message =  __('<a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see the slideshow.', 'nggallery');
		$swfobject->add_params('wmode', 'opaque');
		$swfobject->add_params('bgcolor', $ngg_options['irScreencolor'], '000000', 'string', '#');
		$swfobject->add_attributes('styleclass', 'slideshow-widget');
	
		// adding the flash parameter	
		$swfobject->add_flashvars( 'file', NGGALLERY_URLPATH.'xml/imagerotator.php?gid='.$galleryID );
		$swfobject->add_flashvars( 'shownavigation', 'false', 'true', 'bool');
		$swfobject->add_flashvars( 'shuffle', $ngg_options['irShuffle'], 'true', 'bool');
		$swfobject->add_flashvars( 'showicons', $ngg_options['irShowicons'], 'true', 'bool');
		$swfobject->add_flashvars( 'overstretch', $ngg_options['irOverstretch'], 'false', 'string');
		$swfobject->add_flashvars( 'rotatetime', $ngg_options['irRotatetime'], 5, 'int');
		$swfobject->add_flashvars( 'transition', $ngg_options['irTransition'], 'random', 'string');
		$swfobject->add_flashvars( 'backcolor', $ngg_options['irBackcolor'], 'FFFFFF', 'string', '0x');
		$swfobject->add_flashvars( 'frontcolor', $ngg_options['irFrontcolor'], '000000', 'string', '0x');
		$swfobject->add_flashvars( 'lightcolor', $ngg_options['irLightcolor'], '000000', 'string', '0x');
		$swfobject->add_flashvars( 'screencolor', $ngg_options['irScreencolor'], '000000', 'string', '0x');
		$swfobject->add_flashvars( 'width', $irWidth, '260');
		$swfobject->add_flashvars( 'height', $irHeight, '320');	
		// create the output
		$out  = $swfobject->output();
		// add now the script code
	    $out .= "\n".'<script type="text/javascript" defer="defer">';
		$out .= "\n".'<!--';
		$out .= "\n".'//<![CDATA[';
		$out .= $swfobject->javascript();
		$out .= "\n".'//]]>';
		$out .= "\n".'-->';
		$out .= "\n".'</script>';
				
		echo $out;
	}
	
	// Slidehow widget control
	function widget_output($args) {

		global $wpdb;
		
		// If the Imagerotator didn't exist, skip the output
		if ( NGGALLERY_IREXIST == false ) 	 
			return;
			
	    extract($args);
  
    	// Each widget can store its own options. We keep strings here.
		$options = get_option('widget_nggslideshow');
		
		// These lines generate our output. 
		echo $before_widget . $before_title . $options['title'] . $after_title;

		$this->render_slideshow($options['galleryid'] , $options['width'] , $options['height']);

		echo $after_widget;
		
	}	
	
	// Admin section
	function widget_control() {
	 	global $wpdb;
	 	$options = get_option('widget_nggslideshow');
	 	if ( !is_array($options) )
			$options = array('title'=>'Slideshow', 'galleryid'=>'0','height'=>'120','width'=>'160',);
			
		if ( $_POST['ngg-submit'] ) {

			$options['title'] = strip_tags(stripslashes($_POST['ngg-title']));
			$options['galleryid'] = (int) $_POST['ngg-galleryid'];
			$options['height'] = (int) $_POST['ngg-height'];
			$options['width'] = (int) $_POST['ngg-width'];
			update_option('widget_nggslideshow', $options);
		}
		
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$height = $options['height'];
		$width = $options['width'];
		
		// The Box content
		$tables = $wpdb->get_results("SELECT * FROM $wpdb->nggallery ORDER BY 'name' ASC ");
?>
		<p><label for="ngg-title"><?php _e('Title:', 'nggallery'); ?><input id="ngg-title" name="ngg-title" class="widefat" type="text" value="<?php echo $title; ?>" /></label></p>
		<p>
			<label for="ngg-galleryid"><?php _e('Select Gallery:', 'nggallery'); ?>
				<select size="1" name="ngg-galleryid" id="ngg-galleryid" class="widefat">
					<option value="0" <?php if (0 == $options['galleryid']) echo "selected='selected' "; ?> ><?php _e('All images', 'nggallery'); ?></option>
<?php
				if($tables) {
					foreach($tables as $table) {
					echo '<option value="'.$table->gid.'" ';
					if ($table->gid == $options['galleryid']) echo "selected='selected' ";
					echo '>'.$table->name.'</option>'."\n\t"; 
					}
				}
?>
				</select>
			</label>
		</p>
		<p><label for="ngg-height"><?php _e('Height:', 'nggallery'); ?> <input id="ngg-height" name="ngg-height" type="text" style="padding: 3px; width: 45px;" value="<?php echo $height; ?>" /></label></p>
		<p><label for="ngg-width"><?php _e('Width:', 'nggallery'); ?> <input id="ngg-width" name="ngg-width" type="text" style="padding: 3px; width: 45px;" value="<?php echo $width; ?>" /></label></p>
		<input type="hidden" id="ngg-submit" name="ngg-submit" value="1" />
<?php	
	}
}// End class
}
// start it
$nggSlideshowWidget = new nggSlideshowWidget;	

/**
 * nggWidget - The widget control for NextGEN Gallery ( require WP2.5 or higher)
 *
 * @package NextGEN Gallery
 * @author Alex Rabe
 * @copyright 2008
 * @version 1.10
 * @access public
 */
if (!class_exists('nggWidget')) { 
class nggWidget {
	
	function nggWidget() {
	
		// Run our code later in case this loads prior to any required plugins.
		add_action('widgets_init', array(&$this, 'ngg_widget_register'));
		
	}
	
	function ngg_widget_register() {

		if ( !$options = get_option('ngg_widget') )
			$options = array();
		
		$widget_ops = array('classname' => 'ngg_images', 'description' => __( 'Add recent or random images from the galleries','nggallery' ));
		$control_ops = array('width' => 250, 'height' => 200, 'id_base' => 'ngg-images');
		$name = __('NextGEN Widget','nggallery');
		$id = false;

		foreach ( array_keys($options) as $o ) {
			// Old widgets can have null values for some reason
			if ( !isset($options[$o]['title']) )
				continue;
				
			$id = "ngg-images-$o"; // Never never never translate an id
			wp_register_sidebar_widget($id, $name, array(&$this, 'ngg_widget_output'), $widget_ops, array( 'number' => $o ) );
			wp_register_widget_control($id, $name, array(&$this, 'ngg_widget_control'), $control_ops, array( 'number' => $o ));
		}

		// If there are none, we register the widget's existance with a generic template
		if ( !$id ) {
			wp_register_sidebar_widget( 'ngg-images-1', $name, array(&$this, 'ngg_widget_output'), $widget_ops, array( 'number' => -1 ) );
			wp_register_widget_control( 'ngg-images-1', $name, array(&$this, 'ngg_widget_control'), $control_ops, array( 'number' => -1 ) );
		}

	 }

function ngg_widget_control($widget_args = 1) {
		
		global $wp_registered_widgets;
		static $updated = false;
		
		// Get the widget ID
		if (is_numeric($widget_args))
			$widget_args = array('number' => $widget_args);

		$widget_args = wp_parse_args($widget_args, array('number' => -1));
		extract($widget_args, EXTR_SKIP);

		$options = get_option('ngg_widget');
		if ( !is_array($options) )
			$options = array();
	
		if (!$updated && !empty($_POST['sidebar'])) {
			$sidebar = (string) $_POST['sidebar'];

			$sidebars_widgets = wp_get_sidebars_widgets();
			if ( isset($sidebars_widgets[$sidebar]) )
				$this_sidebar = &$sidebars_widgets[$sidebar];
			else
				$this_sidebar = array();

			foreach ( $this_sidebar as $_widget_id ) {
				// Remove all widgets of this type from the sidebar.  We'll add the new data in a second.  This makes sure we don't get any duplicate data
				// since widget ids aren't necessarily persistent across multiple updates
				if ( 'ngg_images' == $wp_registered_widgets[$_widget_id]['classname'] 
					&& 	isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
					
					$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
					if (!in_array( "ngg-images-$widget_number", $_POST['widget-id'])) // the widget has been removed.
						unset($options[$widget_number]);
				}
			}

			foreach ( (array) $_POST['widget_ngg_images'] as $widget_number => $widget_ngg_images ) {
				if ( !isset($widget_ngg_images['width']) && isset($options[$widget_number]) ) // user clicked cancel
					continue;
					
				$widget_ngg_images = stripslashes_deep( $widget_ngg_images );
				$options[$widget_number]['title']	= $widget_ngg_images['title'];
				$options[$widget_number]['items']	= (int) $widget_ngg_images['items'];
				$options[$widget_number]['type']	= $widget_ngg_images['type'];
				$options[$widget_number]['show']	= $widget_ngg_images['show'];
				$options[$widget_number]['width']	= (int) $widget_ngg_images['width'];
				$options[$widget_number]['height']	= (int) $widget_ngg_images['height'];
				$options[$widget_number]['exclude']	= $widget_ngg_images['exclude'];
				$options[$widget_number]['list']	= $widget_ngg_images['list'];				

			}

			update_option('ngg_widget', $options);
			$updated = true;
		}
		
		if ( -1 == $number ) {
			// Init parameters check
			$title = 'Gallery';
			$items = 4;
			$type = 'random';
			$show= 'thumbnail';
			$width = 75;
			$height = 50;
			$exclude = 'all';
			$list = '';
			$number = '%i%';
		} else {
			extract( (array) $options[$number] );
		}

		// The form has inputs with names like widget-many[$number][something] so that all data for that instance of
		// the widget are stored in one $_POST variable: $_POST['widget-many'][$number]
		?>

		<p>
			<label for="ngg_images-title-<?php echo $number; ?>"><?php _e('Title :','nggallery'); ?>
			<input id="ngg_images-title-<?php echo $number; ?>" name="widget_ngg_images[<?php echo $number; ?>][title] ?>" type="text" class="widefat" value="<?php echo $title; ?>" />
			</label>
		</p>
			
		<p>
			<label for="ngg_images-items-<?php echo $number; ?>"><?php _e('Show :','nggallery'); ?><br />
			<select id="ngg_images-items-<?php echo $number; ?>" name="widget_ngg_images[<?php echo $number; ?>][items]">
				<?php for ( $i = 1; $i <= 10; ++$i ) echo "<option value='$i' ".($items==$i ? "selected='selected'" : '').">$i</option>"; ?>
			</select>
			<select id="ngg_images-show-<?php echo $number; ?>" name="widget_ngg_images[<?php echo $number; ?>][show]" >
				<option <?php selected("thumbnail" , $show); ?> value="thumbnail"><?php _e('Thumbnails','nggallery'); ?></option>
				<option <?php selected("original" , $show); ?> value="orginal"><?php _e('Original images','nggallery'); ?></option>
			</select>
			</label>
		</p>

		<p>
			<label for="widget_ngg_images<?php echo $number; ?>">&nbsp;
			<input name="widget_ngg_images[<?php echo $number; ?>][type]" type="radio" value="random" <?php checked("random" , $type); ?> /> <?php _e('random','nggallery'); ?>
			<input name="widget_ngg_images[<?php echo $number; ?>][type]" type="radio" value="recent" <?php checked("recent" , $type); ?> /> <?php _e('recent added ','nggallery'); ?>
			</label>
		</p>

		<p>
			<label for="ngg_images-width-<?php echo $number; ?>"><?php _e('Width x Height :','nggallery'); ?><br />
			<input style="width: 50px; padding:3px;" id="ngg_images-width-<?php echo $number; ?>" name="widget_ngg_images[<?php echo $number; ?>][width]" type="text" value="<?php echo $width; ?>" /> x
			<input style="width: 50px; padding:3px;" id="ngg_images-height-<?php echo $number; ?>" name="widget_ngg_images[<?php echo $number; ?>][height]" type="text" value="<?php echo $height; ?>" /> (px)
			</label>
		</p>

		<p>
			<label for="ngg_images-exclude-<?php echo $number; ?>"><?php _e('Select :','nggallery'); ?>
			<select id="ngg_images-exclude-<?php echo $number; ?>" name="widget_ngg_images[<?php echo $number; ?>][exclude]" class="widefat">
				<option <?php selected("all" , $exclude); ?>  value="all" ><?php _e('All galleries','nggallery'); ?></option>
				<option <?php selected("denied" , $exclude); ?> value="denied" ><?php _e('Only which are not listed','nggallery'); ?></option>
				<option <?php selected("allow" , $exclude); ?>  value="allow" ><?php _e('Only which are listed','nggallery'); ?></option>
			</select>
			</label>
		</p>

		<p>
			<label for="ngg_images-list-<?php echo $number; ?>"><?php _e('Gallery ID :','nggallery'); ?>
			<input id="ngg_images-list-<?php echo $number; ?>" name="widget_ngg_images[<?php echo $number; ?>][list]" type="text" class="widefat" value="<?php echo $list; ?>" />
			<br/><small><?php _e('Gallery IDs, separated by commas.','nggallery'); ?></small>
			</label>
		</p>

		<input type="hidden" id="ngg_images-submit-<?php echo $number; ?>" name="widget_ngg_images[<?php echo $number; ?>][submit]" value="1" />
		
	<?php
	
	}

	function ngg_widget_output($args, $widget_args = 1 , $options = false) {

		global $wpdb;
				
		extract($args, EXTR_SKIP);
		if ( is_numeric($widget_args) )
			$widget_args = array( 'number' => $widget_args );
		
		$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
		extract($widget_args, EXTR_SKIP);

		// We could get this also as parameter
		if (!$options)				
			$options = get_option('ngg_widget');
			
		$title = $options[$number]['title'];
		$items 	= $options[$number]['items'];
		$exclude = $options[$number]['exclude'];
		$list = $options[$number]['list'];

		$count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->nggpictures WHERE exclude != 1 ");
		if ($count < $options[$number]['items']) 
			$options[$number]['items'] = $count;

		$exclude_list = '';

		// THX to Kay Germer for the idea & addon code
		if ( (!empty($list)) && ($exclude != 'all') ) {
			$list = explode(',',$list);
			// Prepare for SQL
			$list = "'" . implode("', '", $list ) . "'";
			
			if ($exclude == 'denied')	
				$exclude_list = "AND NOT t.gid IN ($list)";

			if ($exclude == 'allow')	
				$exclude_list = "AND t.gid IN ($list)";
		}
		
		if ( $options[$number]['type'] == 'random' ) 
			$imageList = $wpdb->get_results("SELECT t.*, tt.* FROM $wpdb->nggallery AS t INNER JOIN $wpdb->nggpictures AS tt ON t.gid = tt.galleryid WHERE tt.exclude != 1 $exclude_list ORDER by rand() limit {$items}");
		else
			$imageList = $wpdb->get_results("SELECT t.*, tt.* FROM $wpdb->nggallery AS t INNER JOIN $wpdb->nggpictures AS tt ON t.gid = tt.galleryid WHERE tt.exclude != 1 $exclude_list ORDER by pid DESC limit 0,$items");

		echo $before_widget . $before_title . $title . $after_title;
		echo "\n".'<div class="ngg-widget">'."\n";
	
		if (is_array($imageList)){
			foreach($imageList as $image) {
				// get the URL constructor
				$image = new nggImage($image);

				// get the effect code
				$thumbcode = $image->get_thumbcode("sidebar_".$number);
				
				//TODO:For mixed portrait/landscape it's better to use only the height setting, if widht is 0 or vice versa
				$out = '<a href="'.$image->imageURL.'" title="'.stripslashes($image->description).'" '.$thumbcode.'>';
				// Typo fix for the next updates (happend until 1.0.2)
				$options[$number]['show'] = ( $options[$number]['show'] == 'orginal' ) ? 'original' : $options[$number]['show'];
				
				if ( $options[$number]['show'] == 'original' )
					$out .= '<img src="'.NGGALLERY_URLPATH.'nggshow.php?pid='.$image->pid.'&amp;width='.$options[$number]['width'].'&amp;height='.$options[$number]['height']. '" width="'.$options[$number]['width'].'" height="'.$options[$number]['height'].'" title="'.$image->alttext.'" alt="'.$image->alttext.'" />';
				else	
					$out .= '<img src="'.$image->thumbURL.'" width="'.$options[$number]['width'].'" height="'.$options[$number]['height'].'" title="'.$image->alttext.'" alt="'.$image->alttext.'" />';			
				
				echo $out . '</a>'."\n";
				
			}
		}
		
		echo '</div>'."\n";
		echo $after_widget;
		
	}

}// end widget class
}
// let's show it
$nggWidget = new nggWidget;	

/**
 * nggSlideshowWidget($galleryID, $width, $height)
 * Function for templates without widget support
 * 
 * @param integer $galleryID 
 * @param string $width
 * @param string $height
 * @return echo the widget content
 */
function nggSlideshowWidget($galleryID, $width = '', $height = '') {

	nggSlideshowWidget::render_slideshow($galleryID, $width, $height);
	
}

/**
 * nggDisplayRandomImages($number,$width,$height,$exclude,$list,$show)
 * Function for templates without widget support
 *
 * @return echo the widget content
 */
function nggDisplayRandomImages($number, $width = '75', $height = '50', $exclude = 'all', $list = '', $show = 'thumbnail') {
	
	$options[1] = array('title'=>'', 
						'items'=>$number,
						'show'=>$show ,
						'type'=>'random',
						'width'=>$width, 
						'height'=>$height, 
						'exclude'=>$exclude,
						'list'=>$list   );
	
	nggWidget::ngg_widget_output($args = array(), 1, $options);
}

/**
 * nggDisplayRecentImages($number,$width,$height,$exclude,$list,$show)
 * Function for templates without widget support
 *
 * @return echo the widget content
 */
function nggDisplayRecentImages($number, $width = '75', $height = '50', $exclude = 'all', $list = '', $show = 'thumbnail') {

	$options[1] = array('title'=>'', 
						'items'=>$number,
						'show'=>$show ,
						'type'=>'recent',
						'width'=>$width, 
						'height'=>$height, 
						'exclude'=>$exclude,
						'list'=>$list   );
	
	nggWidget::ngg_widget_output($args = array(), 1, $options);
}

?>