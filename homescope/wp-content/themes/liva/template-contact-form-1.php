<?php
/*
* Template Name: Contact Form Template 1
*/
//checking if email is valid
$error = false;
$message = '';
$email = ot_get_option('contact_form_email');
if ( !is_email( $email ) )
{
	$message = '<p>' . __('Fatal error! Please check your email in Theme Options!','liva') . '</p>';
	$error = true;
}
$form_name = '';
$form_email = '';
$form_message = '';

if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'],'ts_contact-form_'))
{
	$form_name = sanitize_text_field($_POST['form_name']);
	$form_email = sanitize_text_field($_POST['form_email']);
	$form_message = filter_var($_POST['form_message'], FILTER_SANITIZE_STRING);
	
	$error = false;
	if (empty($form_name) || empty($form_email) || empty($form_message))
	{
		$message .= '<p>' . __('Please fill all required fields.','liva') . '</p>';
		$error = true;
	}

	if ( $error == false && !is_email( $form_email ) )
	{
		$message .= '<p>' . __('Please check your email.','liva') . '</p>';
		$error = true;
	}

	if ( $error === false )
	{
		$site_name = is_multisite() ? $current_site->site_name : get_bloginfo('name');
		if (wp_mail($email, $site_name, esc_html($form_message),'From: "'. esc_html($form_name) .'" <' . esc_html($form_email) . '>'))
		{
			$message = '<p>' . __('Email sent. Thank you for contacting us','liva') . '</p>';
		}
		else
		{
			$message = '<p>' .__('Server error. Pease try again later.','liva') . '</p>';
			$error = true;
		}

	}
}

get_header(); ?>

<div class="container">
	<div class="content_fullwidth">
		
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		
			<div class="one_half">

				<?php the_content(); ?>

				<form action="" method="post">

				<fieldset>

					<?php if ($error || $message): ?>
						<div class="<?php echo ($error === true ? 'error': 'success')?>">
							<div class="message-box-wrap ">
								<?php echo $message; ?>
							</div>
						</div>
					<?php endif; ?>

					<label for="name" class="blocklabel"><?php _e('Your Name','liva');?>*</label>
					<p><input name="form_name" class="input_bg" type="text" id="name" value='<?php echo $form_name; ?>'/></p>

					<label for="email" class="blocklabel"><?php _e('E-Mail','liva');?>*</label>
					<p><input name="form_email" class="input_bg" type="text" id="email" value='<?php echo $form_email; ?>' /></p>

					<label for="message" class="blocklabel"><?php _e('Your Message','liva');?>*</label>
					<p><textarea name="form_message" class="textarea_bg" id="message" cols="20" rows="7" ><?php  echo $form_message; ?></textarea></p>

					<p>
					<div class="clearfix"></div>

					<?php wp_nonce_field( 'ts_contact-form_', '_wpnonce', true); ?>
					<input name="Send" type="submit" value="<?php _e('SUBMIT','liva'); ?>" class="comment_submit" id="send"/></p>

				</fieldset>

				</form> 

			</div>
		
			<div class="one_half last">
				
				<div class="address-info">
					<?php echo get_post_meta(get_the_ID(),'contact_form_box',true); ?>
				</div>

				 <h3><i><?php _e('Find the Address','liva'); ?></i></h3>
				 <div class="google-map"><?php 
					//map field name was change with wp 3.9 to fix editor issue
					$new_map = get_post_meta(get_the_ID(), 'maparea',true);
					if ($new_map) {
						$map = $new_map;
					} else {
						$map = get_post_meta(get_the_ID(), 'map',true);
					}
					echo do_shortcode($map); ?>
				 </div>
			</div>
		<?php endwhile; // end of the loop. ?>
	</div>
</div><!-- end content area -->
<div class="clearfix mar_top5"></div>
<?php get_footer(); ?>