<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<div id="post-comments">
	<h3>Comments</h3>
	<?php if ($comments) : ?>
		<ol>
			<? foreach ($comments as $comment): ?>
				<li id="comment-<? comment_ID() ?>" class="vcard">
					<h4 class="fn url"><a href="<? comment_author_link() ?>"><?= get_avatar($comment, 54 ); ?> <? comment_author(); ?> </a></h4>
					<?php if ($comment->comment_approved == '0') : ?><em>Your comment is awaiting moderation.</em><? endif; ?>
					<p class="comment-date"><a href="#comment-<? comment_ID() ?>" title="Permalink for this comment"><?php comment_date('F jS, Y') ?> : <?php comment_time() ?></a> <?php edit_comment_link('edit','&nbsp;&nbsp;',''); ?></p>
					<div class="comment">
						<? comment_text() ?>
					</div>
				</li>
			<? endforeach; ?>
			</ol>
	<? else: ?>
		<?php if ('open' == $post->comment_status) : ?>
			<p class="nocomments">No comments.</p>
		<?php else : // comments are closed ?>
			<p class="nocomments">Comments are closed.</p>
		<?php endif; ?>
	<? endif; ?>
</div><!-- /end #post-comments -->

<? if ('open' == $post->comment_status) : ?>
	<? if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p>You must be <a href="<?= get_option('siteurl'); ?>/wp-login.php?redirect_to=<?= urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
	<? else : ?>	
		<div id="reply">
			<form action="<?= get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment-form">
				<h3>Add Comment</h3>
				
				<? if ( $user_ID ) : ?>
					<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>
				<? else : ?>
					<label for="author" class="required" accesskey="n">Name</label>
					<input type="text" name="author" id="author" tabindex="1" />
					
					<label for="email" class="required" accesskey="e">Email</label>
					<input type="text" name="email" id="email" tabindex="2" />

					<label for="url">Website</label>
					<input type="text" name="url" id="url" tabindex="3" />
				<? endif; ?>
				
				<label for="comment" class="required" accesskey="c">Comment</label>
				<textarea name="comment" id="comment" rows="10" tabindex="4" cols=" "></textarea>

				<input name="reset" type="reset" id="reset-comment" tabindex="6" value="" />
				<input name="submit" type="submit" id="submit-comment" tabindex="5" value="" />
				
				<input type="hidden" name="comment_post_ID" value="<?= $id; ?>" />
				
				<?php do_action('comment_form', $post->ID); ?>
			</form>
		</div><!-- /end #reply -->
	<? endif; // If registration required and not logged in ?>
<? endif; // if you delete this the sky will fall on your head ?>
