<?php
require_once(dirname(__FILE__).'/../../lib/civil_war_photo_list.php');
$flickr_photos = new CivilWarPhotoList($num);
?>
<h2 class="photos"><a href="#">Photos &amp; Imagery</a></h2>
<ul class="flickr">
  <? foreach ($flickr_photos->photos() as $photo): ?>
    <li>
      <a href="http://www.flickr.com/photos/<?= $photo['owner']; ?>/<?= $photo['id']; ?>/">
        <img src="<?= $flickr_photos->thumbnail_for($photo); ?>" height="75px" width="75px" style="background-color: #aaa" alt="<?= $photo['title'] ?>" />
      </a>
    </li>
  <? endforeach; ?>
</ul>
<p class="more">
  <a href="http://www.flickr.com/groups/1362691@N20/" class="logo-link">
    <img src="/images/flickr-logo-color.gif" alt="flickr-logo" /></a>
  <a href="http://www.flickr.com/groups_join.gne?id=1362691@n20" class="addyours">Add Yours</a> 
</p>
