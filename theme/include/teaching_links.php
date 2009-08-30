<?
$links = get_linkobjectsbyname('Teach');
$count = 1;
?>
<h2>Teaching With&hellip;</h2>
<? if(count($links) > 0): ?>
	<ul class="dividers">
		<? foreach($links as $link): ?>
			<li<? if($count == count($links)): ?> class="last"<? endif; ?>>
				<a href="<?= $link->link_url; ?>"><?= $link->link_name; ?></a> &mdash; <?= $link->link_description; ?>
			</li>
			<? $count = $count + 1; ?>
		<? endforeach; ?>
	</ul>
<? endif; ?>