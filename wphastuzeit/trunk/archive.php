<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header();
?>

	<div id="main">

	<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	
	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h1 class="pagetitle"><?php single_cat_title(); ?></h1>
	<h4 class="description"><?php echo category_description(); ?></h4>
	
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	<h1 class="pagetitle">Texte mit Tags &#8216;<?php single_tag_title(); ?>&#8217;</h1>
	
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h1 class="pagetitle">Texte vom <?php the_time('F jS, Y'); ?></h1>
	
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h1 class="pagetitle">Texte vom <?php the_time('F, Y'); ?></h1>
	
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h1 class="pagetitle">Texte aus <?php the_time('Y'); ?></h1>
	
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	
		<?php $thisauthor = get_userdata(get_query_var('author')); ?>
		
		<h1 class="pagetitle"><?php echo $thisauthor->display_name; ?></h1>
					
			<div id="authorinfo">
				<div id="avatar">
						<?php if(function_exists('get_avatar')) {
							echo get_avatar($thisauthor->user_email, 70, "" );
						} ?>
				</div>
				
				<?php if ($thisauthor->description) { ?>
					<div id="description"><?php echo $thisauthor->description; ?></div>
				<?php } ?>
				
				<?php if ($thisauthor->user_url) { ?>
					<div><span>Website:</span> <a class="url" href="<?php echo $thisauthor->user_url; ?>" title="Website von <?php echo $thisauthor->display_name; ?>"><?php echo $thisauthor->user_url; ?></a></div>
				<?php } ?>
				
				<?php if ($thisauthor->twitter) { ?>
					<div><span>Twitter:</span> <a class="url" href="<?php echo $thisauthor->twitter; ?>" title="<?php echo $thisauthor->display_name; ?> auf Twitter"><?php echo $thisauthor->twitter; ?></a></div>
				<?php } ?>
				
				<?php if ($thisauthor->facebook) { ?>
					<div><span>Facebook:</span> <a class="url" href="<?php echo $thisauthor->facebook; ?>" title="<?php echo $thisauthor->display_name; ?> auf Facebook"><?php echo $thisauthor->facebook; ?></a></div>
				<?php } ?>
				
				<?php if ($thisauthor->studivz) { ?>
					<div><span>StudiVZ:</span> <a class="url" href="<?php echo $thisauthor->studivz; ?>" title="<?php echo $thisauthor->display_name; ?> auf Facebook"><?php echo $thisauthor->stduivz; ?></a></div>
				<?php } ?>
				
				<?php if ($thisauthor->jabber) { ?>
					<div><span>Jabber/GTalk:</span> <a href="xmpp:<?php echo $thisauthor->jabber; ?>"><?php echo $thisauthor->jabber; ?></a></div>
				<?php } ?>
				
				<?php if ($thisauthor->aim) { ?>
					<div><span>AIM:</span> <a href="aim:<?php echo $thisauthor->aim; ?>"><?php echo $thisauthor->aim; ?></a></div>
				<?php } ?>
				
				<?php if ($thisauthor->yim) { ?>
					<div><span>Yahoo IM:</span> <a href="ymsgr:<?php echo $thisauthor->yim; ?>"><?php echo $thisauthor->yim; ?></a></div>
				<?php } ?>
				
				<?php if ($thisauthor->icq) { ?>
					<div><span>ICQ:</span> <a href="ymsgr:<?php echo $thisauthor->icq; ?>"><?php echo $thisauthor->icq; ?></a></div>
				<?php }
				
				if ( is_user_logged_in() ) { ?>
					<a id="profile-edit-link" href="http://hastuzeit.de/wp-admin/profile.php">F&uuml;lle dein eigenes Profil aus</a>
				<?php } ?>
			</div>
			
			<h2 class="pagetitle">Alle Texte von <?php echo $thisauthor->display_name; ?></h2>
	
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h1 class="pagetitle">Blog Archives</h1>
	<?php } ?>

		<?php if (function_exists('wp_pagenavi')) { ?>
		<div id="tabnav">
			<?php wp_pagenavi(); ?>
		</div>
		<?php } else { ?>				
			<div class="next-links">
				<div class="alignleft"><?php next_posts_link('&laquo; &Auml;ltere Artikel') ?></div>
				<div class="alignright"><?php previous_posts_link('Neuere Artikel &raquo;') ?></div>
			</div>
		<?php } ?>
	
		<?php while (have_posts()) : the_post(); ?>
		
		<?php if ( in_category('3') && !is_single() ) continue; ?>
		
		<?php if ( is_category('Termine') ) { ?>
		
			<?php if (function_exists('ec3_get_calendar')) {
				ec3_get_calendar();
			} ?>
		
		<?php } ?>
			
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
			<p class="meta"><span class="date"><?php the_time('M Y') ?></span> <span class="category-link"><?php the_category(' ') ?></span> <?php edit_post_link('Bearbeiten', '', ''); ?> <span class="alignright comment-link"><?php comments_popup_link('0', '1', '%'); ?></span></p>

			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Link zu <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			
			<!-- wenn custom field unterueberschrift vorhanden, dann anzeigen -->
			<?php 
				$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
      			if ($unterueber != "")
          			echo "<h2 class=\"unterueber\">$unterueber</h2>";
			?>
			
			<p class="author-link">von <?php if(function_exists('coauthors_posts_links'))
							    coauthors_posts_links(", ", " und ");
							else
							    the_author_posts_link(); ?></p>
						
			<!-- Nutze exzerpt, wenn angegeben, ansonsten the_content -->
			<?php if (!empty($post->post_excerpt)) : ?>
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
					the_post_thumbnail(array( 150,150 ), array( 'class' => 'alignleft' ));
				} else {
					images('1', '150', '150', '', false);
				} ?>
				<?php the_excerpt(); ?>
				<p><a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark" title="Link zu <?php the_title(); ?>">Mehr, mehr, mehr</a></p>
			<?php else : ?>
				<?php the_content('Mehr, mehr, mehr'); ?>
			<?php endif; ?>
			
		</div>
	
	<?php endwhile; ?>

		<?php if (function_exists('wp_pagenavi')) { ?>
			<?php wp_pagenavi(); ?>
		<?php } else { ?>				
			<div class="next-links">
				<div class="alignleft"><?php next_posts_link('&laquo; &Auml;ltere Artikel') ?></div>
				<div class="alignright"><?php previous_posts_link('Neuere Artikel &raquo;') ?></div>
			</div>
		<?php } ?>

	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf('<h2 class="pagetitle">Ups, es existieren noch keine Beitr&auml;ge in %s</h2>', single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo('<h2 class="pagetitle">Nix gefunden.</h2>');
		}
		get_search_form();

	endif;
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>