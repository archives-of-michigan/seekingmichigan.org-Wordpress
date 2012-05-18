jQuery(document).ready(function() {
	jQuery('.galleria-thumbnails-container').remove(); jQuery('.galleria-tooltip').remove(); jQuery('.galleria-info-description').remove();
	jQuery("#galleria").krioImageLoader({ onStart: function() {
		jQuery(this).galleria({
			width: 990,
			height: slideParams['height'],
			autoplay: slideParams['autoplay'],
			thumbnails: slideParams['thumbnails'],
			showCounter: slideParams['showCounter'],
			showInfo: slideParams['showInfo'],
			showImagenav: slideParams['showImagenav'],
			transition: slideParams['transition'],
			transitionSpeed: slideParams['transitionSpeed']
		});
	}});
	jQuery('.galleria-container').css('background', slideParams['background']);
	if(slideParams['thumbnails'] == false) {
		jQuery('.galleria-stage').css('bottom', '10px');
	}
});
