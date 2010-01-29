<?php
$alias = '/'.trim($_GET['alias'],'/');
$idnum = $_GET['itnum'];

$contentdm_post = FALSE;
foreach(get_posts('category=486&numberposts=-1') as $post) {
  if(get_post_meta($post->ID, 'alias', true) == $alias && 
     get_post_meta($post->ID, 'idnum', true) == $idnum) {
    $contentdm_post = $post;
  }
}

if($contentdm_post == FALSE) {
  wp_insert_post();
}

include('../../../../wp-comments-post.php');
