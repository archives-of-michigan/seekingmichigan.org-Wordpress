<?php
$icons = array('', 'agenda', 'arrow-down', 'arrow-left-down', 'arrow-left-up', 'arrow-left', 'arrow-right-down', 'arrow-right-up', 'arrow-right', 'arrow-up', 'badge', 'bag', 'bass-speaker', 'battery-1', 'battery-2', 'battery-3', 'battery-4', 'beer-mug', 'binoculars', 'book', 'bookmark', 'bug', 'bulb', 'buoy', 'calculator', 'calendar', 'car', 'cart', 'cassette', 'cd-dvd', 'champion-cup', 'chip', 'clip', 'clipboard', 'clock', 'closed-lock', 'cloud', 'cocktail', 'coffee-cup', 'coffee-mug', 'collapse', 'comment', 'credit-card', 'cronometer', 'document', 'drop', 'empty-clipboard', 'envelope', 'expand', 'eye', 'facebook', 'first-aid-kit', 'flag', 'floppy-disc', 'flower', 'folder', 'game-boy', 'gas', 'gear', 'gift', 'glass', 'globe-1', 'globe-2', 'hard-disk', 'headphones', 'heart', 'id', 'industry', 'info', 'iphone', 'ipod', 'joystick', 'key', 'keyboard', 'lab', 'laptop', 'leaf', 'lollipop', 'magnifying-glass', 'man-user', 'memory-card', 'microphone', 'mobile-phone', 'monitor', 'moon', 'mouse', 'movie-film', 'music-note', 'network-socket', 'news', 'opened-envelope', 'opened-lock', 'pen', 'pencil', 'phone-1', 'phone-2', 'photography-camera', 'photography-film', 'photography', 'planet', 'plug', 'podcast', 'pointing-down', 'pointing-left', 'pointing-right', 'pointing-up', 'print', 'projector', 'pushpin-1', 'pushpin-2', 'puzzle', 'quote', 'radio', 'refresh', 'restaurant', 'router', 'rss', 'satelite', 'scissors', 'server', 'share', 'shield', 'sign-post', 'skull', 'snow-flake', 'speaker', 'star', 'suitcase', 'sun', 'surveillance-camera', 'tag', 'thumbs-down', 'thumbs-up', 'thunder', 'tools', 'traffic-cone', 'trash', 'tree', 'truck', 'tv', 'twitter-bird', 'twitter', 'umbrella', 'usb', 'user', 'video-camera', 'virus', 'wall-socket-1', 'wall-socket-2', 'wallet', 'webcam', 'window', 'woman-user', 'zoom-in', 'zoom-out');

// [full_page] block shortcode
function e404_full_page_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="full_page'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('full_page', 'e404_full_page_shortcode');

// [one_half] block shortcodes
function e404_one_half_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_half'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'e404_one_half_shortcode');

function e404_one_half_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_half last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />'."\n";
}
add_shortcode('one_half_last', 'e404_one_half_last_shortcode');

// [one_third] block shortcodes
function e404_one_third_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_third'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'e404_one_third_shortcode');

function e404_one_third_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_third last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('one_third_last', 'e404_one_third_last_shortcode');

// [two_third] block shortcodes
function e404_two_third_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="two_third'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'e404_two_third_shortcode');

function e404_two_third_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="two_third last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('two_third_last', 'e404_two_third_last_shortcode');

// [one_fourth] block shortcodes
function e404_one_fourth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_fourth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'e404_one_fourth_shortcode');

function e404_one_fourth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_fourth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('one_fourth_last', 'e404_one_fourth_last_shortcode');

// [three_fourth] block shortcodes
function e404_three_fourth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="three_fourth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'e404_three_fourth_shortcode');

function e404_three_fourth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="three_fourth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('three_fourth_last', 'e404_three_fourth_last_shortcode');

// [one_fifth] block shortcodes
function e404_one_fifth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_fifth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fifth', 'e404_one_fifth_shortcode');

function e404_one_fifth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_fifth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('one_fifth_last', 'e404_one_fifth_last_shortcode');

// [two_fifth] block shortcodes
function e404_two_fifth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="two_fifth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('two_fifth', 'e404_two_fifth_shortcode');

function e404_two_fifth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="two_fifth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('two_fifth_last', 'e404_two_fifth_last_shortcode');

// [three_fifth] block shortcodes
function e404_three_fifth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="three_fifth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fifth', 'e404_three_fifth_shortcode');

function e404_three_fifth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="three_fifth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('three_fifth_last', 'e404_three_fifth_last_shortcode');

// [four_fifth] block shortcodes
function e404_four_fifth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="four_fifth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('four_fifth', 'e404_four_fifth_shortcode');

function e404_four_fifth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="four_fifth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('four_fifth_last', 'e404_four_fifth_last_shortcode');

// [one_sixth] block shortcodes
function e404_one_sixth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_sixth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('one_sixth', 'e404_one_sixth_shortcode');

function e404_one_sixth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_sixth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('one_sixth_last', 'e404_one_sixth_last_shortcode');

// [five_sixth] block shortcodes
function e404_five_sixth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="five_sixth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('five_sixth', 'e404_five_sixth_shortcode');

function e404_five_sixth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="five_sixth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('five_sixth_last', 'e404_five_sixth_last_shortcode');

// [one_eighth] block shortcodes
function e404_one_eighth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_eighth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('one_eighth', 'e404_one_eighth_shortcode');

function e404_one_eighth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="one_eighth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('one_eighth_last', 'e404_one_eighth_last_shortcode');

// [three_eighth] block shortcodes
function e404_three_eighth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="three_eighth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('three_eighth', 'e404_three_eighth_shortcode');

function e404_three_eighth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="three_eighth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('three_eighth_last', 'e404_three_eighth_last_shortcode');

// [five_eighth] block shortcodes
function e404_five_eighth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="five_eighth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('five_eighth', 'e404_five_eighth_shortcode');

function e404_five_eighth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="five_eighth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('five_eighth_last', 'e404_five_eighth_last_shortcode');

// [seven_eighth] block shortcodes
function e404_seven_eighth_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="seven_eighth'.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode('seven_eighth', 'e404_seven_eighth_shortcode');

function e404_seven_eighth_last_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	if(!empty($align))
		$align = ' '.$align;
	return '<div class="seven_eighth last'.$align.'">'.do_shortcode($content).'</div><br class="clear" />';
}
add_shortcode('seven_eighth_last', 'e404_seven_eighth_last_shortcode');

// [blockquote] shortcode
function e404_blockquote_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => '', 'author' => ''), $atts));

	$aligns = array('center', 'right', 'left', 'none');
	if(empty($align) || !in_array($align, $aligns))
		$align = "center";
		
	$before = '<blockquote class="bq-'.$align.'">';
	$after = '</blockquote>';
	if(!empty($author))
		$after = '<cite>'.$author.'</cite>'.$after;
	
	return $before.do_shortcode('<span>'.$content.'</span>').$after;
}
add_shortcode('blockquote', 'e404_blockquote_shortcode');

// [code] shortcode
function e404_code_shortcode($atts, $content = null) {
	return '[raw]<code>'.nl2br($content).'</code>[/raw]';
}
add_shortcode('code', 'e404_code_shortcode');

// [highlight1] shortcode
function e404_highlight1_shortcode($atts, $content = null) {
	return '<span class="highlight1">'.do_shortcode($content).'</span>';
}
add_shortcode('highlight1', 'e404_highlight1_shortcode');

// [highlight2] shortcode
function e404_highlight2_shortcode($atts, $content = null) {
	return '<span class="highlight2">'.do_shortcode($content).'</span>';
}
add_shortcode('highlight2', 'e404_highlight2_shortcode');

// [slogan] shortcode
function e404_slogan_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => '', 'border' => ''), $atts));
	if(empty($align) || !in_array($align, array('center', 'left', 'right')))
		$align = '';
	else
		$align = ' '.trim($align);
	$output = $border_class = '';
	$border_top = $border_bottom = false;

	if($border == 'top') {
		$border_top = true;
		$border_bottom = false;
		$border_class = ' border-top';
	}
	elseif($border == 'bottom') {
		$border_top = false;
		$border_bottom = true;
		$border_class = ' border-bottom';
	}
	elseif($border == 'both') {
		$border_top = true;
		$border_bottom = true;
		$border_class = ' border-both';
	}
	$output .= '<div class="slogan'.$align.$border_class.'">';
	if($border_top)	
		$output .= '<hr class="divider divider-btop" />';
	$output .= $content;
	if($border_bottom)	
		$output .= '<hr class="divider divider-bbottom" />';
	$output .= '</div>';

	return do_shortcode($output);
}
add_shortcode('slogan', 'e404_slogan_shortcode');

// [tip] shortcode
function e404_tip_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => ''), $atts));
	if(empty($title))
		return do_shortcode($content);
	return '<span class="tiptip" title="'.$title.'">'.do_shortcode($content).'</span>';
}
add_shortcode('tip', 'e404_tip_shortcode');

