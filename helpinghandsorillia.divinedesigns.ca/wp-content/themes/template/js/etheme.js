jQuery(document).ready(function($){


    // **********************************************************************// 
    // ! 8theme Mega Search
    // **********************************************************************//
    
    $.fn.etMegaSearch = function ( options ) {
		var et_search = $(this);
		var form = et_search.find('form');
		var input = form.find('input[type="text"]');
		var resultArea = et_search.find('.et-search-result');
		var close = et_search.find('.et-close-results');
		
		input.keyup(function() {
		
			if($(this).val() == '' || $(this).val().length < 3) {
                et_search.removeClass('loading result-exist');
				return;
			}
			
			data = 's='+$(this).val() + '&products=' + et_search.data('products') + '&count=' + et_search.data('count') + '&images=' + et_search.data('images') + '&posts=' + et_search.data('posts') + '&portfolio=' + et_search.data('portfolio') + '&pages=' + et_search.data('pages') + '&action=et_get_search_result';
			
			et_search.addClass('loading');
        	resultArea.html('');
			
            $.ajax({
                url: myAjax.ajaxurl,
                method: 'GET',
                data: data,
                dataType: 'JSON',
                error: function(data) {
                    console.log('AJAX error');
                },
                success : function(data){
                	if(data.results) {
	                	et_search.addClass('result-exist');
                	} else {
	                	et_search.removeClass('result-exist');
                	}
                	resultArea.html(data.html);
                },
                complete : function() {
	                et_search.removeClass('loading');
                }
            });			
		});
		
		close.click(function() {
			et_search.removeClass('result-exist');
		});

        return this;
    }
    
    $('.et-mega-search').each(function(){
	    $(this).etMegaSearch();
    });
    

    

    // **********************************************************************// 
    // ! Countdown
    // **********************************************************************//


    $.fn.countdown = function ( options ) {

        var settings = $.extend({
            type: "default"
        }, options );

        setInterval(function countdown_update() {
            var countdown = $('.et-timer');
            var eventDate = Date.parse(countdown.data('final')) / 1000;
            var currentDate = Math.floor($.now() / 1000);
            var days = countdown.find('.days');
            var hours = countdown.find('.hours');
            var minutes = countdown.find('.minutes');
            var seconds = countdown.find('.seconds');
            
            var remindSeconds = eventDate-currentDate;
            
            if(remindSeconds > 0) {
                var remindDays = Math.floor(remindSeconds / (60 * 60 * 24));
                remindSeconds -= remindDays * 60 * 60 * 24;
                var remindHours = Math.floor(remindSeconds / (60 * 60));
                remindSeconds -= remindHours * 60 * 60;
                var remindMinutes = Math.floor(remindSeconds / (60));
                remindSeconds -= remindMinutes * 60;
                 
                if(remindDays < 10) remindDays = '0' + remindDays;
                if(remindHours < 10) remindHours = '0' + remindHours;
                if(remindMinutes < 10) remindMinutes = '0' + remindMinutes;
                if(remindSeconds < 10) remindSeconds = '0' + remindSeconds;
                
                if(days < 1 || remindDays == '00') {
                    days.parent().hide().next().hide();
                } else {
                    days.text(remindDays);
                }
                hours.text(remindHours);
                minutes.text(remindMinutes);
                seconds.text(remindSeconds);
            }
            
        }, 1000);

        return this;
    }

    $('.et-timer').countdown();


    



    
    // **********************************************************************// 
    // ! Mobile loader
    // **********************************************************************//
    $('.mobile-loader > div').fadeOut(300);
    $('.mobile-loader').delay(300).fadeOut(800, function(){
        $('.mobile-loader').remove();
    });

    // **********************************************************************// 
    // ! Product images sections loading
    // **********************************************************************//
    
    $('.single-product-page .images').addClass('shown');


    // **********************************************************************// 
    // ! Animated Counters
    // **********************************************************************//

    function animateCounter(el) {
        var initVal = parseInt(el.text());
        var finalVal = el.data('value');
        if(finalVal <= initVal) return;
        var intervalTime = 1;
        var time = 200;
        var step = parseInt((finalVal - initVal)/time.toFixed());
        if(step < 1) {
            step = 1;
            time = finalVal - initVal;
        }
        var firstAdd = (finalVal - initVal)/step - time;
        var counter = parseInt((firstAdd*step).toFixed()) + initVal;
        var i = 0;
        var interval = setInterval(function(){
            i++;
            counter = counter + step;
            el.text(counter);
            if(i == time) {
                clearInterval(interval);
            }
        }, intervalTime);
    }

    // **********************************************************************// 
    // ! Full width section
    // **********************************************************************//
    
    function et_sections(){
    	
        $('.et_section').each(function(){
            $(this).css({
                'left': - ($(window).width() - $('.header > .container').width())/2,
                'width': $(window).width(),
                'visibility': 'visible'
            });
            var videoTag = $(this).find('.section-back-video video');
            videoTag.css({
                'width': $(window).width(),
                //'height': $(window).width() * videoTag.height() / videoTag.width() 
            });
        });

    }

    et_sections()

    $(window).resize(function(){
        et_sections();
    })
    
    
    // **********************************************************************// 
    // ! Hidden Top Panel
    // **********************************************************************//

    $(function(){
        var topPanel = $('.top-panel');
        var pageWrapper = $('.page-wrapper');
        var showPanel = $('.show-top-panel');
        var panelHeight = topPanel.outerHeight();
        showPanel.toggle(function(){
            $(this).addClass('show-panel');
            pageWrapper.attr('style','transform: translateY('+panelHeight+'px);-ms-transform: translateY('+panelHeight+'px);-webkit-transform: translateY('+panelHeight+'px);');
            topPanel.addClass('show-panel');
        },function(){
            pageWrapper.attr('style','')
            topPanel.removeClass('show-panel');
            $(this).removeClass('show-panel');
        });
    });

    // **********************************************************************// 
    // ! Remove some br and p
    // **********************************************************************//
    $('.toggle-element ~ br').remove();
    $('.toggle-element ~ p').remove();
    $('.block-with-ico h5').next('p').remove();
    $('.tab-content .row-fluid').next('p').remove();
    $('.tab-content .row-fluid').prev('p').remove();


    

    // **********************************************************************// 
    // ! Fade animations
    // **********************************************************************//

    setTimeout(function() {
        $('.fade-in').removeClass('fade-in');
    }, 500);
    
    // **********************************************************************// 
    // ! Products grid images slider
    // **********************************************************************//

    function contentProdImages() {
        $('.hover-effect-slider').each(function() {
            var slider = $(this);
            var index = 0;
            var autoSlide;
            var imageLink = slider.find('.product-content-image');
            var imagesList = imageLink.data('images-list');
            imagesList = imagesList.split(",");
            var arrowsHTML = '<div class="small-slider-arrow arrow-left">left</div><div class="small-slider-arrow arrow-right">right</div>';
            var counterHTML = '<div class="slider-counter"><span class="current-index">1</span>/<span class="slides-count">' + imagesList.length + '</span></div>';

            if(imagesList.length > 1) {
                slider.prepend(arrowsHTML);
                slider.prepend(counterHTML);

                // Previous image on click on left arrow
                slider.find('.arrow-left').click(function(event) {
                    if(index > 0) {
                        index--; 
                    } else {
                        index = imagesList.length-1; // if the first item set it to last
                    }
                    imageLink.find('img').attr('src', imagesList[index]); // change image src
                    slider.find('.current-index').text(index + 1); // update slider counter
                });

                // Next image on click on left arrow
                slider.find('.arrow-right').click(function(event) {
                    if(index < imagesList.length - 1) {
                        index++;
                    } else {
                        index = 0; // if the last image set it to first
                    }
                    imageLink.find('img').attr('src', imagesList[index]);// change image src
                    slider.find('.current-index').text(index + 1);// update slider counter
                });


            }

        });
    }

    contentProdImages();

    // **********************************************************************// 
    // ! Wishlist
    // **********************************************************************//
    $('.yith-wcwl-add-button.show').each(function(){
        var wishListText = $(this).find('a').text();
        $(this).find('a').attr('data-hover',wishListText);
    });    

    // **********************************************************************// 
    // ! Main Navigation plugin
    // **********************************************************************//

    $.fn.et_menu = function ( options ) {
        var methods = {
            showChildren: function(el) {
                el.fadeIn(100).css({
                    display: 'list-item',
                    listStyle: 'none'
                }).find('li').css({listStyle: 'none'});
            },
            calculateColumns: function(el) {
                // calculate columns count
                var columnsCount = el.find('.container > ul > li.menu-item-has-children').length;
                var dropdownWidth = el.find('.container > ul > li').outerWidth();
                var padding = 20;
                if(columnsCount > 1) {
                    dropdownWidth = dropdownWidth*columnsCount + padding;
                    el.css({
                        'width':dropdownWidth
                    });
                }

                // calculate right offset of the  dropdown
                var headerWidth = $('.menu-wrapper').outerWidth();
                var headerLeft = $('.menu-wrapper').offset().left;
                var dropdownOffset = el.offset().left - headerLeft;
                var dropdownRight = headerWidth - (dropdownOffset + dropdownWidth);

                if(dropdownRight < 0) {
                    el.css({
                        'left':'auto',
                        'right':0
                    });
                } 
            },
            openOnClick: function(el,e) {
                var timeOutTime = 0;
                var openedClass = "current";
                var header = $('.header-wrapper');
                var $this = el;


                if($this.parent().hasClass(openedClass)) {
                    e.preventDefault();
                    $this.parent().removeClass(openedClass);
                    $this.next().stop().slideUp(settings.animTime);
                    header.stop().animate({'paddingBottom': 0}, settings.animTime);
                } else {

                    if($this.parent().find('>div').length < 1) {
                        return;
                    }

                    e.preventDefault();

                    if($this.parent().parent().find('.' + openedClass).length > 0) {
                        timeOutTime = settings.animTime;
                        header.stop().animate({'paddingBottom': 0}, settings.animTime);
                    }

                    $this.parent().parent().find('.' + openedClass).removeClass(openedClass).find('>div').stop().slideUp(settings.animTime);

                    setTimeout(function(){
                        $this.parent().addClass(openedClass);
                        header.stop().animate({'paddingBottom': $this.next().height()+50},settings.animTime);
                        $this.next().stop().slideDown(settings.animTime);
                    },timeOutTime);
                }
            }
        };

        var settings = $.extend({
            type: "default", // can be columns, default, mega, combined
            animTime: 250,
            openByClick: true
        }, options );

        if(settings.type == 'mega') {
            this.find('>li>a').click(function(e) {
                methods.openOnClick($(this),e);
            });
            return this;
        }

        this.find('>li').hover(function (){
            if(!$(this).hasClass('open-by-click') || (!settings.openByClick && $(this).hasClass('open-by-click'))) {
                if(settings.openByClick) {
                    $('.open-by-click.current').find('>a').click();
                    $(this).find('>a').unbind('click');
                }
                var dropdown = $(this).find('> .nav-sublist-dropdown');
                methods.showChildren(dropdown);

                if(settings.type == 'columns') {
                    methods.calculateColumns(dropdown);
                }
            } else {
                $(this).find('>a').unbind('click');
                $(this).find('>a').bind('click', function(e) {
                    methods.openOnClick($(this),e);
                });
            }
        }, function () {
            if(!$(this).hasClass('open-by-click') || (!settings.openByClick && $(this).hasClass('open-by-click'))) {
                $(this).find('> .nav-sublist-dropdown').fadeOut(100).attr('style', '');
            }
        });

        return this;
    }

    // First Type of column Menu
    $('.main-nav .menu').et_menu({
        type: "default"
    });

    $('.fixed-header .menu').et_menu({
        openByClick: false
    });
    


    function et_equalize_height(elements, removeHeight) {
        var heights = [];

        if(removeHeight) {
            elements.attr('style', '');
        }

        elements.each(function(){
            heights.push($(this).height());
        });

        var maxHeight = Math.max.apply( Math, heights );
        if($(window).width() > 767) {
            elements.height(maxHeight);
        }
    }

    $(window).resize(function(){
        //et_equalize_height($('.product-category'), true);
    });

    // **********************************************************************// 
    // ! "Top" button
    // **********************************************************************//

    var scroll_timer;
    var displayed = false;
    var $message = jQuery('.back-to-top');
    
    jQuery(window).scroll(function () {
        window.clearTimeout(scroll_timer);
        scroll_timer = window.setTimeout(function () { 
        if(jQuery(window).scrollTop() <= 0) 
        {
            displayed = false;
            $message.removeClass('btt-shown');
        }
        else if(displayed == false) 
        {
            displayed = true;
            $message.stop(true, true).addClass('btt-shown').click(function () { $message.removeClass('btt-shown'); });
        }
        }, 400);
    });
    
    jQuery('.back-to-top').click(function(e) {
            jQuery('html, body').animate({scrollTop:0}, 600);
            return false;
    });


 

    // **********************************************************************// 
    // ! Fixed header
    // **********************************************************************// 
    
    $(window).scroll(function(){
        if (!$('body').hasClass('fixNav-enabled')) {return false; }
        var fixedHeader = $('.fixed-header-area');
        var scrollTop = $(this).scrollTop();
        var headerHeight = $('.header-wrapper').height() + 20;
        
        if(scrollTop > headerHeight){
            if(!fixedHeader.hasClass('fixed-already')) {
                fixedHeader.stop().addClass('fixed-already');
            }
        }else{
            if(fixedHeader.hasClass('fixed-already')) {
                fixedHeader.stop().removeClass('fixed-already');
            }
        }
    });
    // **********************************************************************// 
    // ! Icons Preview
    // **********************************************************************// 

    var modalDiv = $('#iconModal');
    
    $('.demo-icons .demo-icon').click(function(){

        var name = $(this).find('i').attr('class');

        
        modalDiv.find('i').each(function(){
            $(this).attr('class',name);
        });
        
        modalDiv.find('#myModalLabel').text(name);
        
        modalDiv.modal();
    });



    // **********************************************************************// 
    // ! Search form
    // **********************************************************************// 
    
    var searchBlock = $('.search.hide-input');
    var searchForm = searchBlock.find('#searchform');
    var searchBtn = searchForm.find('.button');
    var searchInput = searchForm.find('input[type="text"]');

    searchBtn.click(function(e) {
        e.preventDefault();
        searchInput.fadeIn(200).focus();
        $('body').addClass('search-input-shown');


        // Hide search input on click
        $(document).click(function(e) {
            var target = e.target;
            if (!$(target).is('.search.hide-input') && !$(target).parents().is('.search.hide-input')) {
                searchInput.fadeOut(200);
                $('body').removeClass('search-input-shown');
            }
        });

    });

    // **********************************************************************// 
    // ! Tabs
    // **********************************************************************// 

    var tabs = $('.tabs');
    $('.tabs > p > a').unwrap('p');
    
    var leftTabs = $('.left-bar, .right-bar');
    var newTitles;
    
    leftTabs.each(function(){
        var currTab = $(this);
        //currTab.find('> a.tab-title').each(function(){
            newTitles = currTab.find('> a.tab-title').clone().removeClass('tab-title').addClass('tab-title-left');
        //});

        newTitles.first().addClass('opened');

        
        var tabNewTitles = $('<div class="left-titles"></div>').prependTo(currTab);
        tabNewTitles.html(newTitles);

        currTab.find('.tab-content').css({
            'minHeight' : tabNewTitles.height()
        });
    });
    
    
    tabs.each(function(){
        var currTab = $(this);
        
        if(!currTab.hasClass('closed-tabs')) {
	        currTab.find('.tab-title').first().addClass('opened').next().show();
        }

        currTab.find('.tab-title, .tab-title-left').click(function(e){
            
            e.preventDefault();
            
            var tabId = $(this).attr('id');
        
            if($(this).hasClass('opened')){
                if(currTab.hasClass('accordion') || $(window).width() < 767){
                    $(this).removeClass('opened');
                    $('#content_'+tabId).hide();
                }
            }else{
                currTab.find('.tab-title, .tab-title-left').each(function(){
                    var tabId = $(this).attr('id');
                    $(this).removeClass('opened');
                    $('#content_'+tabId).hide();
                });


                if(currTab.hasClass('accordion') || $(window).width() < 767){
                    $('#content_'+tabId).removeClass('tab-content').show();
                    setTimeout(function(){
                        $('#content_'+tabId).addClass('tab-content').show(); // Fix it
                    },1);
                } else {
                    $('#content_'+tabId).show();
                }
                $(this).addClass('opened');
            }
        });
    });
    
    

    /*
    * Variations images changes
    * to make it work properly comment in woocommerce/assets/js/frontend/add-to-cart-variation.js 
    * this.unbind( 'check_variations update_variation_values found_variation' );
    */
    $('form.variations_form').on( 'found_variation', function( event, variation ) {
        var $variation_form = $(this);
        var $product        = $(this).closest( '.product' );
        var $product_img    = $product.find( 'a#main-zoom-image img:eq(0)' );
        var $product_link   = $product.find( 'a#main-zoom-image' );

        $product_link.attr('data-o_href',$product_link.attr('href'));

        var o_src           = $product_img.attr('data-o_src');
        var o_title         = $product_img.attr('data-o_title');
        var o_href          = $product_link.attr('data-o_href');

        var variation_image = variation.image_src;
        var variation_link = variation.image_link;
        var variation_title = variation.image_title;

        $('.woocommerce-main-image').attr('href', variation_image);
                    
        if ($('.main-image-slider').hasClass('zoom-enabled')) {
        	console.log(variation_image);
        	console.log(variation_link);
            if($(window).width() > 768 && variation_image.length > 5 && variation_link.length > 5){
                $('a#main-zoom-image').swinxyzoom('load', variation_image,  variation_link);
            }

            $('a#main-zoom-image').attr('href', variation_link);

            //$('.product-thumbnails-slider li:eq(0) img').attr('src', variation_image);
        } else{

            $('a#main-zoom-image').attr('href', variation_link);

            //$('.product-thumbnails-slider li:eq(0) img').attr('src', variation_image);
        }

    })              
    // Reset product image
    .on( 'reset_image', function( event ) {
    

        var $product        = $(this).closest( '.product' );
        var $product_img    = $product.find( 'a#main-zoom-image img:eq(0)' );
        var $product_link   = $product.find( 'a#main-zoom-image' );

        var o_src           = $product_img.attr('data-o_src');
        var o_href          = $product_link.attr('data-o_href');

        $('.woocommerce-main-image').attr('href', o_href);

        if ($('.main-image-slider').hasClass('zoom-enabled')) {
            if($(window).width() > 768 && o_src.length > 5 && o_href.length > 5){
                $('a#main-zoom-image').swinxyzoom('load', o_src,  o_href);
            }

            $('a#main-zoom-image').attr('href', o_href);

            //$('.product-thumbnails-slider li:eq(0) img').attr('src', o_src);
        } else{
            $('a#main-zoom-image').attr('href', o_href);

            //$('.product-thumbnails-slider li:eq(0) img').attr('src', o_src);
        }


    } );

    // **********************************************************************// 
    // ! Toggle elements
    // **********************************************************************// 


    var etoggle = $('.toggle-block');
    var etoggleEl = etoggle.find('.toggle-element');


    //etoggleEl.first().addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').show();

    etoggleEl.find('.toggle-title').click(function(e) {
        e.preventDefault();
        if($(this).hasClass('opened')) {
            $(this).removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
        }else {
            if($(this).parent().hasClass('noMultiple')){
                $(this).parent().find('.toggle-element').removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
            }
            $(this).addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').slideDown(200);
        }
    });


    // **********************************************************************// 
    // ! Mobile navigation
    // **********************************************************************// 

    var navList = $('.mobile-nav div > ul');
    var etOpener = '<span class="open-child">(open)</span>';
    navList.addClass('et-mobile-menu');
    
    navList.find('li:has(ul)',this).each(function() {
        $(this).prepend(etOpener);
    })
    
    navList.find('.open-child').click(function(){
        if ($(this).parent().hasClass('over')) {
            $(this).parent().removeClass('over').find('>ul').slideUp(200);
        }else{
            $(this).parent().parent().find('>li.over').removeClass('over').find('>ul').slideUp(200);
            $(this).parent().addClass('over').find('>ul').slideDown(200);
        }
    });
    
    $('.menu-icon, .close-mobile-nav').click(function(event) {
        if(!$('body').hasClass('mobile-nav-shown')) {
            $('body').addClass('mobile-nav-shown', function() {
                // Hide search input on click
                setTimeout(function(){
                    $(document).one("click",function(e) {
                        var target = e.target;
                        if (!$(target).is('.mobile-nav') && !$(target).parents().is('.mobile-nav')) {

                                    $('body').removeClass('mobile-nav-shown');
                        }
                    });  
                }, 111);
            });



        } else{
            $('body').removeClass('mobile-nav-shown');
        }
    });

    // **********************************************************************// 
    // ! Side Block
    // **********************************************************************// 

    $('.side-area-icon, .close-side-area').click(function(event) {
        if(!$('body').hasClass('shown-side-area')) {
            $('body').addClass('shown-side-area', function() {
                // Hide search input on click
                setTimeout(function(){
                    $(document).one("click",function(e) {
                        var target = e.target;
                        if (!$(target).is('.side-area') && !$(target).parents().is('.side-area')) {
                            $('body').removeClass('shown-side-area');
                        }
                    });  
                }, 111);
            });
        } else{
            $('body').removeClass('shown-side-area');
        }
    });


    // **********************************************************************// 
    // ! Alerts
    // **********************************************************************// 

    function closeParentBtn(){
        var closeParentBtn = jQuery('.close-parent');

        closeParentBtn.click(function(e){
            closeParent(this);
        });

        function closeParent(el) {
            jQuery(el).parent().slideUp(100);
        }
    }

    closeParentBtn();

    // **********************************************************************// 
    // ! Contact Form ajax
    // **********************************************************************// 

    var eForm = $('#contact-form');
    var spinner = jQuery('.spinner');

    $('.required-field').focus(function(){
        $(this).removeClass('validation-failed');
    });

    eForm.find('#submit').click(function(e){
        e.preventDefault();
        $('#contactsMsgs').html('');
        spinner.show();
        var errmsg;
        errmsg = '';

        eForm.find('.required-field').each(function(){
            if($(this).val() == '') {       
                    $(this).addClass('validation-failed');
                }
        });

        if(errmsg){
            $('#contactsMsgs').html('<p class="error">' + errmsg + '</p>');
            spinner.hide();
        }else{
            
            url = eForm.attr('action');
            
            data = eForm.serialize();
                   
            $.ajax({
                url: url,
                method: 'GET',
                data: data,
                error: function(data) {
                    $('#contactsMsgs').html('<p class="error">Error while ajax request<span class="close-parent"></span></p>');
                    spinner.hide();
                },
                success : function(data){
                    if (data.status == 'success') {
                        $('#contactsMsgs').html('<p class="success">' + data.msg + '<span class="close-parent"></span></p>');
                        eForm.find("input[type=text], textarea").val("");
                    }else{
                        $('#contactsMsgs').html('<p class="error">' + data.msg + '<span class="close-parent"></span></p>');
                    }
                    spinner.hide();
                    closeParentBtn();
                }
            });
            
        }

    });

    // **********************************************************************// 
    // ! Custom Comment Form Validation
    // **********************************************************************// 
    var ethemeCommentForm = $('#commentform');

    ethemeCommentForm.find('#submit').click(function(e){
        $('#commentsMsgs').html('');

        ethemeCommentForm.find('.required-field').each(function(){
            if($(this).val() == '') { 
                $(this).addClass('validation-failed');
                e.preventDefault();
            }   
        });

    });
    // **********************************************************************// 
    // ! Load in view 
    // **********************************************************************// 
    
    var counters = $('.animated-counter');

    counters.each(function(){
        $(this).waypoint(function(){
            animateCounter($(this));
        }, { offset: '100%' });
    });

    var progressBars = $('.progress-bars');
    /*
        progressBars.waypoint(function() {
            i = 0;
            $(this).find('.progress-bar').each(function () {
                i++;
                
                var el = $(this);
                var width = $(this).data('width');
                setTimeout(function(){
                    el.find('div').animate({
                        'width' : width + '%'
                    },400);
                    el.find('span').css({
                        'opacity' : 1
                    });
                },i*300, "easeOutCirc");
            
            });
        }, { offset: '85%' });
    */

    // helper hex to rgb
    function componentToHex(c) {
        var hex = c.toString(16);
        return hex.length == 1 ? "0" + hex : hex;
    }

    function rgbToHex(r, g, b) {
        return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
    }

    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    $('.parallax .banner-bg').each(function(){
        $(this).parallax('50%',0.05);
    });


    if($(window).width() > 767) { 
	    $('.parallax-section').each(function(){
	        var speed = 0.1;
	        if($(this).data('parallax-speed') != '') {
	            speed = $(this).data('parallax-speed');
	        }
	        $(this).parallax('50%', speed);
	    });  
    }



}); // document ready


