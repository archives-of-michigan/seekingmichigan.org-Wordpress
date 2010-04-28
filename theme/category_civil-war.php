<?
/*
Template Name: Civil War
*/

include('lib/phpFlickr/phpFlickr.php');
$ini = parse_ini_file('../../seekingmichigan.ini');
$f = new phpFlickr($ini['flickr_api_key']);
$flickr_photos = $f->groups_pools_getPhotos('1362691@N20', NULL, NULL, NULL, 3, 1);

$breadcrumbs = array('Civil War' => '');
define("BODY_CLASS","civilwar");
include('header.php');
?>
<div id="lead-in">
  <h3>Curriculum, Research &amp; Events</h3>
  <p>Seek, discover and look at Michigan's Civil War in documents, photographs and maps at SeekingMichigan.org</p>
</div>
<div id="civil-war-search">
  <form>
    <input type="text" class="text" value="Enter text"/>
    <input type="image" src="/images/search-button.png" id="search-button" name="search-button" value=" " />
  </form>
</div>
<div id="main-bars">
  <div id="event-bar">
    <div class="wrapper">
      <h2 class="events"><a href="#">Events &amp; Dates</a></h2>
      <div class="calendar-grid">
        <img src="" height="192px" width="243px" style="background-color: #aaa" />
      </div>

      <h3>March 29, 2010</h3>
      <ul>
        <li><h4><a href="#">Title of Event or Date listing</a></h4>
          <p>The Civil War Manuscripts collection consists of letters and diaries</p>	</li>
        <li><h4><a href="#">Title of Event or Date listing</a></h4>
          <p>The Civil War Manuscripts collection consists of letters and diaries</p>	</li>
        <li><h4><a href="#">Title of Event or Date listing</a></h4>
          <p>The Civil War Manuscripts collection consists of letters and diaries</p>	</li>
      </ul>

      <h3>April 5, 2010</h3>
      <ul>
        <li><h4><a href="#">Title of Event or Date listing</a></h4>
          <p>The Civil War Manuscripts collection consists of letters and diaries</p>	</li>
      </ul>
      
      </div>
      </div><!-- end bar -->

      <div id="blog-bar">
        <div class="wrapper">
      <h2 class="reveille"><a href="#">Reveille!</a></h2>
      <h3>March 29, 2010</h3>
      <ul>
        <li><h4><a href="#">Title of Event or Date listing</a></h4>
          <p>The Civil War Manuscripts collection consists of letters and diaries</p>	</li>
        <li><h4><a href="#">Title of Event or Date listing</a></h4>
          <p>The Civil War Manuscripts collection consists of letters and diaries</p>	</li>
        <li><h4><a href="#">Title of Event or Date listing</a></h4>
          <p>The Civil War Manuscripts collection consists of letters and diaries</p>	</li>
      </ul>
      
      <h3>April 5, 2010</h3>
      <ul>
        <li><h4><a href="#">Title of Event or Date listing</a></h4>
          <p>The Civil War Manuscripts collection consists of letters and diaries</p>	</li>
      </ul>
  
      <h2 class="curriculum"><a href="#">Curriculum Support</a></h2>
      <h3>March 29, 2010</h3>
      <ul>
        <li><h4><a href="#">Title of Event or Date listing</a></h4>
          <p>The Civil War Manuscripts collection consists of letters and diaries</p>	</li>
      </ul>
      </div>
      </div><!-- end bar -->
  
      <div id="resource-bar">
        <div class="wrapper">
      <h2 class="links"><a href="#">Resources &amp; Links</a></h2>
      <ul>
        <li><h4><a href="#">Link goes here</a></h4></li>
        <li><h4><a href="#">Link goes here</a></h4></li>
        <li><h4><a href="#">Link goes here</a></h4></li>
        <li><h4><a href="#">Link goes here</a></h4></li>
        <li><h4><a href="#">Link goes here</a></h4></li>
      </ul>
  
      <h2 class="photos"><a href="#">Photos &amp; Imagery</a></h2>
      <ul class="flickr">
        <? foreach ($flickr_photos['photo'] as $photo): ?>
          <li>
            <a href="http://www.flickr.com/photos/<?= $photo['owner']; ?>/<?= $photo['id']; ?>/">
              <img src="http://www.flickr.com/photos/<?= $photo['owner']; ?>/<?= $photo['id']; ?>" height="75px" width="75px" style="background-color: #aaa" alt="<?= $photo['title'] ?>" />
            </a>
          </li>
        <? endforeach; ?>
      </ul>
      <p class="more">
        <a href="#" class="logo-link">
          <img src="/images/flickr-logo-color.gif" alt="flickr-logo" /></a>
        <a href="#" class="addyours">Add Yours</a> 
      </p>

      <h2 class="videos"><a href="#">Video</a></h2>
      <ul class="youtube">
        <li><a href="#"><img src="/images/video-thumb1.jpg" height="78px" width="126px" style="background-color: #aaa" /></a></li>
        <li><a href="#"><img src="/images/video-thumb2.jpg" height="78px" width="126px" style="background-color: #aaa" /></a></li>
      </ul>
      <p class="more">
        <a href="#" class="logo-link">
          <img src="/images/youtube-logo-color.gif" alt="youtube-logo" />
        </a>
        <a href="#" class="addyours">Add Yours</a> 
      </p>
    </div>
  </div><!-- end bar -->
  <div class="sponsor-plug">
    <p>Sponsored by the Michigan Sequicentennial of the Civil War Commission</p>
  </div>
</div>
<div id="main-whitebox-left"></div>
<div id="main-whitebox-top"></div>
<div id="main-whitebox-right"></div>
<? include('footer.php'); ?>
