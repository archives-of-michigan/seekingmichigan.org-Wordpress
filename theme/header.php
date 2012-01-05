<?php
$js_includes = isset($js_includes) ? $js_includes : array();
$breadcrumbs = isset($breadcrumbs) ? $breadcrumbs : array('Home' => '');
$teach_page = is_category('teach') || 
  (preg_match('/teach/', BODY_CLASS) && preg_match('/landing/', BODY_CLASS));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
  <title><?= bloginfo('name'); ?><? if(isset($title)): ?> - <?= $title ?><? endif ?></title>
  <meta http-equiv="Content-Type" content="<?= bloginfo('html_type'); ?>; charset=<?= bloginfo('charset'); ?>" />
  <link rel="stylesheet" href="/css/screen/main.css" type="text/css" media="screen, projection" />
  <? if($rss): ?>
    <? foreach($rss as $feed_url => $feed_title): ?>
      <link rel="alternate" type="application/rss+xml" title="Seeking Michigan RSS Feed - <?= $feed_title ?>" href="<?= $feed_url ?>" />
    <? endforeach; ?>
  <? endif; ?>
  <link rel="pingback" href="<?= bloginfo('pingback_url'); ?>" />
  <!--[if IE]>
  <link rel="stylesheet" href="/css/screen/patches/win-ie-all.css" type="text/css" media="screen, projection" />
  <![endif]-->
  <!--[if IE 7]>
  <link rel="stylesheet" href="/css/screen/patches/win-ie7.css" type="text/css" media="screen, projection" />
  <![endif]-->
  <!--[if lt IE 7]>
  <link rel="stylesheet" href="/css/screen/patches/win-ie-old.css" type="text/css" media="screen, projection" />
  <script type="text/javascript" src="/js/lib/dd-png.js"></script>
  <![endif]-->
  <script type="text/javascript" src="/js/core.js"></script>
  <script src="https://www.google.com/jsapi?key=ABQIAAAAFh94cV5fp4whmgH803gmnRQX-gWck_IUGTV6pUvQ92U12qlimxQjiyp3XAX1NStAhuyr0CXdpSn9ng" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <!-- <script type="text/javascript" src="/js/jquery.js"></script> -->
  <? foreach($js_includes as $js): ?>
    <? if(preg_match('/^http:\/\//',$js) > 0): ?>
      <script type="text/javascript" src="<?= $js ?>"></script>
    <? else: ?>
      <script type="text/javascript" src="/js/<?= $js ?>.js"></script>
    <? endif; ?>
  <? endforeach; ?>
  <?php wp_head(); ?>
  <script type="text/javascript">
    addthis_pub  = 'seekingmichigan'; 
    addthis_offset_top = -10; 
    addthis_offset_left = 5; 
    addthis_options = 'delicious, email, digg, facebook, google, technorati, twitter, myspace,  more';
    
    $(document).ready(function() {
      $('.addthis').mouseover(function(event){
        url = $(this).attr('rel');
        title = $(this).attr('title');
        return addthis_open(this, '', url, title);
      }).mouseout(function(event){
        addthis_close();
      }).click(function(event){
        return addthis_sendto();
      });
    });
    
        $(document).ready(function(){
	//hide the all of the element with class stuff
	$(".stuff").hide();
	//toggle the component with class stuff
	$(".label").click(function(){
		$(this).parent().next(".stuff").slideToggle(600);
		if ($(this).text() == "[+]") {
		$(this).html("[-]"); } else {
		$(this).html("[+]"); }
	});
    });
  </script>
 <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
  <script type="text/javascript">
    try { 
	var pageTracker=_gat._getTracker("UA-7441223-1");
	pageTracker._setDomainName("none");
	pageTracker._setAllowLinker(true);
	pageTracker._trackPageview(); } catch(err) {}
  </script>
  
  <? if(is_category('civil-war') || preg_match('/civilwar/',BODY_CLASS)): ?>
    <script type="text/javascript" src="/js/events_calendar.js"></script>
    
         <!-- post from site -->
