<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */
?>

			<br class="dirtyLittleTrick" />
		
		</div><!-- end #wrapper -->
		
		<div id="footer">
		
			<ul>
				<li><a href="<?php echo get_option('home'); ?>/" title="">Texte</a></li>
				<?php wp_list_pages('title_li='); ?>
			
			</ul>
		
			<div id="copyright">
				<p>&copy; <?php 
							$year=date("Y");
							echo "2005 - $year";							
							?> <a href="<?php echo get_option('home'); ?>/">hastuzeit</a> - Alle Rechte vorbehalten</p>
				<p>design.icon.code.vooodo.<a href="http://matthiaskretschmann.com" title="Matthias Kretschmann" rel="friend">matthias.kretschmann</a></p>
				<p><a class="valid" href="http://validator.w3.org/check?uri=referer" title="Valid XHTML 1.0">xhtml 1.0</a></p>
			</div>
		
		</div><!-- end #footer -->

		
		<!-- All the funky scripts -->
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/style/js/plugins.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/style/js/effects.js"></script>

		<?php wp_footer(); ?>
		
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-10899823-1");
		pageTracker._trackPageview();
		} catch(err) {}</script>

	</body>

<!--
   Design, Icons and Front-End Development by Matthias Kretschmann | http://matthiaskretschmann.com
-->
</html>