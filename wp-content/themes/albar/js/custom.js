/**
 * Albar Theme Custom Functionality
 *
 */
( function( $ ) {
    
    jQuery( document ).ready( function() {
        
		// Adding padding to the footer widgets
		$('.footer-widgets .widget').wrapInner('<div class="footer-widgets-pad" />');
		// Add class to last footer widget
		$('.footer-widgets .widget:last').addClass('footer-widget-last');
		
        // Search Show / Hide
        $(".search-button").toggle(function(){
            $(".search-block").animate( { bottom: '-=55' }, 150 );
            $(".search-block .search-field").focus();
        },function(){
            $(".search-block").animate( { bottom: '+=55' }, 150 );
        });
        
        // Scroll To Top Button Functionality
        $(".scroll-to-top").bind("click", function() {
            $('html, body').animate( { scrollTop: 0 }, 800 );
        });
        $(window).scroll(function(){
            if ($(this).scrollTop() > 400) {
                $('.scroll-to-top').fadeIn();
            } else {
                $('.scroll-to-top').fadeOut();
            }
        });
		
    });
    
    $(window).resize(function () {
        
        // Function to make the Icon always be square
        $('.alba-icon-inner').each(function(c) {
            var this_icon = $(this);
            var this_icon_id = 'alba-icon-'+c;
            this_icon.attr('id', this_icon_id);
            $('#alba-icon-'+c).css('min-width', $('#alba-icon-'+c).height());
        });
        
    }).resize();
    
    $(window).load(function() {
        alba_home_slider();
        alba_carousel();
        alba_post_images();
        alba_blog_list_carousel();
    });
    
    function alba_carousel() {
        $(".alba-carousel-wrapper").each(function(c) {
            var this_carousel = $(this);
            var this_carousel_id = 'alba-carousel-id-'+c;
            var column_no = this_carousel.data('columns');
            this_carousel.attr('id', this_carousel_id);
            $('#'+this_carousel_id+' .alba-carousel').carouFredSel({
                responsive: true,
                scroll: null,
                circular: false,
                infinite: false,
                auto: false,
                onCreate: function(items) {
                    this_carousel.removeClass('alba-carousel-remove-load');
                    $('#'+this_carousel_id+' .alba-carousel').removeClass('alba-carousel-remove');
                },
                items: {
                    width: 300,
                    height: '200px',
                    visible: {
                        min: 1,
                        max: column_no
                    }
                },
                pagination: {
                    container: '#'+this_carousel_id+' .alba-carousel-pagination'
                },
                prev: '#'+this_carousel_id+' .alba-carousel-arrow-prev',
                next: '#'+this_carousel_id+' .alba-carousel-arrow-next'
            });
        });
    }

    function alba_post_images() {
        $(".alba-pi-wrapper").each(function(c) {
            var this_pi_carousel = $(this);
            var this_pi_carousel_id = 'alba-pi-carousel-id-'+c;
            this_pi_carousel.attr('id', this_pi_carousel_id);

            $('#'+this_pi_carousel_id+'.alba-pi-wrapper').hover(function() {
                $('#'+this_pi_carousel_id+' .alba-pi-pager').addClass( 'visible' );
                $('#'+this_pi_carousel_id+' .alba-pi-prev').addClass( 'visible' );
                $('#'+this_pi_carousel_id+' .alba-pi-next').addClass( 'visible' );
                $('#'+this_pi_carousel_id+' .alba-pi-carousel').trigger( 'next' );
            }, function() {
                $('#'+this_pi_carousel_id+' .alba-pi-pager').removeClass( 'visible' );
                $('#'+this_pi_carousel_id+' .alba-pi-prev').removeClass( 'visible' );
                $('#'+this_pi_carousel_id+' .alba-pi-next').removeClass( 'visible' );
                $('#'+this_pi_carousel_id+' .alba-pi-carousel').trigger( 'prev' );
            });

            $('#'+this_pi_carousel_id+' .alba-pi-carousel').carouFredSel({
                circular: false,
                infinite: false,
                direction: 'up',
                auto: false,
                scroll: {
                    queue: 'last'
                }
            });
            $('#'+this_pi_carousel_id+' .alba-pi-images').carouFredSel({
                circular: false,
                infinite: false,
                auto: false,
                pagination: '#'+this_pi_carousel_id+' .alba-pi-pager',
                prev: '#'+this_pi_carousel_id+' .alba-pi-prev',
                next: '#'+this_pi_carousel_id+' .alba-pi-next'
            });
        });
    }
    
    function alba_blog_list_carousel() {
        $(".alba-blog-standard-block-img-carousel-wrapper").each(function(c) {
            var this_blog_carousel = $(this);
            var this_blog_carousel_id = 'alba-blog-standard-block-img-carousel-id-'+c;
            this_blog_carousel.attr('id', this_blog_carousel_id);
            $('#'+this_blog_carousel_id+' .alba-blog-standard-block-img-carousel').carouFredSel({
                responsive: true,
                circular: false,
                width: 580,
                height: "variable",
                items: {
                    visible: 1,
                    width: 580,
                    height: 'variable'
                },
                onCreate: function(items) {
                    $('#'+this_blog_carousel_id).removeClass('alba-blog-standard-block-img-wrapper-remove');
                    $('#'+this_blog_carousel_id+' .alba-blog-standard-block-img-carousel').removeClass('alba-blog-standard-block-img-remove');
                },
                scroll: 500,
                auto: false,
                prev: '#'+this_blog_carousel_id+' .alba-blog-standard-block-img-prev',
                next: '#'+this_blog_carousel_id+' .alba-blog-standard-block-img-next'
            });
        });
    }
    
    function alba_home_slider() {
        var home_slider_auto = $('#alba-home-slider-wrapper').data('auto');
        var home_slider_circular = $('#alba-home-slider-wrapper').data('circular');
        var home_slider_infinite = $('#alba-home-slider-wrapper').data('infinite');
        
        $("#alba-home-slider").carouFredSel({
            responsive: true,
            circular: home_slider_circular,
            infinite: home_slider_infinite,
            width: 1200,
            height: 'variable',
            items: {
                visible: 1,
                width: 1200,
                height: 'variable'
            },
            onCreate: function(items) {
                $("#alba-home-slider-wrapper").removeClass("alba-home-slider-remove");
            },
            scroll: {
                fx: 'uncover-fade',
                duration: 450
            },
            auto: home_slider_auto,
            pagination: '#alba-home-slider-pager',
            prev: "#alba-home-slider-prev",
            next: "#alba-home-slider-next"
        });
    }
} )( jQuery );