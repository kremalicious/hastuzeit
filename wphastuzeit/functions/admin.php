<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

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
  $contactmethods['flickr'] = 'Flickr Photostream<br /><small style="color:#666666;font-style:italic">gesamte URL inklusive http://</small>';
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