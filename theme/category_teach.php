<? 
$js_includes = array('teach','widgets','http://s7.addthis.com/js/152/addthis_widget.js');
$breadcrumbs = array('Teach' => '');
$rss = array('/category/teach/feed/' => 'Teach');
define('BODY_CLASS','teach landing');  # use 'teach sidebar' for list
$title = 'Teach';
include('header.php'); 

if($_GET['all'] == 'true') {
  query_posts(array('posts_per_page' => -1));
}
?>
<div id="lead-in">
  <p>Ideas for teaching kids to Seek, Discover, and Look at Michigan’s Stories.</p>
  <div class="search">
    <form id="teach-search" action="http://seekingmichigan.org" method="get" >
      <label for="search-top" class="hidden">Seek: </label>
      <input type="text" name="s" id="s" placeholder="Enter text " />
      <label for="search-button" class="hidden">Search </label>
      <input type="submit" value=" " id="search-button" name="search-button" />
    </form>
  </div>
</div>


<div id="main-bars">
  <div id="bar-wide">
    <h2 class="schooltoursandprograms">School Tours and Programs</h2>
      <div id="bar-one">
        <div class="wrapper">
          <div class="michigan-map">
            <ul class="maploc">
              <li class="maploc1"><a href="#" title="Fort Wilkins"> Fort Wilkins</a> <strong>Fort Wilkins</strong></li>
              <li class="maploc2"><a href="#" title="Iron Industry Museum"> Iron Industry Museum</a> <strong>Iron Industry Museum</strong></li>
              <li class="maploc3"><a href="#" title="Father Marquette Memorial"> Father Marquette Memorial</a> <strong>Father Marquette Memorial</strong></li>
              <li class="maploc4"><a href="#" title="Fayette Historic Townsite"> Fayette Historic Townsite</a> <strong>Fayette Historic Townsite</strong></li>
              <li class="maploc5"><a href="#" title="Thunder Bay National Marine Sanctuary"> Thunder Bay National Marine Sanctuary</a> <strong>Thunder Bay National Marine Sanctuary</strong></li>
              <li class="maploc6"><a href="#" title="Hartwick Pines and CCC Museum"> Hartwick Pines and CCC Museum</a> <strong>Hartwick Pines and CCC Museum</strong></li>
              <li class="maploc7"><a href="#" title="Tawas Point Historic Lighthouse"> Tawas Point Historic Lighthouse</a> <strong>Tawas Point Historic Lighthouse</strong></li>
              <li class="maploc8"><a href="#" title="Sanilac Petroglyphs"> Sanilac Petroglyphs</a> <strong>Sanilac Petroglyphs</strong></li>
              <li class="maploc9"><a href="#" title="Michigan Historical Museum"> Michigan Historical Museum</a> <strong>Michigan Historical Museum</strong></li>
              <li class="maploc10"><a href="#" title="Walker Tavern"> Walker Tavern</a> <strong>Walker Tavern</strong></li>
              <li class="maploc11"><a href="#" title="Mann House"> Mann House</a> <strong>Mann House</strong></li>
            </ul>
        </div>
        <h2 class="aroundthe"><a href="#">Around the State</a></h2>
        <?= app()->partial('event_list', array('category' => 'Around the State')); ?>
    </div><!-- end wrapper -->
  </div><!-- end bar-one -->

  <div id="bar-two">
    <div class="wrapper">
      <h2 class="atthecenter"><a href="#">At the Center</a></h2>
      <?= app()->partial('link_list', array('category' => 'At the Center')); ?>

      <h2 class="specialprog"><a href="/events/Special Programs">Special Programs</a></h2>
      <?= app()->partial('event_list', array('category' => 'Special Programs')); ?>
    </div><!-- end wrapper -->
  </div><!-- end bar-two -->
</div><!-- end bar-wide -->
  
<div id="bar-thin">
  <h2 class="justforteach">Just for Teachers</h2>
    <div id="bar-three">
      <div class="wrapper">
        <h2 class="classroom"><a href="#">Classroom Content</a></h2>
        <?= app()->partial('link_list', array('category' => 'Classroom')); ?>
	
        <h2 class="workshops"><a href="#">Workshops</a></h2>
        <?= app()->partial('event_list', array('category' => 'Workshops')); ?>
      </div><!-- end wrapper -->
    </div><!-- end bar-three -->
  </div><!-- end bar-thin -->
</div><!-- end mainbars -->

<div id="main-whitebox-left"></div>
<div id="main-whitebox-top"></div>
<div id="main-whitebox-right"></div>
