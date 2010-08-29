<?php $links = get_linkobjectsbyname($category); ?>
<ul>
  <? foreach($links as $link): ?>
    <li>
      <? if($h4): ?>
        <h4>
      <? endif; ?>
      <a href="<?= $link->link_url; ?>"><?= $link->link_name; ?> &raquo;</a>
      <? if($h4): ?>
        </h4>
      <? endif; ?>
    </li>
  <? endforeach; ?>
</ul>
