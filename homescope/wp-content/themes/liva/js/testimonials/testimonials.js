jQuery(document).ready( function($) {
	$(".controlls li a").click(function(e) {
		e.preventDefault();
		var id = jQuery(this).attr("href").replace("#","");
		
		$(this).closest(".faide_slider").find(".faide_slide:visible").fadeOut(500, function() {
			$("div#" + id).fadeIn();
		})
	});
});

