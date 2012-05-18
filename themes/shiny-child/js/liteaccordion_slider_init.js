jQuery(document).ready(function() {
	jQuery('#liteaccordion').krioImageLoader({ onStart: function() {
			jQuery(this).liteAccordion({
				containerWidth : slideParams['containerWidth'],
				containerHeight : slideParams['containerHeight'],
				headerWidth: slideParams['headerWidth'],
				activateOn : slideParams['activateOn'],
				firstSlide : slideParams['firstSlide'],
				slideSpeed : slideParams['slideSpeed'],
				onTriggerSlide : function() {
					this.find('.lacaption').fadeOut();
				},
				onSlideAnimComplete : function() {    
					this.find('.lacaption').fadeIn();
				},
				autoPlay : slideParams['autoPlay'],
				pauseOnHover : slideParams['pauseOnHover'],
				cycleSpeed : slideParams['cycleSpeed'],
				easing : slideParams['easing'],
				enumerateSlides : slideParams['enumerateSlides'],
				theme : 'basic',
				rounded : false,
				linkable : false
		});
	}});
});


