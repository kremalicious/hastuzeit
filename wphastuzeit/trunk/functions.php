<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

automatic_feed_links();

//2.9 Post Thumbnails
if ( function_exists( 'add_theme_support' ) )
add_theme_support('post-thumbnails');

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name'=>'sidebarleft',
		'description' => 'Obere linke Spalte der Sidebar. Zuerst sollte hier immer zuerst das Popular Posts Widget mit dem Titel &quot;beliebte beitr&auml;ge&quot; eingestellt werden.',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name'=>'sidebarright',
		'description' => 'Obere rechte Spalte der Sidebar. Hier sollte immer zuerst das Letzte Kommentare Widget mit dem Titel &quot;frisch angemerkt&quot; eingestellt werden.',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name'=>'sidebarbottom',
		'description' => 'Unterer zweispaltiger Abschnitt der Sidebar. Zuerst wird immer die Pinnwand und die N&auml;chsten Termine angezeigt, die hier nicht aufgef&uuml;hrt und auch nicht ver&auml;nderbar sind.',
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
	echo $excerpt;
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
		$theImage = '<img src="/uploads/2009/10/hastuzeit-Icon-Dimmed.png" '.$size.' />';
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
				
				<div id="description"><?php the_author_meta( 'description' ); ?></div>
				
				<?php if ( get_the_author_meta( 'user_url' ) ) { ?>
					<div><span>Website:</span> <a class="url" rel="author" href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('user_url'); ?></a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
					<div><span>Twitter:</span> <a class="url" rel="author" href="https://twitter.com/<?php the_author_meta('twitter'); ?>"><?php the_author_meta('twitter'); ?></a></div>
				<?php } ?>
				
				<?php if ( get_the_author_meta( 'facebook' ) ) { ?>
					<div><span>Facebook:</span> <a class="url" rel="author" href="<?php the_author_meta('facebook'); ?>"><?php the_author_meta('display_name'); ?>'s Profil</a></div>
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

//Quotes handling, yummy french quotes
function frenchquotes( $text ) {
	$char_codes = array("‘", "’", "“", "”", '„', '“', '&#8216;', '&#8217;', '&#8220;', '&#8221;', '&#8242;', '&#8243;');
	$replacements = array('&#187;', '&#171;', '&#187;', '&#171;', '&#187;', '&#171;', '&#187;', '&#171;', '&#187;', '&#171;', '&#187;', '&#171;');
	return str_replace($char_codes, $replacements, $text);
}

add_filter('comment_text', 'frenchquotes', 11);
add_filter('single_post_title', 'frenchquotes', 11);
add_filter('the_title', 'frenchquotes', 11);
add_filter('the_content', 'frenchquotes', 11);
add_filter('the_excerpt', 'frenchquotes', 11);
add_filter('widget_text', 'frenchquotes', 11);


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
    	return  '<strong>' . $unterueber . '</strong><br />' . $content;
    } else {
    	return $content;
    }
        
}
 
add_filter( 'the_content', 'feed_custom_field' );


////////////////////////////////////////////////////////////////////
//// ADMIN AREA STUFF //////////////////////////////////////////////
////////////////////////////////////////////////////////////////////

//Custom Login Screen CSS
function custom_login() { 
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/style/css/login.css" />';
}
add_action('login_head', 'custom_login');

//Custom Admin Area CSS
function hastuzeit_admin() {
   echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/style/css/admin.css" />';
}
add_action('admin_head', 'hastuzeit_admin');

//change admin footer text
function footer_text() {
  return '<a href="http://hastuzeit.de">hastuzeit.de</a> basiert auf <a href="http://wordpress.org">WordPress</a> und den Voodoo-F&auml;higkeiten von <a href="http://matthiaskretschmann.com">Matthias</a> | <a href="mailto:redaktion@hastuzeit.de">Mail an Redaktion</a> | hastuzeit auf <a href="https://twitter.com/hastuzeit" title="hastuzeit auf twitter">Twitter</a>, <a href="http://www.facebook.com/hastuzeit" title="Werde Fan auf Facebook">Facebook</a>';
}
add_filter('admin_footer_text', 'footer_text');

//More Contact Methods
function hastuzeit_new_contactmethods( $contactmethods ) {
  $contactmethods['twitter'] = 'Twitter Username';
  $contactmethods['facebook'] = 'Facebook Profil<br /><small style="color:#666666;font-style:italic">gesamte URL inklusive http://</small>';
  $contactmethods['studivz'] = 'StudiVZ Profil<br /><small style="color:#666666;font-style:italic">gesamte URL inklusive http://</small>';
  $contactmethods['icq'] = 'ICQ';
  
  return $contactmethods;
}
add_filter('user_contactmethods','hastuzeit_new_contactmethods',10,1);

//remove some dashboard widgets
function remove_dashboard_widgets() {
 	global $wp_meta_boxes;

	// Remove the incoming links widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	//Remove the News stuff
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

// Hoook into the 'wp_dashboard_setup' action to register our function
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

//Disable upgrade notice
if ( !current_user_can( 'edit_users' ) ) {
  add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
  add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

/*
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
*/

?>