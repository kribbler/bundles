<?php if (get_theme_option('footer_show_widgets')) :
	if ('4' == get_theme_option('footer_widgets_columns')) {
		get_template_part('includes/templates/footer/4columns');
	} else {
		get_template_part('includes/templates/footer/3columns');
	}
endif; ?>

<div class="footer-wrap">
	<div class="blue-line-wrap">
		<div class="fancy_bg">
			<footer class="container">
			<?php if (get_theme_option('footer_show_social_media')) : ?>
				<ul class="social pull-right">
				<?php
					if($slPinterest = get_theme_option("social_link_pinterest")){
						echo '<li title="pinterest" class="custom-tooltip blue-tooltip"><a href="' . $slPinterest . '" class="pinterest-icon"></a></li>';
					}
					
					if($slGoogle = get_theme_option("social_link_google")){
						echo '<li title="google" class="custom-tooltip blue-tooltip"><a href="' . $slGoogle . '" class="google-icon"></a></li>';
					}
					
					if($slLinkedIn = get_theme_option("social_link_linkedin")){
						echo '<li title="linkedin" class="custom-tooltip blue-tooltip"><a href="' . $slLinkedIn . '" class="linkedin-icon"></a></li>';
					}
					
					if($slTwitter = get_theme_option("social_link_twitter")){
						echo '<li title="twitter" class="custom-tooltip blue-tooltip"><a href="' . $slTwitter . '" class="twitter-icon"></a></li>';
					}
					
					if($slFacebook = get_theme_option("social_link_facebook")){
						echo '<li title="facebook" class="custom-tooltip blue-tooltip"><a href="' . $slFacebook . '" class="facebook-icon"></a></li>';
					}
				?>
				</ul>
			<?php endif; ?>
			
			<div class="container">
				<div class="row">
					<div class="span4">
						<?php dynamic_sidebar('footer-left');?>
					</div>
					<div class="span4">
						<?php dynamic_sidebar('footer-center');?>
					</div>
					<div class="span4">
						<?php dynamic_sidebar('footer-right');?>
						<div class="purple_box_footer">
							<?php
								if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
									echo do_shortcode('[content_block id=60 ]');
								else 
									echo do_shortcode('[content_block id=78 ]'); 
							?>
						</div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				
				<div class="row row_upper_border">
					<div class="span6">
						<?php dynamic_sidebar('coyright-area-1');?>
					</div>
					<div class="span6 right_align">
						<?php dynamic_sidebar('coyright-area-2');?>
					</div>
				</div>
			</div>
				<div class="copyright pull-left">
					<?php //echo get_theme_option('footer_note'); ?>
				</div>
			</footer>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#toggle_maxbasic').toggle(
		function(){
			$(this).html('view less');
			$('#h_maxbasic').slideDown('fast');
		},
		function(){
			$('#h_maxbasic').slideUp('fast');	
			$(this).html('view more');
		}
	);

	$('#toggle_maxbrand').toggle(
		function(){
			$(this).html('view less');
			$('#h_maxbrand').slideDown('fast');
		},
		function(){
			$('#h_maxbrand').slideUp('fast');	
			$(this).html('view more');
		}
	);

	$('#toggle_maxexperience').toggle(
		function(){
			$(this).html('view less');
			$('#h_maxexperience').slideDown('fast');
		},
		function(){
			$('#h_maxexperience').slideUp('fast');	
			$(this).html('view more');
		}
	);

	$('#toggle_maxjumpstart').toggle(
		function(){
			$(this).html('view less');
			$('#h_maxjumpstart').slideDown('fast');
		},
		function(){
			$('#h_maxjumpstart').slideUp('fast');	
			$(this).html('view more');
		}
	);

	$('#toggle_maxaccelerator').toggle(
		function(){
			$(this).html('view less');
			$('#h_maxaccelerator').slideDown('fast');
		},
		function(){
			$('#h_maxaccelerator').slideUp('fast');	
			$(this).html('view more');
		}
	);

	$('#toggle_maxhealthcheck').toggle(
		function(){
			$(this).html('view less');
			$('#h_maxhealthcheck').slideDown('fast');
		},
		function(){
			$('#h_maxhealthcheck').slideUp('fast');	
			$(this).html('view more');
		}
	);

	$('#toggle_maxfranchise').toggle(
		function(){
			$(this).html('view less');
			$('#h_maxfranchise').slideDown('fast');
		},
		function(){
			$('#h_maxfranchise').slideUp('fast');	
			$(this).html('view more');
		}
	);

	$('#toggle_plan8').toggle(
		function(){
			$(this).html('view less');
			$('#h_plan8').slideDown('fast');
		},
		function(){
			$('#h_plan8').slideUp('fast');	
			$(this).html('view more');
		}
	);

	//homepage team carousel

	var i = 1;
	//$('#use_the_1').addClass('featured_active');

    //when user clicks the image for sliding right  
    $('#right_scroll').click(function(){  
        if (i < 3){
            i++;
            //console.log(i);
        
            //get the width of the items ( i like making the jquery part dynamic, so if you change the width in the css you won't have o change it here too ) '  
            var item_width = $('#carousel_ul li').outerWidth();  
  
            //calculate the new left indent of the unordered list  
            var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;  
  
            //make the sliding effect using jquery's anumate function '  
            $('#carousel_ul').animate({'left' : left_indent},{queue:false, duration:200},function(){  
  
                //get the first list item and put it after the last list item (that's how the infinite effects is made) '  
                $('#carousel_ul li:last').after($('#carousel_ul li:first'));  
                
                //and get the left indent to the default -210px  
                $('#carousel_ul').css({'left' : '-210px'});  
            });
        }  
    });  

    //when user clicks the image for sliding left  
    $('#left_scroll').click(function(){  
        if (i > 1){
            i--;
            //console.log(i);
        
            var item_width = $('#carousel_ul li').outerWidth();  
  
            /* same as for sliding right except that it's current left indent + the item width (for the sliding right it's - item_width) */  
            var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;  
  
            $('#carousel_ul').animate({'left' : left_indent},{queue:false, duration:200},function(){  
  
            /* when sliding to left we are moving the last item before the first item */  
            $('#carousel_ul li:first').before($('#carousel_ul li:last'));  
  
            /* and again, when we make that change we are setting the left indent of our unordered list to the default -210px */  
            $('#carousel_ul').css({'left' : '-210px'});  
            });  
        }
    }); 

    $('.listing_summary').hide();
    
    $('.li_inactive').hover(
		function(){
			var id = $(this).attr('id');
			id = id.split("_");
			id = id[2];
			$('#hidden_member_summary_' + id).show();
		},
		function(){
			var id = $(this).attr('id');
			id = id.split("_");
			id = id[2];
			$('#hidden_member_summary_' + id).hide();
		}
	);

    /*$('.featured_h').mouseover(function(){

		var id = $(this).attr('id');
		id = id.split("_");
		id = id[2];
		console.log(id);
		$('#hidden_member_summary_' + id).fadeIn('fast');
	});*/
});
</script>
<?php wp_footer(); ?>

</body>
</html>