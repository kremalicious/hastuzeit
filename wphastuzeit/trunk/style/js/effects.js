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
    
    //Search term highlighting init
	if(typeof(hls_query) != 'undefined'){
      $('#content').highlight(hls_query, 1, 'hls');
    }
    
    //Open pdf links and external links in new window
    $('a[href*=.pdf], a.external').click(function(){
		window.open(this.href);
	return false;
	});
	

}); //don't delete me or the DOM will collaps

//Finally load all this after the content has loaded
$(window).load(function() {
	
	//qTip
	$('#content .hentry a[title]').qtip({
		show: {
      		delay: 20,
      		effect: {
      			type: 'slide', 
      			length: 100 } 
      	},
		position: {
      		corner: { 
      			target: 'bottomMiddle', 
      			tooltip: 'topLeft'
      		}
      	},
      	style: {
      		color: '#666',
      		lineHeight: '1.2em',
      		fontFamily: '"Trebuchet MS", "Lucida Grande", Lucida, Verdana, sans-serif',
      		maxWidth: 200,
      		background: 'transparent',
		    tip: { // Now an object instead of a string
	        	corner: 'topLeft', // We declare our corner within the object using the corner sub-option
	        	color: '#ccc'
	        },
		    border: {
	        	width: 1,
	        	color: '#ccc'
	      	},
	      
		}
	});

	scrolltotop.init();
	
});