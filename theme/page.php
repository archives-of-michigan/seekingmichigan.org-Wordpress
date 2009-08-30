<?
define("BODY_CLASS","look");
include('header.php');
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="section-header" style="background: none">
	<h1><?php the_title(); ?></h1>
</div>
<div id="main-content">
  <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
  <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>
<?php endwhile; endif; ?>

<div id="main-whitebox-left"></div>
<div id="main-whitebox-right"></div>

<? include('footer.php'); ?>