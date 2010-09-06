<?php
$recent_articles = get_posts(array(
  'category__and' => array($category),
  'category__not_in' => array(14,15),
  'numberposts' => $num));
?>
<h2>Recent Articles</h2>
<? if(count($recent_articles)): ?>
	<ul>
		<? foreach($recent_articles as $post): ?>
			<li><a href="<?= get_permalink($post->ID); ?>"><?= $post->post_title; ?></a></li>
		<? endforeach; ?>
	</ul>
<? else: ?>
	<span class="note">No recent articles</span>
<? endif; ?>
