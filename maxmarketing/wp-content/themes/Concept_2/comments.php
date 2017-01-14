<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ( __( 'Please do not load this page directly. Thanks!', 'concept7' ) );

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'concept7' ); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ( comments_open() ) : ?>
<div id="comment-wrapper">
    <h3><?php comments_number( __( 'No Comments', 'concept7' ), __( '1 Comment', 'concept7' ), _n( '% comment', '% comments', get_comments_number(), 'concept7' ) ); ?> <a class="leave-cmt btn no_colored_bg  white_color" href="#respond"><?php _e('Leave a comment', 'concept7') ?> &nbsp;<i class="icon-angle-down"></i></a></h3>
    
    <?php if ( have_comments() ) : ?>
    <ul id="comments">
    <?php wp_list_comments(
		array(
			'login_text' => 'Log in to Reply',
			'reply_text' => 'reply',
			'callback' => 'better_comments'
		));
	?>
    </ul>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h6 class="nav-previous"><?php previous_comments_link( __( '&lt; Older Comments', 'concept7' ) ); ?></h6>
			<h6 class="nav-next"><?php next_comments_link( __( 'Newer Comments &gt;', 'concept7' ) ); ?></h6>
		</nav>
	<?php endif; // check for comment navigation ?>
    <?php endif; ?>
	<?php else :
    // comments are closed ?>
    <?php endif; ?>
    
    <?php if ( comments_open() ) : ?>
    <div class="row-fluid">
    <?php 
	function my_fields($fields) {
	$fields['author'] = '<div class="cf-label name-label span4" style="margin-left:0;">
                    <input type="text" aria-required="true" tabindex="1" size="22" value="'. __( 'Your name (Required)', 'concept7') .'" id="author" name="author">
                </div>';
	$fields['email'] = '<div class="cf-label email-label span4">
                    <input type="text" aria-required="true" tabindex="2" size="22" value="'. __( 'Email (Required)', 'concept7').'" id="email" name="email">
                </div>';
	$fields['url'] = '<div class="cf-label website-label span4">
                    <input type="text" tabindex="3" size="22" value="'. __( 'Website', 'concept7').'" id="url" name="url">
                </div>';
	return $fields;
	}
	add_filter('comment_form_default_fields','my_fields');

	comment_form(
		array(
			'comment_field' => '<div class="clear" style="height:5px;"></div><div class="clearfix comment-textarea">
                    <textarea style="padding:14px 2%; width:96%;" tabindex="4" cols="15" rows="7" id="comment" name="comment">'. __( 'Message (Required)', 'concept7').'</textarea>
                </div>'
	)); 
	
	?>
    </div>
</div>

<?php endif;?>