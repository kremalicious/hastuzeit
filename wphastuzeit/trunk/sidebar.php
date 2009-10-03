<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */
?>
	</div><!-- end #content -->
	
	<div id="sidebar">

		<?php get_search_form(); ?>

		<h4 class="widgettitle">Events</h4>
		
		<?php if (function_exists('sidebarEventsCalendar')) { ?>
			<?php sidebarEventsCalendar();?>
		<?php } ?>
		
		<ul id="sidebar-left" class="column">		
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebarleft') ) : ?>
							
			<?php endif; ?>
			
		</ul>
				
		<ul id="sidebar-right" class="column">		
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebarright') ) : ?>
			
			<?php endif; ?>
			
		</ul>
		
		

	</div><!-- end #sidebar -->