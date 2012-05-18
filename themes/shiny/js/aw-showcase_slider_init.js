jQuery(document).ready(function() {
	jQuery("#showcase").krioImageLoader({ onStart: function() {
			jQuery("#showcase").css('overflow', 'visible');
			jQuery(this).awShowcase({
				content_width: slideParams['content_width'],
				content_height: slideParams['content_height'],
				thumbnails: slideParams['thumbnails'],
				thumbnails_direction: slideParams['thumbnails_direction'],
				transition: slideParams['transition'],
				transition_speed: slideParams['transition_speed'],
				interval: slideParams['interval'],
				auto: slideParams['autostart'],
				continuous: slideParams['autostart'],
				buttons: false,
				tooltip_width: 200,
				tooltip_icon_width: 32,
				tooltip_icon_height: 32,
				tooltip_offsetx: 18,
				tooltip_offsety: 0
		});
	}});
	jQuery('.showcase-arrow-previous, .showcase-arrow-next').css('top', (slideParams['content_height']/2)-15);
});
