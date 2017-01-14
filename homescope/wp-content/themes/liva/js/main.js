(function ($) {
// VERTICALLY ALIGN FUNCTION
$.fn.vAlign = function() {
    return this.each(function(i){
    var ah = $(this).height();
    var ph = $(this).parent().height();
    var mh = Math.ceil((ph-ah) / 2);
    $(this).css('padding-top', mh);
    });
};
})(jQuery);
$(document).ready(function(){



	/*--------------------- Animated Pictures ---------------*/

var anim_block, anim_elem = $('.animated-block'), gn = 1;

if (anim_elem.size() > 0) {
anim_elem.each(function(){
  //jQuery(this).parents('.wrapper').addClass('animated-block');
  var  el_scr = $(this).offset();
  if($('.group1').size()>0) {
  var prev_el = $('.group'+(gn-1)).offset();
    prev_el_top = prev_el.top;
  } else  {
    prev_el_top = 0;
  }
  if (el_scr.top == prev_el_top) {
  $(this).addClass('group'+(gn-1));
  } else {
  $(this).addClass('group'+gn);
    gn++;
  }
  if ($(this).css('opacity') < 1) {
    $(this).addClass('transparent-animation');
  }
  $(this).removeClass($(this).data('animation'));
  return gn;
});

  for (var g = 0; g < gn; g++) {

  var i=0;
  $('.group' + g).each(function(){
    $(this).css({
        '-webkit-animation-delay': i+'s',
        '-moz-animation-delay': i+'s',
        '-o-animation-delay': i+'s',
        '-ms-animation-delay': i+'s',
        'animation-delay': i+'s'
    });
    i=i+0.15;
  });
}
}

  function anim_images() {
    if ($('.media_for_js').css('z-index') == 940) {
      anim_elem.each(function(){
      var el = $(this);
      var block_offset = el.offset();
        if ( $(window).scrollTop() + window.innerHeight > block_offset.top+el.height()/2) {
            el.addClass(el.data('animation') + ' animated');
        }
      });
    }
}


    $(window).scroll(function() {
        anim_images();
    });

  $(window).load(function() {
    setTimeout(anim_images,300);
  setTimeout(function(){  $('.flexslider').animate({opacity:1},500);},0)
  });


/*--------------------- Animated Pictures ---------------*/




	var win_h = $(window).height();
	function setHeight(){
		$('.home > .hero').css({height:win_h});
		$(".vcenter").vAlign();
	}

	setHeight();

	$(window).bind('resize',function() {
		setHeight();
	});

	if ( $('#menu').length > 0 ) {

		$('#menu').onePageNav({

		   currentClass: 'current',
		   changeHash: false,
		   scrollSpeed: 900,
		   scrollOffset: 69,
		   scrollThreshold: 0.1,
		   filter: ':not(.external)',
		   begin: function() {
			   //I get fired when the animation is starting
		   },
		   end: function() {
			   //I get fired when the animation is ending
		   },
		   scrollChange: function() {
			   //I get fired when you enter a section and I pass the list item of the section
		   }
	   });
	}

     $('#nav-button').click(function(){
        $top_nav = $('#menu');
        if($top_nav.is(':hidden')){
            $top_nav.slideDown("slow");
        }else{
            $top_nav.slideUp();
        }
     })


  $('.icon-box5').parent('div').addClass('bordered');

  var main_menu = $('#trueHeader').find('ul.menu').attr('id');
  if ($('#'+main_menu).length > 0) {
    selectnav(main_menu, {
        label: '--- Navigation --- ',
        indent: '-'
      });
  }
  //recent projects shortcode
  var $container = $('.portfolioContainer');
    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });

    $('.portfolioFilter a').click(function(){
        $('.portfolioFilter .current').removeClass('current');
        $(this).addClass('current');

        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
         });
         return false;
    });

	//tweets time
	$('.tweet_time').each(function() {

		var date = new Date($(this).html()),
		diff = (((new Date()).getTime() - date.getTime()) / 1000),
		day_diff = Math.floor(diff / 86400);

		if ( isNaN(day_diff) || day_diff < 0)
		{
			$(this).html('');
		}

		difference_text = day_diff == 0 && (
			diff < 60 && locales.just_now ||
			diff < 120 && locales.one_minute_ago ||
			diff < 3600 && Math.floor( diff / 60 ) + " " + locales.minutes_ago ||
			diff < 7200 && main.one_hour_ago ||
			diff < 86400 && Math.floor( diff / 3600 ) + " " + locales.hours_ago) ||
			day_diff == 1 && locales.yesterday ||
			day_diff < 7 && day_diff + " " + locales.days_ago||
			day_diff < 31 && Math.ceil( day_diff / 7 ) + " " + locales.weeks_ago ||
			day_diff < 365 && Math.ceil( day_diff / 30 ) + " " + locales.months_ago ||
			day_diff < 730  && locales.one_year_ago ||
			day_diff >= 730  && Math.ceil( day_diff / 365 ) + " " + locales.years_ago;

		$(this).html(difference_text);
	});

	 $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });

        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 500);
            return false;
        });


/*--------------------- Fancybox ---------------*/

	/* Simple image gallery. Uses default settings */
	$('.fancybox').fancybox({
		width		: 680,
		heights		: 495

	});

	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});

/*--------------------- Portfolio isotope ---------------*/

	if ($('.portfolioContainer').length > 0) {

		var $container = $('.portfolioContainer');
		$container.isotope({
			filter: '*',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});

		$('.portfolioFilter a').click(function(){
			$('.portfolioFilter .current').removeClass('current');
			$(this).addClass('current');

			var selector = $(this).attr('data-filter');
			$container.isotope({
				filter: selector,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			 });
			 return false;
		});
	}