// [icon_button] shortcode
function e404_icon_button_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('icon' => '', 'url' => '', 'title' => '', 'caption' => '', 'color' => '', 'transparent' => ''), $atts));

	global $e404_default_icons, $e404_default_transparency;
	$stylesheet = str_replace('.css', '', $GLOBALS['stylesheet']);

	if(!in_array($color, array('black', 'white'))) {
		if(isset($e404_default_icons[$stylesheet]))
			$color = $e404_default_icons[$stylesheet];
		if(empty($color))
			$color = 'black';
	}
	if($transparent == 'true' || $transparent == '1')
		$transparent = ' transparent';
	else {
		if(isset($e404_default_transparency[$stylesheet])) {
			if($e404_default_transparency[$stylesheet] == 'true')
				$transparent = ' transparent';
			else
				$transparent = '';
		}
	}
	$output = '';
	$output .= '<div class="icon-button">';
	if(!empty($icon)) {
		if(empty($url))
			$output .= '<img src="'.OF_DIRECTORY.'/images/icons/'.$color.'/'.$icon.'.png" class="icon'.$transparent.'" alt="'.$title.'" />';
		else
			$output .= '<a href="'.$url.'"><img src="'.OF_DIRECTORY.'/images/icons/'.$color.'/'.$icon.'.png" class="icon'.$transparent.'" alt="'.$title.'" /></a>';
	}
	if(empty($url))
		$output .= '<strong>'.$title.'</strong>';
	else
		$output .= '<a href="'.$url.'">'.$title.'</a>';
	if(!empty($caption))
		$output .= '<span>'.$caption.'</span>';
	$output .= '</div>';

	return $output;
}
add_shortcode('icon_button', 'e404_icon_button_shortcode');

// [icon_box] shortcode
function e404_icon_box_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('icon' => '', 'url' => '', 'title' => '', 'caption' => '', 'more_text' => '', 'size' => '', 'color' => '', 'transparent' => ''), $atts));
	
	global $e404_default_icons, $e404_default_transparency;
	$stylesheet = str_replace('.css', '', $GLOBALS['stylesheet']);

	if(!in_array($color, array('black', 'white'))) {
		if(isset($e404_default_icons[$stylesheet]))
			$color = $e404_default_icons[$stylesheet];
		if(empty($color))
			$color = 'black';
	}
	if(!in_array($size, array('big', 'medium', 'small')))
		$size = 'big';
	$size = 'icon-'.$size;
	if($transparent == 'true' || $transparent == '1')
		$transparent = ' transparent';
	else {
		if(isset($e404_default_transparency[$stylesheet])) {
			if($e404_default_transparency[$stylesheet] == 'true')
				$transparent = ' transparent';
			else
				$transparent = '';
		}
	}
	$output = '';
	$output .= '<h2 class="icon-box '.$size.'">';
	if(!empty($icon))
		$output .= '<img src="'.OF_DIRECTORY.'/images/icons/'.$color.'/'.$icon.'.png" class="icon'.$transparent.'" alt="'.$title.'" />';
	if(empty($url))
		$output .= $title;
	else
		$output .= '<a href="'.$url.'">'.$title.'</a>';
	if(!empty($caption))
		$output .= '<span>'.$caption.'</span>';
	$output .= '</h2>';
	
	if(trim($content) != '')
		$output .= '<p>'.do_shortcode($content).'</p>';
	if(!empty($url) && !empty($more_text)) {
		$output .= '<p class="more"><span><a href="'.$url.'">'.$more_text.'</a></span></p>';
	}

	return $output;
}
add_shortcode('icon_box', 'e404_icon_box_shortcode');

// [testimonial] shortcode
function e404_testimonial_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('image' => '', 'url' => '', 'name' => '', 'info' => ''), $atts));
	
	$output = '';
	$output .= '<div class="testimonial-box light-box"><div class="border-img leftside avatar-box">';
	if(!empty($image))
		$output .= '<img width="90" height="90" src="'.$image.'" alt="'.$name.'" />';
	else
		$output .= '<img width="90" height="90" src="'.OF_DIRECTORY.'/images/avatar.png" alt="'.$name.'" />';
	$output .= '</div><div class="comment-text">';
	if(!empty($url))
		$output .= '<cite class="comment-author"><a href="'.$url.'">'.$name.'</a></cite>';
	else
		$output .= '<cite class="comment-author"><span>'.$name.'</span></cite>';
	if(!empty($info))
		$output .= '<span class="comment-info">'.$info.'</span>';
	
	if(trim($content) != '')
		$output .= '<p>"'.do_shortcode($content).'"</p>';
	$output .= '</div></div>';

	return $output;
}
add_shortcode('testimonial', 'e404_testimonial_shortcode');

// [person] shortcode
function e404_person_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('image' => '', 'url' => '', 'name' => '', 'info' => '', 'twitter' => '', 'facebook' => '', 'linkedin' => ''), $atts));
	
	$output = '';
	$output .= '<div class="person-box light-box"><div class="border-img leftside avatar-box">';
	if(!empty($image))
		$output .= '<img width="90" height="90" src="'.$image.'" alt="'.$name.'" />';
	else
		$output .= '<img width="90" height="90" src="'.OF_DIRECTORY.'/images/avatar.png" alt="'.$name.'" />';
	$output .= '</div><div class="person-text">';
	if(!empty($url))
		$output .= '<cite class="person-name"><a href="'.$url.'">'.$name.'</a></cite>';
	else
		$output .= '<cite class="person-name"><span>'.$name.'</span></cite>';
	if(!empty($info))
		$output .= '<span class="person-info">'.$info.'</span>';
	
	if(trim($content) != '')
		$output .= '<p>'.do_shortcode($content).'</p>';
	if(!(empty($twitter) && empty($facebook) && empty($linkedin))) {
		$output .= '<ul class="person-social">';
		if(!empty($twitter))
			$output .= '<li><a href="http://twitter.com/'.$twitter.'" class="person-twitter tiptip" title="Twitter">Twitter</a></li>';
		if(!empty($facebook))
			$output .= '<li><a href="'.$facebook.'" class="person-facebook tiptip" title="Facebook">Facebook</a></li>';
		if(!empty($linkedin))
			$output .= '<li><a href="http://www.linkedin.com/in/'.$linkedin.'" class="person-linkedin tiptip" title="LinkedIn">LinkedIn</a></li>';
		$output .= '</ul>';
	}
	$output .= '</div></div>';

	return $output;
}
add_shortcode('person', 'e404_person_shortcode');

// [line_dotted] shortcode
function e404_line_dotted_shortcode() {
	return '<hr class="divider-dotted" />';
}
add_shortcode('line_dotted', 'e404_line_dotted_shortcode');

// [line_top] shortcode
function e404_line_top_shortcode() {
	return '<div class="divider-top"><a href="#">Top</a></div>';
}
add_shortcode('line_top', 'e404_line_top_shortcode');

// [line] shortcode
function e404_line_shortcode() {
	return '<hr class="divider-full" />';
}
add_shortcode('line', 'e404_line_shortcode');

// [clear] shortcode
function e404_clear_shortcode() {
	return '<br class="clear" />';
}
add_shortcode('clear', 'e404_clear_shortcode');

// [h1], [h2], [h3], [h4], [h5], [h6] shortcodes
function e404_h1_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('color' => '', 'nomargin' => '', 'fancy' => ''), $atts));
	if($nomargin == 'true' || $nomargin == '1' || $fancy == 'true' || $fancy == '1') {
		$class = ' class="';
		if($nomargin == 'true' || $nomargin == '1')
			$class .= 'nomargin ';
		if($fancy == 'true' || $fancy == '1')
			$class .= 'fancy-header';
		$class .= '"';
	}
	else {
		$class = '';
	}
	return '<h1'.$class.e404_custom_colors_style('', $color).'>'.do_shortcode($content).'</h1>';
}
function e404_h2_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('color' => '', 'nomargin' => '', 'fancy' => ''), $atts));
	if($nomargin == 'true' || $nomargin == '1' || $fancy == 'true' || $fancy == '1') {
		$class = ' class="';
		if($nomargin == 'true' || $nomargin == '1')
			$class .= 'nomargin ';
		if($fancy == 'true' || $fancy == '1')
			$class .= 'fancy-header';
		$class .= '"';
	}
	else {
		$class = '';
	}
	return '<h2'.$class.e404_custom_colors_style('', $color).'>'.do_shortcode($content).'</h2>';
}
function e404_h3_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('color' => '', 'nomargin' => '', 'fancy' => ''), $atts));
	if($nomargin == 'true' || $nomargin == '1' || $fancy == 'true' || $fancy == '1') {
		$class = ' class="';
		if($nomargin == 'true' || $nomargin == '1')
			$class .= 'nomargin ';
		if($fancy == 'true' || $fancy == '1')
			$class .= 'fancy-header';
		$class .= '"';
	}
	else {
		$class = '';
	}
	return '<h3'.$class.e404_custom_colors_style('', $color).'>'.do_shortcode($content).'</h3>';
}
function e404_h4_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('color' => '', 'nomargin' => '', 'fancy' => ''), $atts));
	if($nomargin == 'true' || $nomargin == '1' || $fancy == 'true' || $fancy == '1') {
		$class = ' class="';
		if($nomargin == 'true' || $nomargin == '1')
			$class .= 'nomargin ';
		if($fancy == 'true' || $fancy == '1')
			$class .= 'fancy-header';
		$class .= '"';
	}
	else {
		$class = '';
	}
	return '<h4'.$class.e404_custom_colors_style('', $color).'>'.do_shortcode($content).'</h4>';
}
function e404_h5_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('color' => '', 'nomargin' => '', 'fancy' => ''), $atts));
	if($nomargin == 'true' || $nomargin == '1' || $fancy == 'true' || $fancy == '1') {
		$class = ' class="';
		if($nomargin == 'true' || $nomargin == '1')
			$class .= 'nomargin ';
		if($fancy == 'true' || $fancy == '1')
			$class .= 'fancy-header';
		$class .= '"';
	}
	else {
		$class = '';
	}
	return '<h5'.$class.e404_custom_colors_style('', $color).'>'.do_shortcode($content).'</h5>';
}
function e404_h6_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('color' => '', 'nomargin' => '', 'fancy' => ''), $atts));
	if($nomargin == 'true' || $nomargin == '1' || $fancy == 'true' || $fancy == '1') {
		$class = ' class="';
		if($nomargin == 'true' || $nomargin == '1')
			$class .= 'nomargin ';
		if($fancy == 'true' || $fancy == '1')
			$class .= 'fancy-header';
		$class .= '"';
	}
	else {
		$class = '';
	}
	return '<h6'.$class.e404_custom_colors_style('', $color).'>'.do_shortcode($content).'</h6>';
}
add_shortcode('h1', 'e404_h1_shortcode');
add_shortcode('h2', 'e404_h2_shortcode');
add_shortcode('h3', 'e404_h3_shortcode');
add_shortcode('h4', 'e404_h4_shortcode');
add_shortcode('h5', 'e404_h5_shortcode');
add_shortcode('h6', 'e404_h6_shortcode');

