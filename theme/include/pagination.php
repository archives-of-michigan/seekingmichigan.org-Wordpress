<?php if($paginator->is_paginated()): ?>
<div class="paginate">
  <ul>
    <li class="show-all"><?= $paginator->show_all_link(); ?></li>
    <? if(!$paginator->is_first_page()): ?>
      <li class="previous"><?= previous_posts_link('Previous', 0); ?></li>
    <? endif; ?>
		<? foreach($paginator->pageset as $page_nav_num => $page_nav_link): ?>
			<? if($page_nav_link): ?>
				<li><a href="<?= $page_nav_link; ?>"><?= $page_nav_num; ?></a></li>
			<? else: ?>
				<li><?= $page_nav_num; ?></li>
			<? endif; ?>
		<? endforeach; ?>
    <? if(!$paginator->is_last_page()): ?>
      <li class="next"><?= next_posts_link('Next', 0) ?></li>
    <? endif; ?>
	</ul>
</div>
<? endif; ?>
