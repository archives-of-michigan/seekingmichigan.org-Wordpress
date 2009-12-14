<?php
$js_includes = isset($js_includes) ? $js_includes : array();
$breadcrumbs = isset($breadcrumbs) ? $breadcrumbs : array('Home' => '');
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
  <script type="text/javascript" src="/js/jquery.js"></script>
  <? foreach($js_includes as $js): ?>
    <? if(preg_match('/^http:\/\//',$js) > 0): ?>
      <script type="text/javascript" src="<?= $js ?>"></script>
    <? else: ?>
      <script type="text/javascript" src="/js/<?= $js ?>.js"></script>
    <? endif; ?>
  <? endforeach; ?>
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
  </script>
  <script type="text/javascript" src="http://www.google-analytics.com/ga.js"></script>
  <script type="text/javascript">
    try { _gat._getTracker("UA-7441223-1")._trackPageview(); } catch(err) {}
  </script>
  <?php app()->partial('banner', 
                       array('scene' => app()->helper('header')->banner_scene())); ?>
</head>
<body id="www.seekingmichigan.com" class="<?= BODY_CLASS ?>">
  <div class="wrapper">
    <div id="header">
      <div class="wrapper">
        <h1><a href="<?= get_settings('home'); ?>"><img src="/images/seeking-logo.gif" width="309" height="41" alt="Seeking Michigan Logo" /><span>Seeking Michigan</span></a></h1>
        <ul id="nav">
          <li id="nav-seek"><a href="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_advanced.php"> Seek</a></li>
          <li id="nav-discover"><a href="/discover"> Discover</a></li>
          <li id="nav-look"><a href="/look"> Look</a></li>
          <li id="nav-teach"><a href="/teach"> Teach</a></li>
        </ul>
      </div>
    </div>
    <? if(is_home()): ?>
      <div id="callout">
        <div class="wrapper">
          <h2>
            <strong>Explore Michigan’s Past &amp; Present:</strong> 
            <a href="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_advanced.php">Seek</a> family histories.
            <a href="/discover">Discover</a> something new.
            <a href="/look">Look</a> at Michigan’s stories.</h2>
        </div>
      </div>
    <? else: ?>
      <div id="utility-bar">
        <div class="wrapper">
          <?php app()->partial('breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
          <?php if(app()->helper('header')->show_search()) {
            app()->partial('search', array('home_url' => get_bloginfo('home')));
          } ?>
        </div>
      </div>
    <? endif; ?>
    <div id="main">
      <div class="wrapper">
