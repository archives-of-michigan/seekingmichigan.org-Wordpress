<h2><?= $heading; ?></h2>
<? if(count($featured_article)): ?>
  <? foreach($featured_article as $item): ?>
    <div class="item">
      <? 
        $image = get_post_meta($item->ID, 'Image', true);
        $byline = get_post_meta($item->ID, 'Byline', true);
      ?>
      <? if($image): ?>
        <p class="float-photo left"><img src="<?= $image; ?>" alt="story image" style="width: 79px;" /></p>
      <? endif; ?>
      <h3><a href="<?= get_permalink($item->ID); ?>" title="Read more"><?= $item->post_title; ?></a></h3>
      <? if($byline): ?>
        <p class="byline"><?= $byline; ?></p>
      <? endif; ?>
      <p><?= $item->post_excerpt; ?></p>
    </div>
  <? endforeach; ?>
<? else: ?>
  <span class="note">No featured items</span>
<? endif; ?>