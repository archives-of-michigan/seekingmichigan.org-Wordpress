<?php
$e404_all_options['e404_slider_width'] = 930;

function e404_show_slider() {
	$slider_type = e404_get_slider_type();
	if($slider_type) {
		switch ($slider_type) {
			case 'nivo':
				e404_show_nivo_slider();
                break;
			case 'accordion':
				e404_show_accordion_slider();
                break;
			case 'anything':
				e404_show_anything_slider();
                break;
			case 'showcase':
				e404_show_showcase_slider();
                break;
			case 'liteaccordion':
				e404_show_liteaccordion_slider();
                break;
		}
	}
}

function e404_get_slider_type() {
	global $e404_options, $e404_all_options;
	$slider_type = false;
	$current_template = e404_get_current_template();
	if($current_template == 'home-page-showcase.php')
		$slider_type = 'showcase';
	if($current_template == 'home-page-anything.php')
		$slider_type = 'anything';
	elseif($current_template == 'home-page-nivo.php')
		$slider_type = 'nivo';
	elseif($current_template == 'home-page-accordion.php')
		$slider_type = 'accordion';
	elseif($current_template == 'home-page-liteaccordion.php')
		$slider_type = 'liteaccordion';
	elseif($current_template == 'home-page.php') {
		$slider_type = $e404_all_options['e404_home_slider'];
	}
	return $slider_type;
}

function e404_get_slideshow() {
	$slideshow = false;
	$current_template = e404_get_current_template();
	if(substr($current_template, 0, 9) == 'home-page') {
		$slideshow = get_option('e404_home_slideshow');
	}
	return $slideshow;
}

function e404_get_slider_height() {
	$height = 300;
	$current_template = e404_get_current_template();
	if(substr($current_template, 0, 9) == 'home-page') {
		$height = get_option('e404_home_slider_height');
	}
	return $height;
}

add_action('get_header', 'e404_init_slider');
function e404_init_slider() {
	global $e404_all_options;
	$slider_type = e404_get_slider_type();
	if($slider_type) {
		switch ($slider_type) {
			case 'nivo':
				wp_enqueue_script('nivo', OF_DIRECTORY.'/js/jquery.nivo.slider.pack.js', '', '', true);
				wp_enqueue_style('nivo', OF_DIRECTORY.'/css/nivo-slider.css');
				wp_enqueue_script('nivo-init', OF_DIRECTORY.'/js/nivo_slider_init.js', '', '', true);
				break;
			case 'accordion':
				wp_enqueue_script('easing', OF_DIRECTORY.'/js/jquery.easing.js', '', '', true);
				wp_enqueue_script('kwicks', OF_DIRECTORY.'/js/jquery.kwicks.pack.js', '', '', true);
				wp_enqueue_style('accordion', OF_DIRECTORY.'/css/accordion-slider.css');
				wp_enqueue_script('accordion-init', OF_DIRECTORY.'/js/accordion_slider_init.js', '', '', true);
				break;
			case 'anything':
				wp_enqueue_script('easing', OF_DIRECTORY.'/js/jquery.easing.js', '', '', true);
				wp_enqueue_script('anything', OF_DIRECTORY.'/js/jquery.anythingslider.min.js', '', '', true);
				if($e404_all_options['e404_anything_video_extension'] == 'true')
					wp_enqueue_script('anything-video', OF_DIRECTORY.'/js/jquery.anythingslider.video.min.js', '', '', true);
				wp_enqueue_style('anything', OF_DIRECTORY.'/css/anything-slider.css');
				wp_enqueue_script('anything-init', OF_DIRECTORY.'/js/anything_slider_init.js', '', '', true);
				break;
			case 'showcase':
				wp_enqueue_script('aw-showcase', OF_DIRECTORY.'/js/jquery.aw-showcase.min.js', '', '', true);
				wp_enqueue_style('aw-showcase', OF_DIRECTORY.'/css/aw-showcase-slider.css');
				wp_enqueue_script('aw-showcase-init', OF_DIRECTORY.'/js/aw-showcase_slider_init.js', '', '', true);
				break;
			case 'liteaccordion':
				wp_enqueue_script('easing', OF_DIRECTORY.'/js/jquery.easing.js', '', '', true);
				wp_enqueue_script('liteaccordion', OF_DIRECTORY.'/js/jquery.liteaccordion.min.js', '', '', true);
				wp_enqueue_style('liteaccordion', OF_DIRECTORY.'/css/liteaccordion.css');
				wp_enqueue_script('liteaccordion-init', OF_DIRECTORY.'/js/liteaccordion_slider_init.js', '', '', true);
				break;
		}
	}
}

