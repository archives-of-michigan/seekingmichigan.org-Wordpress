<?php 
/*
Template Name: Teach Page
*/

while (have_posts()) {
  the_post();
  $title = the_title('','',false);
  $content = get_the_content();
}

$js_includes = array('http://s7.addthis.com/js/152/addthis_widget.js');
$breadcrumbs = array('Teach' => '/teach', $title => '');
define('BODY_CLASS','teach landing');

include('header.php');
?>
<div id="main-content">
	<div id="left-main-content">
	<?= $content; ?>
	</div>
	<?= app()->partial('sidebar_teach_programs'); ?>
</div>

<div id="main-whitebox-left"></div>
<div id="main-whitebox-right"></div>

<? include('footer.php'); ?>