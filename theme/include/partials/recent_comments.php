<?php
$sql = "SELECT DISTINCT p.post_title, c.comment_ID, c.comment_post_ID, 
          SUBSTRING(c.comment_content,1,100) AS excerpt 
        FROM $wpdb->comments c
          INNER JOIN $wpdb->posts p ON (c.comment_post_ID = p.ID)
          INNER JOIN $wpdb->term_relationships tr ON (p.ID = tr.object_id)
          INNER JOIN $wpdb->term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
          INNER JOIN $wpdb->terms t ON (tt.term_id = t.term_id)
        WHERE t.name = '$category' AND tt.taxonomy = 'category' AND
          c.comment_approved = '1' AND p.post_password = '' 
        ORDER BY c.comment_date_gmt DESC 
        LIMIT $num";
$recent_comments = $wpdb->get_results($sql);
?>
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
