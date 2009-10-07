/*
 * main JS Document for hastuzeit.de
 * Copyright (c) 2009 Matthias Kretschmann | krema@jpberlin.de
 * http://matthiaskretschmann.com
 * http://kremalicious.com
 */
	
//On with the real fun
$(function () { //DOMdiDOM

	label2value();
	
	//AJAX Live Search
    $('#s').liveSearch({url: '/index.php?ajax=1&s='});
    
    //Open pdf links and external links in new window
    $('a[href*=.pdf], a.external').click(function(){
		window.open(this.href);
	return false;
	});

}); //don't delete me or the DOM will collaps

//Finally load all this after the content has loaded
// $(window).load(function() {
	
// });