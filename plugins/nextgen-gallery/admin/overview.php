<?php  
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

/**
 * nggallery_admin_overview()
 *
 * Add the admin overview in wp2.7 style 
 * @return mixed content
 */
function nggallery_admin_overview()  {	
?>
<div class="wrap ngg-wrap">
	<h2><?php _e('NextGEN Gallery Overview', 'nggallery') ?></h2>
	<div id="dashboard-widgets-wrap" class="ngg-overview">
	    <div id="dashboard-widgets" class="metabox-holder">
	    	<div id="side-info-column" class="inner-sidebar">
				<?php do_meta_boxes('ngg_overview', 'right', ''); ?>
			</div>
			<div id="post-body" class="has-sidebar">
				<div id="dashboard-widgets-main-content" class="has-sidebar-content">
				<?php do_meta_boxes('ngg_overview', 'left', ''); ?>
				</div>
			</div>
	    </div>
	</div>
</div>
<?php
}

/**
 * Show the server settings
 * 
 * @return void
 */
function ngg_overview_server() {
?>
<div id="dashboard_server_settings" class="dashboard-widget-holder wp_dashboard_empty">
	<div class="ngg-dashboard-widget">
	  <?php if (IS_WPMU) {
	  	if (wpmu_enable_function('wpmuQuotaCheck'))
			echo ngg_SpaceManager::details();
		else {
			//TODO:WPMU message in WP2.5 style
			echo ngg_SpaceManager::details();
		}
	  } else { ?>
	  	<div class="dashboard-widget-content">
      		<ul class="settings">
      		<?php ngg_get_serverinfo(); ?>
	   		</ul>
		</div>
	  <?php } ?>
    </div>
</div>
<?php	
}

/**
 * Show the GD ibfos
 * 
 * @return void
 */
function ngg_overview_graphic_lib() {
?>
<div id="dashboard_server_settings" class="dashboard-widget-holder">
	<div class="ngg-dashboard-widget">
	  	<div class="dashboard-widget-content">
	  		<ul class="settings">
			<?php ngg_gd_info(); ?>
			</ul>
		</div>
    </div>
</div>
<?php	
}

/**
 * Show the latest NextGEN Gallery news
 * 
 * @return void
 */
function ngg_overview_news(){
	// get feed_messages
	require_once(ABSPATH . WPINC . '/rss.php');
?>
<div class="rss-widget">
    <?php
//    $rss = @fetch_rss('http://alexrabe.boelinger.com/?tag=nextgen-gallery&feed=rss2');
      $rss = @fetch_rss('http://alexrabe.boelinger.com/feed/rss2/');

      if ( isset($rss->items) && 0 != count($rss->items) )
      {
        $rss->items = array_slice($rss->items, 0, 3);
        echo "<ul>";
		foreach ($rss->items as $item)
        {
        ?>
          <li><a class="rsswidget" title="" href='<?php echo wp_filter_kses($item['link']); ?>'><?php echo wp_specialchars($item['title']); ?></a>
		  <span class="rss-date"><?php echo date("F jS, Y", strtotime($item['pubdate'])); ?></span> 
          <div class="rssSummary"><strong><?php echo human_time_diff(strtotime($item['pubdate'], time())); ?></strong> - <?php echo $item['description']; ?></div></li>
        <?php
        }
        echo "</ul>";
      }
      else
      {
        ?>
        <p><?php printf(__('Newsfeed could not be loaded.  Check the <a href="%s">front page</a> to check for updates.', 'nggallery'), 'http://alexrabe.boelinger.com/') ?></p>
        <?php
      }
    ?>
</div>
<?php
}

/**
 * Show a summary of the used images
 * 
 * @return void
 */
