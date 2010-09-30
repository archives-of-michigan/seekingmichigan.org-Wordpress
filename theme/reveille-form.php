<?
/*
Template Name: Reveille Form
*/

$breadcrumbs = array('Reveille' => '/reveille', 'Submit a Post' => '');
$title = 'Reveille - Submit an Article';
define("BODY_CLASS","civilwar sub");
include('header.php');
?>
<div id="main-content">
  <? app()->partial('sidebar_reveille'); ?>

  <div id="viewer">
    <h3>Submit a Reveille Article</h3>
    <? tdomf_the_form(1); ?>
  </div>
</div>
<? include('footer.php'); ?>
