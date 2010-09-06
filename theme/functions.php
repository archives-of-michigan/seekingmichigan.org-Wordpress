<?php
include('include/tiny_mce.php');
include('vendor/framework/lib/application.php');
$SM_APP = new Application;

function app() {
  global $SM_APP;
  return $SM_APP;
}

app()->add_partial_root('sm_include_partials', dirname(__FILE__).'/include/partials');

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
  
  app()->partial('share');
}

function comments() {
  include('comments_list.php');
}
