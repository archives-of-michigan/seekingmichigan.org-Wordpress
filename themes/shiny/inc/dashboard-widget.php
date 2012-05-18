<?php
function e404_dashboard_widget() {
	?>
	<div class="rss-widget">
		<ul>
	<?php
	$tweets = e404_get_tweets('e404themes', 5);
	foreach($tweets as $tweet) {
		echo '<li>'.twitter_hyperlinks($tweet['text']);
		echo '<span class="rss-date"><a href="http://twitter.com/e404themes/status/'.$tweet['id'].'">'.$tweet['time'].'</a></span></li>';
	}
	?>
		</ul>
		<a class="rsswidget" href="http://twitter.com/e404themes">Follow us on Twitter</a>
	</div>
	<?php
}

function e404_add_dashboard_widget() {
	wp_add_dashboard_widget('e404_dashboard_widget', 'News from e404 Themes', 'e404_dashboard_widget');
	global $wp_meta_boxes;
	
	$left_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	$right_dashboard = $wp_meta_boxes['dashboard']['side']['core'];
	
	$my_widget = array('e404_dashboard_widget' => $left_dashboard['e404_dashboard_widget']);
	 
	unset($left_dashboard['e404_dashboard_widget']);
	
	$right_dashboard = array_merge($my_widget, $right_dashboard);
	
	$wp_meta_boxes['dashboard']['normal']['core'] = $left_dashboard; 
	$wp_meta_boxes['dashboard']['side']['core'] = $right_dashboard;
}
add_action('wp_dashboard_setup', 'e404_add_dashboard_widget');

?>
