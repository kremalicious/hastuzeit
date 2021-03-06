<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

require_once('functions/javascripts.php');
require_once('functions/clean-wphead.php');
require_once('functions/htaccess.php');
require_once('functions/robots.php');
require_once('functions/admin.php');


// Let there be syndication!
add_theme_support( 'automatic-feed-links' );

//2.9 Post Thumbnails
if ( function_exists( 'add_theme_support' ) )
add_theme_support('post-thumbnails');

// 3.0 Custom Background
//add_custom_background();

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name'=>'sidebarleft',
		'description' => 'Linke Spalte der Sidebar. Hier sollten zuerst die Links aus der Kategorie Freunde rein.',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name'=>'sidebarright',
		'description' => 'Rechte Spalte der Sidebar. Hier sollten zuerst die Links aus der Kategorie Favoriten rein.',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name'=>'sidebarbottom',
		'description' => 'Zweispaltiger Abschnitt der Sidebar. Hier sollten externe News &uuml;ber RSS rein.',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}

//Ping separation
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
       <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>"><?php comment_author_link() ?></li>
<?php
}

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

//Exclude Pings from comment count
function comment_count( $count ) {
        if ( ! is_admin() ) {
                global $id;
                $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
                return count($comments_by_type['comment']);
        } else {
                return $count;
        }
}
add_filter('get_comments_number', 'comment_count', 0);

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

//custom excerpt
function trim_excerpt($num) {
	$limit = $num+1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt)."...";
	echo '<p>'.$excerpt.'</p>';
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
	if(empty($theImage)){ //Defines a default image
		$theImage = '<img alt="hastuzeit icon" src="/uploads/2009/10/hastuzeit-Icon-Dimmed.png" '.$size.' />';
		echo $link.$theImage.$linkend;
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


//disable loading of some plugin styles
function my_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

//remove the more-anchor-tag
if ( !function_exists('remove_more_anchor') ) {
	function remove_more_anchor($content) {
		global $id;
		
		return str_replace('#more-' . $id . '"', '"', $content);
	}
	add_filter('the_content', 'remove_more_anchor');
}

//Custom default gravatar
function wphastuzeit_addgravatar( $avatar_defaults ) {
	$myavatar = get_stylesheet_directory_uri() . '/style/images/hastuzeit-gravatar.png';
	$avatar_defaults[$myavatar] = 'WP Hastuzeit Gravatar';
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'wphastuzeit_addgravatar' );

//Autor Info Box with Shortcode
function autorbox() {
	?>
		<h3>&Uuml;ber <?php the_author_meta('display_name'); ?></h3>
			
			<div id="authorinfo">
				
				<div id="avatar"><?php echo get_avatar( get_the_author_meta('email'), 70); ?></div>
				
				<div id="author-description"><?php the_author_meta( 'description' ); ?></div>
				
				<?php if ( get_the_author_meta( 'user_url' ) ) { ?>
					<div><span>Website:</span> <a class="url" rel="author" href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
					<div><span>Twitter:</span> <a class="url" rel="author" href="https://twitter.com/<?php the_author_meta('twitter'); ?>"><?php the_author_meta('twitter'); ?></a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'facebook' ) ) { ?>
					<div><span>Facebook:</span> <a class="url" rel="author" href="<?php the_author_meta('facebook'); ?>"><?php the_author_meta('display_name'); ?>'s Profil</a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'flickr' ) ) { ?>
					<div><span>Flickr:</span> <a class="url" rel="author" href="<?php the_author_meta('flickr'); ?>"><?php the_author_meta('display_name'); ?>'s Photostream</a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'studivz' ) ) { ?>
					<div><span>StudiVZ:</span> <a class="url" rel="author" href="<?php the_author_meta('studivz'); ?>"><?php the_author_meta('display_name'); ?>'s Profil</a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'jabber' ) ) { ?>
					<div><span>Jabber/GTalk:</span> <a class="url" href="<?php the_author_meta('jabber'); ?>"><?php the_author_meta('jabber'); ?></a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'aim' ) ) { ?>
					<div><span>AIM:</span> <a class="url" href="aim:addbuddy?screenname=<?php the_author_meta('aim'); ?>"><?php the_author_meta('aim'); ?></a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'yim' ) ) { ?>
					<div><span>Yahoo IM:</span> <a class="url" href="ymsgr:addfriend?<?php the_author_meta('yim'); ?>"><?php the_author_meta('yim'); ?></a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'icq' ) ) { ?>
					<div><span>ICQ:</span> <a class="url" href="<?php the_author_meta('icq'); ?>"><?php the_author_meta('icq'); ?></a></div>
				<?php } 
				
				if ( is_user_logged_in() ) { ?>
					<a id="profile-edit-link" href="http://hastuzeit.de/wp-admin/profile.php">F&uuml;lle dein eigenes Profil aus</a>
				<?php } ?>
			</div>
<?php
}
add_shortcode('autorinfo', 'autorbox');

//Quotes handling, yummy danish quotes
function danishquotes( $text ) {
	$char_codes = array("‘", "’", '„', '“', '&#147;', '&#148;', '&lsquo;', '&rsquo;', '&#8220;', '&#8221;', '“', '”');
	$replacements = array('&#187;', '&#171;', '&#187;', '&#171;', '&#187;', '&#171;', '&#187;', '&#171;', '&#187;', '&#171;', '&#187;', '&#171;');
	return str_replace($char_codes, $replacements, $text);
}

add_filter('comment_text', 'danishquotes', 11);
add_filter('single_post_title', 'danishquotes', 11);
add_filter('the_title', 'danishquotes', 11);
add_filter('the_content', 'danishquotes', 11);
add_filter('the_excerpt', 'danishquotes', 11);
add_filter('widget_text', 'danishquotes', 11);

//Wrap ampersands with a special class
function style_ampersands($text) {
	$amp_finder = "/(\s|&nbsp;)(&|&amp;|&\#38;|&#038;)(\s|&nbsp;)/";
    return preg_replace($amp_finder, '\\1<span class="amp">&amp;</span>\\3', $text);
}

add_filter('comment_text', 'style_ampersands', 1);
add_filter('single_post_title', 'style_ampersands', 1);
add_filter('the_title', 'style_ampersands', 1);
add_filter('the_content', 'style_ampersands', 1);
add_filter('the_excerpt', 'style_ampersands', 1);
add_filter('widget_text', 'style_ampersands', 1);


////////////////////////////////////////////////////////////////////
//// FEED STUFF ////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////

//Exclude categories from the main rss feed
function feed_exclude($query) {
	if ($query->is_feed) {
		$query->set('cat','-3');
	}

return $query;
}
add_filter('pre_get_posts','feed_exclude');

//Include some custom fields in the feed
function feed_custom_field( $content ) {

    global $post, $id;
 
    if ( !is_feed() )
        return $content;
 
    $unterueber = get_post_meta( $post->ID, 'Unterüberschrift', $single = true );
 
    // Print custom fields and Content
    if ( $unterueber != '' ) {
    	return  '<strong>' . $unterueber . '</strong> <br />' . $content;
    } else {
    	return $content;
    }
        
}
 
add_filter( 'the_content', 'feed_custom_field' );

?>