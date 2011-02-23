<?php
/*
Template Name: Heftarchiv
*/
?>

<?php get_header(); ?>
			
			<div id="main">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<h1 class="pagetitle"><?php the_title(); ?></h1>
				
				<?php edit_post_link('Bearbeiten', '<p>', '</p>'); ?>
				
				<?php the_content(); ?>
					  
				<?php endwhile; endif; ?>
				
				<h2 class="accordionButton">2011</h2>
				
				<div class="accordionContent">
				
					<!-- Hefte 2011 Loop -->
					<?php
						$postslist = query_posts('category_name=Heftarchiv&showposts=-1&year=2011');
					 	foreach ($postslist as $post) : 
					    setup_postdata($post);
					?>
					
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
							<h3><?php the_title(); ?></h3>
							
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
				
				</div>
								
				<h2 class="accordionButton">2010</h2>
				
				<div class="accordionContent">
				
					<!-- Hefte 2010 Loop -->
					<?php
						$postslist = query_posts('category_name=Heftarchiv&showposts=-1&year=2010');
					 	foreach ($postslist as $post) : 
					    setup_postdata($post);
					?>
					
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
							<h3><?php the_title(); ?></h3>
							
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
				
				</div>
				
				
				<h2 class="accordionButton">2009</h2>
				
				<div class="accordionContent">
				
					<!-- Hefte 2009 Loop -->
					<?php
						$postslist = query_posts('category_name=Heftarchiv&showposts=-1&year=2009');
					 	foreach ($postslist as $post) : 
					    setup_postdata($post);
					?>
					
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
							<h3><?php the_title(); ?></h3>
							
							<a class="alignleft" href="<?php $values = get_post_custom_values("Cover big"); echo $values[0]; ?>" title="Cover hastuzeit <?php the_title(); ?>">		
								<img src="<?php $values = get_post_custom_values("Cover small"); echo $values[0]; ?>" alt="Cover <?php the_title(); ?>" class="thumb" width="100" height="139" />
							</a>

							<?php 
								foreach((get_the_category()) as $childcat) {
									if (cat_is_ancestor_of(31, $childcat)) { ?>
										<h4><a class="read" href="<?php echo get_category_link($childcat->term_id);?>">Texte lesen (<?php echo $childcat->category_count;?>)</a></h4>
								<?php } } ?>
							
							<h4><a href="<?php $values = get_post_custom_values("Download"); echo $values[0]; ?>">Download (pdf)</a></h4>
						</div>
						
					<?php endforeach; ?>
				
				</div>
				
				<h2 class="accordionButton">2008</h2>
				
				<div class="accordionContent">
				
					<!-- Hefte 2008 Loop -->
					<?php
					 $postslist = query_posts('category_name=Heftarchiv&showposts=-1&year=2008');
					 foreach ($postslist as $post) : 
					    setup_postdata($post);
					?>
					
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
							<h3><?php the_title(); ?></h3>
										
							<a class="alignleft" href="<?php $values = get_post_custom_values("Cover big"); echo $values[0]; ?>" title="Cover hastuzeit <?php the_title(); ?>">		
								<img src="<?php $values = get_post_custom_values("Cover small"); echo $values[0]; ?>" alt="Cover <?php the_title(); ?>" class="thumb" width="100" height="139" />
							</a>
							
							<?php 
								foreach((get_the_category()) as $childcat) {
									if (cat_is_ancestor_of(31, $childcat)) { ?>
										<h4><a class="read" href="<?php echo get_category_link($childcat->term_id);?>">Texte lesen (<?php echo $childcat->category_count;?>)</a></h4>
								<?php } } ?>
							
							<h4><a href="<?php $values = get_post_custom_values("Download"); echo $values[0]; ?>">Download (pdf)</a></h4>
							
						</div>
						
					<?php endforeach; ?>
				
				</div>
				
				<h2 class="accordionButton">2007</h2>
				
				<div class="accordionContent">
				
					<!-- Hefte 2007 Loop -->
					<?php
					 $postslist = query_posts('category_name=Heftarchiv&showposts=-1&year=2007');
					 foreach ($postslist as $post) : 
					    setup_postdata($post);
					?>
					
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
							<h3><?php the_title(); ?></h3>
										
							<a class="alignleft" href="<?php $values = get_post_custom_values("Cover big"); echo $values[0]; ?>" title="Cover hastuzeit <?php the_title(); ?>">		
								<img src="<?php $values = get_post_custom_values("Cover small"); echo $values[0]; ?>" alt="Cover <?php the_title(); ?>" class="thumb" width="100" height="139" />
							</a>
							
							<?php 
								foreach((get_the_category()) as $childcat) {
									if (cat_is_ancestor_of(31, $childcat)) { ?>
										<h4><a class="read" href="<?php echo get_category_link($childcat->term_id);?>">Texte lesen (<?php echo $childcat->category_count;?>)</a></h4>
								<?php } } ?>
								
							<h4><a href="<?php $values = get_post_custom_values("Download"); echo $values[0]; ?>">Download (pdf)</a></h4>

						</div>
						
					<?php endforeach; ?>
					
				</div>
				
				<h2 class="accordionButton">2006</h2>
				
				<div class="accordionContent">
				
					<!-- Hefte 2006 Loop -->
					<?php
					 $postslist = query_posts('category_name=Heftarchiv&showposts=-1&year=2006');
					 foreach ($postslist as $post) : 
					    setup_postdata($post);
					?>
					
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
							<h3><?php the_title(); ?></h3>
										
							<a class="alignleft" href="<?php $values = get_post_custom_values("Cover big"); echo $values[0]; ?>" title="Cover hastuzeit <?php the_title(); ?>">		
								<img src="<?php $values = get_post_custom_values("Cover small"); echo $values[0]; ?>" alt="Cover <?php the_title(); ?>" class="thumb" width="100" height="139" />
							</a>
							
							<?php 
								foreach((get_the_category()) as $childcat) {
									if (cat_is_ancestor_of(31, $childcat)) { ?>
										<h4><a class="read" href="<?php echo get_category_link($childcat->term_id);?>">Texte lesen (<?php echo $childcat->category_count;?>)</a></h4>
								<?php } } ?>
							
							<h4><a href="<?php $values = get_post_custom_values("Download"); echo $values[0]; ?>">Download (pdf)</a></h4>
							
						</div>
						
					<?php endforeach; ?>
					
				</div>
				
				<h2 class="accordionButton">2005</h2>
				
				<div class="accordionContent">
				
					<!-- Hefte 2005 Loop -->
					<?php
					 $postslist = query_posts('category_name=Heftarchiv&showposts=-1&year=2005');
					 foreach ($postslist as $post) : 
					    setup_postdata($post);
					?>
					
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
							<h3><?php the_title(); ?></h3>
										
							<a class="alignleft" href="<?php $values = get_post_custom_values("Cover big"); echo $values[0]; ?>" title="Cover hastuzeit <?php the_title(); ?>">		
								<img src="<?php $values = get_post_custom_values("Cover small"); echo $values[0]; ?>" alt="Cover <?php the_title(); ?>" class="thumb" width="100" height="139" />
							</a>
							
							<?php 
								foreach((get_the_category()) as $childcat) {
									if (cat_is_ancestor_of(31, $childcat)) { ?>
										<h4><a class="read" href="<?php echo get_category_link($childcat->term_id);?>">Texte lesen (<?php echo $childcat->category_count;?>)</a></h4>
								<?php } } ?>
							
							<h4><a href="<?php $values = get_post_custom_values("Download"); echo $values[0]; ?>">Download (pdf)</a></h4>
							
						</div>
						
					<?php endforeach; ?>
					
				</div>
				
				<h3 id="readiculum">READiculum (2002-2005)</h3>
				<p>Alle &auml;lteren Ausgaben aus der Vorg&auml;ngerin der hastuzeit, READiculum, findet ihr <a href="http://hastuzeit.de/readiculum/seiten/archiv.htm" title="Heftarchiv READiculum">im Archiv</a> auf der <a href="http://hastuzeit.de/readiculum/" title="READiculum">konservierten Website der READiculum</a>.</p>
				
				<p><a href="http://hastuzeit.de/readiculum/" title="READiculum"><img class="aligncenter" id="readiculum-bild" src="http://hastuzeit.de/uploads/2009/12/readiculum-banner.png" alt="readiculum-banner" width="570" height="58"/></a></p>
				
				<p>Die <a href="http://hastuzeit.de/readiculum/" title="READiculum">READiculum</a> war von 2002 bis Januar 2005 die erste hallische Studierendenschaftszeitung und wurde 2005 von der <a href="http://hastuzeit.de/" title="hastuzeit">hastuzeit</a> abgel&ouml;st.</p>
				
<?php get_sidebar(); ?>
<?php get_footer(); ?>