<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="alert">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
		<h3 id="comments"><?php comments_number('Keine Kommentare', '1 Kommentar', '% Kommentare' );?></h3>
		
		<!-- Normal comments -->
		<?php if ( !empty($comments_by_type['comment']) ) : ?>

		<ol class="commentlist">
		
			<?php 
				$args = array(
					'avatar_size' => 47,
					'type' => 'comment'
				);
				wp_list_comments($args); ?>
	
		</ol>
	
	<?php endif; ?>
	
	<!-- Pings and trackbacks -->
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
	  
	  <h3 id="pings">Trackbacks/Pingbacks</h3>
	  
	  <ol class="commentlist">
	  	<?php wp_list_comments('type=pings&callback=list_pings'); ?>
	  </ol>

	<?php endif; ?>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

	<h3><?php comment_form_title( 'Sag Deine Meinung', 'Sag Deine Meinung zu %s' ); ?></h3>

	<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) : ?>

		<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

		<?php else : ?>
		
		<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="author"><small>Name <?php if ($req) echo "(ben&ouml;tigt)"; ?></small></label></p>

		<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="email"><small>Mail (bleibt geheim) <?php if ($req) echo "(ben&ouml;tigt)"; ?></small></label></p>

		<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" onblur="if(this.value=='http://')this.value='';" onfocus="if(this.value=='Website')this.value='http://';" size="22" tabindex="3" />
		<label for="url"><small>Website</small></label></p>
		
		<!-- Facebook Connect Login
		<div id="comment-user-details">
			<?php do_action('alt_comment_login'); ?>
		</div>
		-->
		
		<?php endif; ?>

		<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>

		<input name="submit" type="submit" id="submit" tabindex="5" value="Kommentar absenden" />
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>