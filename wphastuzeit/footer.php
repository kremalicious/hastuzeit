<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */
?>

			<br class="dirtyLittleTrick" />
		
		</div><!-- end #wrapper -->
		
		<div id="footer">
		
			<ul id="footernav">
				<li><a href="<?php echo get_option('home'); ?>/" title="">Texte</a></li>
				<?php wp_list_pages('title_li='); ?>
			</ul>
			
			
		
			<div id="copyright">
				
				<ul id="elsewhere">
					<li><a class="hastuzeit" title="hastuzeit Website" href="http://hastuzeit.de">hastuzeit.de</a></li>
					<li><a class="rss" title="hastuzeit RSS-Feed" href="http://hastuzeit.de/feed/">RSS</a></li>
					<li><a class="twitter" title="hastuzeit auf Twitter" href="http://twitter.com/hastuzeit">Twitter</a></li>
					<li><a class="facebook" title="hastuzeit auf Facebook" href="http://www.facebook.com/pages/hastuzeit/176710040046">Facebook</a></li>
				</ul>
			
				<p class="clear">&copy; <?php 
							$year=date("Y");
							echo "2005 - $year";							
							?> <a href="<?php echo get_option('home'); ?>/">hastuzeit</a> - Alle Rechte vorbehalten</p>
				<p>design.icon.code.voodoo.<a href="http://matthiaskretschmann.com" title="Matthias Kretschmann" rel="friend">matthias.kretschmann</a></p>
				<p><a class="valid" href="http://validator.w3.org/check?uri=referer" title="Valid XHTML 1.0">xhtml 1.0</a> | Wir &hearts; <a href="http://wordpress.org" title="WordPress" rel="friend">WordPress</a></p>
			</div>
		
		</div><!-- end #footer -->

		
		<!-- All the funky scripts -->
		
		<?php if ( is_home() ) { ?>
			<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/style/js/jquery.tweet.min.js"></script>
		<?php } ?>
		
		<?php wp_footer(); ?>

	</body>

<!--
   Design, Icons and Front-End Development by Matthias Kretschmann | http://matthiaskretschmann.com
-->
</html>