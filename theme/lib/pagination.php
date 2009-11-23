<?php
class Pagination {
  function __construct($wp_query, $category_name) {
    $this->options = array();
    $this->category_name = $category_name;
    
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $this->current_page = intval(get_query_var('paged'));
    $pagination_options = get_option('pagination_options');
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if(empty($this->current_page) || $this->current_page == 0) {
      $this->current_page = 1;
    }
    $pages_to_show = intval($pagination_options['num_pages']);
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $this->current_page - $half_page_start;
    if($start_page <= 0) {
      $start_page = 1;
    }
    $end_page = $this->current_page + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
      $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
      $start_page = $max_page - $pages_to_show_minus_1;
      $end_page = $max_page;
    }
    if($start_page <= 0) {
      $start_page = 1;
    }
    
    $this->options['first_page'] = FALSE;
    $this->options['last_page'] = FALSE;
    $this->options['max_pages'] = $max_page;
    $this->options['display_num_pages'] = $pages_to_show;
    
    $this->pageset = array();
    
    if ($start_page >= 2 && $pages_to_show < $max_page) {
      $this->options['first_page'] = clean_url(get_pagenum_link());
    }
    for($i = $start_page; $i  <= $end_page; $i++) {
      if($i == $this->current_page) {
        $this->pageset[$i] = FALSE;
      } else {
        $this->pageset[$i] = get_pagenum_link($i);
      }
    }
    if ($end_page < $max_page) {
      $this->options['last_page'] = get_pagenum_link($max_page);
    }
  }

  public $category_name;
  public $options;  // rejected by Republicans
  public $current_page;
  public $pageset;

  public function is_paginated() {
    return($this->options['max_pages'] > 0);
  }
  public function is_first_page() {
    return($this->options['first_page'] !== FALSE);
  }
  public function is_last_page() {
    return($this->options['last_page'] !== FALSE);
  }

  public function show_all_link() {
    return "<a href=\"/".$this->category_name."?all=true\">Show All</a>";
  }
}
