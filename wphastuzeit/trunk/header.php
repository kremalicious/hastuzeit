<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		
		<title>
			<?php if (is_home()) { 
			echo bloginfo('name');
			echo ' | ';
			echo bloginfo('description');
			} elseif (is_404()) {
			echo '404 Not Found';
			} elseif (is_category()) {
			echo wp_title('');
			echo ' | ';
			echo bloginfo('name');
			} elseif (is_search()) {
			echo 'Search Results';
			echo ' | ';
			echo bloginfo('name');
			} elseif ( is_day() || is_month() || is_year() ) {
			echo 'Archives:'; wp_title('');
			} else {
			echo wp_title('');
			echo ' | ';
			echo bloginfo('name');
			}
			?>
		</title>
		
		<!-- Dynamic Description stuff -->
		<meta name="description" content="<?php if (have_posts() && is_single() OR is_page()):while(have_posts()):the_post();
		$out_excerpt = str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt());
		echo apply_filters('the_excerpt_rss', $out_excerpt);
		endwhile;
		else:
		bloginfo('description'); echo ' f&uuml;r und von den Studierenden der Universit&auml;ten in Halle (Saale)';
		endif; ?>" />
		
		<!-- Dynamic Keywords stuff -->
		<?php  if( ((get_post_meta($post->ID, keywords, true) != "") && (is_single())) || ((get_post_meta($post->ID, keywords, true) != "") && (is_page())) ) { ?>
		<meta name="keywords" content="<?php echo get_post_meta($post->ID, keywords, true); ?>" />
		<?php } else { ?>
		<meta name="keywords" xml:lang="de" content="hastuzeit, uni-halle, universit&auml;t, mlu, halle, halle (saale), martin-luther-universit&auml;t " />
		<?php } ?>
		
		<!-- Block the hungry search robots on some dynamic pages -->
		<?php if(is_single() || is_page() || is_category() || is_home()) { ?>
			<meta name="robots" content="all,noodp" />
		<?php } ?>
		
		<?php if(is_archive()) { ?>
		  	<meta name="robots" content="noarchive,noodp" />
		<?php } ?>
		
		<?php if(is_search() || is_date() || is_author() || is_tag() || is_category('Heftarchiv') || is_404()) { ?>
		  	<meta name="robots" content="noindex,noarchive" />
		<?php } ?>
		
		<!-- This brings in the delicious styles -->
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style/css/typography.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style/css/layout.css" type="text/css" media="screen" />
		
		
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<!-- Favicon and Apple Touch icon -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		
		<!-- Load comment reply script just if were on the single view AND if threaded comments are enabled -->
		<?php if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
		  wp_enqueue_script( 'comment-reply' );
		?>
		
		<!-- Load Contact Form 7 stuff just on the contact page -->
		<?php if (is_page('kontakt'))
			wpcf7_enqueue_scripts();
			wpcf7_enqueue_styles();
		?>
		
		<!-- Load the WordPress included thickbox script -->
		<?php wp_enqueue_script('thickbox'); ?>
		
		<!-- And finally the usual wp_head hook -->
		<?php wp_head(); ?>

	</head>
	
	<body <?php body_class(); ?>>
		
		<!-- warning for Internet Explorer 7 and below users in order to convert them to Firefox-users ;-) -->
		
		<!--[if lt IE 8]>
			<div id="iewarning">
				
				<p>Du benutzt einen sehr alten und unsicheren Web Browser, der nicht in der Lage ist, g&auml;ngige Web Standards korrekt und sicher zu interpretieren. Bitte aktualisiere auf die <a href="http://www.microsoft.com/germany/windows/internet-explorer/" title="Internet Explorer 8">neueste Internet Explorer Version</a> oder benutze einen sicheren und standardkonformen Browser wie <a href="http://www.mozilla.com/firefox/" title="Mozilla Firefox">Firefox</a>, <a href="http://www.apple.com/safari/download/" title="Apple Safari">Safari</a>, <a href="http://www.google.com/chrome" title="Google Chrome">Chrome</a> oder <a href="http://www.opera.com/download/" title="Opera">Opera</a>, um das volle Potential dieser Seite erleben zu k&ouml;nnen.</p>
								
			</div>
			<a id="warning-toggle" href="#">^ Ist mir egal ^</a>
		<![endif]-->
		
		<!-- end Warning for Internet Explorer 7 and below users -->
		
		<div id="wrapper">
		
			<div id="header">
			
				<h1><a class="infopopup" title="Zur Startseite" href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
				<p id="description"><?php bloginfo('description'); ?></p>
				<?php include('admin-menu.php'); ?>
				<ul id="secondnav">
					<li <?php if (is_page('mediadaten')) echo 'class="current_page_item"' ?>><a href="/mediadaten" title="hastuzeit Mediadaten">Mediadaten</a></li>
					<li <?php if (is_page('kontakt')) echo 'class="current_page_item"' ?>><a href="/kontakt" title="hastuzeit kontaktieren">Kontakt/Impressum</a></li>
					<li class="statuslamp green <?php if (is_page('status')) echo 'current_page_item' ?>"><a href="/status" title="hastuzeit Status und Neuerungen">Status</a></li>
				</ul>
			</div><!-- end #header -->
			
			<ul id="navigation">
				<li id="texte" <?php if ( is_home() || is_single() || is_archive() ) echo 'class="current_page_item"' ?>><a href="<?php echo get_option('home'); ?>/" title="Texte">Texte</a>
					<ul>
						<?php wp_list_categories('child_of=6&title_li=&hide_empty=0'); ?> <?php wp_list_categories('include=38,60&title_li=&hide_empty=0'); ?>
					</ul>
				</li>
				
				<?php wp_list_pages('title_li=&exclude=83,110,1935,2086'); ?>
				
				<li class="feed facebook"><a rel="me" href="http://www.facebook.com/pages/hastuzeit/176710040046" title="Werde Fan der hastuzeit auf Facebook" class="infopopup">Facebook</a></li>
				<li class="feed twitter"><a rel="me" href="http://twitter.com/hastuzeit" title="Folge hastuzeit auf Twitter" class="infopopup">Twitter</a></li>
				<li class="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="Alle hastuzeit Texte &uuml;ber RSS abonnieren" class="infopopup">RSS</a></li>
			</ul>
			
			<div id="content">
			