<?
/*
Template Name: Reveille Form
*/

$breadcrumbs = array('Reveille' => '/reveille', 'Submit a Post' => '');
define("BODY_CLASS","civil-war");
include('header.php');
?>
<div id="main-content">
  <div class="wrapper">
    <h3>Submit a Reveille Article</h3>
    <? tdomf_the_form(1); ?>
  </div>
</div>
<? include('footer.php'); ?>
