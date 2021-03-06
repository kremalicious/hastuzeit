<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header(); ?>
		
	<div id="main">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<h1 class="pagetitle"><?php the_title(); ?></h1>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			
			<?php edit_post_link('Bearbeiten', '<p>', '</p>'); ?>
			
			<?php the_content('<p>Read the rest of this page &raquo;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p>Pages: ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		
		</div>
		
		<?php endwhile; endif; ?>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>