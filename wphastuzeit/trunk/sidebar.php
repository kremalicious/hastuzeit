<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */
?>
	</div><!-- end #main -->
	
	<div id="sidebar">

		<?php get_search_form(); ?>
			
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