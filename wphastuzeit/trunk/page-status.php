<?php
/*
Template Name: Status
*/
?>

<?php get_header(); ?>
			
			<div id="main">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<h1 class="pagetitle"><?php the_title(); ?></h1>
				
				<p>Status und Neuerungen auf der hastuzeit-Website. Der Status ist für alle sichtbar, die Neuerungen k&ouml;nnen nur von angemeldeten Benutzern eingesehen werden.</p>

				<h3>Aktueller Status</h3>

				<p class="status"><span class="green"></span>Prinzipiell alles toll. Featured-Slider auf der Startseite macht im Firefox unter Windows ein paar Probleme.</p>
				
				<p><a href="/kontakt" title="hastuzeit kontaktieren">Fehler gefunden? Dann schreib uns und wir werden uns so schnell wie m&ouml;glich darum k&uuml;mmern.</a></p>
								
				<h3>Neues tolles Zeugs</h3>
				
				<img class="aligncenter" src="http://hastuzeit.de/uploads/2009/12/awesome.png" width="448" height="79" alt="Awesome" />
				
				<?php if ( is_user_logged_in() ) { ?>
				
					<?php the_content(); ?>
					
					<?php edit_post_link('Bearbeiten', '<p>', '</p>'); ?>
			
				<?php } else { ?>
					
					<div class="infobox">
					
						<h4>Nicht f&uuml;r deine Augen</h4>
				
						<p>Du musst angemeldet sein, um in den Genuss dieser Seite zu kommen.</p>
											
						<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post" id="contentform">
					
						    <p><label for="log">Benutzername</label><input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" /> </p>
						
						    <p><label for="pwd">Passwort</label><input type="password" name="pwd" id="pwd" size="20" /></p>
							<p>
						       	<input type="submit" name="submit" class="submit" value="Login" />
						    </p>
						
						    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
							<p class="clear"><a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Passwort vergessen?</a></p>
						</form>
					
					</div>
				
				<?php }	?>	  
				
				<?php endwhile; endif; ?>
								
<?php get_sidebar(); ?>
<?php get_footer(); ?>