jQuery(document).ready(function($) {
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
					
					if ( typeof data === 'undefined' || data === null ) {
						return;
					}

					var myNewDiv = "<div class='russell-gallery'>";

					for ( var i = 0; i < data.length; i++ ) {

						if ( i === 0 ) {
							myNewDiv += "<div class='russell-gallery-left'>";
						}
						var categoryLinks = '';
						for ( var k in data[ i ].categories ) {
							categoryLinks += "<li><a href='" + data[ i ].cat_link[ k ] + "'>" +  data[ i ].categories[ k ] + "</a></li>";
						}
						console.log( data[i].categories, data[i].cat_link);
						// var l = "<li>" + data[ i ].categories[k] + "</li>";
						myNewDiv += "<div class='gallery-image'>" +	"<span class='image-title'>" + data[ i ].title + "</span>" + "<a href='" + data[i].link + "'><img src='" + data[ i ].image + "'></a>" + "<ul>" + categoryLinks + "</ul>" + "</div>";
							
						if ( i === Math.ceil( data.length / 2 ) ) {
							myNewDiv += "</div>";
							myNewDiv += "<div class='russell-gallery-right'>";
						}


						if ( i === data.length - 1 ) {
							myNewDiv += "</div>";

						}
					}
					myNewDiv += "</div>";

					$('.russell-content-large').append(myNewDiv);

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
});