<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */
?>

			<br class="dirtyLittleTrick" />
		
		</div><!-- end #wrapper -->
		
		<div id="footer">
		
			<div id="column1" class="column">
				<ul id="navigation-footer">
					<li>Artikel</li>
					<li>Podcast</li>
					<li>Heftarchiv</li>
					<li>Redaktion</li>
					<li>Mediadaten</li>
				</ul>
			</div>
			
			<div id="column2" class="column">
			
			</div>
			
			<div id="column3" class="column">
			
			</div>
			
			<div id="column4" class="column">
			
			</div>

		</div><!-- end #footer -->
		
		<div id="copyright">
			<p>&copy; <?php 
						$year=date("Y");
						echo "2009 - $year";							
						?> hastuzeit - Alle Rechte vorbehalten</p>
			<p>design.icon.code.vooodo.<a href="http://matthiaskretschmann.com" title="Matthias Kretschmann" rel="friend">matthias.kretschmann</a></p>
			<p><a class="valid" href="http://validator.w3.org/check?uri=referer" title="Valid XHTML 1.0">xhtml 1.0</a></p>
		</div>

		
		<!-- All the funky scripts -->
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/style/js/plugins.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/style/js/effects.js"></script>

		<?php wp_footer(); ?>

	</body>

<!--
   Design, Icons and Front-End Development by Matthias Kretschmann | http://matthiaskretschmann.com
-->
</html>