/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function( $ ){
    var $window = $(window);
    var windowHeight = $window.height();

    $window.resize(function () {
        windowHeight = $window.height();
    });

    $.fn.parallax = function(xpos, speedFactor, outerHeight) {
        var $this = $(this);
        var getHeight;
        var firstTop;
        var paddingTop = 0;
        
        
        //get the starting position of each element to have parallax applied to it      
        $this.each(function(){
            firstTop = $this.offset().top;
        });

        if (outerHeight) {
            getHeight = function(jqo) {
                return jqo.outerHeight(true);
            };
        } else {
            getHeight = function(jqo) {
                return jqo.height();
            };
        }
            
        // setup defaults if arguments aren't specified
        if (arguments.length < 1 || xpos === null) xpos = "50%";
        if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
        if (arguments.length < 3 || outerHeight === null) outerHeight = true;
        
        // function to be called whenever the window is scrolled or resized
        function update(){
            var pos = $window.scrollTop();              

            $this.each(function(){
                var $element = $(this);
                var top = $element.offset().top; 
                var height = getHeight($element);
                var viewportBottom = pos + windowHeight; 

                // Check if totally above or totally below viewport
                if (top + height < pos || top > viewportBottom) {
                    return;
                }
                
                
                //$this.css('backgroundPosition', xpos + " " + Math.round((top - viewportBottom) * speedFactor) + "px");
                $this.style('background-position', xpos + " " + Math.round((top - viewportBottom) * speedFactor) + "px", 'important');
            });
        }       

        $window.bind('scroll', update).resize(update);
        update();
    };
})(jQuery);