function e404_get_slideshow_slides() {
	global $e404_all_options;
	$slideshow = e404_get_slideshow();
	if($slideshow < 0) {
		$current_template = e404_get_current_template();
		if(substr($current_template, 0, 9) == 'home-page') {
			$numberposts = $e404_all_options['e404_home_slider_number'];
			$category = $e404_all_options['e404_home_slider_category'];
		}
		$args = array('numberposts' => 30);
		if($category && $category != 0)
			$args['cat'] = $category;
	}
	else {
		$numberposts = 99;
		$slideshow_name = get_term_by('id', $slideshow, 'e404_slideshow');
		$args = array('post_type' => 'e404_slide', 'numberposts' => 99, 'orderby' => 'menu_order date', 'suppress_filters' => 0);
		if($slideshow) {
			$args['e404_slideshow'] = $slideshow_name->slug;
		}
	}

	$slides = get_posts($args);
	$slides_final = array();
	$i = 0;
	foreach($slides as $slide) {
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($slide->ID), 'single-post-thumbnail');
		if($image)
			$slide->e404_thumbnail = $image;
		else
			$slide->e404_thumbnail = null;
		if($image || $slideshow >= 0) {
			$i++;
			$slide->post_title = get_the_title($slide->ID);
			$slides_final[] = $slide;
		}
		if($i == $numberposts)
			break;
	}

	return $slides_final;
}

function e404_get_slide_url($slide) {
	if(e404_get_slideshow() < 0)
		$url = get_permalink($slide->ID);
	else
		$url = get_post_meta($slide->ID, 'e404_slide_target_url', true);
	
	return $url;
}

function e404_show_nivo_slider() {
	global $e404_all_options;
	$slides = e404_get_slideshow_slides();
	$output = '';
	echo '<div class="slider" id="slider" style="height: '.e404_get_slider_height().'px;">';
	foreach($slides as $slide) {
		$slide_output = '';
		$image = $slide->e404_thumbnail;
		if($e404_all_options['e404_nivo_title'] == '0')
			$slide->post_title = '';
		if($image) {
			$url = e404_get_slide_url($slide);
			if(empty($url)) {
				$slide_output .= '<img src="'.e404_img_scale($image[0], $e404_all_options['e404_slider_width'], e404_get_slider_height()).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" />';
			}
			else {
				$slide_output .= '<a href="'.$url.'"><img src="'.e404_img_scale($image[0], $e404_all_options['e404_slider_width'], e404_get_slider_height()).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" /></a>';
			}
			$output .= $slide_output;
		}
	}
	echo $output."\n";
	echo '</div>';
	e404_nivo_params();
}

function e404_nivo_params() {
	global $e404_all_options;
	$nivo_js_params = "
	<script type=\"text/javascript\">
		var slideParams = []; 
		slideParams['effect'] = '".$e404_all_options['e404_nivo_effect']."'; 
		slideParams['slices'] = '".$e404_all_options['e404_nivo_slices']."'; 
		slideParams['animSpeed'] = '".$e404_all_options['e404_nivo_animspeed']."'; 
		slideParams['pauseTime'] = '".$e404_all_options['e404_nivo_pausetime']."'; 
		slideParams['directionNav'] = ".$e404_all_options['e404_nivo_directionnav']."; 
		slideParams['directionNavHide'] = 0;
		slideParams['controlNav'] = ".$e404_all_options['e404_nivo_controlnav']."; 
		slideParams['keyboardNav'] = ".$e404_all_options['e404_nivo_keyboardnav']."; 
		slideParams['pauseOnHover'] = ".$e404_all_options['e404_nivo_pauseonhover']."; 
		slideParams['manualAdvance'] = false;
		slideParams['stopAtEnd'] = ".$e404_all_options['e404_nivo_stopatend'].";
		slideParams['height'] = ".e404_get_slider_height().";
	</script>";
	echo $nivo_js_params;
}

