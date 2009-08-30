<li class="mod">
  <h3>
    <a href="<?= $collection['wp_url'] ?>" title="View <?= $collection['name']; ?>">
      <? if($collection['image']): ?>
        <img src="<?= $collection['image']; ?>" alt="Photo for <?= $collection['name']; ?>" />
      <? endif; ?>
      <?= $collection['name'] ?>
    </a>
  </h3>
  <p class="byline"><?= $collection['byline']; ?></p>
  <p><?= $collection['description']; ?></p>
</li>