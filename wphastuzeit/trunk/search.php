<?php

/**
 * @package WordPress
 * @subpackage hastuzeit
 */
 
 ?>

<?php if($_GET['ajax'] == '1'){ ?>  
  	
  	<div id="live-search">
  	
	    <?php if (have_posts()) : ?>  
	  
	        <?php while (have_posts()) : the_post(); ?>  
	  
	            <div class="live-results">  
	                <h4 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Link zu <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>  
	            </div>  
	  
	        <?php endwhile; ?>  
	  		
	    <?php else : ?>  
	  		<div class="live-results">  
	        	<h4>Nix gefunden. Andere Suche probieren?</h4>
	  		</div>
	    <?php endif; ?>  
  	
  	</div>
  	
<?php } else { ?>

<?php get_header(); ?>

	<div id="main">

	<?php if (have_posts()) : ?>

		<h1 class="pagetitle">Suchergebnisse f&uuml;r '<?php the_search_query(); ?>'</h1>
		
		<?php get_search_form(); ?>
		
		<!-- Pagination if were on a paged site -->
		<?php if (function_exists('wp_pagenavi')) {
			wp_pagenavi();
		} else { ?>				
			<div class="next-links">
				<div class="alignleft"><?php next_posts_link('&laquo; &Auml;ltere Artikel') ?></div>
				<div class="alignright"><?php previous_posts_link('Neuere Artikel &raquo;') ?></div>
			</div>
		<?php } ?>


		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						
					<p class="meta"><span class="date"><?php the_time('M Y') ?></span> <span class="category-link"><?php the_category(' ') ?></span> <?php edit_post_link('Bearbeiten', '', ''); ?> <span class="alignright comment-link"><?php comments_popup_link('0', '1', '%'); ?></span></p>
					
					<div class="alignleft image">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Link zu <?php the_title_attribute(); ?>"><?php if (function_exists('images')) images('1', '100', '100', '', false); ?></a>
					</div>
					
					<div class="alignleft text">
		
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Link zu <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						
						<!-- Wenn custom field unterueberschrift vorhanden, dann anzeigen -->
						<?php 
							$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
			      			if ($unterueber != "")
			          			echo "<h2 class=\"unterueber\">$unterueber</h2>";
						?>
						
						<p class="author-link">von <?php if(function_exists('coauthors_posts_links'))
								    coauthors_posts_links(", ", " und ");
								else
								    the_author_posts_link(); ?>
						</p>
					</div>
							
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

	<?php else : ?>

		<h2 class="pagetitle">Nix gefunden. Andere Suche probieren?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php } ?> 