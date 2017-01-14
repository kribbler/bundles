jQuery(document).ready(function($){
	if($('.ilc_ps_add_cart').length > 0){
		$('.ilc_ps li').hover(
			function(){
				$('.ilc_ps_add_cart_wrap', this).stop(true, true).fadeIn();
			},
			function(){
				$('.ilc_ps_add_cart_wrap', this).stop(true, true).fadeOut();
			}
		);
	}
});