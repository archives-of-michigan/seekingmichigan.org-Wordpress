<?php
	if(function_exists('wp_pagenavi'))
		wp_pagenavi();
	else { ?>
			<div class="wp-pagenavi">
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'shiny')); ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'shiny')); ?></div>
			</div>
	<?php }
?>