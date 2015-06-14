jQuery(document).ready(function() {
			var jQueryslider = jQuery('.cycle-slideshow');
			jQueryslider.imagesLoaded( function() {
			jQuery('#load-cycle').hide(); /* preloader */
			jQueryslider.slideDown(1000);
			});
		});