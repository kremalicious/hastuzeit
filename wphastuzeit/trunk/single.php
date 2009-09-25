<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header();
?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

			
			<?php edit_post_link('Edit this entry','','.'); ?>

			</p>
				
		</div>
		
		<?php previous_post_link('&laquo; %link') ?> | <?php next_post_link('%link &raquo;') ?>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>