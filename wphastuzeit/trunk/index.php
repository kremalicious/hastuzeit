<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header(); ?>

			<?php if ( is_home() ) { ?>
				<div id="featured">
				
					<!-- The Featured Loop -->
					
					 <?php $my_query = new WP_Query('category_name=Featured&showposts=1');
					  while ($my_query->have_posts()) : $my_query->the_post();
					  $do_not_duplicate[] = $post->ID ?>
					  
					  <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					  
					  	<p class="meta"><span class="date"><?php the_time('M Y') ?></span> <span class="category-link"><?php echo the_category_exclude(" ","featured"); ?></span> <?php edit_post_link('Bearbeiten', '', ''); ?> <span class="alignright comment-link"><?php comments_popup_link('0', '1', '%'); ?></span></p>

							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>	
							<!-- wenn custom field unterueberschrift vorhanden, dann anzeigen -->
							<?php 
								$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
				      			if ($unterueber != "")
				          			echo "<h2 class=\"unterueber\">$unterueber</h2>";
							?>
							
							<p class="author">von <?php the_author_posts_link(); ?></p>
										
							<!-- Nutze exzerpt, wenn angegeben, ansonsten the_content -->
							<?php if (!empty($post->post_excerpt)) : ?>
								<?php the_excerpt(); ?>
								<p><a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Read the rest of this entry &raquo;</a></p>
							<?php else : ?>
								<?php the_content('Mehr, mehr, mehr'); ?>
							<?php endif; ?>
							
						</div>	  
					    
					  <?php endwhile; ?>
					
					<div id="zipfel"></div>
				</div>
				
				<div id="ausgabe">
				
				</div>
			<?php } ?>
			
			<div id="main">
				
				<!-- The Main Loop -->

				<?php if (have_posts()) : while (have_posts()) : the_post(); 
				 if (in_array($post->ID, $do_not_duplicate)) continue;
				 update_post_caches($posts); ?>
				
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						
							<p class="meta"><span class="date"><?php the_time('M Y') ?></span> <span class="category-link"><?php the_category(' ') ?></span> <?php edit_post_link('Bearbeiten', '', ''); ?> <span class="alignright comment-link"><?php comments_popup_link('0', '1', '%'); ?></span></p>
				
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							
							<!-- Wenn custom field unterueberschrift vorhanden, dann anzeigen -->
							<?php 
								$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
				      			if ($unterueber != "")
				          			echo "<h2 class=\"unterueber\">$unterueber</h2>";
							?>
							
							<p class="author">von <?php the_author_posts_link(); ?></p>
									
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
				
					<?php next_posts_link('&laquo; &Auml;ltere Artikel') ?> | <?php previous_posts_link('Neuere Artikel &raquo;') ?>
				
				<?php else : ?>
				
					<h2>Not Found</h2>
					<p>Sorry, but you are looking for something that isn't here.</p>
					<?php get_search_form(); ?>
				
				<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>