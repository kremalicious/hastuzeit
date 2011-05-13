<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

function jquery_from_google_ajax_libs() {
	if(!is_admin()):
  	wp_deregister_script( 'jquery' );
  	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js', null, '1.6');
  endif;
}
add_filter('init','jquery_from_google_ajax_libs');

function add_jquery_backup_and_no_conflict() { ?>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php bloginfo('template_directory'); ?>/style/js/libs/jquery-1.6.1.min.js"%3E%3C/script%3E'))</script>
<script>jQuery.noConflict();</script>
<?php }
add_filter('wp_head', 'add_jquery_backup_and_no_conflict', 9);


function add_AwesomeEffects() { 
?>
    <script src="<?php bloginfo('template_directory');?>/style/js/scripts.js"></script>
<?php

}
add_filter('wp_footer','add_AwesomeEffects');