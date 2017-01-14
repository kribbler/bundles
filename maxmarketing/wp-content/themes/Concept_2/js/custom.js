jQuery(document).ready(function($) {
	
	var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
		showLeftPush = document.getElementById( 'showLeftPush' ),
		body = document.body;
				
	$('body').addClass('cbp-spmenu-push');
	
	showLeftPush.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( body, 'cbp-spmenu-push-toright' );
		classie.toggle( menuLeft, 'cbp-spmenu-open' );
	};
	
	// Hide review form - it will be in a lightbox
	$('#review_form_wrapper').hide();
	// Open review form lightbox if accessed via anchor
	if( window.location.hash == '#review_form' ) {
		$('a.show_review_form').trigger('click');
	}
	$("a.show_review_form").prettyPhoto({
		social_tools: false,
		theme: 'light_square',
		deeplinking: false
	});
	
	//$("html").niceScroll({scrollspeed:50,mousescrollstep:35,cursorborder:0,cursorcolor:"rgba(0,0,0,.6)",horizrailenabled:!1});
	var isIE10 = false;
    /*@cc_on
        if (/^10/.test(@_jscript_version)) {
            isIE10 = true;
        }
    @*/
    if(isIE10){
    	$(".effect-wrapper").each(function(i) {
			$(this).addClass('effect-wrapper' + i);
			$(".effect-wrapper" + i).waypoint(function(down) {
				$(".effect-wrapper" + i + "[data-effect] .effect-content").each(function (j) {
					$(this).css({'-webkit-animation-delay':(j * 300) + 'ms','-moz-animation-delay':(j * 300) + 'ms'
							,'-o-animation-delay':(j * 300) + 'ms'
							,'animation-delay':(j * 300) + 'ms'});
					if ((j == $(".effect-wrapper" + i + "[data-effect] .effect-content").size() -1)) {
						$(".effect-wrapper" + i + "[data-effect]").addClass("play");
					}else{
						$(".effect-wrapper" + i + "[data-effect]").removeClass("play");
					}
				});
					
			}, { offset: "80%", triggerOnce: true});
		});
		$('.progress-bar').waypoint(function(down) {
			$('.percent').each(function(i){
				var per = $(this).attr('data-percent');
				$(this).animate({ width: per }, 1500, 'easeOutQuint');
			});
		}, { offset: '80%', triggerOnce: true});
    }else{
    	if(!categorizr.isTablet && !categorizr.isMobile){
			$(".effect-wrapper").each(function(i) {
				$(this).addClass('effect-wrapper' + i);
				$(".effect-wrapper" + i).waypoint(function(down) {
					$(".effect-wrapper" + i + "[data-effect] .effect-content").each(function (j) {
						$(this).css({'-webkit-animation-delay':(j * 300) + 'ms','-moz-animation-delay':(j * 300) + 'ms'
								,'-o-animation-delay':(j * 300) + 'ms'
								,'animation-delay':(j * 300) + 'ms'});
						if ((j == $(".effect-wrapper" + i + "[data-effect] .effect-content").size() -1)) {
							$(".effect-wrapper" + i + "[data-effect]").addClass("play");
						}else{
							$(".effect-wrapper" + i + "[data-effect]").removeClass("play");
						}
					});
						
				}, { offset: "80%", triggerOnce: true});
			});
			$('.progress-bar').waypoint(function(down) {
				$('.percent').each(function(i){
					var per = $(this).attr('data-percent');
					$(this).animate({ width: per }, 1500, 'easeOutQuint');
				});
			}, { offset: '80%', triggerOnce: true});
		}else{
			$(".effect-wrapper").each(function(i){
				$(this).removeAttr('data-effect');
			});
			$('.percent').each(function(i){
				var per = $(this).attr('data-percent');
				$(this).animate({ width: per }, 1500, 'easeOutQuint');
			});
		}
    }
	
	
	$('.navbar .nav > li').hover(function(){
		$(this).children('ul.sub-menu').stop().animate({top:'99%'}, 1000, 'easeOutQuint');
	}, function(){
		$(this).children('ul.sub-menu').stop().animate({top:'40%'}, 1000, 'easeOutQuint');
	});
	
	$('.navbar .nav ul li').hover(function(){
		$(this).children('ul.sub-menu').stop().animate({opacity: 1}, 1000, 'easeOutQuint');
	}, function(){
		$(this).children('ul.sub-menu').stop().animate({opacity: 0}, 1000, 'easeOutQuint');
	});
	
	$('.flex-control-nav').each(function() {
        var fl_w = $(this).outerWidth();
		$(this).css({'margin-left':-fl_w/2});
    });	
	
	if ( $('.flexslider_t').length ){
		$(".flexslider_t").flexslider({
			animation: "fade",
			animationDuration: 1500,
			controlNav: false
		});
	}
	if ( $('.flexslider_m').length ){
		$(".flexslider_m").flexslider({
			animation: "fade",
			animationDuration: 1500,
			controlNav: false
		});
	}
	if ( $('.flexslider_pb').length ){
		$(".flexslider_pb").flexslider({
			animation: "side",
			animationDuration: 1500,
			controlNav: false,    
			slideshow: true,   
		});
	}
	
	$('.custom-search').click(function(){
		$(this).removeClass('custom-search-gradient');
		$form = $(this).find('.menu-search-form');
		$form.show(600, 'easeOutQuint');
		$form.stop().animate({opacity: 1, top: 33}, 600, 'easeOutQuint');
	});
	
	$(document).mouseup(function(e){
		var container = $('.menu-search-form'),
			wrapper = $('.custom-search');
		if (container.has(e.target).length === 0 && wrapper.has(e.target).length === 0){
			container.stop().animate({opacity: 0, top: 23}, 600, 'easeOutQuint');
			container.hide(600, 'easeOutQuint');
			wrapper.addClass('custom-search-gradient');
		}
	});
		
	$("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'light_square',
		allow_resize: true,
	});
	
	$('.post-sharing .icon-share').click(function(e){
		$('.post-sharing').css({'display':'none'});
		$('.sharing').stop().animate({right:0}, 500, 'easeOutQuint');
	});
	$('.sharing-icons .icon-remove-sign').click(function(e){
		$('.sharing').stop().animate({right:-160}, 500, 'easeOutQuint');
		$('.post-sharing').css({'display':'block'});
	});
	
	$(".sidebar-cat a[rel^='tag'], .tag-wrapper a[rel^='tag']").each(function() {
        $(this).addClass('btn-small btn no_colored_bg white_color');
    });
	$('.tagcloud a').each(function() {
        $(this).addClass('btn no_colored_bg white_color');
    });
	$("a.comment-reply-link").each(function() {
        $(this).addClass('btn-small btn no_colored_bg white_color');
    });
	
	$('<i class="icon-reorder"></i>').prependTo('.sidebar-box ul li.cat-item a');
	$('<i class="icon-edit"></i>').prependTo('.sidebar-box ul li.page_item a');
	$('<i class="icon-twitter"></i>').prependTo('#twitter_update_list li');
	
	$('.flex-direction-nav .flex-prev').empty().append('<i class="icon-angle-left"></i>');
	$('.flex-direction-nav .flex-next').empty().append('<i class="icon-angle-right"></i>');
	
	var logo_w = $('.logo-wrapper').width(),
		logo_t = $('.logo-wrapper').position();
	$(window).scroll(function(){
		if($(window).width() >= 960){
			if ($(this).scrollTop() > 50){
				$('#ontop').addClass('ontop-bg');
				$('.logo-wrapper').stop().animate({width:logo_w/1.5, top:logo_t.top/5}, 300);
			} else {
				$('#ontop').removeClass('ontop-bg');
				$('.logo-wrapper').stop().animate({width:logo_w, top:logo_t.top}, 500);
			}
		}
		if ($(this).scrollTop() > 400) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	}); 
 
	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600, 'easeOutQuint');
		return false;
	});
	
	$('.aq-block-aq_background_block > .column-bg').each(function() {
        var window_w = $(window).width();
		var parent_w = $(this).parent().width();
		var parent_h = $(this).parent('.aq-block-aq_column_block').height();
		$(this).css({'width':window_w, 'left': -(window_w - parent_w)/2});
		$(this).css({'height':parent_h});
    });
	
	$('.wpcf7-form-control-wrap input.wpcf7-text').each(function() {
        var placeholder = $(this).attr('name');
		placeholder = placeholder.replace("-", " ");
		placeholder = placeholder.charAt(0).toUpperCase() + placeholder.slice(1);
		$(this).attr('value', placeholder);
    });
	
	$('.wpcf7-form-control-wrap .wpcf7-textarea').each(function() {
        var placeholder = $(this).attr('name');
		placeholder = placeholder.replace("-", " ");
		placeholder = placeholder.charAt(0).toUpperCase() + placeholder.slice(1);
		$(this).attr('value', placeholder);
    });
	
	$('input:text').each(function(){
		var txtval = $(this).val();
		$(this).focus(function(){
			$(this).val('')
		});
		$(this).blur(function(){
			if($(this).val() == ""){
				$(this).val(txtval);
			}
		});
	});
	
	$('input[type="email"]').each(function(){
		var txtval = $(this).val();
		$(this).focus(function(){
			$(this).val('')
		});
		$(this).blur(function(){
			if($(this).val() == ""){
				$(this).val(txtval);
			}
		});
	});
	
	$('textarea').each(function(){
		var txtval = $(this).val();
		$(this).focus(function(){
			$(this).val('')
		});
		$(this).blur(function(){
			if($(this).val() == ""){
				$(this).val(txtval);
			}
		});
	});
	
	$('.map-wrapper .popover h3.popover-title .btn-close').click(function(){
		$('.map-wrapper .popover').css({'display':'none'});
	});
		
	$(".not-status span.da-t").hoverdir({
		hoverDelay	: 50,
		reverse		: true
	});
	if($('body').hasClass('single-post')){
		$("span.da-t").hoverdir({
			hoverDelay	: 50,
			reverse		: true
		});
	}
	
	$(window).load(function(){
		$(window).trigger('resize');
		$('.portfolio-1-arrow').one('click', function(e){
			e.preventDefault();
			var $par = $(this).parent('.portfolio-1-wrapper');
			$par.find('.effect-wrapper').removeClass('play').removeAttr('data-effect');
		});
		$('.portfolio-2-dir').one('click', function(e){
			e.preventDefault();
			var $par = $(this).parent('.portfolio-2-wrapper');
			$par.find('.effect-wrapper').removeClass('play').removeAttr('data-effect');
		});
		$('.recent-1-arrow').one('click', function(e){
			e.preventDefault();
			var $par = $(this).parent('.recent-1-wrapper-carousel');
			$par.find('.effect-wrapper').removeClass('play').removeAttr('data-effect');
		});
		if($(window).width()>=768){
			if ( $('.portfolio-2-container').length ){
				$('.portfolio-2-container').carouFredSel({
					prev: '.portfolio-2-dir.left-dir',
					next: '.portfolio-2-dir.right-dir',
					height: "auto",
					items: {
						visible: 1
					},
					scroll: "quadratic",
					auto: false
				});
			}
			$('.portfolio-1-wrapper').each(function() {
				if( $(this).children('.portfolio-1-container').length > 0){
					$(this).find('.portfolio-1-container').carouFredSel({
						prev: '.portfolio-1-arrow-left',
						next: '.portfolio-1-arrow-right',
						items:{
							visible:{min:1,max:4}
						},
						auto: false,
						responsive: true,
						height: 'auto'
					});
				}
			});
			$('.recent-1-wrapper-carousel').each(function() {
				if( $(this).children('.recent-1-carousel').length > 0){
					$(this).find('.recent-1-carousel').carouFredSel({
						prev: '.recent-1-arrow-left',
						next: '.recent-1-arrow-right',
						items:{
							visible:{min:1,max:4}
						},
						auto: false,
						responsive: true,
						height: 'auto'
					});
				}
			});
		}
		$(".portfolio-item div h6").each(function(){
			var h = $(this).parent().parent().height();
			$(this).css({"margin-top":h/2 - 24});
		});
			
		$(".portfolio-item br").css({"display":"none", "height":0});
		$(".portfolio-item span.da-t div h4").each(function(){
			var h = $(this).parent().height();
			$(this).css({"margin-top":h/2 - 32});
		});
		$('.aq-block-aq_background_block > .column-bg').each(function() {
			var window_w = $(window).width();
			var parent_w = $(this).parent().width();
			$(this).css({'width':window_w, 'left': -(window_w - parent_w)/2});
		});
	});
	
	$(window).load(function(){
		if($(window).width() >= 980){
			setTimeout(function() {
				if ( $('#da-thumbs').length ){
					$('#da-thumbs').isotope({
						animationEngine : 'jquery'
					});
				}
			}, 100);
			setTimeout(function() {
				if ( $('.portfolio-masonry').length ){
					$('.portfolio-masonry').isotope({
						animationEngine : 'jquery', 
						masonry: {
							columnWidth: 240
						}
					});
				}
				if ( $('.testimonial-normal-wrapper').length ){
					$('.testimonial-normal-wrapper').isotope({
						animationEngine : 'jquery', 
						masonry: {
							columnWidth: 80
						}
					});
				}
				if ( $('.recent-1-wrapper').length ){
					$('.recent-1-wrapper').isotope({
						animationEngine : 'jquery',
						masonry: {
							columnWidth: 240
						}
					});
				}
			}, 100);
			if ( $('.recent-1-wrapper-carousel').length ){
				if($('.recent-1-wrapper-carousel').hasClass('isotope')){
					$('.recent-1-wrapper-carousel').isotope('destroy');
				}
			}
		}else if($(window).width() >= 768 && $(window).width() < 980){
			setTimeout(function() {
				if ( $('.portfolio-masonry').length ){
					$('.portfolio-masonry').isotope({
						animationEngine : 'jquery', 
						masonry: {
							columnWidth: 186
						}
					});
				}
				if ( $('.testimonial-normal-wrapper').length ){
					$('.testimonial-normal-wrapper').isotope({
						animationEngine : 'jquery', 
						masonry: {
							columnWidth: 62
						}
					});
				}
				if ( $('.recent-1-wrapper').length ){
					$('.recent-1-wrapper .recent-1-container').isotope({
						animationEngine : 'jquery',
						masonry: {
							columnWidth: 62
						}
					});
				}
			}, 100);
			if ( $('.recent-1-wrapper-carousel').length ){
				if($('.recent-1-wrapper-carousel').hasClass('isotope')){
					$('.recent-1-wrapper-carousel').isotope('destroy');
				}
			}
		}else if($(window).width() < 768 && $(window).width() > 480){
			setTimeout(function() {
				if ( $('.portfolio-masonry').length ){
					$('.portfolio-masonry').isotope({
						animationEngine : 'jquery', 
						masonry: {
							columnWidth: ($(window).width() - $(window).width() * 0,05)/3
						}
					});
				}
				if ( $('.recent-1-wrapper').length ){
					$('.recent-1-wrapper .recent-1-container').isotope({
						animationEngine : 'jquery',
						masonry: {
							columnWidth: ($(window).width() - $(window).width() * 0,05)/3
						}
					});
				}
				if ( $('.recent-1-wrapper-carousel').length ){
					$('.recent-1-wrapper-carousel').isotope({
						animationEngine : 'jquery', 
						masonry: {
							columnWidth: ($(window).width() - $(window).width() * 0,05)/3
						}
					});
				}
			}, 100);
		}else{
			setTimeout(function() {
				if ( $('.portfolio-masonry').length ){
					$('.portfolio-masonry').isotope({
						animationEngine : 'jquery', 
						masonry: {
							columnWidth: ($(window).width() - $(window).width() * 0,08)/2
						}
					});
				}
				if ( $('.recent-1-wrapper').length ){
					$('.recent-1-wrapper .recent-1-container').isotope({
						animationEngine : 'jquery',
						masonry: {
							columnWidth: ($(window).width() - $(window).width() * 0,08)/2
						}
					});
				}
				if ( $('.recent-1-wrapper-carousel').length ){
					$('.recent-1-wrapper-carousel').isotope({
						animationEngine : 'jquery', 
						masonry: {
							columnWidth: ($(window).width() - $(window).width() * 0,08)/2
						}
					});
				}
			}, 100);
		}
	});
	
	$(window).smartresize(function(){
		if ( $('#da-thumbs').length ){
			$('#da-thumbs').isotope({
				animationEngine : 'jquery'
			});
		}
		if($(window).width() >= 980){
			if ( $('.portfolio-masonry').length ){
				$('.portfolio-masonry').isotope({
					animationEngine : 'jquery', 
					masonry: {
						columnWidth: 240
					}
				});
			}
			if ( $('.testimonial-normal-wrapper').length ){
				$('.testimonial-normal-wrapper').isotope({
					animationEngine : 'jquery', 
					masonry: {
						columnWidth: 80
					}
				});
			}
			if ( $('.recent-1-wrapper').length ){
				$('.recent-1-wrapper .recent-1-container').isotope({
					animationEngine : 'jquery',
					masonry: {
						columnWidth: 240
					}
				});
			}
			if ( $('.recent-1-wrapper-carousel').length ){
				if($('.recent-1-wrapper-carousel').hasClass('isotope')){
					$('.recent-1-wrapper-carousel').isotope('destroy');
				}
			}
		}else if($(window).width() <= 979 && $(window).width() >= 768){
			if ( $('.portfolio-masonry').length ){
				$('.portfolio-masonry').isotope({
					animationEngine : 'jquery', 
					masonry: {
						columnWidth: 186
					}
				});
			}
			if ( $('.testimonial-normal-wrapper').length ){
				$('.testimonial-normal-wrapper').isotope({
					animationEngine : 'jquery', 
					masonry: {
						columnWidth: 62
					}
				});
			}
			if ( $('.recent-1-wrapper').length ){
				$('.recent-1-wrapper .recent-1-container').isotope({
					animationEngine : 'jquery',
					masonry: {
						columnWidth: 62
					}
				});
			}
			if ( $('.recent-1-wrapper-carousel').length ){
				if($('.recent-1-wrapper-carousel').hasClass('isotope')){
					$('.recent-1-wrapper-carousel').isotope('destroy');
				}
			}
		}else if($(window).width() <= 767 && $(window).width() > 480){
			if ( $('.portfolio-masonry').length ){
				$('.portfolio-masonry').isotope({
					animationEngine : 'jquery', 
					masonry: {
						columnWidth: ($(window).width() - $(window).width() * 0,05)/3
					}
				});
			}
			if ( $('.recent-1-wrapper').length ){
				$('.recent-1-wrapper .recent-1-container').isotope({
					animationEngine : 'jquery',
					masonry: {
						columnWidth: ($(window).width() - $(window).width() * 0,05)/3
					}
				});
			}
			if ( $('.recent-1-wrapper-carousel').length ){
				$('.recent-1-wrapper-carousel').isotope({
					animationEngine : 'jquery', 
					masonry: {
						columnWidth: ($(window).width() - $(window).width() * 0,05)/3
					}
				});
			}
		}else{
			if ( $('.portfolio-masonry').length ){
				$('.portfolio-masonry').isotope({
					animationEngine : 'jquery', 
					masonry: {
						columnWidth: ($(window).width() - $(window).width() * 0,08)/2
					}
				});
			}
			if ( $('.recent-1-wrapper').length ){
				$('.recent-1-wrapper .recent-1-container').isotope({
					animationEngine : 'jquery',
					masonry: {
						columnWidth: ($(window).width() - $(window).width() * 0,08)/2
					}
				});
			}
			if ( $('.recent-1-wrapper-carousel').length ){
				$('.recent-1-wrapper-carousel').isotope({
					animationEngine : 'jquery', 
					masonry: {
						columnWidth: ($(window).width() - $(window).width() * 0,08)/2
					}
				});
			}
		}
	});
	
	var i = 1;
	
	$("ul[data-liffect] li").each(function (i) {
        $(this).attr("style", "-webkit-animation-delay:" + i * 300 + "ms;"
                + "-moz-animation-delay:" + i * 300 + "ms;"
                + "-o-animation-delay:" + i * 300 + "ms;"
                + "animation-delay:" + i * 300 + "ms;");
        if (i == $("ul[data-liffect] li").size() -1) {
            $("ul[data-liffect]").addClass("play");
        }
    });
	
	$(".filterable").click(function(){
		$("ul[data-liffect]").removeAttr("data-liffect");
		$(".filterable").removeClass("current");
		
		$(this).addClass("current");
		var selector = $(this).find("a").attr("data-filter");
		$('#da-thumbs').isotope({ filter: selector });
		$('.portfolio-masonry').isotope({
			filter: selector
		});
		return false;
	});
		
	if($(window).width() <= 767){
		$('.team.team-even').each(function() {
			var $p  = $(this).find('p'),
				$div = $(this).find('.team-title');
           $(this).append($p);
			$(this).prepend($div);
			$(this).removeClass('team-even');
        });
		$('.history').each(function(i) {
            if(!$(this).hasClass('history-even')){
				var $time = $(this).find('.time-wrapper');
				$(this).prepend($time);
			}
       	});
		if ( $('.portfolio-2-container').length ){
			$(".portfolio-2-container").trigger("destroy", true);
		}
		if ( $('.portfolio-1-container').length ){
			$('.portfolio-1-container').trigger("destroy", true);
		}
		if ( $('.recent-1-carousel').length ){
			$('.recent-1-carousel').trigger("destroy", true);
		}
	}else{
		$('.team').each(function() {
			if($(this).hasClass('team2') && !$(this).hasClass('team-even')){
				$(this).addClass('team-even');
				var $p  = $(this).find('p'),
					$div = $(this).find('.team-title');
				$(this).prepend($p);
				$(this).append($div);
			}
  		});
		$('.history').each(function(i) {
			if(!$(this).hasClass('history-even')){
				var $time = $(this).find('.time-wrapper');
				$(this).append($time);
			}
		});
	}
	
	$(window).resize(function(){
		if($(window).width() >= 980){
			if ($(this).scrollTop() > 50){
				$('#ontop').addClass('ontop-bg');
				$('.logo-wrapper').stop().animate({width:logo_w/1.5, top:logo_t.top/5}, 300);
			} else {
				$('#ontop').removeClass('ontop-bg');
				$('.logo-wrapper').stop().animate({width:logo_w, top:logo_t.top}, 500);
			}
		
		}
		if($(window).width() <= 767){
			$('.team.team-even').each(function() {
				var $p  = $(this).find('p'),
					$div = $(this).find('.team-title');
				$(this).append($p);
				$(this).prepend($div);
				$(this).removeClass('team-even');
			});
			$('.history').each(function(i) {
				if(!$(this).hasClass('history-even')){
					var $time = $(this).find('.time-wrapper');
					$(this).prepend($time);
				}
			});
			if ( $('.portfolio-2-container').length ){
				$(".portfolio-2-container").trigger("destroy", true);
			}
			if ( $('.portfolio-1-container').length ){
				$('.portfolio-1-container').trigger("destroy", true);
			}
			if ( $('.recent-1-carousel').length ){
				$('.recent-1-carousel').trigger("destroy", true);
			}
		}else{
			$('.team').each(function() {
				if($(this).hasClass('team2') && !$(this).hasClass('team-even')){
					$(this).addClass('team-even');
					var $p  = $(this).find('p'),
						$div = $(this).find('.team-title');
					$(this).prepend($p);
					$(this).append($div);
				}
			});
			$('.history').each(function(i) {
				if(!$(this).hasClass('history-even')){
					var $time = $(this).find('.time-wrapper');
					$(this).append($time);
				}
			});
			if ( $('.portfolio-2-container').length ){
				$('.portfolio-2-container').carouFredSel({
					prev: '.portfolio-2-dir.left-dir',
					next: '.portfolio-2-dir.right-dir',
					height: "auto",
					items: {
						visible: 1
					},
					scroll: "quadratic",
					auto: false
				});
			}
			$('.portfolio-1-wrapper').each(function() {
				if( $(this).children('.portfolio-1-container').length > 0){
					$(this).find('.portfolio-1-container').carouFredSel({
						prev: '.portfolio-1-arrow-left',
						next: '.portfolio-1-arrow-right',
						items:{
							visible:{min:1,max:4}
						},
						auto: false,
						responsive: true,
						height: 'auto'
					});
				}
			});
			$('.recent-1-wrapper-carousel').each(function() {
				if( $(this).children('.recent-1-carousel').length > 0){
					$(this).find('.recent-1-carousel').carouFredSel({
						prev: '.recent-1-arrow-left',
						next: '.recent-1-arrow-right',
						items:{
							visible:{min:1,max:4}
						},
						auto: false,
						responsive: true,
						height: 'auto'
					});
				}
			});
		}
		$('.aq-block-aq_background_block > .column-bg').each(function() {
			var window_w = $(window).width();
			var parent_w = $(this).parent().width();
			$(this).css({'width':window_w, 'left': -(window_w - parent_w)/2});
		});
			
	});
	$('.img_block-content').each(function() {
		var $wrapper = $(this).parent('.img_block-wrapper');
		var $wrapper_w = $(this).parent('.img_block-wrapper').width();
		var $wrapper_h = $(this).parent('.img_block-wrapper').height();
		var $content = $(this);
		var $content_w = $(this).width();
		var $content_h = $(this).height();
		var $content_t = $(this).css('margin-top').replace('px', '');
		var $content_l = $(this).css('margin-left').replace('px', '');
		var ratio1 = 724/940;
		if($(window).width() >= 960){
			$content.css({'width':$content_w, 'margin-top':$content_t*1, 'margin-left':$content_l*1});
			$wrapper.css({'width':$wrapper_w,'height':$wrapper_h});
		}else if($(window).width() < 960 && $(window).width() >= 768){
			$content.css({'width':$content_w*ratio1, 'margin-top':$content_t*ratio1, 'margin-left':$content_l*ratio1});
			$wrapper.css({'width':$wrapper_w*ratio1,'height':$wrapper_h*ratio1});
		}
		$(window).resize(function(){
			if($(window).width() >= 960){
				$content.css({'width':$content_w, 'margin-top':$content_t*1, 'margin-left':$content_l*1});
				$wrapper.css({'width':$wrapper_w,'height':$wrapper_h});
			}else if($(window).width() < 960 && $(window).width() >= 768){
				$content.css({'width':$content_w*ratio1, 'margin-top':$content_t*ratio1, 'margin-left':$content_l*ratio1});
				$wrapper.css({'width':$wrapper_w*ratio1,'height':$wrapper_h*ratio1});
			}
		});
	});	

	function adjustIframes()
	{
	  $('.wrapper iframe').each(function(){
		var
		$this       = $(this),
		proportion  = $this.data( 'proportion' ),
		w           = $this.attr('width'),
		actual_w    = $this.width();
		
		if ( ! proportion )
		{
			proportion = $this.attr('height') / w;
			$this.data( 'proportion', proportion );
		}
	  
		if ( actual_w != w )
		{
			$this.css( 'height', Math.round( actual_w * proportion ) + 'px' );
		}
	  });
	}
	
	$(window).on('resize load',adjustIframes);
	
	$('#accordion3 .accordion-group').each(function(){
		if($(this).is('.accordion-group:first-child')){
			$(this).find('.accordion-body').addClass('in');
		}
	});
	$('#accordion2 .accordion-group .accordion-body').removeClass('in');
	$('#accordion2 .accordion-group').each(function(){
		if($(this).is('.accordion-group:first-child')){
			$(this).find('.accordion-body').addClass('in');
		}
	});

	$(".collapse2").collapse({
	  toggle: false
	});
	$('#myTab a:first').tab('show'); // Select first tab
	$('#myTab a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	})
	$('.tab-pane').each(function(){
		$(this).addClass('fade').addClass('in');
	});		
	
	//custom scrollbar
	
	$( '#mi-slider_2' ).catslider();
	var color = $('.column-bg').css("background-color");
	$('.aq-block-aq_column_block .divider-1 .line-1 ul li i').css({'background-color':color});
	$('.aq-block-aq_column_block').each(function(){
		$(this).has('.column-bg-white').addClass('column-section-color');
	});		
	

	var slide = false;
	var height = $('#footer-wrapper').height();
	$('.expand-footer').click(function() {
		var docHeight = $(document).height();
		var windowHeight = $(window).height();
		var scrollPos = docHeight - windowHeight + height;
		$('#footer-wrapper').stop().animate({ height: "toggle"}, 700, 'easeOutQuint');
		if(slide == false) {
			$('html, body').animate({scrollTop: scrollPos+'px'}, 900, 'easeOutQuint');
            slide = true;
							   
		} else {
            slide = false;
        }
	});
});