<link rel='stylesheet' id='pfs-style-css'  href='http://seekingmichigan.org/wp-content/plugins/post-from-site/pfs-style.php?ver=3.0.4' type='text/css' media='all' /> 
<!-- <script type='text/javascript' src='http://seekingmichigan.org/wp-includes/js/jquery/jquery.js?ver=1.4.2'></script> -->
<script type='text/javascript' src='http://seekingmichigan.org/wp-includes/js/jquery/jquery.form.js?ver=2.02m'></script> 
<script type='text/javascript' src='http://seekingmichigan.org/wp-content/plugins/post-from-site/jquery.MultiFile.pack.js?ver=3.0.4'></script> 
<script type='text/javascript' src='http://seekingmichigan.org/wp-content/plugins/post-from-site/pfs-script.js?ver=3.0.4'></script>
         <!-- end post from site -->
  	 <!--kino-events-->
<script type="text/javascript">
var plugin_path = '/wp-content/plugins/kino-event-calendar-plugin';
var ec_color = '#666666';
var ec_hover_color = '#666666';
var event_id;
</script>

  <? elseif($teach_page): ?>
    <link rel="stylesheet" href="http://seekingmichigan.org/css/screen/teach-landing.css" type="text/css" media="screen, projection" />
  <? else: ?>
    <? app()->partial('banner', 
                         array('scene' => app()->helper('header')->banner_scene())); ?>
  <? endif; ?>
</head>
<body id="www.seekingmichigan.com" class="<?= BODY_CLASS ?>">
  <div class="wrapper">
    <div id="header">
      <div class="wrapper">
        <h1>
          <a href="<?= get_settings('home'); ?>">
          <img src="<?= is_category('civil-war') ? '/images/seeking-logo-cw.gif' : '/images/seeking-logo.gif'; ?>" width="309" height="41" alt="Seeking Michigan Logo" />
            <span>Seeking Michigan</span>
          </a>
        </h1>
        <ul id="nav">
          <li id="nav-seek"><a href="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_advanced.php" onclick="pageTracker._link(this.href); return false;"> Seek</a></li>
          <li id="nav-discover"><a href="/discover"> Discover</a></li>
          <li id="nav-look"><a href="/look"> Look</a></li>
          <li id="nav-teach"><a href="/teach"> Teach</a></li>
          <li id="nav-buy"><a href="http://store.seekingmichigan.org"> Buy</a></li>
        </ul>
      </div>
    </div>
    <? if(is_category('civil-war') || is_category('reveille') || preg_match('/civilwar/',BODY_CLASS)): ?>
      <div id="callout">
        <div class="wrapper">
          <h2><a href="/civil-war">Michigan &amp; the Civil War</a></h2>
          <h3>Sesquicentennial 1865-2015: 150 Years</h3>
        </div>
      </div>
    <? elseif($teach_page): ?>
      <div id="callout">
        <div class="wrapper">
          <h2>Education Resources</h2>
          <h3>
            for <a title="Student Resources">Students</a> 
            and <a title="Teacher Resources">Teachers</a></h3>
          <ul>
            <li><a href="/teach/lessons/" title="Lessons">Lessons</a></li>
            <li><a href="/teach/programs/" title="Programs">Programs</a></li>
            <li><a href="/teach/events/" title="Events">Events</a></li>
          </ul>
        </div>
      </div>
    <? elseif(is_home()): ?>
      <div id="callout">
        <div class="wrapper">
          <h2>
            <strong>Explore Michigan’s Past &amp; Present:</strong> 
            <a href="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_advanced.php" onclick="pageTracker._link(this.href); return false;">Seek</a> family histories.
            <a href="/discover">Discover</a> something new.
            <a href="/look">Look</a> at Michigan’s stories.</h2>
        </div>
      </div>
    <? else: ?>
      <div id="utility-bar">
        <div class="wrapper">
          <?php app()->partial('breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
          <?php if(app()->helper('header')->show_search()) {
            if(is_category() || app()->category()) {
              app()->partial('search', array('home_url' => get_bloginfo('home'),
                                             'category' => get_cat_ID(app()->category())));
            } else {
              app()->partial('search', array('home_url' => get_bloginfo('home')));
            }
          } ?>
        </div>
      </div>
    <? endif; ?>
    <div id="main">
      <div class="wrapper">
