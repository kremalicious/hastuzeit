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
			
			<p class="author-link">von <?php if(function_exists('coauthors_posts_links'))
							    coauthors_posts_links(", ", " und ");
							else
							    the_author_posts_link(); ?></p>
			
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
			<?php if ( !in_category('Termine') ) autorbox(); ?>
			
			<?php the_tags( '<p id="tags">', ', ', '</p>'); ?>
			
		</div>
		
		<?php 
			if(function_exists('selfserv_sexy')) { 
				selfserv_sexy(); 
			} 
			if (function_exists('similar_posts')) {
			  similar_posts();
			}	
		?>
		
		
		<div id="more-content">				
			<?php global $post;
				$categories = get_the_category();
				foreach ($categories as $category) :
			?>
		
			<div class="column">
				<h3>frisches aus <?php echo '<a href="' . get_category_link( $category->cat_ID ) . '">' . $category->cat_name . '</a>' ?></h3>
				
				<ul>
					<?php
						$posts = get_posts('numberposts=4&category=-3,'. $category->term_id);
						foreach($posts as $post) :
						$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
					?>
					<li><h4><a class="infopopup" title="<?php if ($unterueber != "") echo $unterueber ?> || <?php the_time('j. F Y'); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4></li>
					
					<?php endforeach; ?>
					
				</ul>
			</div>
				
			<?php endforeach; wp_reset_query(); ?>

		</div>
		
		<div class="next-links">
			<div class="alignleft"><?php previous_post_link('%link', '%title', FALSE, '3') ?></div>
			<div class="alignright"><?php next_post_link('%link', '%title', FALSE, '3') ?></div>
		</div>

	<?php comments_template('',true); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>