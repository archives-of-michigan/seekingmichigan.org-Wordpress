<?
/*
Template Name: Discover
*/

function show_featured_collection($collection) {
  include('include/featured_collection.php');
}

function show_collection($collection) {
  include('include/collection.php');
}

$breadcrumbs = array('Discover' => '/discover', 'Collections' => '', );
define("BODY_CLASS","discover");
include('header.php');

require_once('settings.php');
require_once('lib/content_dm.php');
$contentdm = new ContentDM(CONTENTDM_HOSTNAME, CONTENTDM_ROOT_PATH, CONTENTDM_AJAX_PATH);

$featured_collection_posts = get_posts('category=28&numberposts=4');
$non_featured_collection_posts = get_posts('category=23&numberposts=-1');


# All collections
$cdm_collections = $contentdm->getCollectionsWithMetaData();

$top_four_list = array();

$num_collections = count($featured_collection_posts);
$num_pairs = 2;
$j = 0;
for($i = 0; $i < 2; $i++) {
  $class = ''; 
  if($i == 0) {
    $class = 'first';
  } elseif($i == 2) {
    $class = 'last';
  }
  
  $pair = array('class' => $class, 'right' => FALSE);
  $pair['left'] = create_collection($featured_collection_posts[$j], $contentdm, $cdm_collections);
  
  if($j + 1 < $num_collections) { 
    $pair['right'] = create_collection($featured_collection_posts[$j + 1], $contentdm, $cdm_collections);
  }
  array_push($top_four_list, $pair);
  
  $j += 2;
}

# other collections
$other_collections_list = array(
  array('class' => 'col0', 'entries' => array()), 
  array('class' => 'col1', 'entries' => array()), 
  array('class' => 'last', 'entries' => array()));

$num_other_items = count($non_featured_collection_posts);

for($i = 0; $i < $num_other_items; $i++) {
  $colnum = $i % 3;
  $collection_post = $non_featured_collection_posts[$i];
  $other_collections_list[$colnum]['entries'][] = create_collection($collection_post, $contentdm, $cdm_collections);
}
?>

<div id="section-header">
  <h1><a href="/discover">Discover</a></h1>
</div>
<div id="main-content">
  <div class="wrapper">
    <div  class="collections">
      <div class="wrapper">
        <h2>About Discover</h2>
        <p class="intro">
          <? if(have_posts()) : while(have_posts()) : the_post(); ?>
            <?php the_content(); ?>
          <? endwhile; endif; ?>
        </p>
        <div class="grid">
          <h2>Featured Items</h2>
          <? foreach($top_four_list as $collection): ?>
            <ul <? if($collection['class'] != ''): ?>class="<?= $collection['class'] ?>"<? endif; ?>>
              <li class="odd mod">
                <? show_featured_collection($collection['left']); ?>
              </li>
              <? if($collection['right'] !== FALSE): ?>
                <li class="even mod">
                  <? show_featured_collection($collection['right']); ?>
                </li>
              <? endif; ?>
            </ul>
          <? endforeach; ?>
        </div>
      </div>
    </div>

    <div  class="featured">
      <div class="wrapper">
        <h2>More Collections</h2>
        <? foreach($other_collections_list as $group): ?>
          <ul class="<?= $group['class']; ?>">
            <? foreach($group['entries'] as $entry): ?>
              <? show_collection($entry) ?>
            <? endforeach; ?>
          </ul>
        <? endforeach; ?>
      </div>
    </div>
  </div>
</div>
<? include('footer.php'); ?>