(function($) {    
  if ($.fn.style) {
    return;
  }

  // Escape regex chars with \
  var escape = function(text) {
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
  };

  // For those who need them (< IE 9), add support for CSS functions
  var isStyleFuncSupported = !!CSSStyleDeclaration.prototype.getPropertyValue;
  if (!isStyleFuncSupported) {
    CSSStyleDeclaration.prototype.getPropertyValue = function(a) {
      return this.getAttribute(a);
    };
    CSSStyleDeclaration.prototype.setProperty = function(styleName, value, priority) {
      this.setAttribute(styleName, value);
      var priority = typeof priority != 'undefined' ? priority : '';
      if (priority != '') {
        // Add priority manually
        var rule = new RegExp(escape(styleName) + '\\s*:\\s*' + escape(value) +
            '(\\s*;)?', 'gmi');
        this.cssText =
            this.cssText.replace(rule, styleName + ': ' + value + ' !' + priority + ';');
      }
    };
    CSSStyleDeclaration.prototype.removeProperty = function(a) {
      return this.removeAttribute(a);
    };
    CSSStyleDeclaration.prototype.getPropertyPriority = function(styleName) {
      var rule = new RegExp(escape(styleName) + '\\s*:\\s*[^\\s]*\\s*!important(\\s*;)?',
          'gmi');
      return rule.test(this.cssText) ? 'important' : '';
    }
  }

  // The style function
  $.fn.style = function(styleName, value, priority) {
    // DOM node
    var node = this.get(0);
    // Ensure we have a DOM node
    if (typeof node == 'undefined') {
      return;
    }
    // CSSStyleDeclaration
    var style = this.get(0).style;
    // Getter/Setter
    if (typeof styleName != 'undefined') {
      if (typeof value != 'undefined') {
        // Set style property
        priority = typeof priority != 'undefined' ? priority : '';
        style.setProperty(styleName, value, priority);
      } else {
        // Get style property
        return style.getPropertyValue(styleName);
      }
    } else {
      // Get CSSStyleDeclaration
      return style;
    }
  };
})(jQuery);