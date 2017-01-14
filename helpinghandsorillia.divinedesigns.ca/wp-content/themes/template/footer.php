<?php 
$extra_style = (get_the_title() == 'Contact Us') ? ' style="margin: -90px auto 0; position: relative"' : '';

//
?>
<div class="wave_top" <?php echo $extra_style;?>></div>
<div class="row-fluid bg_blueish">
<div class="container">
<div class="span4"><img src="<?php echo site_url();?>/wp-content/uploads/2015/03/logo-inner.png" alt="logo-inner" width="248" height="128" class="alignright size-full wp-image-61" /></div>
<div class="span8">
<p>&nbsp;</p>
<img src="<?php echo site_url();?>/wp-content/uploads/2015/03/bringing-independence-home.png" alt="bringing-independence-home" width="601" height="77" class="alignleft size-full wp-image-62" /></div>
</div>
<p>&nbsp;</p>
</div>
			<!-- #content -->
			</div>
		</div><!--<div class="page-wrapper container">-->

		<div class="page-wrapper container">
			<div id="footer_menu">
				<?php 
				wp_nav_menu(
				    array(
						'theme_location' => 'footer_menu',
						'menu_class' => 'nav-menu'
					)
				);
				?>
			</div>
			<div id="footer_links">
				<?php 
				wp_nav_menu(
				    array(
						'theme_location' => 'footer_links',
						'after' => '<li class="menu-divider">|</li>'
					)
				);
				?>
			</div>
			
			<hr />

			<div class="row-fluid">
				<div class="span4 mt1">
					<a href="https://www.linkedin.com/company/1171968" target="_blank">
						<img src="<?php echo get_template_directory_uri();?>/images/logo_linkedin.png" title="" alt="" />
					</a>

					<a class="staff_login" href="<?php echo site_url();?>/stafflogin.html">Employee &amp; Volunteer Login</a>
				</div>
				<div class="span4">
					<img class="aligncenter" src="<?php echo get_template_directory_uri();?>/images/logo_supported.png" title="" alt="" />
				</div>
				<div class="span4 footer_assoc mt1">
					<p>Also in Association with</p>
					<img class="alignleft" src="<?php echo get_template_directory_uri();?>/images/logo_ocsa.png" title="" alt="" />
					<img class="alignleft " src="<?php echo get_template_directory_uri();?>/images/logo_nsmcss.png" title="" alt="" />
				</div>
			</div>
			<div id="footer">
			<div id="copyright">Copyright &copy; <?php echo date("Y"); ?> <?php bloginfo('name');?>. All Rights Reserved</div>
			<div id="designed_by"><a href="http://divinedesigns.ca/" target="_blank">Website Design by Divine Designs.ca: Web Design - Graphic Design - Online Marketing</a></div>
			<!-- #footer -->
			</div>
		<div class="page-wrapper container">
	<!-- #wrapper -->
	</div>

	<script style="text/javascript">
	jQuery(document).ready(function($){
		$('.back_to_top').click(function(){
			$("html, body").animate({scrollTop: 0}, 1000);
		});

		function resizeText(multiplier) {
		  if (document.body.style.fontSize == "") {
		    document.body.style.fontSize = "1.0em";
		  }
		  document.body.style.fontSize =  (multiplier) + "em";
		}

		$("#text_size1").click(function() {resizeText(1);});
		$("#text_size2").click(function() {resizeText(1.2);});
		$("#text_size3").click(function() {resizeText(1.4);});

        $('#open_emplyment').click(function(){
            $('#open_volunteer').removeClass('reveal_tab');
            $(this).addClass('reveal_tab');
            $('#inner_volunteer').hide();
            $('#inner_employment').show();
            $('#my_tabs').addClass('wave_top_green');
            $('#inner1').addClass('make_green_bg');
        });

        $('#open_volunteer').click(function(){
            $('#open_emplyment').removeClass('reveal_tab');
            $(this).addClass('reveal_tab');
            $('#inner_employment').hide();
            $('#inner_volunteer').show();
            $('#my_tabs').removeClass('wave_top_green');
            $('#inner1').removeClass('make_green_bg');
        });

        $('.gm-style-iw').parent().addClass('special_window');


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
    
		$('.main-nav .menu').et_menu({
	        type: "default"
	    });


	});


	</script>
	<?php wp_footer();?>
</body>
</html>