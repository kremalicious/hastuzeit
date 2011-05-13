<?php
/**
 * @package WordPress
 * @subpackage hastuzeit
 */

// add to virtual robots.txt
add_action('do_robots', 'hastuzeit_robots');

function hastuzeit_robots() {
	echo "Disallow: /cgi-bin\n";
	echo "Disallow: /wp-admin\n";
	echo "Disallow: /wp-includes\n";
	echo "Disallow: /wp-content/plugins\n";
	echo "Disallow: /plugins\n";
	echo "Disallow: /wp-content/cache\n";
	echo "Disallow: /wp-content/themes\n";
	echo "Disallow: /trackback\n";
	echo "Disallow: /feed\n";
	echo "Disallow: /comments\n";
	echo "Disallow: /category/*/*\n";
	echo "Disallow: */trackback\n";
	echo "Disallow: */feed\n";
	echo "Disallow: */comments\n";
	echo "Disallow: /*?*\n";
	echo "Disallow: /*?\n";
	echo "Disallow: /teaser\n";
	echo "Disallow: /allgemein\n";
	echo "Disallow: /kolumne\n";
	echo "Disallow: /pinnwand\n";
	echo "Disallow: /author\n";
	echo "Disallow: /rubrik\n";
	echo "Disallow: /rubrik/*/*\n";
	echo "Disallow: /status\n";
	echo "Disallow: /errors\n";
	echo "Disallow: /next\n";
	echo "Disallow: /git\n";
	echo "Disallow: /*.css$\n";
	echo "Disallow: /*.js$\n";
	echo "Disallow: /*.ico$\n";
	echo "Disallow: /*.opml$\n";
	echo "Allow: /hefte\n";
}

?>