function e404_b_shortcode($atts, $content = null) {
	return '<strong>'.do_shortcode($content).'</strong>';
}
add_shortcode('b', 'e404_b_shortcode');

function e404_i_shortcode($atts, $content = null) {
	return '<em>'.do_shortcode($content).'</em>';
}
add_shortcode('i', 'e404_i_shortcode');

// [dropcap] shortcode
function e404_dropcap_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('style' => '', 'color' => ''), $atts));
	$styles = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');
	if(empty($style) || !in_array($style, $styles))
		$style = '1';
	
	$before = '<span class="dropcap'.$style.'"'.e404_custom_colors_style('', $color).'>';
	$after = '</span>';

	return $before.do_shortcode($content).$after;
}
add_shortcode('dropcap', 'e404_dropcap_shortcode');

// [button] shortcode
function e404_button_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('style' => '', 'color' => '', 'size' => '', 'width' => '', 'bgcolor' => '', 'textcolor' => '', 'bordercolor' => '', 'href' => '', 'stroke' => '', 'icon' => '', 'target' => ''), $atts));
	$sizes = array('small', 'medium', 'big');
	if(empty($size) || !in_array($size, $sizes))
		$size = 'small';
	$styles = array('normal', 'light', 'glass', 'gradient');
	if(!empty($style) && !in_array($style, $styles))
		$style = '';
	$colors = array('', 'darkgray', 'black', 'red', 'orange', 'brown', 'darkcoffee', 'lemon', 'pear', 'grass', 'turquoise', 'aquamarine', 'ice', 'denim', 'indigo', 'violet', 'fuschia', 'carnationpink', 'frenchrose');
	if(is_numeric($color))
		$color = $colors[(int)$color];
	if(!empty($color) && !in_array($color, $colors))
		$color = '';
	if(!empty($width))
		if(ctype_digit($width))
			$width = ' style="width: '.$width.'px;"';
		else
			$width = ' style="width: '.$width.';"';

	$class_a = $size.'-btn';
	if(!empty($style))
		$class_a .= ' '.$style.'-btn';
	if(!empty($stroke))
		$class_a .= ' stroke-btn';
	if(empty($color))
		$class_span = '';
	else
		$class_span = ' class="'.$color.'-btn"';
		
	if(!empty($target))
		$target = ' target="'.$target.'"';

	$before = '[raw]<a class="'.$class_a.'"'.$target.' href="'.$href.'"><span'.$width.$class_span.e404_custom_colors_style($bgcolor, $textcolor, $bordercolor).'>';
	if(!empty($icon))
		$before .= '<img src="'.OF_DIRECTORY.'/images/bullets/'.$icon.'.png" alt="" /> ';

	$after = '</span></a>[/raw]';

	return do_shortcode($before.$content.$after);
}
add_shortcode('button', 'e404_button_shortcode');

// icons
$icon_types_normal = array('access-denied', 'alert', 'alert2', 'info', 'arrow-right', 'arrow-left', 'arrow-down', 'arrow-up', 'arrow', 'arrow2', 'checkmark', 'glass', 'plus', 'minus', 'user', 'help', 'bubble', 'bubbles', 'tag', 'download', 'calendar', 'clock', 'chart', 'cog', 'cd', 'document', 'folder', 'home', 'film', 'image', 'sound', 'link', 'key', 'locked', 'paperclip', 'marker', 'mail', 'rss', 'access-denied-light', 'alert-light', 'alert2-light', 'info-light', 'arrow-right-light', 'arrow-left-light', 'arrow-down-light', 'arrow-up-light', 'arrow-light', 'arrow2-light', 'checkmark-light', 'glass-light', 'plus-light', 'minus-light', 'user-light', 'help-light', 'bubble-light', 'bubbles-light', 'tag-light', 'download-light', 'calendar-light', 'clock-light', 'chart-light', 'cog-light', 'cd-light', 'document-light', 'folder-light', 'home-light', 'film-light', 'image-light', 'sound-light', 'link-light', 'key-light', 'locked-light', 'paperclip-light', 'marker-light', 'mail-light', 'rss-light');
$icon_types_small = array('small-arrow', 'small-checkmark', 'small-plus', 'small-minus', 'small-dot', 'small-star', 'small-arrow-left', 'small-arrow-right', 'small-add', 'small-go', 'small-toggle-plus', 'small-toggle-minus');
$icon_types = array_merge($icon_types_normal, $icon_types_small);

// [list] shortcode
function e404_list_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('type' => ''), $atts));
	if(empty($type))
		$type = 'arrow';
	if(substr($type, 0, 6) == 'small-') {
		$class = 'small-list';
	}
	else {
		$class = 'img-list';
		$type = 'ico-'.$type;
	}
	
	return '<ul class="'.$class.' '.$type.'">'.do_shortcode($content).'</ul>';
}
add_shortcode('list', 'e404_list_shortcode');

// [span] shortcode
function e404_span_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('type' => ''), $atts));
	if(empty($type))
		$type = 'arrow';
	if(substr($type, 0, 6) == 'small-') {
		$class = 'small-list';
	}
	else {
		$class = 'img-list';
		$type = 'ico-'.$type;
	}
	
	return '<span class="img-box '.$type.'">'.do_shortcode($content).'</span>';
}
add_shortcode('span', 'e404_span_shortcode');

// [link] shortcode
function e404_link_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('type' => '', 'href' => '', 'target' => ''), $atts));
	if(empty($type))
		$type = 'arrow';
	if(substr($type, 0, 6) == 'small-') {
		$class = 'small-list';
	}
	else {
		$class = 'img-list';
		$type = 'ico-'.$type;
	}
	
	if(!empty($target))
		$target = ' target="'.$target.'"';

	return '<a href="'.$href.'"'.$target.' class="img-box '.$type.'">'.do_shortcode($content).'</a>';
}
add_shortcode('link', 'e404_link_shortcode');

// [li] shortcode
function e404_li_shortcode($atts, $content = null) {
	return '<li>'.do_shortcode($content).'</li>';
}
add_shortcode('li', 'e404_li_shortcode');

// [message] shortcode
function e404_message_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('type' => ''), $atts));
	$types = array('info', 'tip', 'note', 'error');
	if(empty($type) || !in_array($type, $types))
		$type = 'info';
	
	return '<div class="message msg-'.$type.'">'.do_shortcode($content).'</div>';
}
add_shortcode('message', 'e404_message_shortcode');

// [image] shortcode
function e404_image_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('raw' => 'true', 'align' => '', 'size' => '', 'title' => '', 'lightbox' => '', 'group' => '', 'width' => '', 'height' => '', 'border' => '', 'href' => '', 'caption' => '', 'shadow' => ''), $atts));
	$image_size = array('vtiny' => 78, 'tiny' => 118, 'vsmall' => 150, 'small' => 198, 'medium' => 278, 'large' => 438, 'huge' => 598, 'full' => 918, 'blog-full' => 538);

	if(trim($content) == '')
		return;

	if(!empty($size)) {
		$nsize = $image_size[$size];
		if($nsize == 0 || !$nsize)
			$shadow = 'false';
	}

	$image_width = $image_height = 0;
	$before = $after = $output = $rel = $image_title = $image_caption = '';
	if(empty($align))
		$align = false;
	elseif($align == 'none')
		$align = false;

	if($shadow == 'true') {
		if($align == 'left' || $align == 'right' || $align == 'center')
			$shadow_align = ' align'.$align.' shadow_'.$align;
		else
			$shadow_align = '';
		$before = '<div class="shadow shadow_'.$size.$shadow_align.'">';
		$align = false;
	}

	if($lightbox == 'true' || $lightbox == '1') {
		if(empty($group))
			$rel = ' rel="prettyPhoto"';
		else
			$rel = ' rel="prettyPhoto['.$group.']"';
		$zoom = "zoom";
		if($align && $align != 'center')
			$zoom .= ' ' .$align.'side';
		if(!empty($caption))
			$image_caption = ' title="'.$caption.'"';
		else
			$image_caption = ' title=""';
		$before .= '<a href="'.$content.'" class="'.$zoom.'"'.$rel.$image_caption.'>';
		$after = '</a>';
	}
	elseif(!empty($href)) {
		$before .= '<a href="'.$href.'">';
		$after = '</a>';
	}
		
	if($shadow == 'true')
		$after .= '</div>';
	
	if(!empty($size))
		$image_width = $image_size[$size];
	else {
		if(!empty($width))
			$image_width = $width;
	}
	if(!empty($height))
		$image_height = $height;
	$image_title = ' alt="'.$title.'"';
	if(!empty($title)) {
		if(!($lightbox == 'true' || $lightbox == '1'))
			$image_title .= ' title="'.$title.'"';
	}
	if($border == 'true' || $border == '1') {
		$image_class = 'border-img';
	}
	else {
		$image_class = 'img';
		$image_width = $image_width + 12;
		if($image_height > 0)
			$image_height = $image_height + 12;
	}
	if($align)
		$image_class .= ' align'.$align;

	$output = $before.'<img src="'.e404_img_scale($content, $image_width, $image_height).'"'.$image_title.' class="'.$image_class.'" />'.$after;

	return $output;
}
add_shortcode('image', 'e404_image_shortcode');

