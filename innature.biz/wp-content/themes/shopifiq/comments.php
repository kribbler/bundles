

<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'shopifiq' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
                <div id="comments" class="hr clearfix"></div>
                <div class="comment-number">
                    <h4 id="comment-number-first"><?php echo get_comments_number(); ?></h4>
                    <h4><?php echo get_comments_number(); ?></h4>
                    <h3 id="comments"><?php echo __('comments', 'shopifiq'); ?></h3>
                </div>

			<ol>
				<?php
                                
                                
                                function shopifiq_comment($comment, $args, $depth) {
                                    
                                    
                                    
                                    $email = $comment->comment_author_email;
                                    
                                    $user_id = -1;
                                    
                                    if ( email_exists($email) )
                                        $user_id = email_exists($email);

                                    
                                    
                                    $GLOBALS['comment'] = $comment; ?>
                            
                            <div class="clearfix">
                                    <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                                        
                                        <div class="comments-left-side clearfix">
                                            <?php echo get_avatar($comment,$size='48' ); ?>
                                            <div class="comment-meta">
                                                <div class="day"><?php echo get_comment_date("M"); ?> <?php echo get_comment_date("d"); ?></div>
                                                <div class="month"><?php echo strtolower(get_comment_date("Y")); ?></div>
                                            </div>
                                        </div>

                                        <div class="comments-right-side clearfix">
                                        <header>
                                            <hgroup>
                                                <!--<h3><?php comment_author(); ?></h3>-->
                                                <h4>
                                                    <?php
                                                        comment_author();
                                                    ?>
                                                    
                                                </h4>
                                            </hgroup>
                                        </header>
                                        <p><?php comment_text() ?></p>
                                        <?php echo comment_reply_link(array_merge( array('reply_text' => 'Reply') , array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                                        </div>
                                    </article>
                            </div>
                            
                            
                            
                            
                            

                                    <?php
                                 }
                                
                                
                                
                                
                                        wp_list_comments('type=comment&callback=shopifiq_comment');
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'shopifiq' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'shopifiq' ) ); ?>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p><?php _e( 'Comments are closed.', 'shopifiq' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

    
        
        <?php 
        if(!isset($fields))
            $fields =  array(
                    'author' => '<p class="comment-form-author">' .
                                '<input id="author" name="author" type="text" placeholder="' . __( 'Name', 'shopifiq' ) . ( $req ? '*' : '') . '" size="30" /></p>',
                    'email'  => '<p class="comment-form-email">' .
                                '<input id="email" name="email" type="text" placeholder="' . __( 'Email', 'shopifiq' ) . ( $req ? '*' : '') . '" size="30" /></p>'
            ); 
            $defaults = array(
            'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
            'comment_field'        => '<p class="comment-form-comment"><div class="wrap-area"><textarea class="required" name="comment" title="message" cols="45" rows="8" aria-required="true"></textarea></div></p>',
            'must_log_in'          => '<p class="must-log-in">You must be logged in to leave a reply.</p>',
            'logged_in_as'         => '<h4 id="comment-header" class="clearfix">' . __('leave a comment', 'shopifiq') . '</h4><div id="comment-form">',
            'comment_notes_before' => '<h4 id="comment-header" class="clearfix">' . __('leave a comment', 'shopifiq') . '</h4><div id="comment-form">',
            'title_reply' => '',
            'comment_notes_after'  => '<div class="clear"></div><div class="form-buttons">
                                <input type="button" class="form-button" name="reset" id="reset" value="' . __("Reset", "shopifiq") . '">
                                <input type="button" class="form-button" name="send-comment" value="Send">
                            </div></div>',
            'id_form'              => 'commentform',
            'id_submit'            => 'submit',
         );
        
        
        comment_form( $defaults ); 
        
        ?>