function ngg_overview_right_now() {
	global $wpdb;
	$images    = intval( $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->nggpictures") );
	$galleries = intval( $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->nggallery") );
	$albums    = intval( $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->nggalbum") );
?>

<p class="sub"><?php _e('At a Glance', 'nggallery'); ?></p>
<div class="table">
	<table>
		<tbody>
			<tr class="first">
				<td class="first b"><a href="admin.php?page=nggallery-add-gallery"><?php echo $images; ?></a></td>
				<td class="t"><?php echo __ngettext( 'Image', 'Images', $images, 'nggallery' ); ?></td>
				<td class="b"></td>
				<td class="last"></td>
			</tr>
			<tr>
				<td class="first b"><a href="admin.php?page=nggallery-manage-gallery"><?php echo $galleries; ?></a></td>
				<td class="t"><?php echo __ngettext( 'Gallery', 'Galleries', $galleries, 'nggallery' ); ?></td>
				<td class="b"></td>
				<td class="last"></td>
			</tr>
			<tr>
				<td class="first b"><a href="admin.php?page=nggallery-manage-album"><?php echo $albums; ?></a></td>
				<td class="t"><?php echo __ngettext( 'Album', 'Albums', $albums, 'nggallery' ); ?></td>
				<td class="b"></td>
				<td class="last"></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="versions">
    <p>
	<?php if(current_user_can('NextGEN Upload images')): ?><a class="button rbutton" href="admin.php?page=nggallery-add-gallery"><strong><?php _e('Upload pictures', 'nggallery') ?></strong></a><?php endif; ?>
	<?php _e('Here you can control your images, galleries and albums.', 'nggallery') ?>
	</p>
	<span>
	<?php
		$userlevel = '<span class="b">' . (current_user_can('manage_options') ? __('Gallery Administrator', 'nggallery') : __('Gallery Editor', 'nggallery')) . '</span>';
        printf(__('You currently have %s rights.', 'nggallery'), $userlevel);
    ?>
    </span>
</div>
<?php
}

add_meta_box('dashboard_right_now', __('Welcome to NextGEN Gallery !', 'nggallery'), 'ngg_overview_right_now', 'ngg_overview', 'left', 'core');
add_meta_box('dashboard_primary', __('Latest News', 'nggallery'), 'ngg_overview_news', 'ngg_overview', 'right', 'core');
add_meta_box('ngg_server', __('Server Settings', 'nggallery'), 'ngg_overview_server', 'ngg_overview', 'left', 'core');
add_meta_box('ngg_gd_lib', __('Graphic Library', 'nggallery'), 'ngg_overview_graphic_lib', 'ngg_overview', 'right', 'core');

// ***************************************************************
function ngg_gd_info() {
	
	if(function_exists("gd_info")){
		$info = gd_info();
		$keys = array_keys($info);
		for($i=0; $i<count($keys); $i++) {
			if(is_bool($info[$keys[$i]]))
				echo "<li> " . $keys[$i] ." : <span>" . ngg_gd_yesNo($info[$keys[$i]]) . "</span></li>\n";
			else
				echo "<li> " . $keys[$i] ." : <span>" . $info[$keys[$i]] . "</span></li>\n";
		}
	}
	else {
		echo '<h4>'.__('No GD support', 'nggallery').'!</h4>';
	}
}

// ***************************************************************		
function ngg_gd_yesNo($bool){
	if($bool) 
		return __('Yes', 'nggallery');
	else 
		return __('No', 'nggallery');
}

// ***************************************************************
function ngg_get_serverinfo() {
// thx to GaMerZ for WP-ServerInfo	
// http://www.lesterchan.net

	global $wpdb;
	// Get MYSQL Version
	$sqlversion = $wpdb->get_var("SELECT VERSION() AS version");
	// GET SQL Mode
	$mysqlinfo = $wpdb->get_results("SHOW VARIABLES LIKE 'sql_mode'");
	if (is_array($mysqlinfo)) $sql_mode = $mysqlinfo[0]->Value;
	if (empty($sql_mode)) $sql_mode = __('Not set', 'nggallery');
	// Get PHP Safe Mode
	if(ini_get('safe_mode')) $safe_mode = __('On', 'nggallery');
	else $safe_mode = __('Off', 'nggallery');
	// Get PHP allow_url_fopen
	if(ini_get('allow_url_fopen')) $allow_url_fopen = __('On', 'nggallery');
	else $allow_url_fopen = __('Off', 'nggallery'); 
	// Get PHP Max Upload Size
	if(ini_get('upload_max_filesize')) $upload_max = ini_get('upload_max_filesize');	
	else $upload_max = __('N/A', 'nggallery');
	// Get PHP Max Post Size
	if(ini_get('post_max_size')) $post_max = ini_get('post_max_size');
	else $post_max = __('N/A', 'nggallery');
	// Get PHP Max execution time
	if(ini_get('max_execution_time')) $max_execute = ini_get('max_execution_time');
	else $max_execute = __('N/A', 'nggallery');
	// Get PHP Memory Limit 
	if(ini_get('memory_limit')) $memory_limit = ini_get('memory_limit');
	else $memory_limit = __('N/A', 'nggallery');
	// Get actual memory_get_usage
	if (function_exists('memory_get_usage')) $memory_usage = round(memory_get_usage() / 1024 / 1024, 2) . __(' MByte', 'nggallery');
	else $memory_usage = __('N/A', 'nggallery');
	// required for EXIF read
	if (is_callable('exif_read_data')) $exif = __('Yes', 'nggallery'). " ( V" . substr(phpversion('exif'),0,4) . ")" ;
	else $exif = __('No', 'nggallery');
	// required for meta data
	if (is_callable('iptcparse')) $iptc = __('Yes', 'nggallery');
	else $iptc = __('No', 'nggallery');
	// required for meta data
	if (is_callable('xml_parser_create')) $xml = __('Yes', 'nggallery');
	else $xml = __('No', 'nggallery');
	
?>
	<li><?php _e('Operating System', 'nggallery'); ?> : <span><?php echo PHP_OS; ?></span></li>
	<li><?php _e('Server', 'nggallery'); ?> : <span><?php echo $_SERVER["SERVER_SOFTWARE"]; ?></span></li>
	<li><?php _e('Memory usage', 'nggallery'); ?> : <span><?php echo $memory_usage; ?></span></li>
	<li><?php _e('MYSQL Version', 'nggallery'); ?> : <span><?php echo $sqlversion; ?></span></li>
	<li><?php _e('SQL Mode', 'nggallery'); ?> : <span><?php echo $sql_mode; ?></span></li>
	<li><?php _e('PHP Version', 'nggallery'); ?> : <span><?php echo PHP_VERSION; ?></span></li>
	<li><?php _e('PHP Safe Mode', 'nggallery'); ?> : <span><?php echo $safe_mode; ?></span></li>
	<li><?php _e('PHP Allow URL fopen', 'nggallery'); ?> : <span><?php echo $allow_url_fopen; ?></span></li>
	<li><?php _e('PHP Memory Limit', 'nggallery'); ?> : <span><?php echo $memory_limit; ?></span></li>
	<li><?php _e('PHP Max Upload Size', 'nggallery'); ?> : <span><?php echo $upload_max; ?></span></li>
	<li><?php _e('PHP Max Post Size', 'nggallery'); ?> : <span><?php echo $post_max; ?></span></li>
	<li><?php _e('PHP Max Script Execute Time', 'nggallery'); ?> : <span><?php echo $max_execute; ?>s</span></li>
	<li><?php _e('PHP Exif support', 'nggallery'); ?> : <span><?php echo $exif; ?></span></li>
	<li><?php _e('PHP IPTC support', 'nggallery'); ?> : <span><?php echo $iptc; ?></span></li>
	<li><?php _e('PHP XML support', 'nggallery'); ?> : <span><?php echo $xml; ?></span></li>
<?php
}

/**
 * WPMU feature taken from Z-Space Upload Quotas
 * @author Dylan Reeve
 * @url http://dylan.wibble.net/
 *
 */
class ngg_SpaceManager {
 
 	function getQuota() {
		if (function_exists(get_space_allowed))
			$quota = get_space_allowed();
		else
			$quota = get_site_option( "blog_upload_space" );
			
		return $quota;
	}
	 
	function details() {
		
		// take default seetings
		$settings = array(

			'remain'	=> array(
			'color_text'	=> 'white',
			'color_bar'		=> '#0D324F',
			'color_bg'		=> '#a0a0a0',
			'decimals'		=> 2,
			'unit'			=> 'm',
			'display'		=> true,
			'graph'			=> false
			),

			'used'		=> array(
			'color_text'	=> 'white',
			'color_bar'		=> '#0D324F',
			'color_bg'		=> '#a0a0a0',
			'decimals'		=> 2,
			'unit'			=> 'm',
			'display'		=> true,
			'graph'			=> true
			)
		);

		$quota = ngg_SpaceManager::getQuota() * 1024 * 1024;
		$used = get_dirsize( constant( "ABSPATH" ) . constant( "UPLOADS" ) );
//		$used = get_dirsize( ABSPATH."wp-content/blogs.dir/".$blog_id."/files" );
		
		if ($used > $quota) $percentused = '100';
		else $percentused = ( $used / $quota ) * 100;

		$remaining = $quota - $used;
		$percentremain = 100 - $percentused;

		$out = "";
		$out .= '<div id="spaceused"> <h3>'.__('Storage Space','nggallery').'</h3>';

		if ($settings['used']['display']) {
			$out .= __('Upload Space Used:','nggallery') . "\n";
			$out .= ngg_SpaceManager::buildGraph($settings['used'], $used,$quota,$percentused);
			$out .= "<br />";
		}

		if($settings['remain']['display']) {
			$out .= __('Upload Space Remaining:','nggallery') . "\n";
			$out .= ngg_SpaceManager::buildGraph($settings['remain'], $remaining,$quota,$percentremain);

		}

		$out .= "</div>";

		echo $out;
	}

	function buildGraph($settings, $size, $quota, $percent) {
		$color_bar = $settings['color_bar'];
		$color_bg = $settings['color_bg'];
		$color_text = $settings['color_text'];
		
		switch ($settings['unit']) {
			case "b":
				$unit = "B";
				break;
				
			case "k":
				$unit = "KB";
				$size = $size / 1024;
				$quota = $quota / 1024;
				break;
				
			case "g":   // Gigabytes, really?
				$unit = "GB";
				$size = $size / 1024 / 1024 / 1024;
				$quota = $quota / 1024 / 1024 / 1024;
				break;
				
			default:
				$unit = "MB";
				$size = $size / 1024 / 1024;
				$quota = $quota / 1024 / 1024;
				break;
		}

		$size = round($size, (int)$settings['decimals']);

		$pct = round(($size / $quota)*100);

		if ($settings['graph']) {
			//TODO:move style to CSS
			$out = '<div style="display: block; margin: 0; padding: 0; height: 15px; border: 1px inset; width: 100%; background-color: '.$color_bg.';">'."\n";
			$out .= '<div style="display: block; height: 15px; border: none; background-color: '.$color_bar.'; width: '.$pct.'%;">'."\n";
			$out .= '<div style="display: inline; position: relative; top: 0; left: 0; font-size: 10px; color: '.$color_text.'; font-weight: bold; padding-bottom: 2px; padding-left: 5px;">'."\n";
			$out .= $size.$unit;
			$out .= "</div>\n</div>\n</div>\n";
		} else {
			$out = "<strong>".$size.$unit." ( ".number_format($percent)."%)"."</strong><br />";
		}

		return $out;
	}

}

/**
 * ngg_get_phpinfo() - Extract all of the data from phpinfo into a nested array
 * 
 * @author jon@sitewizard.ca
 * @return array
 */
function ngg_get_phpinfo() {

	ob_start();
	phpinfo();
	$phpinfo = array('phpinfo' => array());
	
	if ( preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER) )
	    foreach($matches as $match) {
	        if(strlen($match[1]))
	            $phpinfo[$match[1]] = array();
	        elseif(isset($match[3]))
	            $phpinfo[end(array_keys($phpinfo))][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
	        else
	            $phpinfo[end(array_keys($phpinfo))][] = $match[2];
	    }
	    
	return $phpinfo;
}
?>