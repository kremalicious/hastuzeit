<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header(); ?>

	<?php if (have_posts()) : ?>

		<h2>Search Results</h2>


		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						
					<p class="meta"><span class="date"><?php the_time('M Y') ?></span> <span class="category-link"><?php the_category(' ') ?></span> <?php edit_post_link('Bearbeiten', '', ''); ?> <span class="alignright comment-link"><?php comments_popup_link('0', '1', '%'); ?></span></p>
		
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					
					<!-- Wenn custom field unterueberschrift vorhanden, dann anzeigen -->
					<?php 
						$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
		      			if ($unterueber != "")
		          			echo "<h2 class=\"unterueber\">$unterueber</h2>";
					?>
					
					<p class="author">von <?php if(function_exists('coauthors_posts_links'))
							    coauthors_posts_links();
							else
							    the_author_posts_link(); ?></p>
							
					<!-- Nutze exzerpt, wenn angegeben, ansonsten the_content -->
					<?php if (!empty($post->post_excerpt)) : ?>
						<?php if (function_exists('images')) images('1', '150', '150', '', false); ?>
						<?php the_excerpt(); ?>
						<p><a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Mehr, mehr, mehr</a></p>
					<?php else : ?>
						<?php the_content('Mehr, mehr, mehr'); ?>
					<?php endif; ?>
					
				</div>

		<?php endwhile; ?>

					<div class="next-links">
						<div class="alignleft"><?php next_posts_link('&laquo; &Auml;ltere Artikel') ?></div>
						<div class="alignright"><?php previous_posts_link('Neuere Artikel &raquo;') ?></div>
					</div>

	<?php else : ?>

		<h2>No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>