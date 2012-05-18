<?php
/**
 * Gallery sidebar.
 *
 */
global $e404_options;

if(!dynamic_sidebar(e404_get_sidebar_name('gallery'))) :
	e404_subpages_nav(); ?>

	<br class="clear" />
	<?php
endif; ?>
