jQuery(document).ready(function($) {
	"use strict";

	$(".russell-left-content").each(function() {
		
		    //var $this = $(this);

            $(this).owlCarousel();

    });
/*
		$(this).owlCarousel({
			items : $(this).attr('data-items'),
			itemsDesktop : [1199, $(this).attr('data-items')],
			itemsDesktopSmall : [979, $(this).attr('data-items-small')],
			itemsTablet : [768, $(this).attr('data-items-tablet')],
			itemsMobile : [479, $(this).attr('data-items-mobile')],
			scrollPerPage : false,
			//scrollPerPage : $(this).attr('data-scroll_per_page') === 'true' ? true : false,
			autoPlay : $(this).attr('data-autoplay') === 'false' ? false : $(this).attr('data-autoplay'),
			pagination: $(this).attr('data-thumbnails') === 'none' || $(this).attr('data-thumbnails') === 'arrows' ? false : true,
			paginationNumbers: $(this).attr('data-thumbnail-numbers') === 'true' ? true : false,
			stopOnHover: $(this).attr('data-stop-on-hover') === 'true' ? true : false,
			paginationSpeed: $(this).attr('data-speed-scroll'),
			rewindSpeed: $(this).attr('data-speed-rewind'),
			autoHeight: true,
			navigation: $(this).attr('data-navigation') === 'true' ? true : false,
			navigationText : ["&nbsp;","&nbsp;"],
			touchDrag: $(this).attr('data-touchdrag') === 'false' ? false : true,
			mouseDrag: $(this).attr('data-touchdrag') === 'false' ? false : true,
			// This fixes the height issues
	        afterInit: function(){
				setTimeout( function(){
			   	    $this.data('owlGambitCarousel').updateVars();
				 }, 500);
	        },
		});
*/
	
});