// [lightbox] shortcode
function e404_lightbox_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => '', 'group' => '', 'width' => '', 'height' => '', 'href' => '', 'iframe' => ''), $atts));

	if(trim($content) == '')
		return;
	$a_title = '';
	
	if(empty($group))
		$rel = ' rel="prettyPhoto"';
	else
		$rel = ' rel="prettyPhoto['.$group.']"';
	if(!empty($href) && ($iframe == 'true' || $iframe == '1')) {
		$href .= '?iframe=true';
		if((int)$width)
			$href .= '&amp;width='.(int)$width;
		if((int)$height)
			$href .= '&amp;height='.(int)$height;
	}
	if(!empty($title))
		$a_title = ' title="'.$title.'"';
	$before = '<a href="'.$href.'"'.$rel.$a_title.'>';
	$after = '</a>';

	return "\n".$before.do_shortcode($content).$after."\n";
}
add_shortcode('lightbox', 'e404_lightbox_shortcode');

// [accordions] shortcode
function e404_accordions_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('style' => ''), $atts));

	$styles = array('dark' => '1', 'medium' => '2', 'light' => '3');
	$style = e404_get_style_number($style, $styles);

	$before = '<div class="accordion accordion'.$style.'">';
	$after = '</div>';
	
	return ($before).do_shortcode($content).$after;
}

function e404_accordion_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => '', 'bgcolor' => '', 'color' => '', 'bordercolor' => '', 'header_bgcolor' => '', 'header_color' => '', 'header_bordercolor' => ''), $atts));
	
	$before = '<h4 class="accordion_title"'.e404_custom_colors_style($header_bgcolor, $header_color, $header_bordercolor).'>';
	$before .= '<span'.e404_custom_colors_style('', $header_color, '').'>'.$title.'</span></h4>';
	$before .= '<div class="accordion_content light-box"'.e404_custom_colors_style($bgcolor, $color, '', true).'><p>';
	$after = '</p></div>';
	
	return $before.do_shortcode($content).$after;
}
add_shortcode('accordions', 'e404_accordions_shortcode');
add_shortcode('accordion', 'e404_accordion_shortcode');

// [toggle] shortcode
function e404_toggle_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => '', 'bgcolor' => '', 'color' => '', 'header_bgcolor' => '', 'header_color' => '', 'header_bordercolor' => '', 'style' => ''), $atts));

	$styles = array('dark' => '1', 'medium' => '2', 'light' => '3');
	$style = e404_get_style_number($style, $styles);

	$before = '<div class="toggle toggle'.$style.'">';
	$before .= '<h4 class="toggle_title"'.e404_custom_colors_style($header_bgcolor, $header_color, $header_bordercolor).'>';
	$before .= '<span'.e404_custom_colors_style('', $header_color, '').'>'.$title.'</span></h4>';
	$before .= '<div class="toggle_content light-box"'.e404_custom_colors_style($bgcolor, $color, '', true).'><p>';
	$after = '</p></div></div>';
	
	return $before.do_shortcode($content).$after;
}
add_shortcode('toggle', 'e404_toggle_shortcode');

// [box] shortcode
function e404_box_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('big' => '', 'title' => '', 'bgcolor' => '', 'color' => '', 'header_bgcolor' => '', 'header_color' => '', 'header_bordercolor' => '', 'style' => '', 'rounded' => ''), $atts));

	$styles = array('dark' => '3', 'medium' => '2', 'light' => '1');
	$style = e404_get_style_number($style, $styles);
	if($big == 'true' || $big == '1')
		$style .= ' big_text';
	if($rounded == 'true' || $rounded == '1')
		$style .= ' rounded';
		
	$before = '<div class="info_box info_box'.$style.'"'.e404_custom_colors_style($bgcolor, $color).'>';
	if(!empty($title))
		$before .= '<div class="title_box"'.e404_custom_colors_style($header_bgcolor, $header_color, $header_bordercolor).'>'.$title.'</div>';
	$before .= '<div class="content_box"><p>';
	$after = '</p></div></div>';
	
	return $before.do_shortcode($content).$after;
}
add_shortcode('box', 'e404_box_shortcode');

// [tabs] shortcode
function e404_tabs_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('tabs' => ''), $atts));
	
	$tabs = explode(',', $tabs);
	$tab_number = 0;
	$output = '<ul class="tabs group">';
	foreach($tabs as $tab) {
		$tab_number++;
		if($tab_number == 1) {
			$output .= '<li class="current">';
		}
		else {
			$output .= '<li>';
		}
		$output .= '<a href="#" class="tab">'.trim($tab).'</a></li>';
	}
	$output .= '</ul>';
	
	return $output.do_shortcode($content);
}

function e404_tab_shortcode($atts, $content = null) {
	return '<div class="tab_content light-box" style="position: absolute; left: -10000px;"><p>'.do_shortcode($content).'</p></div>';
}
add_shortcode('tabs', 'e404_tabs_shortcode');
add_shortcode('tab', 'e404_tab_shortcode');

// [table] shortcodes
function e404_table_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('style' => '', 'align' => '', 'width' => '', 'highlight' => '', 'border' => ''), $atts));
		
	$styles = array('light', 'medium', 'dark');
	if(empty($style) || !in_array($style, $styles))
		$style = 'light';
	$tclass = 'tables';
	if(!empty($style))
		$tclass .= ' table-'.$style;
	if($highlight == 'true' or $highlight == '1')
		$tclass .= ' highlight-row';
	$tstyle = (empty($width)) ? '' : ' style="width: '.(int)$width.'px"';
	$talign = (empty($align)) ? '' : ' align="'.$align.'"';
		
	if($border == 'true')
		$before = '<div class="table-border">';
	else
		$before = '';
	
	$before .= '<table class="'.$tclass.'"'.$tstyle.$talign.'>';
	$after = '</table>';
		
	if($border == 'true')
		$after .= '</div>';
	
	return $before.do_shortcode($content).$after;
}

function e404_table_header_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	$talign = (empty($align)) ? '' : ' class="th-'.$align.'"';
	
	$before = '<thead'.$talign.'>';
	$after = '</thead>';
	
	return $before.do_shortcode($content).$after;
}

function e404_table_body_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	$talign = (empty($align)) ? '' : ' class="td-'.$align.'"';
	
	$before = '<tbody'.$talign.'>';
	$after = '</tbody>';
	
	return $before.do_shortcode($content).$after;
}

function e404_table_th_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	$talign = (empty($align)) ? '' : ' class="'.$align.'"';
	
	$before = '<th'.$talign.'>';
	$after = '</th>';
	
	return $before.do_shortcode($content).$after;
}

function e404_table_tr_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	$talign = (empty($align)) ? '' : ' class="'.$align.'"';
	
	$before = '<tr'.$talign.'>';
	$after = '</tr>';
	
	return $before.do_shortcode($content).$after;
}

function e404_table_td_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('align' => ''), $atts));
	$talign = (empty($align)) ? '' : ' class="'.$align.'"';
	
	$before = '<td'.$talign.'>';
	$after = '</td>';
	
	return $before.do_shortcode($content).$after;
}
add_shortcode('table', 'e404_table_shortcode');
add_shortcode('thead', 'e404_table_header_shortcode');
add_shortcode('tbody', 'e404_table_body_shortcode');
add_shortcode('tr', 'e404_table_tr_shortcode');
add_shortcode('td', 'e404_table_td_shortcode');
add_shortcode('th', 'e404_table_th_shortcode');

// [pricebox] shortcodes
function e404_pricebox_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => '', 'featured' => ''), $atts));
	if($featured == 'true' || $featured == '1')
		$featured = ' featured-box';
	
	$before = '<div class="pricebox'.$featured.' light-box"><h3>'.$title.'</h3>';
	$after = '</div>';

	return $before.do_shortcode($content).$after;
}

function e404_pricebox_price_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('price' => '', 'period' => ''), $atts));
	
	$output = '<p class="price-td">';
	if(!empty($price))
		$output .= '<strong>'.$price.'</strong>';
	if(!empty($period))
		$output .= '<span>'.$period.'</span>';
	$output .= '</p>';
	
	return $output;
}

function e404_pricebox_body_shortcode($atts, $content = null) {
	$before = '<div class="price-body">';
	$after = '<hr class="dotted" /></div>';
	
	$output = '<ul>';
	$lines = explode("\n", $content);
	foreach($lines as $line) {
		if(trim($line) != '')
			$output .= '<li>'.trim($line).'</li>';
	}
	$output .= '</ul>';
	
	return $before.do_shortcode($output).$after;
}

function e404_pricebox_footer_shortcode($atts, $content = null) {
	$before = '<p class="price-foot">';
	$after = '</p>';
	
	return $before.do_shortcode($content).$after;
}
add_shortcode('pricebox', 'e404_pricebox_shortcode');
add_shortcode('pricebox_price', 'e404_pricebox_price_shortcode');
add_shortcode('pricebox_body', 'e404_pricebox_body_shortcode');
add_shortcode('pricebox_footer', 'e404_pricebox_footer_shortcode');