/*----------- Flexslider ----------*/

    var $window = jQuery(window), flexslider;
    var move = 1;
    function full_w(sl) {
      if (sl.hasClass('full-width')) {
        var ml = (-($(window).width() - sl.parents('.featured-projects').width())/2)-1;
        sl.css({
          'margin-left': ml,
          width:$(window).width()
        });
        move=5;
      }
      return move;
    }
    function getGridSize(sl) {
      var gridsize;
      if (window.innerWidth > 767) {
        if (sl.is('.five-col')) { gridsize = 5 }
          else if (sl.is('.four-col')) { gridsize = 4 }
            else if (sl.is('.three-col')) { gridsize = 3 }
              else if (sl.is('.two-col')) { gridsize = 2 }
          } else {
            gridsize = (window.innerWidth < 325) ? 1 :
            (window.innerWidth < 565) ? 2 :
            (window.innerWidth < 767) ? 3 : 3;
          }
          if (sl.is('.one-col')) { gridsize = 1 }
          return gridsize;
        }
        var sliders = [];

        function flexslider_init() {
          jQuery('.flexslider').each(function(){
            var fs = jQuery(this);
            if (!fs.parents('.open-project').length) {
            fs.removeData('flexslider');
            var selector = (fs.hasClass('fs-inner')) ? '.slides-inner > li' : '.slides > li';
            var slideshow = (fs.hasClass('fs-inner')) ? true : false;
            var animation = (fs.is('.gallery-slider')) ? 'fade' : 'slide';
            var cnav = (fs.hasClass('control-nav')) ? true : false;
            var dnav = (fs.hasClass('direction-nav')) ? true : false;
            var it_w = ($(this).hasClass('vertical')) ? 0 : 200;
            var direction = ($(this).hasClass('vertical')) ? 'vertical' : 'horizontal';
            full_w(fs);

			fs.flexslider({
              animation: "slide",
              animationLoop: true,
              itemWidth: it_w,
              itemMargin: 0,
              smoothHeight: true,
              directionNav: dnav,
              direction: direction,
              slideshow: slideshow,
              controlNav: cnav,
              animation: animation,
              selector: selector,
              move: move,
              slideshowSpeed: 7000,
              minItems: getGridSize(fs),
              maxItems: getGridSize(fs),
              start: function(slider){
                jQuery('body').removeClass('loading');
                sliders.push(slider);
                iframe_size();
                jQuery('.flexslider').animate({opacity:1},500);
                jQuery('.item-con-t1').animate({opacity:1},500);
              }
            });

			if (fs.hasClass('custom-nav') && fs.attr('data-nav-container') != undefined && fs.attr('data-nav-container') != "") {
			  if (fs.closest('.' + fs.attr('data-nav-container')).length > 0) {
			    fsc = fs.closest('.' + fs.attr('data-nav-container'));
				fsc.find('.flex-prev').click(function(){
					fs.flexslider("prev");
				});

				fsc.find('.flex-next').click(function(){
					fs.flexslider("next");
				});
			  }
			}

            }
          });
	}

	$window.load(function() {
	  flexslider_init();
	});

  function slider_grid_size() {
    jQuery.each(sliders, function(i, val) {
      full_w(val)
      val.vars.minItems = getGridSize(val);
      val.vars.maxItems = getGridSize(val);
    });
  }


if ($('.flexslider').length > 0) {
  $window.resizeComplete(function() {
      slider_grid_size();
  },300);
}

/*------ /Flexslider ---------*/

/*-------------- Counters --------------*/


function is_visible(el) {
  var el_off = el.offset(),
  el_top = el_off.top;
  if ($(window).scrollTop() > el_top - window.innerHeight*0.9) {
    return true;
  }
}


$('.fun_facts > li').data('play','false');
function round_counter() {

  $('.fun_facts > li').each(function(){
      var $elm     = $(this),
          sign     = $elm.data("sign"),
          speed    = $elm.data("speed"),
          sign_pos = $elm.data("sign-position"),
          from     = {property: 0},
          to       = {property: $elm.data('quantity')};
    if (is_visible($(this)) && $(this).data('play') == 'false' ) {
      $(from).animate(to, {
        duration: speed,
        step: function() {
          if (!sign_pos=='') {
            if (sign_pos == "before") {
                $elm.find('b').html(sign + Math.ceil(this.property));
            } else {
                $elm.find('b').html(Math.ceil(this.property) + sign);
            }
          } else {
            $elm.find('b').html(Math.ceil(this.property));
          }
        }
      });
      $elm.data('play','true');
    }
  });
}





/*----------- Skills animation -----------*/


  jQuery('.ui-progress-bar').data('play','false');

  function skills_animation() {
  jQuery('.ui-progress-bar').each(function(){
  if (is_visible($('.ui-progress-bar')) && $(this).data('play') == 'false') {
      per = jQuery(this).find('b').attr('data-value');
     var bar = jQuery(this).children('.ui-progress');
     bar.css({'width':0, 'opacity':1}) 
        .animate({ "width" : per + "%"},
        {
          step:function(){

              var skill_width = jQuery(this).attr('style').match(/\d+/)[0];
                jQuery(this).find('b').html(parseInt(skill_width)+'%');
               },
          duration:  per*30
        });
      $(this).data('play','true')
    }
  });
}



$(window).scroll(function(){
    skills_animation();
    round_counter();
});
$(window).load(function(){
    skills_animation();
    round_counter();
});




});