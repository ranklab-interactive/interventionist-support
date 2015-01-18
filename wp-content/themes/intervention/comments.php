<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	This post is password protected. Enter the password to view comments.
<?php
	return;
}
?>
<?php if ( have_comments() ) : ?>
	
	
	<div id="comments">
	<h2 class="gray" style="margin-top:50px;"><?php comments_number('No Responses', 'One Response', '% Responses' );?></h2>
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link() ?></div>
			<div class="prev-posts"><?php next_comments_link() ?></div>
		</div>
		<ol class="commentlist">
			<?php wp_list_comments('type=comment&callback=frothy_goodness_single_comments'); ?>
		</ol>
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link() ?></div>
			<div class="prev-posts"><?php next_comments_link() ?></div>
		</div>
	</div><!-- end comments -->
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<p>Comments are closed.</p>
	<?php endif; ?>
	</div><!-- end comments -->
<?php endif; ?>

<?php if (comments_open()) : ?>

<a name="reply"></a>
<div class="post-box post-box-reply" id="reply">
	<div class="title post-box-reply-title append-clear">
		<h2 class="gray"><?php comment_form_title('Add a Comment', 'Add a Comment to %s'); ?></h2>
		<p class="cancel-comment-reply"><small><?php cancel_comment_reply_link(); ?></small></p>
	</div>
	<div class="interior post-box-reply-interior" >
		<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
		<p>You must be <a href="<?php echo wp_login_url(get_permalink()); ?>">logged in</a> to post a comment.</p>
		<?php else : ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment-form">
			<?php if ( is_user_logged_in() ) : ?>
			<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
			<?php else : ?>
			<p class="input">
				<label for="comment-author">Name</label>
				<input type="text" name="author" id="comment-author"  size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
				<small><?php if ($req) echo "Required"; ?></small>
			</p>
			<p class="input">
				<label for="comment-email">E-mail</label>
				<input type="text" name="email" id="comment-email" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
				<small><?php if ($req) echo "Required"; else echo "Optional"; ?></small>
			</p>
			<p class="input">
				<label for="comment-url">Website</label>
				<input type="text" name="url" id="comment-url" size="22" tabindex="3" />
				<small>Optional</small>
			</p>
			<?php endif; ?>
			<p>
				<label for="comment-comment">Comment</label>
				<textarea name="comment" id="comment-comment" cols="22" rows="5" tabindex="4"></textarea>
			</p>
			<div class="comment-notify-submit">
				<?php 
					if (function_exists('show_subscription_checkbox')) {
						show_subscription_checkbox();
					}
				?>
				<p class="comment-submit"><button type="submit" name="submit" value="submit" id="comment-submit" tabindex="5" class="btn" ><span>Submit</span></button></p>
				<div class="clear"></div>
			</div>
			<?php comment_id_fields(); ?>
			<?php do_action('comment_form', $post->ID); ?>
		</form>
		<?php endif; ?>
	</div>
</div>

<?php endif; ?>