function e404_show_accordion_slider() {
	global $e404_all_options;
	$slides = e404_get_slideshow_slides();
	$output = $class = '';
	foreach($slides as $key => $value) {
		if(!$slides[$key]->e404_thumbnail)
			unset($slides[$key]);
	}
    $slides_number = count($slides);
    $li_width = floor($e404_all_options['e404_slider_width'] / $slides_number);
    echo '<ul class="kwicks horizontal" style="height: '.e404_get_slider_height().'px;">';
    $if_title = (bool)get_option('e404_accordion_title');
    $i = 0;
	foreach($slides as $slide) {
        $i++;
		$slide_output = '';
		$image = $slide->e404_thumbnail;
		if($image) {
			$url = e404_get_slide_url($slide);
			if($i == $slides_number)
				$class = ' id="last"';
			if(empty($url)) {
				$slide_output .= '<li'.$class.'><img src="'.e404_img_scale($image[0], $e404_all_options['e404_accordion_max_width'], e404_get_slider_height()).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" />';
				if($if_title)
					$slide_output .= '<p class="title">'.$slide->post_title.'</p>';
				$slide_output .= '<div class="slide_shadow"></div></li>';
			}
			else {
				$slide_output .= '<li'.$class.'><a href="'.$url.'"><img src="'.e404_img_scale($image[0], $e404_all_options['e404_accordion_max_width'], e404_get_slider_height()).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" />';
				if($if_title)
					$slide_output .= '<p class="title">'.$slide->post_title.'</p>';
				$slide_output .= '</a><div class="slide_shadow"></div></li>';
			}
			$output .= $slide_output;
		}
	}
	echo $output."\n";
    echo '</ul>';
    e404_accordion_params($li_width);
}

function e404_accordion_params($li_width) {
	global $e404_all_options;
	$accordion_js_params = "
	<script type=\"text/javascript\">
		var slideParams = []; 
		slideParams['maxWidth'] = ".$e404_all_options['e404_accordion_max_width'].";
		slideParams['effect'] = '".$e404_all_options['e404_accordion_effect']."';
		slideParams['duration'] = ".$e404_all_options['e404_accordion_effect_duration'].";
		slideParams['height'] = ".e404_get_slider_height().";
		slideParams['liwidth'] = ".$li_width.";
	</script>";
	echo $accordion_js_params;
}

function e404_show_anything_slider() {
	global $e404_all_options;
	
	$slides = e404_get_slideshow_slides();
	$output = '';
	echo '<ul id="aslider" style="overflow: hidden; height: '.e404_get_slider_height().'px;">';
	foreach($slides as $slide) {
		$slide_output = '';
		$image = $slide->e404_thumbnail;
		if($image) {
			$url = e404_get_slide_url($slide);
			if(empty($url)) {
				$slide_output .= '<li><img src="'.e404_img_scale($image[0], $e404_all_options['e404_slider_width'], e404_get_slider_height()).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" /></li>';
			}
			else {
				$slide_output .= '<li><a href="'.$url.'"><img src="'.e404_img_scale($image[0], $e404_all_options['e404_slider_width'], e404_get_slider_height()).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" /></a></li>';
			}
		}
		else {
			$slide_output .= '<li>'.str_replace(array('<p>', '</p>'), "", apply_filters('the_content', $slide->post_content)).'</li>';
		}
		$output .= $slide_output;
	}
	echo $output."\n";
	echo '</ul>';
	e404_anything_params();
}

