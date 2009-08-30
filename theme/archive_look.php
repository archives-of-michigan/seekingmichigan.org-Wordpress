<?
/*
Template Name: Archive
*/

$breadcrumbs = array('Look' => '/look', 'Blog Archives' => '');
define("BODY_CLASS","look");
$title = 'Look';
$js_includes = array('widgets');
include('header.php');

# years/months
$raw_dates = $wpdb->get_results("SELECT YEAR(y.post_date) AS `year`, MONTH(y.post_date) AS `month`, COUNT(y.ID) AS `count` 
                                 FROM wp_posts y 
                                 WHERE y.post_status = 'publish' AND y.post_type = 'post' 
                                 GROUP BY YEAR(y.post_date), MONTH(y.post_date)
                                 ORDER BY y.post_date DESC");

$dates = array();
$prev_year = -1;
foreach($raw_dates as $date){
  if($prev_year != $date->year) {
    $dates[$date->year] = array();
  }
  $dates[$date->year][intval($date->month)] = $date->count;
  $prev_year = $date->year;
}

# GLCEs
$glces = get_categories(array(
  'orderby' => 'name', 
  'order' => 'ASC',
  'hierarchical' => 0,
  'hide_empty' => 0,
  'child_of' => 24
));

$num_glces = sizeof($glces);
$midpoint = $num_glces / 2;
if($num_glces > 1) {
  $glce_col1 = array_slice($glces, 0, $midpoint);
  $glce_col2 = array_slice($glces, $midpoint);
} else {
  $glce_col1 = $categories;
  $glce_col2 = array();
}

$gcle_ids = array();
foreach($glces as $glce) {
  $glce_ids[] = $glce->term_id;
}

# categories
$exclude_list = '1,3,4,14,15,22,23,24,28,';
# 22 - Discover
# 23 - Collection
# 3 - Look
# 14 - Featured Look Item
# 4 - Teach
# 1 - Uncategorized
# 24 - GLCE
# 28 - Featured Collection
$exclude_list .= join(',',$glce_ids);

$categories = get_categories(array(
  'orderby' => 'name', 
  'order' => 'ASC',
  'hierarchical' => 0,
	'hide_empty' => 0,
  'exclude' => $exclude_list
));

$num_categories = sizeof($categories);
$midpoint = $num_categories / 2;
if($num_categories > 1) {
  $category_col1 = array_slice($categories, 0, $midpoint);
  $category_col2 = array_slice($categories, $midpoint);
} else {
  $category_col1 = $categories;
  $category_col2 = array();
}

# recommended tags
$recommended_tags = array(9 => 'michigan', 5 => 'flyfishing');

# recently popular tags
$recently_popular_tags = wp_tag_cloud('number=24&orderby=created_on,count&order=DESC&format=array');

# popular tags
$popular_tags = wp_tag_cloud('number=24&orderby=count&order=DESC&format=array');
?>
<div id="section-header">
  <h1><a href="#">Look</a></h1>
  <p>A leisurely Look at Michigan's stories and traditions from yesterday to yesteryear.</p>
</div>
<!-- classing this div is for special pages like 'archive' -->
<div id="main-content" class="archive">
  <div class="wrapper">
    <div id="bydate">
      <h1>Blog Archives</h1>
      <div class="wrapper mod">
        <h2>By Date</h2>
        <p>Browse all Look articles by year and month</p>
        <dl>
          <? foreach($dates as $year => $months): ?>
            <dt><a href="<?= get_year_link($year) ?>" title="<?= $year ?>"><?= $year ?></a>  &raquo;</dt>
              <? foreach($months as $month => $count): ?>
                <? $monthname = date("M", mktime(0, 0, 0, $month)); ?>
                <dd><a href="<?= get_month_link($year,$month) ?>" title="<?= $monthname ?>"><?= $monthname ?></a>&nbsp;(<?= $count ?>)</dd>
              <? endforeach; ?>
          <? endforeach; ?>
        </dl>
      </div>
    </div>
    <div id="bycategory">
      <div class="wrapper">
        <h2>By Category</h2>
        <p>Each article belongs to one or more categories. Browse all articles belonging to each category.</p>
        <ul class="first">
          <? foreach($category_col1 as $category): ?>
            <li><a href="<?= get_category_link($category->term_id); ?>" title="<?= $category->cat_name ?>"><?= $category->cat_name ?></a></li>
          <? endforeach; ?>
        </ul>
        <ul class="second">
          <? foreach($category_col2 as $category): ?>
            <li><a href="<?= get_category_link($category->term_id); ?>" title="<?= $category->cat_name ?>"><?= $category->cat_name ?></a></li>
          <? endforeach; ?>
        </ul>
      </div>
    </div>

    <div id="bytag">
      <div class="wrapper">
        <h2>By Tag</h2>
        <p>Most Look and Teach articles have tags that describe what kind of content they contain.  From here you can find articles by tag.</p>
        <h3>Recommended Tags</h3>
        <p>
          <? foreach($recommended_tags as $term_id => $tag): ?>
            <a href="<?= get_tag_link($term_id); ?>" title="<?= $tag; ?>"><?= $tag; ?></a>
          <? endforeach; ?>
        </p>
        <h3>Recently Popular Tags</h3>
        <p>
          <? foreach($recently_popular_tags as $tag): ?>
            <?= $tag; ?>
          <? endforeach; ?>
        </p>
        <h3>All-Time Popular Tags</h3>
        <p>
          <? foreach($popular_tags as $tag): ?>
            <?= $tag; ?>
          <? endforeach; ?>
        </p>
      </div><!-- end .wrapper -->
      
    </div><!-- end #bytag -->
  
    
    <div id="byglce">
      <div class="wrapper">
        <h2>By GLCE</h2>
        <p>GLCEs are Grade Level Content Expectations used by social studies educators in Michigan. Seeking Michigan provides 
          articles that aid in providing curriculum content to educators.</p>
        <ul class="first">
          <? foreach($glce_col1 as $glce): ?>
            <li><a href="<?= get_category_link($glce->term_id); ?>" title="<?= $glce->cat_name ?>"><?= $glce->cat_name ?></a></li>
          <? endforeach; ?>
        </ul>
        <ul class="second">
          <? foreach($glce_col2 as $glce): ?>
            <li><a href="<?= get_category_link($glce->term_id); ?>" title="<?= $glce->cat_name ?>"><?= $glce->cat_name ?></a></li>
          <? endforeach; ?>
        </ul>
      </div><!-- end .wrapper -->
    </div><!-- end #byglce -->

  </div><!-- end .wrapper -->
</div>  <!-- end #main-content -->

<div id="main-whitebox-left"></div>
<div id="main-whitebox-right"></div>
<?php get_footer(); ?>