// [galleria] shortcode
function e404_galleria_shortcode($attr, $content = null) {
	global $post, $wp_locale;

	$disabled = get_option('e404_disable_galleria');
	if($disabled == 'true')
		return;

	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'width'		=> '930',
		'height'	=> '580',
		'bgcolor'	=> '',
		'images'	=> '',
		'thumbnails'	=> '',
		'slideshow'	=> '',
		'speed'		=> 3000,
		'order'     => 'ASC',
		'orderby'   => 'menu_order ID',
		'id'        => $post->ID,
		'include'   => '',
		'exclude'   => ''
	), $attr));

	if($thumbnails == 'true' || $thumbnails == '1')
		$thumbnails = 'true';
	else
		$thumbnails = 'false';
	if($slideshow == 'true' || $slideshow == '1')
		$autoplay = (int)$speed;
	else
		$autoplay = '0';

	// gallery from post
	if(empty($images)) {
		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';
	
		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
	
		if ( empty($attachments) )
			return '';
	
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}
	
		$selector = 'galleria-'.$instance;
		$output = '<div id="'.$selector.'">';
	
		foreach ( $attachments as $id => $attachment ) {
			$src = wp_get_attachment_image_src($id, 'full');
			$output .= '<img src="'.e404_img_scale($src[0], $width).'" alt="'.$attachment->post_title.'" />';
		}
		$output .= '</div>';
	}
	// gallery from image URLs
	else {
		$selector = 'galleria-'.$instance;
		$output = '<div id="'.$selector.'">';

		$images = explode("\n", $content);
		foreach($images as $image) {
			if(trim($image) != '') {
				$img_data = explode(";", trim($image));
				$output .= '<img src="'.e404_img_scale($img_data[0], $width).'"';
				if(!empty($img_data[1]))
					$output .= ' alt="'.$img_data[1].'"';
				else
					$output .= ' alt=""';
				$output .= ' />';
			}
		}
		$output .= '</div>';
	}
	$output .= '[raw]<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function() { ';
	$output .= 'jQuery("#'.$selector.'").galleria({ width: '.$width.', height: '.$height.', thumbnails: '.$thumbnails.', autoplay: '.$autoplay.'});';
	$output .= 'jQuery(".galleria-container").css("background", "'.$bgcolor.'");';
	if($thumbnails != 'true' && $thumbnails != '1')
		$output .= 'jQuery(".galleria-stage").css("bottom", "10px");';
	$output .= '});';
	$output .= '</script>[/raw]';

	return $output;
}

function e404_galleria_post_shortcode($attr) {
	$attr['images'] = '';
	return e404_galleria_shortcode($attr);
}

function e404_galleria_images_shortcode($attr, $content = null) {
	$attr['images'] = 'true';
	return e404_galleria_shortcode($attr, $content);
}
add_shortcode('galleria', 'e404_galleria_post_shortcode');
add_shortcode('galleria_images', 'e404_galleria_images_shortcode');

// [gallery] - set link=file as default
function e404_gallery_shortcode($attr) {
	if(empty($attr['link']))
		$attr['link'] = 'file';
	return gallery_shortcode($attr);
}
remove_shortcode('gallery');
add_shortcode('gallery', 'e404_gallery_shortcode');

// [recent_posts] shortcode
function e404_recent_posts_shortcode($atts) {
	extract(shortcode_atts(array('thumbs' => '', 'number' => 5, 'title' => __('Recent Posts', 'shiny'), 'limit' => 60, 'categories' => ''), $atts));
	
	$params = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
	if(!empty($categories))
		$params = array_merge($params, array('category_name' => $categories));
	$r = new WP_Query($params);
	if ($r->have_posts()) :
		$before = '<div class="widgets">';
		if(!empty($title))
			$before .= '<h3 class="nomargin">'.$title.'</h3>';
		$before .= '<ul class="recent-posts">';
		$after = '</ul></div>';
		$output = '';
		while ($r->have_posts()) : $r->the_post();
			if (has_post_thumbnail() && $thumbs != 'false') {
				$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($r->post->ID), 'full');
				$img = '<img src="'.e404_img_scale($large_image_url[0], 50, 50).'" alt="'.esc_attr(get_the_title()).'" />';
			}
			else
				$img = '';
			$output .= '<li>';
			if($img)
				$output .= '<div><a href="'.get_permalink().'" class="border-img recent-link" title="'.esc_attr(get_the_title() ? get_the_title() : get_the_ID()).'">'.$img.'</a></div>';
			
			$output .= '<div class="posts-desc"><a href="'.get_permalink().'" title="'.esc_attr(get_the_title() ? get_the_title() : get_the_ID()).'">'.get_the_title().'</a><br />';
			$excerpt = e404_get_excerpt($r->post);
			$output .= e404_word_limiter($excerpt, $limit);
			$output .= '</div><br class="clear" /></li>';
		endwhile;
	endif;
	wp_reset_query();

	return $before.'[raw]'.$output.'[/raw]'.$after;
}
add_shortcode('recent_posts', 'e404_recent_posts_shortcode');

// [popular_posts] shortcode
function e404_popular_posts_shortcode($atts) {
	extract(shortcode_atts(array('thumbs' => '', 'number' => 5, 'title' => __('Popular Posts', 'shiny'), 'limit' => 60, 'categories' => ''), $atts));
	
	$params = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'orderby' => 'comment_count');
	if(!empty($categories))
		$params = array_merge($params, array('category_name' => $categories));
	$r = new WP_Query($params);
	if ($r->have_posts()) :
		$before = '<div class="widgets">';
		if(!empty($title))
			$before .= '<h3 class="nomargin">'.$title.'</h3>';
		$before .= '<ul class="popular-posts">';
		$after = '</ul></div>';
		$output = '';
		while ($r->have_posts()) : $r->the_post();
			if (has_post_thumbnail() && $thumbs != 'false') {
				$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($r->post->ID), 'full');
				$img = '<img src="'.e404_img_scale($large_image_url[0], 50, 50).'" alt="'.esc_attr(get_the_title()).'" />';
			}
			else
				$img = '';
			$output .= '<li>';
			if($img)
				$output .= '<div><a href="'.get_permalink().'" class="border-img popular-link" title="'.esc_attr(get_the_title() ? get_the_title() : get_the_ID()).'">'.$img.'</a></div>';
			$output .= '<div class="posts-desc"><a href="'.get_permalink().'" title="'.esc_attr(get_the_title() ? get_the_title() : get_the_ID()).'">'.get_the_title().'</a><br />';
			$excerpt = ($r->post->post_excerpt) ? $r->post->post_excerpt : trim(strip_tags(strip_shortcodes($r->post->post_content)));
			$excerpt = str_replace("\n\r", "", $excerpt);
			$excerpt = str_replace("\n", "", $excerpt);
			$output .= e404_word_limiter($excerpt, $limit);
			$output .= '</div><br class="clear" /></li>';
		endwhile;
	endif;
	wp_reset_query();

	return $before.'[raw]'.$output.'[/raw]'.$after;
}
add_shortcode('popular_posts', 'e404_popular_posts_shortcode');

function e404_get_excerpt($post, $limit = 0) {
	$excerpt = '';
	if(!is_object($post))
		return '';
	$excerpt = ($post->post_excerpt) ? $post->post_excerpt : trim(strip_tags(strip_shortcodes($post->post_content)));
	$excerpt = str_replace("\n\r", "", $excerpt);
	$excerpt = str_replace("\n", "", $excerpt);
	if($limit > 0)
		$excerpt = e404_word_limiter($excerpt, $limit);
	return $excerpt;
}

function e404_excerpt($limit = 80) {
	return e404_word_limiter(get_the_excerpt(), $limit);
}

// [tweets] shortcode
function e404_tweets_shortcode($atts) {
	extract(shortcode_atts(array('number' => 5, 'title' => __('Last Tweets', 'shiny'), 'time' => '', 'username' => ''), $atts));
	if(empty($username))
		$username = get_option('e404_twitter');
	if(empty($username))
		return;
	$tweets = e404_get_tweets($username, $number);
	$before = '<div class="widgets">';
	if(!empty($title))
		$before .= '<h3>'.$title.'</h3>';
	$before .= '<ul class="tweets">';
	$after = '</ul></div>';
	$output = '';
	foreach($tweets as $tweet) {
		$output .= '<li>';
        $output .= $tweet['text'];
        if($time == 'true' || $time == '1')
            $output .= ' <span>'.$tweet['time'].'</span>';
		$output .= '</li>';
	}
	$output = twitter_hyperlinks($output);
	$output = twitter_users($output);
	
	return $before.$output.$after;
}
add_shortcode('tweets', 'e404_tweets_shortcode');

// [tweet] shortcode
function e404_tweet_shortcode($atts) {
	extract(shortcode_atts(array('username' => ''), $atts));
	if(empty($username))
		$username = get_option('e404_twitter');
	if(empty($username))
		return;
	$tweets = e404_get_tweets($username, 1);
	$tweet = $tweets[0]['text'].' <a href="http://twitter.com/'.$username.'/statuses/'.$tweets[0]['id'].'">'.$tweets[0]['time'].'</a>';
	$output = '<div class="twitter-box"><p>'.$tweet.'</p></div>';

	$output = twitter_hyperlinks($output);
	$output = twitter_users($output);
	
	return $output;
}
add_shortcode('tweet', 'e404_tweet_shortcode');

