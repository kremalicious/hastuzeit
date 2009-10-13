<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */
?>
	</div><!-- end #main -->
	
	<div id="sidebar">

		<?php get_search_form(); ?>
		
		<ul id="sidebartop">
			<li class="widget" id="notizen">
				
				<h4 class="widgettitle">Notizen</h4>
				
				<ul>
					<?php
						$notizen = get_posts('showposts=5&cat=-3&category_name=Notizen');
						foreach ($notizen as $post) : 
						setup_postdata($post);
					?>
					<li>
						<h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
						<span class="date"><?php the_time('d.m. Y') ?></span>
						<a href="<?php the_permalink(); ?>"><?php images('1', '30', '30', 'alignleft', false); ?></a><?php trim_excerpt('10'); ?>
						<a class="more-link" href="<?php the_permalink(); ?>">Mehr</a>
					</li>
				
				<?php endforeach; ?>
					
					<li class="more"><h5><a class="more-link" href="/notizen" title="Alle Notizen ansehen">Alle Notizen</a></h5></li>
				
				</ul>		
			
			</li>
		</ul>
		<!--

		<h4 class="widgettitle">Partyyyy &amp; Veranstaltungen</h4>
		
		<?php if (function_exists('sidebarEventsCalendar')) { ?>
			<?php sidebarEventsCalendar();?>
		<?php } ?>
		-->
		<ul id="sidebar-left" class="column">
			
			<li class="widget">
			
				<h4 class="widgettitle">frisch getippt</h4>
				
				<ul>
					<?php
						$postslist = query_posts('showposts=10&cat=-3');
						foreach ($postslist as $post) : 
						setup_postdata($post);
					?>
					<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
				
				<?php endforeach; ?>
				
				</ul>		
			
			</li>
				 
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebarleft') ) : ?>
							
			<?php endif; ?>
			
		</ul>
				
		<ul id="sidebar-right" class="column">		
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebarright') ) : ?>
			
			<?php endif; ?>
			
		</ul>

	</div><!-- end #sidebar -->
	
</div><!-- end #content -->