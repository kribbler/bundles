function validateEmail(email) {

    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{1,4})?$/;

    if( !emailReg.test( email ) ) {
        return false;
    } else {
        return true;
    }
}

function validateContactNumber(number) {

    var numberReg = /^((\+)?[1-9]{1,3})?([-\s\.])?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}$/;

    if( !numberReg.test( number ) ) {

        return false;

    } else {

        return true;
    }

}




jQuery(function($){

    /* Notice */

    if( $("#notice-lightbox").length > 0 ) {
        $.prettyPhoto.open("#notice-lightbox");

        $.cookie( 'shopifiq-notification-closed', $("#notification_changes").val() );
    }

    $(".notice-close").on("click", function() {
        $("#notice-inline").addClass("closed").css("margin-top", "-" + $("#notice-inline").innerHeight() + "px");

        $.cookie( 'shopifiq-notification-closed', $("#notification_changes").val() );

        setTimeout(function(){ $("#notice-inline").css("display", "none"); }, 500)
    });

    /* MegaMenu size */    

    $(".megamenu > .sub-menu").each(function(index) {

        var el = $(".megamenu > .sub-menu").eq(index);

        var megaEl = el.children("li");
        var megaWide = el.children("li.wide");

        el.width( ((172 * megaEl.length) + (megaWide.length * 40) ) );

    });

    jQuery.fn.removeClassExcept = function (val) {

    return this.each(function () {

        $(this).removeClass().addClass(val);

        });

    };

    

    $(document).ready(function() {

        $().UItoTop({ easingType: 'easeOutQuart' });

    $('nav li:has(".sub-menu")').addClass('has-sub-menu'); 


       /* Main navigation animations */

       

       $("nav ul > li").hover(function () {

            if( ! $(this).hasClass("megamenu") ) {
                $(this).children("ul").css({"display" : "none"});
            }

            $(this).children(".sub-menu").stop(true).slideDown(200);

        }, function () {

            if($(this).parent().parent().hasClass("megamenu")) {
                return;
            }

            $(this).children("ul").css({"display" : "block"});

            if ( $(this).parent().parent().parent().attr("class") != "sub-menu") {

                if( ($(this).index() == 0 && $(this).parent(".sub-menu").attr("class") == "sub-menu")) {

                    $(this).parent(".sub-menu").stop(true).slideDown(200);
                    $(this).parent().css("overflow", "visible");
                    $(this).children(".sub-menu").stop(true).slideUp(200, function(){

                        $(this).css("overflow", "visible");

                        $(this).parent().css("overflow", "visible");

                    });
                } else {

                    $(this).children(".sub-menu").stop(true).slideUp(200, function(){

                        $(this).css("overflow", "visible");

                        $(this).parent().css("overflow", "visible");

                    });
                }

            }

        });

        

        $("nav ul li ul").hover(function () {

            $(this).stop(true).slideDown();

        }, function () {
/*
            if ( $(this).parent().parent().attr("class") != "sub-menu") {

                $(this).stop(true).slideUp(200, function(){

                    $(this).css("overflow", "visible");

                });

            }
*/
        });

       

       /* Upper menu */



        if (Modernizr.touch){

    

           $(".upper-menu-before, .upper-menu2-before").css({"bottom" : "-55px", "height" : "155px"}); 

            

           $("*").bind("click", function() {

            

                var $target = $(event.target);

                                

                if( $target.hasClass("upper-menu-before") || $target.hasClass("upper-menu") ) {

                    

                    $(".upper-menu").css("margin-top", "0");

                    $(".upper-menu-before").css("height", "40px");

                    e.stopPropagation();

                } else {

                    $(".upper-menu").css("margin-top", "-50px");

                    $(".upper-menu-before").css("height", "150px");

                }

                

                if( $target.hasClass("upper-menu2-before") || $target.hasClass("upper-menu2") ) {

                    

                    $(".upper-menu2").css("margin-top", "0");

                    $(".upper-menu2-before").css("height", "40px");

                    e.stopPropagation();

                } else {

                    $(".upper-menu2").css("margin-top", "-212px");

                    $(".upper-menu2-before").css("height", "150px");

                }

                

           });

           

           

           

           $(".upper-menu").css("margin-top", "-50px");

           $(".upper-menu2").css("margin-top", "-212px");



       }

        /*Responsive on demand */



                $(".responsive-on-demand, .responsive-on-demand-selected").bind("click", function(){

                    if( $.cookie("responsive_on_demand") == 'on' ) {

                        $.cookie("responsive_on_demand", 'off');

                    }

                    else {

                        $.cookie("responsive_on_demand", 'on');

                    }

                    

                    location.reload();

                    

                });

                

                $(".tabs-menu li").bind("click", function(){

                    var index = $(this).index();

                    var parent = $(this).parent();

                    

                    parent.children("li").removeClass("selected-tab-menu");

                    parent.children("li").eq(index).addClass("selected-tab-menu");

                    

                    parent.parent().children(".tabs-wrapper").children(".tab").filter(":visible").stop().fadeOut(200, function(){

                        $(this).parent().children(".tab").eq(index).fadeIn(200);

                    });

                    

                });

                

                /* Accordion shortcode */


                $(".accordion h3").bind("click", function() {

                    if ( ! $(this).hasClass("accordion-h3-selected") ) {

                        $(this).parent().parent().children(".accordion-h3").removeClass("accordion-h3-selected");
                        $(this).parent().parent().children(".accordion-item").children(".accordion-item-content").slideUp(300);

                        

                        $(this).parent().children(".accordion-item-content").slideDown(300, function () {
                            $(this).parent().parent().children(".accordion-item").removeClass("accordion-item-1");
                        });
                        $(this).parent().parent().children(".accordion-item").children(".accordion-h3-selected").removeClass("accordion-h3-selected");
                        $(this).addClass("accordion-h3-selected");

                    } else {
                        $(this).parent().parent().children(".accordion-h3").removeClass("accordion-h3-selected");
                        $(this).parent().parent().children(".accordion-item").children(".accordion-item-content").slideUp(300);
                        $(this).parent().parent().children(".accordion-item").removeClass("accordion-item-1");
                        $(this).parent().parent().children(".accordion-item").children(".accordion-h3-selected").removeClass("accordion-h3-selected");

                    }

                });

                /* FAQ filter */

                $(".faq-filter a").bind("click", function() {

                    var className = $(this).attr("data-filter");
                    $(".faq").slideUp(250, function(){
                        $(".faq").slideDown(250);
                    });
                    if ( className == "*" ) {
                        $(".faq li").show();
                    } else {

                        $(".faq li").hide();
                        $(".faq li." + className).show();

                    }
                    
                });

                /* Alert box close  */

                

                $(".alert-close").bind("click", function(){

                    $(this).parent().slideUp(300); 

                });

                

                /* Fixes for IE8 ( first child, last child, first of type, etc. ) */

                

                if ( $.browser.msie && $.browser.version == "8.0" ) {

                    

                     $(".portfolio-content h3:first-child, .portfolio-content p:first-child").css("margin-top", "0 !important");

                     $("aside li:first-child .sbg_title").css("margin-top", "0");

                     $(".blog .wp-post-image img:first, .blog .wp-post-image").css("display", "inline-block");

                     $("footer#site-footer .xoxo:first").css("margin", "10px 0 0 0");

                     $("footer#site-footer .xoxo .xoxo:first").css("margin", "0");

                     $(".cat-item:last").css("border", "none");

                     $("ul.page-numbers li").last().addClass("last-pagination");

                     

                     $(".tabs-menu li:first").css("border-style", "solid solid none solid");

                     $(".tab:first").css("display", "block");

                     $(".pricing-table-column:last-child").css("margin", "0");

                     $(".accordion .accordion-item:first").css("display", "block");
                     $(".slider-short .slide:first").css("display", "block");


                     $(".portfolio-image .thumbnail").each(function (index){

                        
                        if ( index % 4 == 0 && index != 0 ) {
                            $(".portfolio-image .thumbnail").eq(index).css("margin", "16px 0 0 0");
                        }
                     });


                     $(".latest-post").each(function (index){

                        
                        if ( index % 3 == 0 && index != 0 ) {
                            $(".latest-post").eq(index).css("margin", "0");
                        }
                     });

                     $(".pricing-table-column").each(function( index ){

                        var child = $(".pricing-table-column").eq(index).children(".pricing-table-row");

                        $(".pricing-table-column").eq(index).children(".pricing-table-row").each(function(index2){
                           if( index2 %2 == 0 ) {
                                child.eq(index2).css("background", "#fff");
                            }
                         });


                     });


                     $(".blog-two-column article").each(function (index){

                        
                        if ( (index + 1) % 2 == 0 ) {
                            $(".blog-two-column article").eq(index).css("padding", "0");
                        }
                     });

                     $(".blog-three-column article").each(function (index){

                        
                        if ( (index + 1) % 3 == 0 ) {
                            $(".blog-three-column article").eq(index).css("padding", "0");
                        }
                     });
                     
                     $(".blog-four-column article").each(function (index){

                        
                        if ( (index + 1) % 4 == 0 ) {
                            $(".blog-four-column article").eq(index).css("padding", "0");
                        }
                     });
                     
                     if ( $(".gallery").length > 0 ) {
                         var gal = "." + $(".gallery").attr('class').split(' ')[1];
                         gal2 = gal;
                         gal2 = gal2.replace('.gallery-','');
                         gal2 = gal2.replace('-columns','');
                         gal2 = parseInt(gal2);
                         
                         $(gal + " .gallery-item").each(function (index){

                            
                            if ( (index + 1) % gal2 == 0 ) {
                                $(gal + " .gallery-item").eq(index).css("margin-right", "0");
                            }
                         });
                     }
                                          
                     $("aside .tab.popular .post:last, aside .tab.recent .post:last, aside .tab.comments-widget .post:last").css({"border": "none", "padding" : "20px 0 0 0"})
                     //$("").css("", "");

                }

                

                /* Scroll to comments */

                

                $("#scrollToComments").bind("click", function(){

                    var scroll = $("#comments").offset().top;

                    $('html, body').animate({scrollTop: scroll},'slow');

                });

                

        /* Blog loop */

        

                var thumbnail_change = true;



                $(".right-blog-control").bind("click", function(){

                    if ( thumbnail_change ) {

                        var current_index = 0;

                        var index = 1;



                        if ( $(this).parent().parent().children("img").eq(0).css("display") != "inline-block" ) {

                            index = $(this).parent().parent().children("img.selected-blog-image").index();

                            $(this).parent().parent().children("img.selected-blog-image").removeClass("selected-blog-image");

                            current_index = index;

                            index++;

                            if( index > $(this).parent().parent().children("img").length -1 ) {

                                index = 0;

                            }

                        }



                        thumbnail_change = false;

                        $(this).parent().parent().children("img").eq(current_index).fadeOut(200, function(){

                            $(this).parent().children("img").eq(index).fadeIn(250);

                            $(this).parent().children("img").eq(index).addClass("selected-blog-image");

                            thumbnail_change = true;

                        });

                    }

                });

                

                $(".left-blog-control").bind("click", function(){

                    if ( thumbnail_change ) {

                        var current_index = 0;

                        var index = $(this).parent().parent().children("img").length -1;



                        if ( $(this).parent().parent().children("img").eq(0).css("display") != "inline-block" ) {

                            index = $(this).parent().parent().children("img.selected-blog-image").index();

                            $(this).parent().parent().children("img.selected-blog-image").removeClass("selected-blog-image");

                            current_index = index;

                            index--;

                        }



                        thumbnail_change = false;

                        $(this).parent().parent().children("img").eq(current_index).fadeOut(200, function(){

                            $(this).parent().children("img").eq(index).fadeIn(250);

                            $(this).parent().children("img").eq(index).addClass("selected-blog-image");

                            thumbnail_change = true;

                        });

                    }

                });

                

                

        

                var slider_change = true;



                $(".slider-short-right-control").bind("click", function(){

                    if ( slider_change ) {

                        var current_index = 0;

                        var index = 1;



                        if ( $(this).parent().parent().children(".slide").eq(0).css("display") != "inline-block" ) {

                            index = $(this).parent().parent().children(".slide").filter(":visible").index();

                            

                            current_index = index;

                            index++;

                            if( index > $(this).parent().parent().children(".slide").length -1 ) {

                                index = 0;

                            }

                        }



                        slider_change = false;

                        $(this).parent().parent().children(".slide").eq(current_index).fadeOut(200, function(){

                            $(this).parent().children(".slide").eq(index).fadeIn(250);

                            slider_change = true;

                        });

                    }

                });

                

                $(".slider-short-left-control").bind("click", function(){

                    if ( slider_change ) {

                        var current_index = 0;

                        var index = $(this).parent().parent().children(".slide").length -1;



                        if ( $(this).parent().parent().children(".slide").eq(0).css("display") != "inline-block" ) {

                            index = $(this).parent().parent().children(".slide").filter(":visible").index();

                            current_index = index;

                            index--;

                        }



                        slider_change = false;

                        $(this).parent().parent().children(".slide").eq(current_index).fadeOut(200, function(){

                            $(this).parent().children(".slide").eq(index).fadeIn(250);

                            slider_change = true;

                        });

                    }

                });

                

                /* Testimonials animation */

                

                setTimeout(function() {quotesChange();}, 5000);

                

                function quotesChange() {

                    $(".quotes").each(function(index){

                        var quote = $(".quotes").eq(index);

                        var current = quote.children("article.quote-selected");

                        var next = quote.children("article").eq( current.index() + 1 );

                        if (next.html() == null) {

                            next = quote.children("article").eq(0);

                        }

                        current.removeClass("quote-selected");

                        next.addClass("quote-selected");

                        next.css("display", "none");

                        

                        current.fadeOut(800, function () {

                            next.fadeIn(800, function() { });

                        });

                    });

                    

                     setTimeout(function() {quotesChange();}, 5000);

                }

                

                

                /* Comment functions */

                

                $("#commentform .form-button").bind("click", function(){

                    if( $(this).attr("id") == "reset") {

                        $("#comment-form textarea").val("");

                    } else {

                        $("#submit").click();

                    }

                });

                

                $(".contact-form .form-buttons input").bind("click", function(){

                    if( $(this).attr("id") == "reset") {

                        $(".contact-form textarea").val("");

                        $('.contact-form input[type="text"]').val("");

                        $('.contact-form input[type="email"]').val("");

                        if( ! Modernizr.input.placeholder ) {

                                $('input[type="text"]').each(function(index){

                                    $('input[type="text"]').eq(index).val($('input[type="text"]').eq(index).attr("data-placeholder"));

                                    $('input[type="text"]').eq(index).css("color", "#a9a9a9");

                                });

                                $('textarea').each(function(index){

                                    $('textarea').eq(index).val($('textarea').eq(index).attr("data-placeholder"));

                                    $('textarea').eq(index).css("color", "#a9a9a9");

                                });

                        }

                        

                        $('.contact-form input[type="text"]').removeClass("error");

                        $('.contact-form input[type="text"]').parent().children(".error-text").remove();

                        

                        $(".contact-form textarea").removeClass("error");

                        $(".contact-form textarea").parent().children(".error-text").remove();

                    }

                });

                

                $("form.contact-form").submit(function(){

                     

                     

                    var form = $(this);

                    

                    var is_all_cool = true;

                    

                    form.children(".form-element-wrap").each(function(index){

                        

                        var child = form.children(".form-element-wrap").eq(index).children("input, textarea, select");


                        if( child.attr("data-required") == "required" && ( child.val() == "" || child.val() == child.attr("data-placeholder")) ) {

                            is_all_cool = false;

                            child.addClass("error");

                            child.parent().children(".error-text").remove();

                            child.after('<div class="error-text">This item is required.</div>');

                        } else {

                            child.removeClass("error");

                            child.parent().children(".error-text").remove();

                        }

                        

                        if( child.attr("data-validation") == "phone" && child.val() != "" && child.val() != child.attr("data-placeholder") ) {

                            if( ! validateContactNumber(child.val()) ) {

                                is_all_cool = false;

                                child.addClass("error");

                                child.after('<div class="error-text">Please enter a valid phone number.</div>');

                            } else {

                                child.removeClass("error");

                                child.parent().children(".error-text").remove();

                            }

                        }

                        

                        if( child.attr("data-validation") == "email" && child.val() != ""  && child.val() != child.attr("data-placeholder") ) {

                            if( ! validateEmail(child.val()) ) {

                                is_all_cool = false;

                                child.addClass("error");

                                child.after('<div class="error-text">Please enter a valid e-mail.</div>');

                            } else {

                                child.removeClass("error");

                                child.parent().children(".error-text").remove();

                            }

                        }

                        

                    });

                    

                    if ( is_all_cool ) {

                        

                        form.children(".form-element-wrap").children("input, textarea").removeClass("error");;

                        
                        $.fn.serializeObject = function()
                        {
                        var o = {};
                        var a = this.serializeArray();
                        $.each(a, function() {
                            if (o[this.name]) {
                                if (!o[this.name].push) {
                                    o[this.name] = [o[this.name]];
                                }
                                o[this.name].push(this.value || '');
                            } else {
                                o[this.name] = this.value || '';
                            }
                        });
                        return o;
                        };
                        var form_data = $(this).serializeObject();

                        $.ajax({

                            type: "POST",

                            url: $("#site_url").val() + '/wp-admin/admin-ajax.php',

                            data: {
                                            action: 'MailFunction',
                                            form_data: form_data
                                        },

                            success: function(msg) {

                                form.after('<div style="margin: 80px 0 0 0" class="alert success">' + form.attr('data-sucess') + '<span class="alert-close" id="contact-form-success"></span></div>');

                                $("#contact-form-success").bind("click", function(){

                                    $(this).parent().slideUp(300, function(){

                                        $(this).remove();

                                    }); 

                                });

                             }

        

                        });

                    }

                    

                    return false;

                });

                

                /* Sidebar search widget */

                

                $("#s").attr("placeholder", $("#src_tr").val());

                $("#searchsubmit").val("");

                $("#searchsubmit").css("display", "block")

                

        /* Single portfolio */

        

                var thumbnail_change = true;

                

        $(".thumbnail").bind("click", function(){

                        if ( thumbnail_change && this.id != "selected-thumbnail" ) {

                            $(".thumbnail").removeAttr("id");

                            this.id = "selected-thumbnail";

                            var index = $(this).index();

                            thumbnail_change = false;

                            $(".portfolio-current-image").fadeOut(200, function(){

                                $(".portfolio-image div").removeClass("portfolio-current-image");

                                $(".portfolio-image-single").eq(index).fadeIn(250);

                                $(".portfolio-image-single").eq(index).addClass("portfolio-current-image");

                                thumbnail_change = true;

                            });

                        }

        });

        

                $(".right-portfolio").bind("click", function(){

                    var index = $(".thumbnail#selected-thumbnail").index();

                    $(".thumbnail").eq(++index).click();

                });

                

                $(".left-portfolio").bind("click", function(){

                    var index = $(".thumbnail#selected-thumbnail").index();

                    index--;

                    if ( index >= 0 ) {

                        $(".thumbnail").eq(index).click();

                    }

                    

                });

                

        /* Mobile menu */

        

        $(".mobile-menu").bind("change", function(){

            window.location = $('.mobile-menu :selected').val();

        });

        

        

        /* Placeholer polyfill */

        

        if( ! Modernizr.input.placeholder ) {

            $(".add_to_cart_button").click(function() {
                $(this).attr("class", $(this).attr("class") + "added");
                $(".cart_list-wrapper").remove();  
            });  

            $('input[type="text"]').each(function(index){
                if ( $(this).attr("data-placeholder") ) {
                    $('input[type="text"]').eq(index).val($('input[type="text"]').eq(index).attr("data-placeholder"));
                    $('input[type="text"]').eq(index).css("color", "#a9a9a9");
                }
            });

            $('textarea').each(function(index){

                $('textarea').eq(index).val($('textarea').eq(index).attr("data-placeholder"));

                $('textarea').eq(index).css("color", "#a9a9a9");

            });

            

            $('input[type="text"], textarea').bind("focus", function(){

                if( $(this).val() == $(this).attr("data-placeholder") ) {

                    $(this).val("");

                    $(this).css("color", "#727272");

                }

            });

            

            $('input[type="text"], textarea').bind("blur", function(){

                if( $(this).val() == "" ) {

                    $(this).css("color", "#a9a9a9");

                    $(this).val($(this).attr("data-placeholder"))

                }

            });

            

        }

        

        if ( ! Modernizr.csstransitions ) {

            

            /* Portfolio animation */

            

            var top = 0;

            

            $(".portfolio li").bind("mouseenter", function (){

                    top = ($(".portfolio li").height() - $(this).children(".portfolio-hover").height() )+ "px";

                    

                    $(this).children(".portfolio-hover").css("display","block");                                

                    $(this).children(".portfolio-hover").css("top","0");

                    

                    $(this).children(".portfolio-hover").stop().animate({

                        "opacity" : "1",

                        "top" : top

                    }, 300);

            });

            

            $(".portfolio li").bind("mouseleave", function (){

                    

                    $(this).children(".portfolio-hover").stop().animate({

                        "opacity" : "0",

                        "top" : "0px"

                    }, 300, function(){

                        $(this).css({"top" : top, "display" : "none"});

                    });

            });

                        

                        

            /* Start Top menu polyfill for Slide Up/Down */

            

            $(window).resize(function() {

                if( $("#always-open").val() == "no" ) {

                    canCloseMenu = true;

                }

                /*

                var height = 50; 

                if( $(".upper-menu").height() != 58 ) {

                    height = $(".upper-menu").height() + 2;

                }

                

                if( ! $("#s").is(":focus") ) {

                    $(".upper-menu").css("margin-top", "-" + height + "px")

                }*/

            });

            

            var canCloseMenu = true;

            

            $(".upper-menu").bind("mouseenter",function(){

                if ( canCloseMenu && ($("#always-open").val() == "no" || $("#always-open").val() == "" )) { 

                    var height = 50;

                    if( $(".upper-menu").height() != 58 ) {

                        height = $(".upper-menu").height() + 2;

                    }



                    $(".upper-menu").css("margin-top", "-" + height + "px");

                    $(".upper-menu").stop().animate({

                        marginTop: "0px"

                    }, 300);

                    

                }

            });

            

            $(".upper-menu2").bind("mouseenter",function(){

                if ( canCloseMenu && ($("#always-open").val() == "no" || $("#always-open").val() == ""  )) {

                    var height = 50; 

                    if( $(".upper-menu2").height() != 58 ) {

                        height = $(".upper-menu2").height() + 2;

                    }

                    

                    $(".upper-menu2").css("margin-top", "-" + height + "px");

                    $(".upper-menu2").stop().animate({

                        marginTop: "0px"

                    }, 300);

                }

            });

            

            $(".upper-menu").bind("mouseleave",function(){

                if( canCloseMenu && ($("#always-open").val() == "no" || $("#always-open").val() == "")  ) {

                    var height = 50; 

                    if( $(".upper-menu").height() != 58 ) {

                        height = $(".upper-menu").height() + 2;

                    }

                    

                    if( ! $("#s").is(":focus") ) {

                        $(".upper-menu").stop().animate({

                            marginTop: "-" + height + "px"

                        }, 300);

                    }

                }

            });

            

            $(".upper-menu2").bind("mouseleave",function(){

                if ( canCloseMenu && ($("#always-open").val() == "no" || $("#always-open").val() == "")  ) {

                    var height = 50; 

                    if( $(".upper-menu2").height() != 58 ) {

                        height = $(".upper-menu2").height() + 2;

                    }

                    

                    if( ! $("#s2").is(":focus") ) {

                        $(".upper-menu2").stop().animate({

                            marginTop: "-" + height + "px"

                        }, 300);

                    }

                }

            });

            

            $("#s-top").bind("focus", function(){

                canCloseMenu = false;

            });

            

            $("#s2-top").bind("focus", function(){

                canCloseMenu = false;

            });

            

            $("#s-top").bind("focusout", function(){

                if (  $("#always-open").val() == "no"  || $("#always-open").val() == ""  ) {

                    canCloseMenu = true;

                    var height = 50; 

                    if( $(".upper-menu").height() != 58 ) {

                        height = $(".upper-menu").height();

                    }

                  

                    $(".upper-menu").stop().animate({

                        marginTop:  - height + "px"

                    }, 300);

                }

            });

            

            $("#s2-top").bind("focusout", function(){

                if (  $("#always-open").val() == "no"  || $("#always-open").val() == ""  ) {

                  canCloseMenu = true;

                  var height = 50; 

                  if( $(".upper-menu2").height() != 58 ) {

                      height = $(".upper-menu2").height();

                  }

                

                  $(".upper-menu2").stop().animate({

                      marginTop:  - height + "px"

                  }, 300);

                }

            });

            

            /* End Start Top menu polyfill for Slide Up/Down */

                

        } else {

            

            $("#s-top").bind("focus", function(){

                $(".upper-menu").addClass("upper-menu-no-transition");

            });

            

            $("#s-top").bind("focusout", function(){

                $(".upper-menu").removeClass("upper-menu-no-transition");

            });

            

            $("#s2-top").bind("focus", function(){

                $(".upper-menu2").addClass("upper-menu-no-transition");

            });

            

            $("#s2-top").bind("focusout", function(){

                $(".upper-menu2").removeClass("upper-menu-no-transition");

            });

        }

       

       

       

       

        

    });

    

    

    

    

    

    

    /* Sticky navigation */

    $(window).scroll(function(e) {

        var stickyHeight = 0;

        if( $(".sticky-menu").length > 0 ) {

            if( $("#notice-inline").length > 0 && ! $("#notice-inline").hasClass("closed") ) {
                stickyHeight = $("#notice-inline").height();
            }

            if($(window).scrollTop() > $("#site-header").height() + stickyHeight - 50) {
                if ( $(".sticky-menu").is(':hidden') ) {
                    $(".sticky-menu").show();
                    $("#logo, #access, .woo-header").appendTo(".sticky-menu .main-wrapper");
                    $(".mobile-menu").appendTo(".sticky-menu .main-wrapper");

                    if( ! parseInt($(".cart-contents").html()) ) {
                        cartContent = $(".cart-contents").html();
                    }
                }
            } else {
                if ( $('.sticky-menu').is(':visible') ) {
                    $(".sticky-menu").hide();
                    $("#logo, #access").appendTo(".logo-and-nav");
                    $(".woo-header").appendTo(".woo-header-wrapper");
                    $(".mobile-menu").appendTo(".logo-and-nav");
                }
            }

        }
    });
    

    /* Remove cart "No products in cart!"  */
    $(".add_to_cart_button").click(function() {
        $(".cart_list-wrapper").remove();  
    });  


    /* Featured Products slider */

    var pos = 0;
    var numVisible = 3;

    function numFeatured() {

        if( $(".main-wrapper").width() == 733 || $(".main-wrapper").width() == 457 ) {
            numVisible = 2;
        } else if ( $(".main-wrapper").width() < 457 ) {
            numVisible = 1;
        } else {
            numVisible = 3;
        }

    }

    numFeatured();

    $(window).resize(function() {
        numFeatured();
    });

    function setSelected(pos) {
        $(".featured-slider .product.selected").removeClass("selected");
        $(".featured-slider .product").eq(pos).addClass("selected");

        $(".featured-slider-right h2").fadeOut(200, function(){
            $(".featured-slider-right h2").html($(".featured-slider .product #infos-title").eq(pos).html());
            $(".featured-slider-right h2").fadeIn();
        });
        
        $(".featured-slider-right .description").fadeOut(200, function(){
            $(".featured-slider-right .description").html($(".featured-slider .product #infos-excerpt").eq(pos).html());
            $(".featured-slider-right .description").fadeIn();
        });
    }

    $(".featured-slider-right .btn-right").on("click", function() {
        if( pos < $(".featured-slider .product").length - numVisible ) {
            setSelected(++pos);
            $(".featured-slider").css("margin-left", -(pos * 206));
        } else if ( pos < $(".featured-slider .product").length - 1 ) {
            setSelected(++pos);
        }
    });

    $(".featured-slider-right .btn-left").on("click", function() {
        if( pos < numVisible && pos > 0 && $(".featured-slider").css("margin-left").replace("px", "")  == 0 ) {
            setSelected(--pos);
        }
        else if ( pos > $(".featured-slider .product").length - numVisible && pos < $(".featured-slider .product").length ) {
            setSelected(--pos);
        }
        else if( pos > 0 ) {
            setSelected(--pos);
            $(".featured-slider").css("margin-left", -(pos * 206));
        }
    });

    $(".featured-slider .product").on("click", function(){
        var curIndex = $(this).index();
        if( curIndex > pos ) {
            $(".featured-slider-right .btn-right").click();
        } else if ( curIndex < pos ) {
            $(".featured-slider-right .btn-left").click();
        }
    });


});

