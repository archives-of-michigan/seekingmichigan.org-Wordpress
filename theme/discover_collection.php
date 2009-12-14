<?
/*
Template Name: Discover Collection
*/
$collection_alias = '/'.trim($_GET['collection'],'/');

require_once('settings.php');
require_once('lib/content_dm.php');
$contentdm = new ContentDM(CONTENTDM_HOSTNAME, CONTENTDM_ROOT_PATH, CONTENTDM_AJAX_PATH);

$cdm_collection = $contentdm->collectionInfo($collection_alias);
if($cdm_collection === FALSE) {
  header('Location: http://seekingmichigan.org/404.php');
}
$collection_post = FALSE;
foreach(get_posts('category=23,28,44&numberposts=-1') as $post) {
  if(get_post_meta($post->ID, 'alias', true) == $_GET['collection']) {
    $collection_post = $post;
  }
}

$collection = create_collection($collection_post, $contentdm, array($cdm_collection));

$featured_items = $contentdm->featured_items_for_collection($collection_alias);

$breadcrumbs = array('Discover' => '/discover', 'Collections' => '/discover', $collection['name'] => '');
define("BODY_CLASS","discover");
include('header.php');
?>
<div id="section-header">
  <h1><a href="/discover">Discover</a></h1>
</div>
<div id="main-content">
  <div class="wrapper">
    <div  class="collection-intro ">
      <div class="wrapper">
        <h2>Collection: <a href="<?= $collection['cdm_url'] ?>" title="<?= $collection['name'] ?> Collection"><?= $collection['name'] ?></a></h2>
        <ul class="collection-thumbs">
          <? if($collection['image']): ?>
            <? $url = $collection['image_url'] ? $collection['image_url'] : $collection['cdm_url'] ?>
            <li class="thumb1"><a href="<?= $url ?>"><img src="<?= $collection['image'] ?>" alt="main thumbnail" /></a></li>
          <? endif; ?>
          <? if($collection['image2']): ?>
            <? $url = $collection['image2_url'] ? $collection['image2_url'] : $collection['cdm_url'] ?>
            <li class="thumb2"><a href="<?= $url ?>"><img src="<?= $collection['image2'] ?>" alt="secondary thumbnail" /></a></li>
          <? endif; ?>
          <? if($collection['image3']): ?>
            <? $url = $collection['image3_url'] ? $collection['image3_url'] : $collection['cdm_url'] ?>
            <li class="thumb3"><a href="<?= $url ?>"><img src="<?= $collection['image3'] ?>" alt="tertiary thumbnail" /></a></li>
          <? endif; ?>
        </ul>
        <p><?= $collection['description'] ?></p>
        <ul class="page-actions mod">
          <li class="view-collection"><a href="<?= $collection['cdm_url'] ?>">View Collection</a></li>
          <li class="share-this"><!-- AddThis Button BEGIN --><script type="text/javascript">addthis_pub  = 'seekingmichigan'; addthis_offset_top = -10; addthis_offset_left = 5; addthis_options = 'delicious, email, digg, facebook, google, technorati, twitter, myspace,  more';</script><a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()">Share This</a><script type="text/javascript" src="http://s7.addthis.com/js/152/addthis_widget.js"></script><!-- AddThis Button END --></li>
        </ul>
    
        <form method="get" action="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_results.php">
          <input type="hidden" name="CISOOP1" value="any" />
          <input type="hidden" name="CISOFIELD1" value="CISOSEARCHALL" />
          <input type="hidden" name="CISOROOT" value="<?= $collection_alias ?>">
      
          <label for="CISOBOX1" class="hidden">Seek: </label>
          <input type="text" id="search-collection-string" name="CISOBOX1" />
          <label for="search-collection-button" class="hidden">Search </label>
          <input type="image" id="search-collection-button" value=" " src="/images/search-button.png" />
        </form>
        <p class="advanced-search"><a href="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_advanced.php">Advanced Search &raquo; </a></p>   
      </div>
    </div>
    <div  class="featured in-collection">
      <div class="wrapper mod">
        <h2>Featured Items</h2>
        <? if(count($featured_items) > 0): ?>
          <ul class="col1 color">
            <? $row = 'odd'; ?>
            <? foreach($featured_items as $item): ?>
              <li class="<?= $row ?> mod">
                <h3> 
                  <a href="<?= $item->url ?>" title="View Result">
                    <img src="<?= $item->thumbnail ?>" alt="thumbnail" />
                    <?= $item->Title ?>
                  </a>
                </h3>
                <p class="byline"><?= $item->descri ?></p>
              </li>
              <? $row = ($row == 'odd') ? 'even' : 'odd'; ?>
            <? endforeach; ?>
          </ul>
        <? else: ?>
          No featured items
        <? endif ?>
      </div>
    </div>
    <div  class="recent-related">
      <div class="wrapper">
        <h2>Recent Related Blog Entries</h2>
        <ul class="blog-entries">
          <? query_posts('tag='.$collection_alias); ?>
          <? if(have_posts()): ?>
            <? while(have_posts()) : the_post(); ?>
              <li>
                <h3> <a href="<?= the_permalink(); ?>" title="View <?= the_title(); ?>"><?= the_title(); ?></a></h3>
                <p class="byline">By <a href="<?= the_author_url(); ?>"><? the_author() ?></a> | <span class="date"><?= the_date('F j, Y'); ?></span></p>
                <p><?= the_excerpt(); ?></p>
                <p><a href="<?= the_permalink(); ?>">Read more&hellip;</a></p>
              </li>
            <? endwhile; ?>
          <? else: ?>
            <li>No entries posted yet</li>
          <? endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<? include('footer.php'); ?>