// [nivo_images] shortcode
function e404_nivo_images_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('height' => '373', 'width' => '610', 'effect' => 'fade', 'buttons' => 'true', 'bubbles' => 'true', 'pause' => 2000), $atts));

	$disabled = get_option('e404_disable_nivo');
	if($disabled == 'true')
		return;

	$nivo_effects = array('random', 'sliceDown', 'sliceDownLeft', 'sliceUp', 'sliceUpLeft', 'sliceUpDown', 'sliceUpDownLeft', 'fold', 'fade', 'slideInRight', 'slideInLeft', 'boxRandom', 'boxRain', 'boxRainReverse');
	if(!in_array($effect, $nivo_effects))
		$effect = 'fade';
		
	static $instance = 0;
	$instance++;
	
	$selector = 'islider'.$instance;
	$output = '[raw]<div id="'.$selector.'" class="slider" style="height: '.$height.'px; width: '.$width.'px;">';

	$content = str_replace("\r", "", $content);
	$images = explode("\n", $content);
	foreach($images as $image) {
		if(trim($image) != '') {
			$img_data = explode(";", trim($image));
			$output .= '<a href="'.$img_data[0].'" rel="prettyphoto[nivoi'.$instance.']"><img src="'.e404_img_scale($img_data[0], $width, $height).'"';
			if(!empty($img_data[1]))
				$output .= ' title="'.$img_data[1].'" alt="'.$img_data[1].'"';
			else
				$output .= ' alt=""';
			$output .= ' /></a>';
		}
	}
	$output .= '</div>';
	
	$bubbles = ($bubbles == 'true') ? 1 : 0;
	$buttons = ($buttons == 'true') ? 1 : 0;
	
	$output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function() {
	jQuery("#'.$selector.'").krioImageLoader({ onStart: function(){
			jQuery(this).nivoSlider({
				effect:"'.$effect.'",
				startSlide:0,
				pauseTime: '.$pause.',
				height:'.$height.'+"px",
				directionNav: '.$buttons.',
				controlNav: '.$bubbles.'
			});
	}});
	jQuery(".nivo-directionNav").css("top", ('.$height.'/2)-15); })';
	$output .= '</script>[/raw]';
	
	return $output;
}
add_shortcode('nivo_images', 'e404_nivo_images_shortcode');

// [nivo] shortcode
function e404_nivo_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('height' => '373', 'width' => '610', 'effect' => 'fade', 'slideshow' => '', 'buttons' => 'true', 'bubbles' => 'true', 'pause' => 2000), $atts));

	$disabled = get_option('e404_disable_nivo');
	if($disabled == 'true')
		return;

	$nivo_effects = array('random', 'sliceDown', 'sliceDownLeft', 'sliceUp', 'sliceUpLeft', 'sliceUpDown', 'sliceUpDownLeft', 'fold', 'fade', 'slideInRight', 'slideInLeft', 'boxRandom', 'boxRain', 'boxRainReverse');
	if(!in_array($effect, $nivo_effects))
		$effect = 'fade';
		
	static $instance = 0;
	$instance++;
	
	$selector = 'slider'.$instance;
	$output = '[raw]<div id="'.$selector.'" class="slider" style="height: '.$height.'px; width: '.$width.'px;">';

	$args = array('post_type' => 'e404_slide', 'numberposts' => 99, 'e404_slideshow' => $slideshow);
	$slides = get_posts($args);
	foreach($slides as $slide) {
		$slide_output = '';
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($slide->ID), 'single-post-thumbnail');
		if($image) {
			$url = get_post_meta($slide->ID, 'e404_slide_target_url', true);
			if(empty($url)) {
				$slide_output .= '<img src="'.e404_img_scale($image[0], $width, $height).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" />';
			}
			else {
				$slide_output .= '<a href="'.$url.'"><img src="'.e404_img_scale($image[0], $width, $height).'" title="'.$slide->post_title.'" alt="'.$slide->post_title.'" /></a>';
			}
			$output .= $slide_output;
		}
	}
	$output .= '</div>';

	$bubbles = ($bubbles == 'true') ? 1 : 0;
	$buttons = ($buttons == 'true') ? 1 : 0;

	$output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function() {
	jQuery("#'.$selector.'").krioImageLoader({ onStart: function(){
			jQuery(this).nivoSlider({
				effect:"'.$effect.'",
				startSlide:0,
				pauseTime: '.$pause.',
				height:'.$height.'+"px",
				directionNav: '.$buttons.',
				controlNav: '.$bubbles.'
			});
	}});
	jQuery(".nivo-directionNav").css("top", ('.$height.'/2)-15); })';
	$output .= '</script>[/raw]';
	
	return $output;
}
add_shortcode('nivo', 'e404_nivo_shortcode');

// [youtube] shortcode
function e404_youtube_shortcode($atts) {
	extract(shortcode_atts(array('id' => '', 'height' => '375', 'width' => '610'), $atts));
	if(empty($id))
		return;
	return '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$id.'?rel=0" frameborder="0"></iframe>';
}

// [vimeo] shortcode
function e404_vimeo_shortcode($atts) {
	extract(shortcode_atts(array('id' => '', 'height' => '375', 'width' => '610'), $atts));
	if(empty($id))
		return;
	return '<iframe width="'.$width.'" height="'.$height.'" src="http://player.vimeo.com/video/'.$id.'" frameborder="0"></iframe>';
}

// [dailymotion] shortcode
function e404_dailymotion_shortcode($atts) {
	extract(shortcode_atts(array('id' => '', 'height' => '375', 'width' => '610'), $atts));
	if(empty($id))
		return;
	return '<iframe width="'.$width.'" height="'.$height.'" src="http://www.dailymotion.com/embed/video/'.$id.'?theme=none&hideInfos=1" frameborder="0"></iframe>';
}
if(get_option('e404_disable_media_shortcodes') != 'true') {
	add_shortcode('youtube', 'e404_youtube_shortcode');
	add_shortcode('vimeo', 'e404_vimeo_shortcode');
	add_shortcode('dailymotion', 'e404_dailymotion_shortcode');
}

// [video] shortcode
function e404_video_shortcode($atts) {
	extract(shortcode_atts(array('title' => '', 'poster' => '', 'height' => '375', 'width' => '610', 'source' => '', 'controls' => 'true'), $atts));

	static $instance = 0;
	$instance++;

	$output = '[raw]<a id="flowplayer'.$instance.'" href="'.$source.'" style="display:block;width:'.$width.'px;height:'.$height.'px">';
	if(!empty($poster))
		$output .= '<img src="'.$poster.'" alt="'.$title.'" />';
	
	$output .= '</a>[/raw]';
	$output .= "\n";

	$output .= '[raw]<script type="text/javascript">
	jQuery(document).ready(function() {
		flowplayer("flowplayer'.$instance.'", { src: "'.OF_DIRECTORY.'/lib/flowplayer.swf", wmode: "transparent" }, {';
	if($controls == 'false')
		$output .= ' plugins: { controls: null },';
	$output .= ' clip: { autoPlay: false } })
	});
	</script>[/raw]';
	$output .= "\n";
	return $output;
}
if(get_option('e404_disable_video_shortcode') != 'true') {
	add_shortcode('video', 'e404_video_shortcode');
}

// [map] shortcode
function e404_map_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('height' => '368', 'width' => '100%'), $atts));
	
	$before = '<div class="full_page border-box"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="';
	$after = '&amp;output=embed"></iframe></div>';

	return $before.$content.$after;
}
add_shortcode('map', 'e404_map_shortcode');

// [recent_works_images_full] shortcode
function e404_recent_works_images_full_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => __('Recent Works', 'shiny'), 'url' => '', 'more_text' => __('view all', 'shiny'), 'description' => ''), $atts));
	
	global $e404_all_options;

	if(!empty($description))
		$description = '<p>'.$description.'</p>';
	$output = '[raw]<div class="fancy_list"><div class="one_fourth fancy_title"><h2 class="icon-box">'.$title.'<span><a href="'.$url.'">'.$more_text.'</a></span></h2>'.$description.'</div>';

	$query = array('post_type' => 'portfolio', 'orderby' => 'menu_order date', 'numberposts' => 3);
	$works = get_posts($query);
	$i = 0;
	foreach($works as $work) {
		$i++;
		$preview_url = e404_get_portfolio_preview_url($work->ID);
		$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($work->ID), 'full');
		if(!$large_image_url)
			$large_image_url[0] = OF_DIRECTORY.'/images/blank152.png';
		$image = $large_image_url[0];
		if($i == 3)
			$last = ' last';
		else
			$last = '';
		$output .= '<div class="one_fourth'.$last.' fancy_list_item"><div class="fancy_border"><div class="fancy_image">';
		$output .= '<a href="'.get_permalink($work->ID).'"><img src="'.e404_img_scale($image, 200, 120).'"';
		if(!empty($work->post_title))
			$output .= ' title="'.esc_attr(get_the_title($work->ID)).'" alt="'.esc_attr(get_the_title($work->ID)).'"';
		else
			$output .= ' alt="'.esc_attr(get_the_title($work->ID)).'"';
		$output .= ' /></a><div class="fancy_hover"><h3><a href="'.get_permalink($work->ID).'">'.esc_html(get_the_title($work->ID)).'</a></h3></div></div>';
		
		$output .= '<div class="fancy_meta"><ul>';
		$output .= '<li><a href="'.get_permalink($work->ID).'" class="tiptip fancy_icon fancy_details" title="'.__('More details', 'shiny').'"></a></li>';
		$output .= '<li><a href="'.$preview_url.'" rel="prettyphoto" class="tiptip fancy_icon fancy_preview" title="'.__('Preview', 'shiny').'"></a></li>';
		if($e404_all_options['e404_portfolio_like_this'] == 'true') {
			$like_class = e404_liked($work->ID) ? 'fancy_likes_you_like' : 'fancy_likes';
			$output .= '<li><a href="#" class="tiptip fancy_icon like_this '.$like_class.'" id="like-'.$work->ID.'" title="'.e404_likes_text(e404_like_this($work->ID), false).'"></a></li>';
		}
		$output .= '</ul></div></div></div>';
	}
	$output .= '<br class="clear" /></div>';

	$output .= '[/raw]';
	
	return $output;
}
add_shortcode('recent_works_images_full', 'e404_recent_works_images_full_shortcode');

