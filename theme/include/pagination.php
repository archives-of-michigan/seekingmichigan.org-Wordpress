<?php # Note: $pagniator is defined in category.php ?>
<?php if($paginator->is_paginated()): ?>
<div class="paginate">
  <ul>
    <li class="show-all">
      <a href="<?= $paginator->show_all_url(); ?>">Show All</a>
    </li>
    <? if($paginator->show_prev_link()): ?>
      <li class="previous"><a href="<?= $paginator->prev_link(); ?>">Previous</a></li>
    <? endif; ?>
		<? foreach($paginator->pageset as $page_nav_num => $page_nav_link): ?>
			<? if($page_nav_link): ?>
				<li><a href="<?= $page_nav_link; ?>"><?= $page_nav_num; ?></a></li>
			<? else: ?>
				<li><?= $page_nav_num; ?></li>
			<? endif; ?>
		<? endforeach; ?>
    <? if($paginator->show_next_link()): ?>
      <li class="next"><a href="<?= $paginator->next_link(); ?>">Next</a></li>
    <? endif; ?>
	</ul>
</div>
<? endif; ?>
