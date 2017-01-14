<?php
/*
Template Name: Home Page
*/


	get_header();
?>

<?php 
	extract(etheme_get_page_sidebar());
?>

<?php if($page_slider != 'no_slider' && $page_slider != ''): ?>
	
	<?php echo do_shortcode('[rev_slider_vc alias="'.$page_slider.'"]'); ?>

<?php endif; ?>

<div class="container home_slider">
<?php echo do_shortcode( '[rev_slider home-slider]' );?>
</div>

<div id="home_block1" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=46 ]');
			else 
				echo do_shortcode('[content_block id=49 ]'); 
		?>
	</div>
</div>

<div id="home_block2" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=48 ]');
			else 
				echo do_shortcode('[content_block id=51 ]'); 
		?>
	</div>
</div>

<div id="home_block3" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=50 ]');
			else 
				echo do_shortcode('[content_block id=54 ]'); 
		?>
	</div>
</div>

<div id="home_block4" class="greener margin_40">
	<div class="container">
		<?php
			if ($_SERVER['REMOTE_ADDR'] == '::1') 
				echo do_shortcode('[content_block id=56 ]');
			else 
				echo do_shortcode('[content_block id=56 ]'); 
		?>
	</div>
</div>

<?php /*
<div class="container">
	<div class="page-content sidebar-position-<?php echo $position; ?> responsive-sidebar-<?php echo $responsive; ?>">
		<div class="row-fluid">
			<?php if($position == 'left' || ($responsive == 'top' && $position == 'right')): ?>
				<div class="<?php echo $sidebar_span; ?> sidebar sidebar-left">
					<?php //etheme_get_sidebar($sidebarname); ?>
				</div>
			<?php endif; ?>
			
			<div class="content <?php echo $content_span; ?>">
				<?php if(have_posts()): while(have_posts()) : the_post(); ?>
					
					<?php the_content(); ?>

					<div class="post-navigation">
						<?php wp_link_pages(); ?>
					</div>
					
					<?php if ($post->ID != 0 && current_user_can('edit_post', $post->ID)): ?>
						<?php edit_post_link( __('Edit this', ETHEME_DOMAIN), '<p class="edit-link">', '</p>' ); ?>
					<?php endif ?>

				<?php endwhile; else: ?>

					<h3><?php _e('No pages were found!', ETHEME_DOMAIN) ?></h3>

				<?php endif; ?>

			</div>

			<?php if($position == 'right' || ($responsive == 'bottom' && $position == 'left')): ?>
				<div class="<?php echo $sidebar_span; ?> sidebar sidebar-right">
					<?php etheme_get_sidebar($sidebarname); ?>
				</div>
			<?php endif; ?>
		</div><!-- end row-fluid -->

	</div>
</div><!-- end container -->
*/ ?>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		for (i=1; i<=9; i++){
			$('#graph_' + i).find('span').hide();
			$('#graph_' + i).hover(
				function(){
					$(this).addClass('visible');
					if ($(this).attr('id') == 'graph_1'){
						$(this).css('background-color', '#007da5');
					}
					if ($(this).attr('id') == 'graph_2'){
						$(this).css('background-color', '#fa4c06');
					}
					if ($(this).attr('id') == 'graph_3'){
						$(this).css('background-color', '#f18903');
						$(this).css('width', '100px');
					}
					if ($(this).attr('id') == 'graph_4'){
						$(this).css('background-color', '#1fc2de');
					}
					if ($(this).attr('id') == 'graph_5'){
						$(this).css('background-color', '#c3d600');
					}
					if ($(this).attr('id') == 'graph_6'){
						$(this).css('background-color', '#f9e11b');
					}
					if ($(this).attr('id') == 'graph_7'){
						$(this).css('background-color', '#00b287');
					}
					if ($(this).attr('id') == 'graph_8'){
						$(this).css('background-color', '#f6303e');
					}
					if ($(this).attr('id') == 'graph_9'){
						$(this).css('background-color', '#76bd1d');
					}
					$(this).find('span').show();
				},
				function(){
					$(this).find('span').hide();
					$(this).removeClass('visible');
					$(this).css('background', 'none');
				}
			);
	
		}
		
		$('.item a').click(function(){
			window.location.href = $(this).attr('href');
			return false;
		});
		$('.item').toggle(
			function(){
				$('.inside').slideUp('fast');
				$('.item').find('.arrow').removeClass('arrow_up');
				var id = $(this).attr('id');
				id = id.split("_");
				id = id[1];
				$(this).find('.arrow').addClass('arrow_up');
				$('#inside_' + id).slideDown('fast');
				console.log('#inside_' + id);
			},
			function(){
				var id = $(this).attr('id');
				id = id.split("_");
				id = id[1];
				$(this).find('.arrow').removeClass('arrow_up');
				$('.inside').slideUp('fast');
			}
		);

		$('#item_1').trigger('click');
	});
</script>
<?php
	get_footer();
?>