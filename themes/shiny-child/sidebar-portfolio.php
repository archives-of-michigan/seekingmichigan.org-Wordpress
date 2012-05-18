<?php
/**
 * Portfolio sidebar.
 *
 */

global $e404_options;

if(!dynamic_sidebar(e404_get_sidebar_name('portfolio'))) :
	e404_subpages_nav(); ?>

			<div class="widgets categories-widget">
				<h3><?php echo e404_get_taxonomy_name('categories'); ?></h3>
				<ul class="arrow-gray">
    			<?php wp_list_categories('title_li=&taxonomy=portfolio-category'); ?>
				</ul>
			</div>
			<div class="widgets">
				<h3><?php echo e404_get_taxonomy_name('tags') ?></h3>
				<div class="tags-meta">
				<?php
				$tags = get_terms('portfolio-tag');
				$html = '';
				foreach ($tags as $tag) {
					$tag_link = get_term_link($tag, $tag->taxonomy);
					$html .= "<a href='{$tag_link}' title='{$tag->name}' class='{$tag->slug}'>";
					$html .= "{$tag->name}</a>";
				}
				echo $html;
				?>
				</div><br class="clear" />
			</div>

<?php endif; ?>
