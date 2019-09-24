    jQuery(function() {
    //header-nav
    if( jQuery(window).width() > 767) {
    jQuery('.nav li.dropdown').hover(function() {
    jQuery(this).addClass('open');
    }, function() {
    jQuery(this).removeClass('open');
    }); 
    jQuery('.nav li.dropdown-submenu').hover(function() {
    jQuery(this).addClass('open');
    }, function() {
    jQuery(this).removeClass('open');
    }); 
    }

    jQuery('li.dropdown').find(' .fa').each(function(){
    jQuery(this).on('click', function(){
    if( jQuery(window).width() < 767) {
    jQuery(this).parent().next().slideToggle();
    }
    return false;
    });
    });
    });

    jQuery(document).ready(function() {	
    var Page = (function() {
    var $navArrows = jQuery( '#nav-arrows' ),
    $nav = jQuery( '#nav-dots > span' ),
    slitslider = jQuery( '#slider' ).slitslider( {
    onBeforeChange : function( slide, pos ) {
    $nav.removeClass( 'nav-dot-current' );
    $nav.eq( pos ).addClass( 'nav-dot-current' );
    }
    } ),
    init = function() {
    initEvents();							
    },
    initEvents = function() {
    // add navigation events
    $navArrows.children( ':last' ).on( 'click', function() {
    slitslider.next();
    return false;
    } );
    $navArrows.children( ':first' ).on( 'click', function() {								
    slitslider.previous();
    return false;
    } );
    $nav.each( function( i ) {						
    jQuery( this ).on( 'click', function( event ) {									
    var $dot = $( this );								
    if( !slitslider.isActive() ) {
    $nav.removeClass( 'nav-dot-current' );
    $dot.addClass( 'nav-dot-current' );								
    }									
    slitslider.jump( i + 1 );							
    return false;								
    } );								
    } );
    };
    return { init : init };
    })();
    Page.init();
    });

    jQuery(document).ready(function() {	
    new WOW().init();
    });
    jQuery(document).ready(function() {
    var $gallery = jQuery('.gallery a.big_light_box').simpleLightbox();
    $gallery.on('show.simplelightbox', function() {
    console.log('Requested for showing');
    })
    .on('shown.simplelightbox', function() {
    console.log('Shown');
    })
    .on('close.simplelightbox', function() {
    console.log('Requested for closing');
    })
    .on('closed.simplelightbox', function() {
    console.log('Closed');
    })
    .on('change.simplelightbox', function() {
    console.log('Requested for change');
    })
    .on('next.simplelightbox', function() {
    console.log('Requested for next');
    })
    .on('prev.simplelightbox', function() {
    console.log('Requested for prev');
    })
    .on('nextImageLoaded.simplelightbox', function() {
    console.log('Next image loaded');
    })
    .on('prevImageLoaded.simplelightbox', function() {
    console.log('Prev image loaded');
    })
    .on('changed.simplelightbox', function() {
    console.log('Image changed');
    })
    .on('nextDone.simplelightbox', function() {
    console.log('Image changed to next');
    })
    .on('prevDone.simplelightbox', function() {
    console.log('Image changed to prev');
    })
    .on('error.simplelightbox', function(e) {
    console.log('No image found, go to the next/prev');
    console.log(e);
    });
    });

/* scroll-up*/
jQuery(document).ready(function(){
	// hide #back-top first
	jQuery("#scroll-up").hide();
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#scroll-up').fadeIn();
			} else {
				jQuery('#back-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		jQuery('#scroll-up a').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
});
/* scroll-up*/



	