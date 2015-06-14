
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}
// setting the viewport width
var viewport = updateViewportDimensions();


var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;

function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


    var callback = function () {
    jQuery(".cycle-slideshow,.slides,.slides .slide-thumb,.slides .slide-noimg,.full-top-area").height(jQuery(window).height() - 0)
     };
       jQuery(document).ready(callback);
     jQuery(window).resize(callback);

      jQuery(document).ready(function(){
      jQuery('a.arrow').on('click',function (e) {
          e.preventDefault();

          var target = this.hash,
          jQuerytarget = jQuery(target);

          jQuery('html, body').stop().animate({
              'scrollTop': jQuerytarget.offset().top
          }, 900, 'swing', function () {
             window.location.href.split('#')[0] = target;
          });
      });
    });
        jQuery(document).ready(function() {
          jQuery('.author-hide,.related-hide').remove();
        });

            jQuery(document).ready(function () {
                jQuery('#push, #close').click(function () {
                var jQuerynavigacia = jQuery('body, #main-navigation'),
                val = jQuerynavigacia.css('right') === '320px' ? '0px' : '320px';
                jQuerynavigacia.animate({
                right: val
                }, 300)
                });
               var removeClass = true;
                jQuery('#push').click(function () {
                jQuery(' #close').toggleClass('fixed');
                removeClass = false;

              });
              jQuery('#close').click(function () {
                jQuery(this).removeClass('fixed');
                removeClass = false;
              });
            });

    (function(jQuery){
      jQuery(window).load(function(){
        
        jQuery("#main-navigation").mCustomScrollbar({
          theme:"minimal"
        });
        
      });
    })(jQuery);

jQuery(document).ready(function($) {

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();


}); /* end of as page load scripts */
