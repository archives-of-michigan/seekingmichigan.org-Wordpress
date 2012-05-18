<?php
if($e404_all_options['e404_remove_generator'] == 'true')
    remove_action('wp_head', 'wp_generator');

if($e404_all_options['e404_remove_feeds'] == 'true')
    remove_action('wp_head', 'feed_links', 2);

if($e404_all_options['e404_remove_extra_feeds'] == 'true')
    remove_action('wp_head', 'feed_links_extra', 3);
    
if($e404_all_options['e404_remove_rsd'] == 'true')
    remove_action('wp_head', 'rsd_link');
    
if($e404_all_options['e404_remove_wlw'] == 'true')
    remove_action('wp_head', 'wlwmanifest_link');

if($e404_all_options['e404_remove_nav_links'] == 'true') {
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
}

?>