// [recent_posts_images_full] shortcode
function e404_recent_posts_images_full_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => __('Recent Posts', 'shiny'), 'url' => '', 'more_text' => __('view all', 'shiny'), 'categories' => '', 'description' => ''), $atts));
	
	global $e404_all_options;

	if(!empty($description))
		$description = '<p>'.$description.'</p>';
	$output = '[raw]<div class="fancy_list fancy_blog_list"><div class="one_fourth fancy_title"><h2 class="icon-box">'.$title.'<span><a href="'.$url.'">'.$more_text.'</a></span></h2>'.$description.'</div>';

	$query = array('orderby' => 'menu_order date', 'numberposts' => 3);
	if(!empty($categories))
		$query = array_merge($query, array('category_name' => $categories));
	$posts = get_posts($query);
	$i = 0;
	foreach($posts as $post) {
		$i++;
		$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		if(!$large_image_url)
			$large_image_url[0] = OF_DIRECTORY.'/images/blank152.png';
		$image = $large_image_url[0];
		if($i == 3)
			$last = ' last';
		else
			$last = '';
		$output .= '<div class="one_fourth'.$last.' fancy_list_item"><div class="fancy_border">';
		$output .= '<a href="'.get_permalink($post->ID).'"><img src="'.e404_img_scale($image, 200, 120).'"';
		if(!empty($post->post_title))
			$output .= ' title="'.esc_attr(get_the_title($post->ID)).'" alt="'.esc_attr(get_the_title($post->ID)).'"';
		else
			$output .= ' alt="'.esc_attr(get_the_title($post->ID)).'"';
		$output .= ' /></a><div class="fancy_blog_header"><span class="fancy_date">'.get_the_time(get_option('date_format'), $post).'</span><br />';
		$output .= '<div class="fancy_hover"><h3><a href="'.get_permalink($post->ID).'">'.esc_html(get_the_title($post->ID)).'</a></h3></div></div>';
		
		$output .= '<div class="fancy_meta"><ul>';
		$output .= '<li><a href="'.get_permalink($post->ID).'" class="tiptip fancy_icon fancy_details" title="'.__('More details', 'shiny').'"></a></li>';
		$comments_number = get_comments_number($post->ID);
		if($comments_number == 0)
			$comments_number_txt = __('No comments', 'shiny');
		elseif($comments_number == 1)
			$comments_number_txt = __('1 comment', 'shiny');
		else
			$comments_number_txt = sprintf(__('%d comments'), $comments_number);
		if(comments_open($post->ID))
			$output .= '<li><a href="'.get_comments_link($post->ID).'" class="tiptip fancy_icon fancy_comments" title="'.$comments_number_txt.'"></a></li>';
		if($e404_all_options['e404_blog_like_this'] == 'true') {
			$like_class = e404_liked($post->ID) ? 'fancy_likes_you_like' : 'fancy_likes';
			$output .= '<li><a href="#" class="tiptip fancy_icon like_this '.$like_class.'" id="like-'.$post->ID.'" title="'.e404_likes_text(e404_like_this($post->ID), false).'"></a></li>';
		}
		$output .= '</ul></div></div></div>';
	}
	$output .= '<br class="clear" /></div>';

	$output .= '[/raw]';
	
	return $output;
}
add_shortcode('recent_posts_images_full', 'e404_recent_posts_images_full_shortcode');

// [recent_posts_images] shortcode
function e404_recent_posts_images_shortcode($atts) {
	extract(shortcode_atts(array('number' => 2, 'more_text' => __('Read more', 'shiny'), 'categories' => ''), $atts));
	
	$output = '[raw]<ul class="post-list">';
	
	$query = array('orderby' => 'menu_order date', 'numberposts' => $number);
	if(!empty($categories))
		$query = array_merge($query, array('category_name' => $categories));
	$posts = get_posts($query);
	foreach($posts as $post) {
		$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		if(!$large_image_url)
			$large_image_url[0] = OF_DIRECTORY.'/images/blank152.png';
		$output .= '<li><div class="shadow shadow_vtiny alignleft shadow_left">
		<a href="'.get_permalink($post->ID).'"><img src="'.e404_img_scale($large_image_url[0], 78, 70).'" alt="'.get_the_title($post->ID).'" title="'.get_the_title($post->ID).'" class="border-img" /></a></div>
		<div class="post-list-info">
			<p><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></p>
			<div class="more">
				<span class="details-link"><a href="'.get_permalink($post->ID).'">'.$more_text.'</a></span>
				<span class="comments-link"><a href="'.get_comments_link($post->ID).'">'.$post->comment_count.'</a></span>
			</div>
		</div></li>';
	}
	
	$output .= '</ul>[/raw]';

	return do_shortcode($output);
}
add_shortcode('recent_posts_images', 'e404_recent_posts_images_shortcode');

// [popular_posts_images] shortcode
function e404_popular_posts_images_shortcode($atts) {
	extract(shortcode_atts(array('number' => 2, 'more_text' => __('Read more', 'shiny'), 'categories' => ''), $atts));
	
	$output = '[raw]<ul class="post-list">';
	
	$query = array('orderby' => 'comment_count', 'numberposts' => $number);
	if(!empty($categories))
		$query = array_merge($query, array('category_name' => $categories));
	$posts = get_posts($query);
	foreach($posts as $post) {
		$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		if(!$large_image_url)
			$large_image_url[0] = OF_DIRECTORY.'/images/blank152.png';
		$output .= '<li><div class="shadow shadow_vtiny alignleft shadow_left">
		<a href="'.get_permalink($post->ID).'"><img src="'.e404_img_scale($large_image_url[0], 78, 70).'" alt="'.get_the_title($post->ID).'" title="'.get_the_title($post->ID).'" class="border-img" /></a></div>
		<div class="post-list-info">
			<p><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></p>
			<div class="more">
				<span class="details-link"><a href="'.get_permalink($post->ID).'">'.$more_text.'</a></span>
				<span class="comments-link"><a href="'.get_comments_link($post->ID).'">'.$post->comment_count.'</a></span>
			</div>
		</div></li>';
	}
	
	$output .= '</ul>[/raw]';

	return do_shortcode($output);
}
add_shortcode('popular_posts_images', 'e404_popular_posts_images_shortcode');

// [recent_comments] shortcode
function e404_recent_comments_shortcode($atts) {
	extract(shortcode_atts(array('number' => 3), $atts));
	
	$output = '[raw]<ul class="latest-comments">';
	
	$query = array('status' => 'approve', 'number' => $number);
	$comments = get_comments($query);
	foreach($comments as $comment) {
		$output .= '<li><div><p><span>'.$comment->comment_author.'</span>'.__(' on:', 'shiny').'</p>
		<p><a href="'.get_permalink($comment->comment_post_ID).'">'.get_the_title($comment->comment_post_ID).'</a></p>
		</div></li>';
	}
	
	$output .= '</ul>[/raw]';

	return do_shortcode($output);
}
add_shortcode('recent_comments', 'e404_recent_comments_shortcode');

// [scrollable] shortcode
function e404_scrollable_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => '', 'images' => 5, 'height' => ''), $atts));
	
	$disabled = get_option('e404_disable_scrollable');
	if($disabled == 'true')
		return;
	
	if($images < 2 || $images > 6)
		$images = 5;
	$sizes = array(2 => 'large', 3 => 'medium', 4 => 'small', 5 => 'vsmall', 6 => 'tiny');
	$widths = array(2 => 438, 3 => 278, 4 => 198, 5 => 150, 6 => 118);
	$heights = array(2 => 288, 3 => 178, 4 => 128, 5 => 98, 6 => 78);
	if(empty($height))
		$height = $heights[$images];
	
	static $instance = 0;
	$instance++;
	
	$selector = 'scrollable'.$instance;
	$output = '[raw]<div class="scroller group">';
	if(!empty($title))
		$output .= '<h2>'.$title.'</h2>';
	$output .= '<div class="scroller_btns"><a class="prev browse arrowleft"><span>prev</span></a> <a class="next browse arrowright"><span>next</span></a></div><div class="scrollable" style="height: '.($height + 32).'px;" id="'.$selector.'">';
	$output .= '<div class="items">';

	$i = 0;
	$content = str_replace("\r", "", $content);
	$images_list = explode("\n", $content);
	foreach($images_list as $image) {
		if(trim($image) != '') {
			if(($i % $images) == 0)
				$output .= '<div class="panel">';
	
			$img_data = explode(";", trim($image));
			$output .= '<div class="shadow shadow_'.$sizes[$images].' scroller_item"><a class="border-img zoom" href="'.$img_data[0].'" rel="prettyphoto[scrl'.$instance.']"><img src="'.e404_img_scale($img_data[0], $widths[$images], $height).'"';
			if(!empty($img_data[1]))
				$output .= ' title="'.$img_data[1].'" alt="'.$img_data[1].'"';
			else
				$output .= ' alt=""';
			$output .= ' /></a></div>';

			$i++;
			if(($i % $images) == 0)
				$output .= '</div>';
		}
	}
	if(($i % $images) != 0)
		$output .= '</div>';
	$output .= '</div></div><br class="clear" /></div>';

	$output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function() { jQuery("#'.$selector.'").scrollable(); });';
	$output .= '</script>[/raw]';
	
	return $output;
}
add_shortcode('scrollable', 'e404_scrollable_shortcode');

