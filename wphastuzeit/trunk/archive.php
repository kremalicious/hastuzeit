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
	
		<?php
			if(isset($_GET['author_name'])) :
			$curauth = get_userdatabylogin($author_name);
			else :
			$curauth = get_userdata(intval($author));
			endif;
		?>
	<h1 class="pagetitle">Texte von <?php echo $curauth->display_name; ?></h1>
	
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
				<?php the_excerpt(); ?>
				<p><a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark" title="Link zu <?php the_title(); ?>">Read the rest of this entry &raquo;</a></p>
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
			printf("<h2>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2>No posts found.</h2>");
		}
		get_search_form();

	endif;
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>