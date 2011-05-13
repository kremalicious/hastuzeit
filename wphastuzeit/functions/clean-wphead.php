<?php 

// cleanup wp_head
function hastuzeit_head_cleanup() {
	// http://wpengineer.com/1438/wordpress-header/
	//remove_action('wp_head', 'feed_links', 2);
	//remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	
	remove_action('wp_head', 'rel_canonical');	
		function hastuzeit_rel_canonical() {
		if (!is_singular())
			return;
		global $wp_the_query;
		if (!$id = $wp_the_query->get_queried_object_id())
			return;
		$link = get_permalink($id);
		echo "<link rel=\"canonical\" href=\"$link\">\n";
	}
	add_action('wp_head', 'hastuzeit_rel_canonical');	
	
	// remove CSS from recent comments widget
	function hastuzeit_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
	
	add_action('wp_head', 'hastuzeit_recent_comments_style', 1);
}

add_action('init', 'hastuzeit_head_cleanup');	

// remove WordPress version from RSS feed
function hastuzeit_no_generator() { return ''; }
add_filter('the_generator', 'hastuzeit_no_generator');