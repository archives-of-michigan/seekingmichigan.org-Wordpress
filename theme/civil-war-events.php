<?php
/*
Template Name: Civil War - events
*/

$js_includes = array('civil_war_search');
$rss = array('/category/civil-war/feed/' => 'Civil War');
$breadcrumbs = array('Civil War' => '');
define("BODY_CLASS","civilwar cw-events");
include('header.php');
?>

<div id="lead-in">
	<h3>Curriculum, Research &amp; Events</h3>
	<p>Participate in the celebration of Michigan's role in the American Civil War.</p>
</div>
<div id="civil-war-search">
	<form method="get" action="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_results.php">
		<input name="CISOBOX1" id="search-text" class="text" value="Enter text" type="text" />
		<input name="CISOOP1" value="all" type="hidden" />
		<input name="CISOFIELD1" value="CISOSEARCHALL" type="hidden" />
		<input name="CISOROOT" value="/p129401coll15" type="hidden" />
		<input name="CISOROOT" value="/p4006coll15" type="hidden" />
		<input name="CISOROOT" value="/p4006coll3" type="hidden" />
		<input src="civil-war_files/search-button.png" id="search-button" name="search-button" value=" " type="image" />
	</form>
</div>
<div id="main-whitebox-left"></div>
<div id="main-whitebox-top"></div>
<div id="main-whitebox-right"></div>

<!-- Start redo of website here -->
<div id="content">
	<div id="title">
		<h3><span class="noshow">Events</span></h3>
	</div>
	<div id="results">
		<ul>
		    <?php
			// $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			$today = date("Y-m-d");
			query_posts(
			    array(
				'post_type' => 'events',
				'posts_per_page' => 10,
				'orderby' => 'meta_value',
				'order' => 'asc',
				'meta_key' => '_event_start_date',
				'meta_value' => $today,
				'meta_compare' => ">="
			    )
			);
		    ?>
		    <?php get_template_part('loop-fullevents');  // Loop template for fuller event listing (loop-fullevents.php) ?>
		    <?php  wp_reset_query(); ?>
		</ul>
	</div>
</div>
<div id="cw-sidebar">
	<div id="calendar">
	
		<?php dynamic_sidebar( 'primary' ); ?>
		
		<p class="more">
			<a class="addyours" href="#">Add Yours</a>
		</p>
	</div>
	<div id="flickr">
		<a href="http://www.flickr.com/groups/1362691@N20/"><h3><span class="noshow">Flickr</span></h3></a>
		<p>View Civil War photographs from the Archives of Michigan and share your own.</p>
		<p class="more">
			<a class="addyours" href="http://www.flickr.com/groups_join.gne?id=1362691@n20">Add Yours</a>
		</p>
	</div>
	<div id="youtube">
		<a href="http://www.youtube.com/user/MICivilWar"><h3><span class="noshow">YouTube</span></h3></a>
		<p>Watch videos of Civil War reenactments and upload your own to share.</p>
		<p class="more">
			<a class="addyours" href="http://www.youtube.com/user/MICivilWar">Add Yours</a>
	</div>
	<div id="blog">
		<a href="/reveille"><h3><span class="noshow">Blog</span></h3></a>
		<p>Share you insights and stories about the Civil War.</p>
	</div>	
</div>
<div id="browse">
	<ul>
		<li class="records">
			<a href="/records"><p>Find original letters, photographs, and military records from the Civil War.</p></a>
		</li>
		<li class="exhibits">
			<a href="/exhibits"><p>Look for upcoming Civil War exhibits and demonstrations around Michigan.</p></a>
		</li>    	
		<li class="links">
			<a href="/links"><p>Connect to Civil War websites of community partners from around the State.</p></a>
		</li>
	</ul>
</div>
<div>
</div>

<? include('footer.php'); ?>