function e404_anything_params() {
	global $e404_all_options;

	$anything_js_params = "
	<script type=\"text/javascript\">
		var slideParams = []; 
		slideParams['height'] = ".e404_get_slider_height().";
		slideParams['effect'] = '".$e404_all_options['e404_anything_effect']."';
		slideParams['animationTime'] = ".$e404_all_options['e404_anything_animationtime'].";
		slideParams['delay'] = ".$e404_all_options['e404_anything_delay'].";
		slideParams['buildArrows'] = ".$e404_all_options['e404_anything_buildarrows'].";
		slideParams['toggleArrows'] = ".$e404_all_options['e404_anything_togglearrows'].";
		slideParams['buildNavigation'] = ".$e404_all_options['e404_anything_buildnavigation'].";
		slideParams['enableKeyboard'] = ".$e404_all_options['e404_anything_enablekeyboard'].";
		slideParams['pauseOnHover'] = ".$e404_all_options['e404_anything_pauseonhover'].";
		slideParams['stopAtEnd'] = ".$e404_all_options['e404_anything_stopatend'].";
	</script>";
	echo $anything_js_params;
}

function e404_show_showcase_slider() {
	global $e404_all_options, $e404_awkward_options;
	
	$slides = e404_get_slideshow_slides();
	$output = '';

	$slider_height = e404_get_slider_height();
	if($e404_all_options['e404_showcase_thumbnails'] == 'horizontal')
		$slider_height = $slider_height + 112;

	echo '<div id="showcase" class="showcase" style="overflow: hidden; height: '.$slider_height.'px;">';
	foreach($slides as $slide) {
		$slide_output = '<div class="showcase-slide">';
		$slide_output .= '<div class="showcase-content">';
		$meta = $e404_awkward_options->the_meta($slide->ID);
		$image = $slide->e404_thumbnail;
		if($image) {
			$url = e404_get_slide_url($slide);
			if(empty($url)) {
				$slide_output .= '<img src="'.e404_img_scale($image[0], $e404_all_options['e404_slider_width'], e404_get_slider_height()).'" alt="'.$slide->post_title.'" />';
			}
			else {
				$slide_output .= '<a href="'.$url.'"><img src="'.e404_img_scale($image[0], $e404_all_options['e404_slider_width'], e404_get_slider_height()).'" alt="'.$slide->post_title.'" /></a>';
			}
		}
		else {
			$slide_output .= str_replace(array('<p>', '</p>'), "", apply_filters('the_content', $slide->post_content));
		}
		$slide_output .= '</div>';
		if(!empty($slide->post_title) && $e404_all_options['e404_showcase_captions'] == '1' && $image) {
			$slide_output .= '<div class="showcase-caption">'.$slide->post_title.'</div>';
		}
		if($e404_all_options['e404_showcase_thumbnails'] != 'disabled') {
			if(isset($meta['thumbnail']))
				$image[0] = $meta['thumbnail'];
			$slide_output .= '<div class="showcase-thumbnail">';
			$slide_output .= '<img src="'.e404_img_scale($image[0], 120, 90).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" />';
			if($e404_all_options['e404_showcase_thumbnail_captions'] == '1') {
				$slide_output .= '<div class="showcase-thumbnail-caption">'.$slide->post_title.'</div>';
			}
			$slide_output .= '<div class="showcase-thumbnail-cover"></div></div>';
		}
		if(isset($meta['tooltips']) && is_array($meta['tooltips']) && count($meta['tooltips'] > 0)) {
			$slide_output .= '<div class="showcase-tooltips">';
			foreach($meta['tooltips'] as $tooltip) {
				if(isset($tooltip['url']) && !empty($tooltip['url']))
					$href = $tooltip['url'];
				else
					$href = "#";
				$slide_output .= '<a href="'.$href.'" coords="'.($tooltip['coords_x']).','.($tooltip['coords_y']).'">'.$tooltip['content'].'</a>';
			}
			$slide_output .= '</div>';
		}
		$slide_output .= '</div>';
		$output .= $slide_output;
	}
	echo $output."\n";
	echo '</div>';
	e404_showcase_params();
}

