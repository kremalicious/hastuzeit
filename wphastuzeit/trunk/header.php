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
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<!-- Favicon and Apple Touch icon -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		
		<?php
		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
		  wp_enqueue_script( 'comment-reply' );
		?>
		<?php wp_enqueue_script('thickbox'); ?>
		<?php wp_head(); ?>

	</head>
	
	<body <?php body_class(); ?>>
		
		<div id="wrapper">
			<div id="beta"></div>
		
			<div id="header">
			
				<h1><a title="Zur Startseite" href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
				<p id="description"><?php bloginfo('description'); ?></p>
				<?php include('admin-menu.php'); ?>
			</div><!-- end #header -->
			
			<ul id="navigation">
				<li id="texte" <?php if ( is_home() || is_single() || is_archive() ) echo 'class="current_page_item"' ?>><a href="<?php echo get_option('home'); ?>/" title="Texte">Texte</a>
					<ul>
						<?php wp_list_categories('child_of=6&title_li=&hide_empty=0'); ?> <?php wp_list_categories('include=38&title_li=&hide_empty=0'); ?>
					</ul>
				</li>
				<?php wp_list_pages('title_li=&exclude=83,110'); ?>
				<li class="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="hastuzeit Texte &uuml;ber RSS abonnieren">RSS</a></li>
			</ul>
			
			<div id="content">
			