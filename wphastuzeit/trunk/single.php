<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header();
?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<h1><?php the_title(); ?></h1>
			
			<!-- wenn custom field unterueberschrift vorhanden, dann anzeigen -->
			<?php 
				$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
      			if ($unterueber != "")
          			echo "<h2 class=\"unterueber\">$unterueber</h2>";
			?>
			
			<p class="meta"> <span class="category-link"><?php the_category(' ') ?></span> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> <?php edit_post_link('Edit', '', ''); ?></p>
			
			<p class="author">von <?php the_author_posts_link(); ?></p>
			<p class="date"><?php the_time('F') ?><span class="year"><?php the_time('Y') ?></span></p>
			
			<?php if (!empty($post->post_excerpt)) : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
			
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
			<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
			
			<p class="author-info">
				<?php the_author(); ?>
			</p>

				
		</div>
		
		<?php previous_post_link('&laquo; %link') ?> | <?php next_post_link('%link &raquo;') ?>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>