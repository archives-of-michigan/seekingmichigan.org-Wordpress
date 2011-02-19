<?php
/*
Template Name: Civil War - links
*/

$js_includes = array('civil_war_search');
$rss = array('/category/civil-war/feed/' => 'Civil War');
$breadcrumbs = array('Civil War' => '');
define("BODY_CLASS","civilwar");
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
		<input src="../images/search-button.png" id="search-button" name="search-button" value=" " type="image" />
	</form>
</div>
<div id="main-whitebox-left"></div>
<div id="main-whitebox-top"></div>
<div id="main-whitebox-right"></div>

<!-- Start redo of website here -->
<div id="content">
	<div id="links-title">
		<h3><span class="noshow">Links</span></h3>
	</div>
	<div id="results">
		<ul>
		   <?php
$bookmarks = get_bookmarks( array(
				'orderby'   => 'name',
				'order'     => 'ASC',
				'category'  => '65'
                          ));

// Loop through each bookmark and print formatted output
foreach ( $bookmarks as $bm ) { 
    echo '<li class="bookmark"><h4><a href="'.$bm->link_url.'" target="'.$bm->link_target.'" rel="'.$bm->link_rel.'">'.$bm->link_name.'</a></h4>';
    echo '<p class="description">'.$bm->link_notes.'</p>';
    echo '<p class="url">'.$bm->link_url.'</p>';
    echo '<div id="details"><ul><li class="share-link"><a class="addthis" title="" rel="" href="http://www.addthis.com/bookmark.php">Share This</a> </li></ul></div></li>';
}
?>
		</ul>
	</div>
</div>
<div id="cw-sidebar">
	<div id="cw-calendar">
	
		<?php dynamic_sidebar( 'primary' ); ?>
		
		<p class="more">
		<?php if (function_exists('post_from_site')) {post_from_site();} else { echo '<a class="addyours" href="#">Add Yours</a>'; } ?>
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
		<p>Share your insights and stories about the Civil War.</p>
	</div>	
</div>
	<div id="browse">
		<ul>
			<li class="records">
				<a href="/records"><h3><span class="noshow">Records</span></h3></a>
				<p><a href="/records">Find original letters, photographs, and military records from the Civil War.</a></p>
			</li>
			<li class="exhibits">
				<a href="/exhibits"><h3><span class="noshow">Exhibits</span></h3></a>
				<p><a href="/exhibits">Look for coming Civil War exhibits and demonstrations around Michigan.</a></p>
			</li>    	
			<li class="links">
				<a href="/links"><h3><span class="noshow">Links</span></h3></a>
				<p><a href="/links">Connect to Civil War websites of community partners from around the State.</a></p>
			</li>
		</ul>
	</div>
<div>
</div>

<? include('footer.php'); ?>
