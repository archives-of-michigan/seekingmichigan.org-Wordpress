<?php $links = get_linkobjectsbyname('Civil War'); ?>

<h2 class="links"><a id="resources_and_links">Resources &amp; Links</a></h2>
<ul>
  <? foreach($links as $link): ?>
    <li><h4><a href="<?= $link->link_url; ?>"><?= $link->link_name; ?></a></h4></li>
  <? endforeach; ?>
</ul>
