<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback which is
 * located in the functions.php file.
 *
 * @package liva
 * @since liva 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<?php // You can start editing here -- including this comment! ?>

<?php if ( have_comments() ) : ?>

	<div class="clearfix divider_line"></div>

	<h4><i><?php _e('Comments','liva');?> (<span><?php echo number_format_i18n(get_comments_number()); ?></span>)</i></h4>
	<div class="mar_top_bottom_lines_small3"></div>

	<?php
		/* Loop through and list the comments. Tell wp_list_comments()
		 * to use theme_comment() to format the comments.
		 * If you want to overload this in a child theme then you can
		 * define theme_comment() and that will be used instead.
		 * See theme_comment() in inc/template-tags.php for more.
		 */
		wp_list_comments( array( 'callback' => 'ts_theme_comment' ) );
	?>

	<?php
		$args = array(
			'prev_text'    => __('Previous','liva'),
			'next_text'    => __('Next','liva'),
		);
		paginate_comments_links($args);
	?>

<?php endif; // have_comments() ?>

<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>

	<div class="clearfix divider_line"></div>

	<h4><i><?php _e('Comments are closed.','liva');?></i></h4>
	<div class="mar_top_bottom_lines_small3"></div>
<?php endif; ?>


	<div class="comment_form">

<!--		<h4><i>Leave a Comment</i></h4>-->

<!--		<form action="blog-post.html" method="post">
			<input type="text" name="yourname" id="name" class="comment_input_bg" />
			<label for="name">Name*</label>

			<input type="text" name="email" id="mail" class="comment_input_bg" />
			<label for="mail">Mail*</label>

			<input type="text" name="website" id="website" class="comment_input_bg" />
			<label for="website">Website</label>

			<textarea name="comment" class="comment_textarea_bg" rows="20" cols="7" ></textarea>
			<div class="clearfix"></div> 
			<input name="send" type="submit" value="Submit Comment" class="comment_submit"/>
			<p></p>
			<p class="comment_checkbox"><input type="checkbox" name="check" /> Notify me of followup comments via e-mail</p>
		</form>-->

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$args = array(
		'id_form' => 'commentform',
		'id_submit' => 'comment_submit',
		'title_reply' => __( 'Leave a Comment' ,'liva'),
		'title_reply_to' =>  __( 'Leave a Comment to %s'  ,'liva'),
		'cancel_reply_link' => __( 'Cancel Comment'  ,'liva'),
		'label_submit' => __( 'Submit Comment'  ,'liva'),
		'comment_field' => '<textarea class="comment_textarea_bg" aria-required="true" rows="1" cols="1" name="comment" id="comment" ' . $aria_req . '></textarea>',
		'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'liva' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  ,'liva'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'comment_notes_before' => '',
		'comment_notes_after' => '<div class="clearfix"></div><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'liva'), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'fields' => apply_filters( 'comment_form_default_fields',
			array(
				'author' => '
					<input class="comment_input_bg" id="author" type="text" ' . $aria_req . ' size="20" value="' . esc_attr( $commenter['comment_author'] ) . '" name="author">
					<label for="author">' . __( 'Name', 'liva' ) . ' ' . ( $req ? '*' : '' ) . '</label>',
				'email' => '
					<input class="comment_input_bg" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="20"' . $aria_req . ' />
					<label for="email">' . __( 'Email', 'liva' ) . ' ' . ( $req ? '*' : '' ) . '</label>'
			)
		)
	);
	comment_form($args); ?>
</div><!-- end comment form -->
<div class="clearfix mar_top5"></div>
	