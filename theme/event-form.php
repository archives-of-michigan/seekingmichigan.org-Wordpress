<?
/*
Template Name: Event Form
*/

$breadcrumbs = array('Civil War' => '/civil-war', 'Submit an Event' => '');
define("BODY_CLASS","civil-war");
include('header.php');
?>
<div id="main-content">
  <div class="wrapper">
    <h3>Submit a Michigan Civil War Event</h3>
    <? tdomf_the_form(2); ?>
  </div>
</div>
<? include('footer.php'); ?>
