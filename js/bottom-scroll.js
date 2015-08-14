jQuery(document).ready(function($) {



// var myNewWrapper = "<div>" +
// "<div class='left'></div>" + "<div class='right'></div>" +
// "</div>";

	var isDoingAjax = false;
	var page = 2;

	$('.russell-content-large').bind('scroll', function() {
		if ( $(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight ) {
				// $('.russell-content-large').append(myNewWrapper);
				// alert('end reached');
				
				if ( isDoingAjax ) {
					return;
				}
				isDoingAjax = true;
				
				$.ajax({
					url: bottomScrollParams.ajaxurl,
					data: {
						'action': 'russell_latest_post',
						'page': page
					},
					success: function( data ) {
						data = JSON.parse( data );
						
						console.log( data );
						
						var myNewDiv = 
						
							"<div class='russell-gallery'>" + 
								"<div class='russell-gallery-left'>" + 
									"<div class='gallery-image'>" +	"<img src='" + data[0].image + "'/>" + "</div>" +
									"<div class='gallery-image'>" +	"<img src='" + data[1].image + "'/>" + "</div>" +
									"<div class='gallery-image'>" +	"<img src='" + data[2].image + "'/>" + "</div>" +
									"<div class='gallery-image'>" +	"<img src='" + data[3].image + "'/>" + "</div>" +
									"<div class='gallery-image'>" +	"<img src='" + data[4].image + "'/>" + "</div>" +
								"</div>" + 
								"<div class='russell-gallery-right'>" + 
									"<div class='gallery-image'>" +	"<img src='" + data[5].image + "'/>" + "</div>" +
									"<div class='gallery-image'>" +	"<img src='" + data[6].image + "'/>" + "</div>" +
									"<div class='gallery-image'>" +	"<img src='" + data[7].image + "'/>" + "</div>" +
									"<div class='gallery-image'>" +	"<img src='" + data[8].image + "'/>" + "</div>" +
									"<div class='gallery-image'>" +	"<img src='" + data[9].image + "'/>" + "</div>" +
								"</div>" +
							"</div>";
							
						// Convert data into HTML
						
						// Insert HTML in content large area
						
						$('.russell-content-large').append(myNewDiv);
						
						isDoingAjax = false;
						page++;
			        },
			        error: function( errorThrown ){
						isDoingAjax = false;
			        }
					
					
					
				});
				
		}
	});
});