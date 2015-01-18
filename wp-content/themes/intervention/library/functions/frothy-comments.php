<?php
//Custom Comments
function frothy_goodness_single_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div class="comment">
		<div class="comment-details">
			<div class="comment-author">
				<div class="comment-avatar"><?php echo get_avatar($comment, $size =
'50'); ?></div>
				<div class="comment-meta">
					<span class="author"><?php echo get_comment_author_link(); ?></span>
					<span class="time"><?php echo get_comment_date('F j, Y'); ?></span>
				</div>
				<div class="comment-actions">
					<?php edit_comment_link(__('Edit'),'<span class="edit">','</span> | ') ?>
					<?php comment_reply_link(array_merge( $args, array('respond_id' => 'reply' ,'add_below' => 'reply', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div><!-- end comment-author -->
			<div class="comment-message">
					<?php comment_text(); ?>
					<?php if ($comment->comment_approved == '0') : ?>
					<p class="comment-notice"><?php _e('My comment is awaiting moderation.') ?></p>
					<?php endif; ?>
			</div><!-- end comment-message -->
		</div><!-- end comment-details -->
	</div><!-- end comment -->
</li>
<?php } ?>