// [recent_works_images_scrollable] shortcode
function e404_recent_works_images_scrollable_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => __('Recent Works', 'shiny'), 'url' => '', 'more_text' => __('view all', 'shiny'), 'works' => 8), $atts));
	
	global $e404_all_options;
	
	static $instance = 0;
	$instance++;
	
	$selector = 'scrollable_works'.$instance;

	if(!empty($description))
		$description = '<p>'.$description.'</p>';
	$output = '[raw]<div class="scroller scroller_works group"><h2>'.$title.'</h2>';
	$output .= '<div class="scroller_btns"><span class="view-all"><a href="'.$url.'">'.$more_text.'</a></span> <a class="prev browse arrowleft"><span>prev</span></a> <a class="next browse arrowright"><span>next</span></a></div><div class="scrollable scrollable_works" id="'.$selector.'">';
	$output .= '<div class="items">';

	$query = array('post_type' => 'portfolio', 'orderby' => 'menu_order date', 'numberposts' => $works);
	$works = get_posts($query);
	$i = 0;
	foreach($works as $work) {
		if(($i % 4) == 0)
			$output .= '<div class="panel">';
		$i++;
		$preview_url = e404_get_portfolio_preview_url($work->ID);
		$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($work->ID), 'full');
		if(!$large_image_url)
			$large_image_url[0] = OF_DIRECTORY.'/images/blank152.png';
		$image = $large_image_url[0];
		if($i == 4)
			$last = ' last';
		else
			$last = '';
		$output .= '<div class="one_fourth'.$last.' fancy_list_item"><div class="fancy_border"><div class="fancy_image">';
		$output .= '<a href="'.get_permalink($work->ID).'"><img src="'.e404_img_scale($image, 200, 120).'"';
		if(!empty($work->post_title))
			$output .= ' title="'.esc_attr(get_the_title($work->ID)).'" alt="'.esc_attr(get_the_title($work->ID)).'"';
		else
			$output .= ' alt="'.esc_attr(get_the_title($work->ID)).'"';
		$output .= ' /></a><div class="fancy_hover"><h3><a href="'.get_permalink($work->ID).'">'.esc_html(get_the_title($work->ID)).'</a></h3></div></div>';
		
		$output .= '<div class="fancy_meta"><ul>';
		$output .= '<li><a href="'.get_permalink($work->ID).'" class="tiptip fancy_icon fancy_details" title="'.__('More details', 'shiny').'"></a></li>';
		$output .= '<li><a href="'.$preview_url.'" rel="prettyphoto" class="tiptip fancy_icon fancy_preview" title="'.__('Preview', 'shiny').'"></a></li>';
		if($e404_all_options['e404_portfolio_like_this'] == 'true') {
			$like_class = e404_liked($work->ID) ? 'fancy_likes_you_like' : 'fancy_likes';
			$output .= '<li><a href="#" class="tiptip fancy_icon like_this '.$like_class.'" id="like-'.$work->ID.'" title="'.e404_likes_text(e404_like_this($work->ID), false).'"></a></li>';
		}
		$output .= '</ul></div></div></div>';
		if(($i % 4) == 0)
			$output .= '</div>';
	}
	if(($i % 4) != 0)
		$output .= '</div>';
		
	$output .= '</div><br class="clear" /></div></div>';

	$output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function() { jQuery("#'.$selector.'").scrollable(); });';
	$output .= '</script>[/raw]';
	
	return $output;
}
add_shortcode('recent_works_images_scrollable', 'e404_recent_works_images_scrollable_shortcode');

// [recent_posts_images_scrollable] shortcode
function e404_recent_posts_images_scrollable_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('title' => __('Recent Posts', 'shiny'), 'url' => '', 'more_text' => __('view all', 'shiny'), 'categories' => '', 'posts' => 8), $atts));
	
	global $e404_all_options;
	
	static $instance = 0;
	$instance++;
	
	$selector = 'scrollable_posts'.$instance;

	if(!empty($description))
		$description = '<p>'.$description.'</p>';
	$output = '[raw]<div class="scroller scroller_posts group fancy_blog_list"><h2 class="icon-box">'.$title.'</h2>';
	$output .= '<div class="scroller_btns"><span class="view-all"><a href="'.$url.'">'.$more_text.'</a></span> <a class="prev browse arrowleft"><span>prev</span></a> <a class="next browse arrowright"><span>next</span></a></div><div class="scrollable scrollable_posts" id="'.$selector.'">';
	$output .= '<div class="items">';

	$query = array('orderby' => 'menu_order date', 'numberposts' => $posts);
	if(!empty($categories))
		$query = array_merge($query, array('category_name' => $categories));
	$posts = get_posts($query);
	$i = 0;
	foreach($posts as $post) {
		if(($i % 4) == 0)
			$output .= '<div class="panel">';
		$i++;
		$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		if(!$large_image_url)
			$large_image_url[0] = OF_DIRECTORY.'/images/blank152.png';
		$image = $large_image_url[0];
		if($i == 4)
			$last = ' last';
		else
			$last = '';
		$output .= '<div class="one_fourth'.$last.' fancy_list_item"><div class="fancy_border">';
		$output .= '<a href="'.get_permalink($post->ID).'"><img src="'.e404_img_scale($image, 200, 120).'"';
		if(!empty($post->post_title))
			$output .= ' title="'.esc_attr(get_the_title($post->ID)).'" alt="'.esc_attr(get_the_title($post->ID)).'"';
		else
			$output .= ' alt="'.esc_attr(get_the_title($post->ID)).'"';
		$output .= ' /></a><div class="fancy_blog_header"><span class="fancy_date">'.get_the_time(get_option('date_format'), $post).'</span><br />';
		$output .= '<div class="fancy_hover"><h3><a href="'.get_permalink($post->ID).'">'.esc_html(get_the_title($post->ID)).'</a></h3></div></div>';
		
		$output .= '<div class="fancy_meta"><ul>';
		$output .= '<li><a href="'.get_permalink($post->ID).'" class="tiptip fancy_icon fancy_details" title="'.__('More details', 'shiny').'"></a></li>';
		$comments_number = get_comments_number($post->ID);
		if($comments_number == 0)
			$comments_number_txt = __('No comments', 'shiny');
		elseif($comments_number == 1)
			$comments_number_txt = __('1 comment', 'shiny');
		else
			$comments_number_txt = sprintf(__('%d comments'), $comments_number);
		if(comments_open($post->ID))
			$output .= '<li><a href="'.get_comments_link($post->ID).'" class="tiptip fancy_icon fancy_comments" title="'.$comments_number_txt.'"></a></li>';
		if($e404_all_options['e404_blog_like_this'] == 'true') {
			$like_class = e404_liked($post->ID) ? 'fancy_likes_you_like' : 'fancy_likes';
			$output .= '<li><a href="#" class="tiptip fancy_icon like_this '.$like_class.'" id="like-'.$post->ID.'" title="'.e404_likes_text(e404_like_this($post->ID), false).'"></a></li>';
		}
		$output .= '</ul></div></div></div>';
		if(($i % 4) == 0)
			$output .= '</div>';
	}
	if(($i % 4) != 0)
		$output .= '</div>';
	$output .= '</div><br class="clear" /></div></div>';

	$output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function() { jQuery("#'.$selector.'").scrollable(); });';
	$output .= '</script>[/raw]';
	
	return $output;
}
add_shortcode('recent_posts_images_scrollable', 'e404_recent_posts_images_scrollable_shortcode');

// custom colors style
function e404_custom_colors_style($bgcolor = '', $color = '', $bordercolor = '', $hidden = false) {
	$output = '';
	if(!(empty($bgcolor) && empty($color) && empty($bordercolor) && !$hidden)) {
		$output .= ' style="';
		if(!empty($bgcolor)) {
			$output .= 'background-color: '.$bgcolor.'; ';
		}
		if(!empty($color)) {
			$output .= 'color: '.$color.'; ';
		}
		if(!empty($bordercolor)) {
			$output .= 'border-color: '.$bordercolor.'; ';
		}
		if($hidden)
			$output .= 'display: none; ';
		$output = substr($output, 0, strlen($output) - 1);
		$output .= '"';
	}
	return $output;	
}

// get style number
function e404_get_style_number($style, &$styles) {
	if(array_key_exists($style, $styles))
		return $styles[$style];
	else
		return '1';
}

// shortcode formatting fix
// source: http://tutorials.mysitemyway.com/adding-column-layout-shortcodes-to-a-wordpress-theme/
function webtreats_formatter($content) {
	$new_content = '';

	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {

			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {

			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	// e404
	$new_content = str_replace("\t", "", $new_content);
	$new_content = str_replace('<p><br class="clear" /></p>', '<br class="clear" />', $new_content);
	$new_content = str_replace('<p><br class="clear" /><br />', '<br class="clear" />', $new_content);
	$new_content = str_replace('<br class="clear" /></p>', '<br class="clear" />', $new_content);
	$new_content = str_replace('<p><br style="clear: both" />', '<br style="clear: both" />', $new_content);
	$new_content = str_replace("<p><br style='clear: both;' />", '<br style="clear: both" />', $new_content);
	$new_content = str_replace('<br style="clear: both" /><br />', '', $new_content);
	$new_content = str_replace('<p><code>', '<code>', $new_content);
	$new_content = str_replace('</code></p>', '</code>', $new_content);

	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'webtreats_formatter', 99);
add_filter('widget_text', 'webtreats_formatter', 99);

?>