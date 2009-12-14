<?php
include('vendor/framework/lib/application.php');
$SM_APP = new Application;

function app() {
  global $SM_APP;
  return $SM_APP;
}

function recent_articles($category, $num) {
	global $recent_articles;
	$recent_articles = get_posts(array('category__and' => array($category), 'category__not_in' => array(14,15), 'numberposts' => 5));
	
	include('include/recent_articles.php');
}

function recent_comments($category, $num) {
	global $wpdb;
	
	$sql = "SELECT DISTINCT p.post_title, c.comment_ID, c.comment_post_ID, 
						SUBSTRING(c.comment_content,1,100) AS excerpt 
					FROM $wpdb->comments c
						INNER JOIN $wpdb->posts p ON (c.comment_post_ID = p.ID)
						INNER JOIN $wpdb->term_relationships tr ON (p.ID = tr.object_id)
						INNER JOIN $wpdb->term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
						INNER JOIN $wpdb->terms t ON (tt.term_id = t.term_id)
					WHERE t.name = '$category' AND tt.taxonomy = 'category' AND
						c.comment_approved = '1' AND p.post_password = '' 
					ORDER BY c.comment_date_gmt DESC 
					LIMIT $num";
	global $recent_comments;
	$recent_comments = $wpdb->get_results($sql);
	
	include('include/recent_comments.php');
}

function featured_article($category, $title) {
	global $featured_article, $heading;
	$featured_article = get_posts("category_name=$category&numberposts=1");
	$heading = $title;
	
	include('include/featured_article.php');
}

function create_collection($collection_post, $contentdm, $cdm_collections) {
  $post_alias = get_post_meta($collection_post->ID, 'alias', true);
  $trimmed_post_alias = trim($post_alias,'/');
  
  $cdm_collection = collection_for_post($cdm_collections, $trimmed_post_alias);
  if($cdm_collection === FALSE) { return FALSE; }
  
  
  $collection = array('name' => $cdm_collection->name, 
                      'cdm_url' => $contentdm->url_for_collection_alias('/'.$trimmed_post_alias),
                      'wp_url' => '/discover-collection?collection='.$trimmed_post_alias,
                      'alias' => $trimmed_post_alias);
  if(isset($cdm_collection->full_res_info) && isset($cdm_collection->full_res_info->archivesize)) {
    $collection['width'] = $cdm_collection->full_res_info->archivesize->width;
    $collection['height'] = $cdm_collection->full_res_info->archivesize->height;
  }
  
  $collection['image'] = get_post_meta($collection_post->ID, 'Image', true);
  $collection['image_url'] = get_post_meta($collection_post->ID, 'Image URL', true);
  $collection['image2'] = get_post_meta($collection_post->ID, 'Image2', true);
  $collection['image2_url'] = get_post_meta($collection_post->ID, 'Image2 URL', true);
  $collection['image3'] = get_post_meta($collection_post->ID, 'Image3', true);
  $collection['image3_url'] = get_post_meta($collection_post->ID, 'Image3 URL', true);
  $collection['description'] = $collection_post->post_content;
  $collection['byline'] = get_post_meta($collection_post->ID, 'Byline', true);
  
  return $collection;
}

function collection_for_post($collections, $post_alias) {
  foreach($collections as $collection) {
    if(strtolower($collection->alias) == '/'.strtolower($post_alias)) {
      return $collection;
    }
  }
  
  return FALSE;
}

function share_this($url, $title) {
  $isgd_url = 'http://is.gd/api.php?longurl='.$url;
  $curl_handle = curl_init($isgd_url);
  curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
  $url = curl_exec($curl_handle);
  curl_close($curl_handle);
  
  include('include/share.php');
}

function flickr($account, $friendly_user, $num_items = 8) {
  include('include/flickr.php');
}

function comments() {
  include('comments_list.php');
}
?>
