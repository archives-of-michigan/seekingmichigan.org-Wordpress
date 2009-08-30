<? paginate(); ?>
<? if($pagination['max_pages'] > 0): ?>
<div class="paginate">
	<ul>
		<li class="show-all"><a href="/look?all=true">Show All</a></li>
		<? if($pagination['first_page'] !== FALSE): ?><li class="previous"><?= previous_posts_link('Previous', 0); ?></li><? endif; ?>
		<? foreach($pagination['pageset'] as $page_nav_num => $page_nav_link): ?>
			<? if($page_nav_link): ?>
				<li><a href="<?= $page_nav_link; ?>"><?= $page_nav_num; ?></a></li>
			<? else: ?>
				<li><?= $page_nav_num; ?></li>
			<? endif; ?>
		<? endforeach; ?>
		<? if($pagination['last_page'] !== FALSE): ?><li class="next"><?= next_posts_link('Next', 0) ?></li><? endif; ?>
	</ul>
</div>
<? endif; ?>