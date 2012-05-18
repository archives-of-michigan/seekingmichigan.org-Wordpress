<?php
/**
 * Blog sidebar.
 *
 */

if(!dynamic_sidebar(e404_get_sidebar_name('blog'))) : ?>
			<div class="widgets categories-widget">
				<h3><?php _e('Categories', 'shiny'); ?></h3>
				<ul class="arrow-green">
    			<?php wp_list_categories('title_li='); ?>
				</ul>
			</div>
			<div class="widgets">
				<h3><?php _e('Tags', 'shiny'); ?></h3>
				<div class="tags-meta">
				<?php
				$tags = get_tags();
				$html = '';
				foreach ($tags as $tag) {
					$tag_link = get_tag_link($tag->term_id);
					$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
					$html .= "{$tag->name}</a>";
				}
				echo $html;
				?>
				</div><br class="clear" />
			</div>
<?php endif; ?>