function e404_showcase_params() {
	global $e404_all_options;

	$slider_height = e404_get_slider_height();
	$slider_width = $e404_all_options['e404_slider_width'];
	if($e404_all_options['e404_showcase_thumbnails'] == 'disabled') {
		$thumbnails = 'false';
	}
	else {
		$thumbnails = 'true';
		if($e404_all_options['e404_showcase_thumbnails'] == 'vertical')
			$slider_width = $slider_width - 142;
	}
	$showcase_js_params = "
	<script type=\"text/javascript\">
		var slideParams = []; 
		slideParams['content_height'] = ".$slider_height.";
		slideParams['content_width'] = ".$slider_width.";
		slideParams['thumbnails'] = ".$thumbnails.";
		slideParams['thumbnails_direction'] = '".$e404_all_options['e404_showcase_thumbnails']."';
		slideParams['transition'] = '".$e404_all_options['e404_showcase_transition']."';
		slideParams['transition_speed'] = '".$e404_all_options['e404_showcase_transition_speed']."';
		slideParams['interval'] = '".$e404_all_options['e404_showcase_interval']."';
		slideParams['autostart'] = '".$e404_all_options['e404_showcase_autostart']."';
	</script>";
	echo $showcase_js_params;
}

function e404_show_liteaccordion_slider() {
	global $e404_all_options;
	
	$slides = e404_get_slideshow_slides();
	$output = '';

	$slider_height = e404_get_slider_height();

	echo '<div id="liteaccordion" style="overflow: hidden; height: '.$slider_height.'px;"><ol>';
	foreach($slides as $slide) {
		$slide_output = '<li>';
		$slide_output .= '<h2><span>'.$slide->post_title.'</span></h2>';
		$image = $slide->e404_thumbnail;
		if($image) {
			$slide_output .= '<div><img src="'.e404_img_scale($image[0], $e404_all_options['e404_slider_width'], e404_get_slider_height()).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" />';
			if($e404_all_options['e404_liteaccordion_captions'] == 1 && !empty($slide->post_content)) {
				$slide_output .= '<div class="lacaption">'.apply_filters('the_content', $slide->post_content).'</div>';
			}
			$slide_output .= '</div>';
		}
		else {
			$slide_output .= apply_filters('the_content', $slide->post_content);
		}
		$slide_output .= '</li>';
		$output .= $slide_output;
	}
	echo $output;
	echo '</ol></div>';
	e404_liteaccordion_params();
}

function e404_liteaccordion_params() {
	global $e404_all_options;

	$slider_height = e404_get_slider_height();
	$slider_width = $e404_all_options['e404_slider_width'];
	$showcase_js_params = "
	<script type=\"text/javascript\">
		var slideParams = []; 
		slideParams['containerHeight'] = ".$slider_height.";
		slideParams['containerWidth'] = ".($slider_width).";
		slideParams['headerWidth'] = ".$e404_all_options['e404_liteaccordion_header_width'].";
		slideParams['easing'] = '".$e404_all_options['e404_liteaccordion_transition']."';
		slideParams['activateOn'] = '".$e404_all_options['e404_liteaccordion_activateon']."';
		slideParams['firstSlide'] = ".$e404_all_options['e404_liteaccordion_firstslide'].";
		slideParams['slideSpeed'] = ".$e404_all_options['e404_liteaccordion_slidespeed'].";
		slideParams['cycleSpeed'] = ".$e404_all_options['e404_liteaccordion_cyclespeed'].";
		slideParams['autoPlay'] = ".$e404_all_options['e404_liteaccordion_autostart'].";
		slideParams['pauseOnHover'] = ".$e404_all_options['e404_liteaccordion_pauseonhover'].";
		slideParams['enumerateSlides'] = ".$e404_all_options['e404_liteaccordion_enumerateslides'].";
	</script>";
	echo $showcase_js_params;
}

?>