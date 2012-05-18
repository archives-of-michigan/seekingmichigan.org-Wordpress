<?php
/**
 * Footer Template
 *
 */

global $e404_options;

?>
</div>
<div id="footer_wrapper">
	<div id="footer">
		<?php dynamic_sidebar('e404_footer_sidebar'); ?>
		<br class="clear" />
	</div>
	<div id="copyright_wrapper">
		<div id="copyright" class="group">
			<div id="footer_nav" class="full_page">
			<?php if(has_nav_menu('footer-menu')) wp_nav_menu(array('theme_location' => 'footer-menu', 'container' => false, 'menu_class' => '', 'depth' => 1)); ?>
			</div>
			<div class="one_half"><?php echo $e404_options['footer_below_left']; ?></div>
			<div class="one_half last right"><?php echo $e404_options['footer_below_right']; ?></div>
		</div>
	</div>
</div>
<?php
	wp_footer();
?>
</div>
</body>
</html>
