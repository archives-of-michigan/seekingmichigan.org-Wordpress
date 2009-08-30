<?
$featured_item = get_posts("category=44&numberposts=1");

if($featured_item) {
  $collection_alias = '/'.get_post_meta($featured_item[0]->ID, 'alias', true);
  
  require_once(realpath(dirname(__FILE__)).'/../settings.php');
  require_once(realpath(dirname(__FILE__)).'/../lib/content_dm.php');
  $contentdm = new ContentDM(CONTENTDM_HOSTNAME, CONTENTDM_ROOT_PATH, CONTENTDM_AJAX_PATH);
  $cdm_collection = $contentdm->collectionInfo($collection_alias);

  if($cdm_collection !== FALSE) {
    $home_collection = create_collection($featured_item[0], $contentdm, array($cdm_collection));
  }
}
?>
<? if($featured_item && $home_collection): ?>
  <h3>
    <a href="<?= $home_collection['wp_url'] ?>" title="<?= $home_collection['name'] ?>">
      <?= $home_collection['name'] ?>
    </a>
  </h3>
  <p class="feature-photo">
    <? if($home_collection['image']): ?>
      <img src="<?= $home_collection['image'] ?>" alt="Image for <?= $home_collection['name'] ?>" />
    <? endif; ?>
  </p>
  <p><?= $home_collection['description'] ?></p>
  <p>
    <a href="/discover-collection?collection=<?= $home_collection['alias'] ?>" title="Read more">Read more »</a>  |  
    <a href="/discover" title="View more collections">View more collections »</a>
  </p>
<? else: ?>
  <span class="note">No featured collection</span>
<? endif; ?>