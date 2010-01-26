<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header(); ?>

			<?php if ( is_home() and !is_paged() ) { ?>
			
				<div id="featured">
					
					<div id="featured_head">
						<h4>Wichtig</h4>
					</div>
					
					<div class="scroll">
					<div class="scrollContainer">
				
						<!-- The Featured Loop -->
						<?php
						 $args = array(
							'showposts' => 9,
							'post__in'  => get_option('sticky_posts'),
							'caller_get_posts' => 1
						);
						 $postslist = query_posts($args);
						 foreach ($postslist as $post) : 
						    setup_postdata($post);
						 ?>
						
						<div class="panel post" id="post-<?php the_ID(); ?>">
						
							<div class="featured_media">
						
								<a href="<?php the_permalink(); ?>" rel="bookmark">
								
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
									the_post_thumbnail(array( 150,150 ), array( 'class' => 'alignleft'));
								} else {
									images('1', '150', '150', '', false);
								} ?>
								
								</a>
							
							</div>
							
							<div class="featured_text">
								
								<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Link zu <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<?php edit_post_link('Bearbeiten', '', ''); ?>
								<!-- Wenn custom field unterueberschrift vorhanden, dann anzeigen -->
								<?php 
									$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
					      			if ($unterueber != "")
					          			echo "<h3 class=\"unterueber\">$unterueber</h3>";
								?>
								
								
								<a class="more-link" href="<?php the_permalink(); ?>" title="Link zu <?php the_title_attribute(); ?>">Mehr, Mehr, Mehr</a>
							
							</div>
	
						</div><!-- end .panel -->
						
						<?php endforeach; ?>
					
					</div><!-- end .scrollContainer -->
					</div><!-- end .scroll -->
					
					<!-- Here comes the featured navigation -->
					<div id="shade">
					
						<ul class="featured_nav">
							
							<?php
							 $args = array(
								'showposts' => 9,
								'post__in'  => get_option('sticky_posts'),
								'caller_get_posts' => 1
							);
							 $postslist = query_posts($args);
							 foreach ($postslist as $post) : 
							    setup_postdata($post);
							 ?>
							
							<li class="thumb">
								<a href="#post-<?php the_ID(); ?>" title="<?php the_title_attribute(); ?>">
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
										the_post_thumbnail(array( 50,50 ), array( 'class' => 'alignleft'));
									} else {
										images('1', '50', '50', '', false);
									} ?>
								</a>
							</li>
							
							<?php endforeach; ?>
							
						</ul>
						
					</div>
	
					<div id="zipfel"></div>
				</div><!-- end #featured -->
				
				<div id="ausgabe">
					 
					
					<!-- The Paper Loop -->
						<?php
						 $postslist = query_posts('category_name=Heftarchiv&showposts=1');
						 foreach ($postslist as $post) : 
						    setup_postdata($post);
						 ?>
					  
					  	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					  	
					  		<h3>Frische Ausgabe 
					  		<?php 
					  		foreach((get_the_category()) as $childcat) {
								if (cat_is_ancestor_of(31, $childcat)) { 
									echo $childcat->cat_name;
								}
							} ?> / <?php the_time('M y') ?></h3>
					  									
							<a class="alignleft" href="<?php $values = get_post_custom_values("Cover big"); echo $values[0]; ?>" title="Cover hastuzeit <?php the_title(); ?>">		
								<img src="<?php $values = get_post_custom_values("Cover small"); echo $values[0]; ?>" alt="Cover <?php the_title(); ?>" class="thumb" width="100" height="139" />
							</a>

							<?php 
								foreach((get_the_category()) as $childcat) {
									if (cat_is_ancestor_of(31, $childcat)) { ?>
										<h4><a class="read" href="<?php echo get_category_link($childcat->term_id);?>">Texte lesen (<?php echo $childcat->category_count;?>)</a></h4>
								<?php } } 
								
								$pdf = 'Download';
								$themeta = get_post_meta($post->ID, $pdf, TRUE);
								
								if($themeta != '') {
									echo '<h4><a href="'. $themeta .'">Download (pdf)</a></h4>';
								}
								
								?>
							
						</div>
					  
					  <?php endforeach; ?>
					  
					  <p id="nextausgabe" class="clear textfade">Die neue Ausgabe Nr. 31 erscheint am 25.01. 2010. Passend zum Jahresbeginn lautet das Schwerpunktthema diesmal &raquo;Frohe Zukunft&laquo;. Einzelne Texte werden vorab an dieser Stelle ver&ouml;ffentlicht.</p>

				</div>
				<div id="tweet">
					<h3>Gezwitscher</h3>
					<div class="follow">
						<p class="textfade"><em>&raquo;hastuzeit&laquo;</em> im Tweet verwenden, um hier zu erscheinen</p>
						<a href="http://twitter.com/hastuzeit">Folge uns</a>
						<a href="http://twitter.com/home?status=Tolle Seite: hastuzeit | Die hallesche Studierendenschaftszeitschrift http://hastuzeit.de" title="Tweet This">Twittere uns</a>
					
					</div>
				</div>
			<?php } ?>
			
			<div id="main">
				
				<!-- The Main Loop -->
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$sticky=get_option('sticky_posts');
				$args=array(
				   'category__not_in' => array(3,60),
				   'caller_get_posts'=>1,
				   'post__not_in' => $sticky,
				   'paged'=>$paged,
				   );
				
				$postslist = query_posts($args);
				
				if ( is_paged() ) { 
				if (function_exists('wp_pagenavi')) { ?>
				<div id="tabnav">
					<?php wp_pagenavi(); ?>
				</div>
				<?php } else { ?>				
					<div class="next-links">
						<div class="alignleft"><?php next_posts_link('&laquo; &Auml;ltere Artikel') ?></div>
						<div class="alignright"><?php previous_posts_link('Neuere Artikel &raquo;') ?></div>
					</div>
				<?php } }?>
				
				<?php
						 foreach ($postslist as $post) : 
						    setup_postdata($post);
				?>
				
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
						<p class="meta"><span class="date"><?php the_time('M Y') ?></span> <span class="category-link"><?php the_category(' ') ?></span> <?php edit_post_link('Bearbeiten', '', ''); ?> <span class="alignright comment-link"><?php comments_popup_link('0', '1', '%'); ?></span></p>
			
						<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Link zu <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						
						<!-- Wenn custom field unterueberschrift vorhanden, dann anzeigen -->
						<?php 
							$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
			      			if ($unterueber != "")
			          			echo "<h3 class=\"unterueber\">$unterueber</h3>";
						?>
						
						<p class="author-link">von <?php if(function_exists('coauthors_posts_links'))
						    coauthors_posts_links(", ", " <span class=\"amp\">&amp;</span> ");
						else
						    the_author_posts_link(); ?></p>
								
						<!-- Nutze exzerpt, wenn angegeben, ansonsten the_content -->
						<?php if (!empty($post->post_excerpt)) : ?>
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
								the_post_thumbnail(array( 150,150 ), array( 'class' => 'alignleft' ));
							} else {
								images('1', '150', '150', '', false);
							} ?>
							<?php the_excerpt(); ?>
							<p><a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark" title="Link zu <?php the_title(); ?>">Mehr, mehr, mehr</a></p>
						<?php else : ?>
							<?php the_content('Mehr, mehr, mehr'); ?>
						<?php endif; ?>
						
					</div>
					
				<?php endforeach; ?>
				
				<?php if (function_exists('wp_pagenavi')) { ?>
					<?php wp_pagenavi(); ?>
				<?php } else { ?>				
					<div class="next-links">
						<div class="alignleft"><?php next_posts_link('&laquo; &Auml;ltere Artikel') ?></div>
						<div class="alignright"><?php previous_posts_link('Neuere Artikel &raquo;') ?></div>
					</div>
				<?php } ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>