<?php

class CivilWarReveilleList {
  public static function grouped_by_date() {
    $reveille_dates = array();
    foreach(get_posts('category_name=reveille&numberposts=5') as $post) {
      $date = new DateTime($post->post_date);
      $date_string = $date->format('F j, Y');
      if(!$reveille_dates[$date_string]) {
        $reveille_dates[$date_string] = array();
      }
      $reveille_dates[$date_string][] = $post;
    }

    return $reveille_dates;
  }
}
