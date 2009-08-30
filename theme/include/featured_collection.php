<h3>
  <? if($collection['image']): ?>
    <img src="<?= $collection['image']; ?>" alt="Photo for <?= $collection['name']; ?>" />
  <? endif; ?>
  <a href="<?= $collection['wp_url']; ?>" title="View <?= $collection['name']; ?>"><?= $collection['name']; ?></a>
</h3>
<p><?= $collection['description']; ?></p>
<p><a href="<?= $collection['wp_url']; ?>" title="About">About</a>  |  <a href="<?= $collection['cdm_url']; ?>" title="View Collection">View Collection</a></p>