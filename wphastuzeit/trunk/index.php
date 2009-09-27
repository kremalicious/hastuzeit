<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			
			<!-- wenn custom field unterueberschrift vorhanden, dann anzeigen -->
			<?php 
				$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
      			if ($unterueber != "")
          			echo "<h2 class=\"unterueber\">$unterueber</h2>";
			?>
			
			<p class="date"><?php the_time('F') ?><span class="year"><?php the_time('Y') ?></span></p>
			<p class="meta"> <span class="category-link"><?php the_category(' ') ?></span> <?php the_author_posts_link(); ?> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> <?php edit_post_link('Edit', '', ''); ?></p>
			
			<!-- Nutze exzerpt, wenn angegeben, ansonsten the_content -->
			<?php if (!empty($post->post_excerpt)) : ?>
				<?php the_excerpt(); ?>
				<a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Read the rest of this entry &raquo;</a>	
			<?php else : ?>
				<?php the_content('Read the rest of this entry &raquo;'); ?>
			<?php endif; ?>
		</div>

	<?php endwhile; ?>

	<?php next_posts_link('&laquo; Older Entries') ?> | <?php previous_posts_link('Newer Entries &raquo;') ?>

<?php else : ?>

	<h2>Not Found</h2>
	<p>Sorry, but you are looking for something that isn't here.</p>
	<?php get_search_form(); ?>

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>