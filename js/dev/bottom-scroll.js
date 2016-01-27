jQuery(document).ready(function($) {
	
	var smallestValue = 9999.99;
	var isDoingAjax = false;
	var page = 2;
	var query = null;
	var previousTagID = null;
	
	var ajaxRightposts = function() {
		
		if ( $('body').hasClass('archive') ) {
			query = bottomScrollParams.query;
		}
		
		if ( isDoingAjax ) {
			return;
		}
	
		if ( $(this).attr('data-tag-id') ) {
			// Function was called by a filter link
			page = 1;
			previousTagID = $(this).attr('data-tag-id');
			$('.russell-gallery').remove();
			
			var newDiv = '<div id="loader-wrapper"><div id="loader"></div></div>';
			setTimeout(function() {
				var $ = jQuery;
				$('.russell-content-large').append( newDiv );
			});
		
			setTimeout(function() {
				var $ = jQuery;
				$('div#loader-wrapper').remove();
			}, 3000);
			
		} else {
				// Function was called by a scroll
			if ( $(this).scrollTop() + $(this).innerHeight() < $(this)[0].scrollHeight ) {
				return;
			}
		}
		
		isDoingAjax = true;
			
		$.ajax({
			url: bottomScrollParams.ajaxurl,
			data: {
				'action': 'russell_large_content',
				'page': page,
				'query': query,
				'tag_id': previousTagID, 
				},
			success: function( data ) {
					data = JSON.parse( data );
				
					if ( typeof data === 'undefined' || data === null  || data.length === 0 ) {
						return;
					}
					var myNewDiv = "<div class='russell-gallery'>";

					var smallestValue = 9999;
					var leftY = rightY = 0;
					var leftArr = [], rightArr = [];
					
					for ( var i = 0; i < data.length; i++ ) {
						var value = 1;
						
						if ( data[i].image_height !== null ) {
							value = data[i].image_height / data[i].image_width;
						}
						if ( value < smallestValue ) {
							smallestValue = value;	
					    }
						var finalValue = value / smallestValue;
						
						if ( leftY <= rightY ) {
							leftArr.push(data[i]);
							leftY += value;
						} else {
							rightArr.push(data[i]);
							rightY += value;
						}
					}
					
					if ( leftArr.length >= rightArr.length ) {
						if ( leftArr.length === 9 || leftArr.length === 8 || leftArr.length === 7 || leftArr.length === 6 || leftArr.length === 5 || leftArr.length === 4 || leftArr.length === 3 || leftArr.length === 2 || leftArr.length === 1 ) {
							var value = leftArr.length;
							$(".russell-content-large").addClass('left-' + value );
						} 
					} else {
						if ( rightArr.length === 9 || rightArr.length === 8 || rightArr.length === 7 || rightArr.length === 6 || rightArr.length === 5 || rightArr.length === 4 || rightArr.length === 3 || rightArr.length === 2 || rightArr.length === 1 ) {
							var value = rightArr.length;
							$(".russell-content-large").addClass('right-' + value );
						} 
					}
					
					// Print opening div.
					if ( leftArr.length ) {
						myNewDiv += "<div class='russell-gallery-left'>";
					}
					// Print out all left images.
					for ( var h in leftArr ) {
						
						var categoryLinks = '';
						for ( var k in leftArr[ h ].categories ) {
							categoryLinks += "<li><a href='" + leftArr[ h ].cat_link[ k ] + "'>" +  leftArr[ h ].categories[ k ] + "</a></li>";
						}
						if ( leftArr[ h ].image === false ) {
							
						} else if ( leftArr[ h ].image === '' ) {
							myNewDiv += "<div class='gallery-image has-no-featured-image russell_hide' style='flex-grow:" + finalValue + "; background-image: url(" + leftArr[h].image + ");'>" + "<span class='image-title'>" + leftArr[ h ].title + "</span>" + "<a href='" + leftArr[ h ].link + "' class='link'>Link</a>" + "<ul>" + categoryLinks + "</ul>" + "<div class='overlay'>" + "</div>" + "</div>";
						} else {
							myNewDiv += "<div class='gallery-image russell_hide' style='flex-grow:" + finalValue + "; background-image: url(" + leftArr[h].image + ");'>" + "<span class='image-title'>" + leftArr[ h ].title + "</span>" + "<a href='" + leftArr[ h ].link + "' class='link'>Link</a>" + "<ul>" + categoryLinks + "</ul>" + "<div class='overlay'>" + "</div>" + "</div>";
						}
					} 
					// Print closing div.
					if ( leftArr.length ) {	
						myNewDiv += "</div>";
						myNewDiv += "<div class='russell-gallery-right'>";
					}
					// Print out all right images.
					for ( var h in rightArr ) {
					
						var categoryLinks = '';
						for ( var k in rightArr[ h ].categories ) {
							categoryLinks += "<li><a href='" + rightArr[ h ].cat_link[ k ] + "'>" +  rightArr[ h ].categories[ k ] + "</a></li>";
						}
						if ( rightArr[ h ].image === false ) {
						
						} else if ( rightArr[ h ].image === '' ) {
							myNewDiv += "<div class='gallery-image has-no-featured-image russell_hide' style='flex-grow:1;'>" + "<span class='image-title'>" + rightArr[ h ].title + "</span>" + "<a href='" + rightArr[ h ].link + "' class='link'>Link</a>" + "<ul>" + categoryLinks + "</ul>" + "<div class='overlay'>" + "</div>" + "</div>";
						} else {
							myNewDiv += "<div class='gallery-image russell_hide' style='flex-grow:" + finalValue + "; background-image: url(" + rightArr[h].image + ");'>" + "<span class='image-title'>" + rightArr[ h ].title + "</span>" + "<a href='" + rightArr[ h ].link + "' class='link'>Link</a>" + "<ul>" + categoryLinks + "</ul>" + "<div class='overlay'>" + "</div>" + "</div>";
						}	
					}
					
					// Print closing div.
					if ( rightArr.length ) {
						myNewDiv += "</div>";
					}
					
					myNewDiv += "</div>";
					
					setTimeout(function() {
						var $ = jQuery;
						$('.russell-content-large').append(myNewDiv);
						setTimeout(function() {
							var $ = jQuery;
							$('.russell_hide').removeClass('russell_hide');
						}, 10);
					}, 2000);
					
					isDoingAjax = false;

					page++;
				},				
	        error: function() {
				isDoingAjax = false;
	        }
		});
	};
	
	$('body.home .russell-content-large, body.archive .russell-content-large, body.search .russell-content-large').bind('scroll', ajaxRightposts );
	$('body.archive .russell-content-small .russell-taglist li a, body.search .russell-content-small .russell-taglist li a').click( ajaxRightposts );

	if ( $('body').hasClass('home') | $('body').hasClass('archive') | $('body').hasClass('search') ) {
		page = 1;
		ajaxRightposts();
	}
	setTimeout(function() {
		var $ = jQuery;
		$('div#loader-wrapper').remove();
	}, 3000 );	
});