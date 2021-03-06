<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */
?>
	</div><!-- end #main -->
	
	<div id="sidebar">

		<?php get_search_form(); ?>
		
		<div id="tabs" class="widget">
					
			<ul class="tabNavigation widgettitle">
				<li><a class="current" rel="frisch" href="#">frisch</a></li>
				<li><a href="#" rel="beliebt">beliebt</a></li>
				<li><a id="linkComments" rel="latestcomments" href="#">kommentiert</a></li>
			</ul>
			
			<div id="list-wrap">
			
				<div id="frisch" class="current">
					<ul>
						<?php
							$postslist = query_posts('showposts=10&cat=-3&caller_get_posts=1');
							
							foreach ($postslist as $post) : 
							setup_postdata($post);
							$unterueber = get_post_meta($post->ID, "Unterüberschrift", true);
						?>
						<li>
							<h4>
								<a class="infopopup" href="<?php the_permalink(); ?>" title="<?php if ($unterueber != "") echo $unterueber ?> || <?php the_time('j. F Y'); ?>">	
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
										the_post_thumbnail(array( 25,25 ), array( 'class' => 'alignleft'));
									} else {
										images('1', '25', '25', '', false);
									} ?>
									<?php the_title(); ?>
								</a>
							</h4>
							<?php edit_post_link('Bearbeiten', '', ''); ?>
						</li>
					
					<?php endforeach; ?>
					
					</ul>
				</div>
				
				<div id="beliebt" class="popular-posts">
					<?php if (function_exists('get_mostpopular')) get_mostpopular('range=all&order_by=views&limit=10&stats_comments=0&stats_views=0&pages=0'); ?>
				</div>
				
				<div id="latestcomments">
					<?php the_widget('WP_Widget_Recent_Comments', 'title=&number=7'); ?> 
				</div>
			
			</div>
		
		</div>
		
		<ul id="sidebarbottom">
			<li class="widget" id="pinnwand">
				
				<h4 class="widgettitle">Pinnwand</h4>
				
				<ul>
					<?php
						$pinnwand = get_posts('showposts=5&cat=-3&category_name=Pinnwand');
						foreach ($pinnwand as $post) : 
						setup_postdata($post);
					?>
					<li>
						<h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
						<span class="date"><?php the_time('d.m. Y') ?></span>
						<?php trim_excerpt('10'); ?>
						<a class="more-link" href="<?php the_permalink(); ?>">Mehr</a>
						<?php edit_post_link('Bearbeiten', '', ''); ?>
					</li>
				
				<?php endforeach; ?>
					
					<li class="more">
						<h5><a class="more-link" href="/pinnwand" title="Pinnwand ansehen">Die ganze Pinnwand</a></h5>
					</li>
				
				</ul>		
			
			</li>
			
			<li class="widget" id="termine">
				
				<h4 class="widgettitle">N&auml;chste Termine</h4>
				
				<ul>
					<li>
					<?php if (function_exists('ec3_get_events')) {
						ec3_get_events(
						   5,
						   '<a href="%LINK%">%TITLE% (%TIME%)</a>',
						   '%DATE%:',
						   'j. F'
						);
					}
					?></li>
					<li class="more">
						<!-- Just for Contributors and above -->
			            <?php if ( current_user_can('level_1') ) : ?>
			            	<h5><a class="more-link new-post" href="<?php echo get_option('home'); ?>/wp-admin/post-new.php">Neuen Termin anlegen</a></h5>     
			            <?php endif ?>
						<h5><a class="more-link" href="/termine/" title="Termine einsehen">Alle Termine <span class="amp">&amp;</span> Kalender</a></h5>
						<h5><a class="more-link ical infopopup" href="webcal://hastuzeit.de/?ec3_ical" title="Alle Termine als Webcal-Kalender abonnieren (f&uuml;r Import in iCal, Sunbird, Google Calendar etc.) Neue Termine erscheinen dann bequem und automagisch in eurem Kalender">Termine abonnieren</a></h5>
					</li>
				</ul>
			</li>
			</ul>
			
			<ul id="sidebar-left" class="column">
				 
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebarleft') ) : ?>
								
				<?php endif; ?>
				
			</ul>
					
			<ul id="sidebar-right" class="column">		
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebarright') ) : ?>
				
				<?php endif; ?>
				
			</ul>
			
			<ul class="twoColumn">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebarbottom') ) : ?>
							
			<?php endif; ?>
			</ul>

	</div><!-- end #sidebar -->
	
</div><!-- end #content -->