<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

get_header();
?>
	
	<div id="main">
	
		<h1 class="pagetitle">404 - Irgendwas ging schief!</h1>
		
		<img class="alignleft" src="<?php bloginfo('template_url') ?>/style/images/failtoycat.jpg" alt="failtoycat" width="250" height="181"/>
		
		<p>Sorry, aber irgendetwas ging schief. Du hast einen 404 Fehler produziert und mit an Sicherheit grenzender Wahrscheinlichkeit wird dein Computer in ca. 3 Sekunden explodieren.</p>
		
		<p>Aber im Ernst: Hast du die Adresse korrekt eingegeben?</p>
		
		<h3 class="clear">Suche probieren?</h3>
		<?php get_search_form(); ?>
		
		<h3>Letzte Beitr&auml;ge</h3>
			
			<p>Oder du wirfst einen Blick auf unsere letzten Artikel</p>

				<ul>
					<?php query_posts('showposts=10');
					if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title();?> </a></li>
					<?php endwhile; ?><?php endif; ?>
				</ul>

<?php get_sidebar(); ?>
<?php get_footer(); ?>