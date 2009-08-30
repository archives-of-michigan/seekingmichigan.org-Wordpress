<h2>Recent Comments</h2>
<? if(count($recent_comments)): ?>
	<ul>
		<? foreach($recent_comments as $comment): ?>
			<li><a href="/?p=<?= $comment->comment_post_ID ?>"><?= $comment->post_title ?></a> &mdash; <?= $comment->excerpt ?></li>
		<? endforeach; ?>
	</ul>
<? else: ?>
	<span class="note">No recent comments</span>
<? endif; ?>