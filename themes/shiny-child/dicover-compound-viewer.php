<?php
/**
 * Template name: Compound viewer in Discover
 *
 */

get_header(); ?>
	
	<div id="wrapper" class="sidebar-right-wrapper">
		<div id="wrapper_inner">
	
		<div class="portfolio-nav">
			<div class="portfolio-header">
				<h2>Item Title Goes Here</h2>
				<h4>Subtitle Goes Here with a Page #</h4>
			</div>
			<ul>
				<li class="portfolio-all"><a href="#">all search results</a></li>
				<li class="portfolio-btns"><a href="http://localhost:8888/wordpress/portfolio/civil-war-service-records/" class="prev browse arrowleft"><span>prev</span></a></li>
				<li><p>1 of 14890</p></li>
				<li class="portfolio-btns"><a href="http://localhost:8888/wordpress/portfolio/films/" class="next browse arrowright"><span>next</span></a></li>
			</ul>
			<br class="clear">
			<hr class="divider-dotted">
			<div class="portfolio-btns">
				<ul>
					<li><a class="small-btn gradient-btn" href=""><span><img src="http://localhost:8888/wordpress/wp-content/themes/shiny-child/images/bullets/plus.png" alt="" /> share this</span></a></li>
					<li><a class="small-btn gradient-btn" href=""><span><img src="http://localhost:8888/wordpress/wp-content/themes/shiny-child/images/bullets/link.png" alt="" /> copy link</span></a></li>
					<li><a class="small-btn gradient-btn" href=""><span><img src="http://localhost:8888/wordpress/wp-content/themes/shiny-child/images/bullets/download.png" alt="" />Download</span></a></li>
					<li><a class="small-btn gradient-btn" href=""><span><img src="http://localhost:8888/wordpress/wp-content/themes/shiny-child/images/bullets/write.png" alt="" /> Print</span></a></li>
				</ul>
			</div>
		</div>
		<br class="clear">
		<?php if($e404_options['breadcrumbs']) : ?><div id="breadcrumb"><?php e404_breadcrumbs(); ?></div><?php endif; ?>
		<br class="clear" />
	
		<div id="page-content" class="three_fourth">
		
		<div id="item-viewer">
		<div id="featured compound">
			<div id="featured_border">
				<div id="featured_inner">
					<img src="http://localhost:8888/wordpress/wp-content/themes/shiny-child/lib/timthumb.php?src=http://localhost:8888/wordpress/wp-content/uploads/2012/04/bg_viewer.png&amp;w=652&amp;h=500&amp;zc=1" alt="" />
				</div>
			</div>
		</div>
	
		<div class="portfolio-nav">
		<div class="portfolio-header metadata">
			<h2 class="icon-box icon-big"><img src="http://localhost:8888/wordpress/wp-content/themes/shiny-child/images/icons/black/tag.png" class="icon transparent" alt="Metadata" />Metadata<span>a description of the item</span></h2>
		</div>
		<div class="portfolio-btns">
			<ul>
				<li><a class="small-btn gradient-btn" href=""><span><img src="http://localhost:8888/wordpress/wp-content/themes/shiny-child/images/bullets/tag.png" alt="" /> add tag</span></a></li>
				<li><a class="small-btn gradient-btn" href=""><span><img src="http://localhost:8888/wordpress/wp-content/themes/shiny-child/images/bullets/bubbles.png" alt="" /> add comment</span></a></li>
				<li><a class="small-btn gradient-btn" href=""><span><img src="http://localhost:8888/wordpress/wp-content/themes/shiny-child/images/bullets/rating.png" alt="" /> add rating</span></a></li>
			</ul>
		</div>
		</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="page-layout">
				<?php the_content(); ?>

				<?php if(!is_attachment() && $e404_options['page_comments']) {
					comments_template('', true);
				} ?>
			</div>
		</div>
		</div>
<?php endwhile; ?>
			
			<?php get_template_part('navigation'); ?>

		</div>
		<div id="sidebar" class="one_fourth last sidebar-right">
			<ul class="tabs group">
				<li class="current"><a href="#" class="tab">Thumbnails</a></li>
				<li><a href="#" class="tab">Content</a></li>
			</ul>
			<div class="tab_content light-box" style="position: absolute; left: -10000px;">
				<p>
				Image Page 1<br />
				Image Page 2<br />
				Image Page 3
				</p>
			</div>
			<div class="tab_content light-box" style="position: absolute; left: -10000px;">
				<p>
				Page 1<br />
				Page 2<br />
				Page 3
				</p>
			</div>
		</div>
		<br class="clear" />
		</div>
	</div>

<?php get_footer(); ?>
