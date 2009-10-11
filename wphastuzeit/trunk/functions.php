<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

automatic_feed_links();

if ( function_exists('register_sidebar') ) {
	register_sidebar(array('name'=>'sidebarleft',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array('name'=>'sidebarright',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}

//replace default jQuery script
if( !is_admin()){
   wp_deregister_script('jquery'); 
   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"), false, '1.3'); 
   wp_enqueue_script('jquery');
}

//remove the Wordpress version from the code
remove_action('wp_head', 'wp_generator');

// No self-pings
if ( !function_exists('noself_ping') ) {
	function noself_ping(&$links) {
		$home = get_option('home');
		foreach($links as $l => $link)
			if ( 0 === strpos($link, $home) )
				unset($links[$l]);
	}
	add_action( 'pre_ping', 'noself_ping' );
}

//special the_category so we can exclude some categories
function the_category_exclude($separator=', ',$exclude='') {
	$toexclude = explode(",", $exclude);
	$newlist = array();
	foreach((get_the_category()) as $category) {
		if(!in_array($category->category_nicename,$toexclude)){
			//$newlist[] = $category->cat_name;
			$newlist[] = '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>'  . $category->name.'</a>';
		}
	}
	return implode($separator,$newlist);
}

//Use first images of posts as thumbnails
function images($num = 1, $width = null, $height = null, $class = '', $displayLink = true) {
	global $more;
	$more = 1;
	if($width) { $size = ' width="'.$width.'px"'; }
	if($height) { $size .= ' height="'.$height.'px"'; }
	if($class) { $class = ' class="'.$class.'"'; }
	if($displayLink != false) { $link = '<a href="'.get_permalink().'">'; $linkend = '</a>'; }
	$content = get_the_content();
	$count = substr_count($content, '<img');
	$start = 0;
	for($i=1;$i<=$count;$i++) {
		$imgBeg = strpos($content, '<img', $start);
		$post = substr($content, $imgBeg);
		$imgEnd = strpos($post, '>');
		$postOutput = substr($post, 0, $imgEnd+1);
		$replace = array('/width="[^"]*" /','/height="[^"]*" /','/class="alignleft" /');
		$postOutput = preg_replace($replace, '',$postOutput);
		$image[$i] = $postOutput;
		$start=$imgBeg+$imgEnd+1;
	}
	if($num == 'all') {
		$x = count($image);
		for($i = 1;$i<=$x; $i++) {
			if(stristr($image[$i],'<img')) { 
			$theImage = str_replace('<img', '<img'.$size.$class, $image[$i]);
			echo $link.$theImage.$linkend;	
			}
		}
	} else {
		if(stristr($image[$num],'<img')) { 
			$theImage = str_replace('<img', '<img'.$size.$class, $image[$num]);
			echo $link.$theImage.$linkend;
		}
	}
	$more = 0;
}

//Highlight search terms
function hls_set_query() { 
	$query = attribute_escape(get_search_query());
	
	if(strlen($query) > 0){ 
		echo ' <script type="text/javascript"> var hls_query = "'.$query.'"; </script> ';
	} 
} 
add_action('wp_print_scripts', 'hls_set_query');

//custom login screen with js too
function custom_login() { 
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/style/css/login.css" />';
}
add_action('login_head', 'custom_login');

//Exclude categories from the main rss feed
function feed_exclude($query) {
	if ($query->is_feed) {
		$query->set('cat','-3');
	}

return $query;
}

add_filter('pre_get_posts','feed_exclude');

//custom excerpt
function trim_excerpt($num) {
	$limit = $num+1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt)."...";
	echo $excerpt;
}

//header color
define('HEADER_TEXTCOLOR', 'CC3399');
function header_style() {
	?>
	<style type="text/css">
	#header{
		background-color: #<?php header_textcolor();?>;
	}
	</style>
	<?php
}

function admin_header_style() {
	?>
	<style type="text/css">
	#header {
		background-color: #<?php header_textcolor();?>;
	}
	</style>
	<?php
}

if ( function_exists('add_custom_image_header') ) {
	add_custom_image_header('header_style', 'admin_header_style');
}

?>