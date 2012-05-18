jQuery(document).ready(function() {
	jQuery('.kwicks li').css('width', slideParams['liwidth']);
	jQuery('.kwicks li').css('height', slideParams['height']);
	jQuery('.kwicks.horizontal p.title').css('opacity', '1.0');
	jQuery('.kwicks').krioImageLoader({ onStart: function() {
			jQuery(this).kwicks({
				spacing: 0,
				max: slideParams['maxWidth'],
				easing: slideParams['effect'],
				duration: slideParams['duration']
			});
			jQuery('li', this).hover(function() {
				jQuery('.title').stop().fadeTo('slow', 0);
				jQuery('.title', this).stop().fadeTo('slow', 1);
			},function() {
				jQuery('.title').stop().fadeTo('slow', 1);
			});
	}});
});
