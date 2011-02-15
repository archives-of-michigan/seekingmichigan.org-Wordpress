<?php
/*
Template Name: Civil War Page With Events Widget
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
					<input src="civil-war_files/search-button.png" id="search-button" name="search-button" value=" " type="image" />
				</form>
			</div>
			<div id="main-whitebox-left"></div>
			<div id="main-whitebox-top"></div>
			<div id="main-whitebox-right"></div>
      
			<!-- Start redo of website here -->  
			<div id="community">
				<ul>
					<li id="calendar-community"></li>
					<li id="flickr-community"></li>
					<li id="youtube-community"></li>
				</ul>
			</div>
			<div id="content">
				<div id="quick-links">
					<h3><span class="noshow">Quick Links</span></h3>
					<ul>
						<li>
							<a href="http://www.itd.nps.gov/cwss/">
							<img src="civil-war_files/nps-thumbnail.png" width="50" height="50" alt="Solider Histories" />
							Search for details on soldier and regimental histories from the Civil War
							<span class="brown-arrow"></span></a>
						</li>
						<li class="central-link-item">
							<a href="http://digital.library.cornell.edu/m/moawar/waro.html">
							<img src="civil-war_files/cornell-thumbnail.png" width="50" height="50" alt="Cornell" />
							Research official records of the Union and Confederate armies
							<span class="brown-arrow"></span></a>							
						</li>
						<li>
							<a href="http://www.suvcwmi.org/graves/search.php">
							<img src="civil-war_files/graves-thumbnail.png" width="50" height="50" alt="Graves" />
							Find graves of Civil War soldiers
							<span class="brown-arrow"></span></a>
						</li>
					</ul>
					<ul class="no-border">
						<li>
							<a href="http://www.michigan.gov/dnr/0,1607,7-153-54463_19313-125416--,00.html">
							<img src="http://seekingmichigan.org/images/blog-thumbnail.png" width="50" height="50" alt="Blog" />
							Share your insights and stories about the Civil War
							<span class="brown-arrow"></span></a>
						</li>
						<li class="central-link-item">
							<a href="http://www.nationalcivilwarmuseum.org/index_1.php">
							<img src="http://seekingmichigan.org/images/museum-thumbnail.png" width="50" height="50" alt="Museum" />
							Explore the National Civil War Museum
							<span class="brown-arrow"></span></a>
						</li>
						<li>
							<a href="http://www.facebook.com/pages/Michigan-Civil-War-Sesquicentennial/130561693679331">
							<img src="civil-war_files/flag-thumbnail.png" width="50" height="50" alt="Facebook" />
							Connect to other Michigan Civil War fans on Facebook
							<span class="brown-arrow"></span></a>
						</li>
					</ul>
				</div>
				<div id="events">
					<h3><span class="noshow">Upcoming Events</span></h3>
					<ul>
    <?php
        // $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        query_posts(
            array(
                'post_type' => 'events',
                'posts_per_page' => 5,
                'orderby' => 'meta_value_num',
                'meta_key' => '_event_start_date'
            )
        );
    ?>
    <?php get_template_part('loop-events');  // Loop template for events (loop-events.php) ?>
    <?php  wp_reset_query(); ?>

					<li class="end"><a href="#">
					See all events<span class="yellow-arrow"></span></a>
					</li>
					</ul>
				</div>
			</div>
			<div id="browse">
				<ul>
					<li class="records">
						<a href="#">
						<p>Find original letters, photographs, and military records from the Civil War.</p></a>
					</li>
					<li class="exhibits">
						<a href="#">
						<p>Look for upcoming Civil War exhibits and demonstrations around Michigan.</p></a>
					</li>    	
					<li class="links">
						<a href="#">
						<p>Connect to Civil War websites of community partners from around the State.</p></a>
					</li>
				</ul>
			</div>
		<div>
	</div>

<? include('footer.php'); ?>