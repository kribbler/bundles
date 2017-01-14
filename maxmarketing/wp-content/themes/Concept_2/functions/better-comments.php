<?php
function better_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div class="comment" id="comment-<?php comment_ID(); ?>">
            
            <div class="comment-content">					
                <?php echo get_avatar($comment, $size = '55'); ?>
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                <div class="comment-meta">
                    <h4><?php comment_author_link() ?>
                    	<span><?php comment_date(); ?> at <?php comment_time() ?></span>
                    </h4> 
                    
						
                </div>	
                <div class="comment-text">
                    <?php comment_text() ?>
					<?php if ($comment->comment_approved == '0') : ?>
                        <p style="font-style:italic;"><?php _e('Your comment is awaiting moderation.','concept7') ?></p>
                        <br />
                    <?php endif; ?>
					<?php edit_comment_link(__('[Edit]', 'concept7'),'  ','') ?>
                </div>
            </div>
        </div>

<?php
}
?>