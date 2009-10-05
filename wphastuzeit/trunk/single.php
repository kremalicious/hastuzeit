<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header();
?>

	<div id="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<p class="meta"><span class="date"><?php the_time('M Y') ?></span> <span class="category-link"><?php the_category(' ') ?></span> <?php edit_post_link('Bearbeiten', '', ''); ?> <span class="alignright comment-link"><?php comments_popup_link('0', '1', '%'); ?></span></p>
			
			<h1><?php the_title(); ?></h1>
			
			<!-- wenn custom field unterueberschrift vorhanden, dann anzeigen -->
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
				<?php the_excerpt(); ?>
			<?php endif; ?>
			
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
			<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
			
		</div>
		
		<?php previous_post_link('&laquo; %link') ?> | <?php next_post_link('%link &raquo;') ?>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>