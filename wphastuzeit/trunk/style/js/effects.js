/*
 * main JS Document for hastuzeit.de
 * Copyright (c) 2009 Matthias Kretschmann | krema@jpberlin.de
 * http://matthiaskretschmann.com
 * http://kremalicious.com
 */
	
//On with the real fun
$(function () { //DOMdiDOM
	
	//initiate the label replacement
	label2value();
	
	//AJAX Live Search
    $('#s').liveSearch({url: '/index.php?ajax=1&s='});
    
    //Laaacyyyy content images
    $('#main img').lazyload({ 
    	placeholder : '/wp-content/themes/wphastuzeit/style/images/lazyload-grey.png',
    	effect 		: 'fadeIn' 
	});

    
    //The Featured Slider, omnomnom
    if ( $("#featured").length > 0 ) {
	    var $panels = $('#featured .scrollContainer .panel');
		var $container = $('#featured .scrollContainer');
		var horizontal = true;
		if (horizontal) {
	        $panels.css({
	            'float' : 'left',
	            'position' : 'relative'
	        });
	        $container.css('width', $panels[0].offsetWidth * $panels.length);
	    }
		
		var $scroll = $('#featured .scroll').css('overflow', 'hidden');
		
	    $scroll
	        .before('<span class="scrollButtons left"></span>')
	        .after('<span class="scrollButtons right"></span>');
		
		function selectNav() {
		  $(this)
		    .parents('ul:first')
		      .find('a')
		        .removeClass('selected')
		      .end()
		    .end()
		    .addClass('selected');
		}
		
		$('#featured .featured_nav').find('a').click(selectNav);
		
		function trigger(data) {
		  var el = $('#featured .featured_nav').find('a[href$="' + data.id + '"]').get(0);
		  selectNav.call(el);
		}
		
		if (window.location.hash) {
		  trigger({ id : window.location.hash.substr(1) });
		} else {
		  $('.featured_nav a:first').click();
		}
	
		var offset = parseInt((horizontal ? 
		  $container.css('paddingTop') : 
		  $container.css('paddingLeft')) 
		  || 0) * -1;
		
		var scrollOptions = {
		  target: $scroll,
		  items: $panels,
		  navigation: '.featured_nav a',
		  prev: 'span.left', 
          next: 'span.right',
		  axis: 'xy',
		  onAfter: trigger,
		  offset: offset,
		  duration: 500,
		};
		$('#featured').serialScroll(scrollOptions);
		$.localScroll(scrollOptions);
		scrollOptions.duration = 1;
		$.localScroll.hash(scrollOptions);
		
		// start to automatically cycle the tabs
		var cycleTimer = setInterval(function () {
		   $scroll.trigger('next');
		}, 7000);
		
		var $stopTriggers = $('#featured .navigation').find('a')
		    .add('.scroll')
		    .add("a[href^='#']");
		
		function stopCycle() {
		   $stopTriggers.unbind('click.cycle');
		   clearInterval(cycleTimer);
		}
		$stopTriggers.bind('click.cycle', stopCycle);
		
		//qTip Featured
		$('#featured .featured_nav a[title]').qtip({
			show: {
	      		delay: 10,
	      		effect: {
	      			type: 'fade', 
	      			length: 100 } 
	      	},
			position: {
	      		corner: { 
	      			target: 'rightTop', 
	      			tooltip: 'topLeft'
	      		}
	      	},
	      	style: {
	      		color: '#122d45',
	      		lineHeight: '1.2em',
	      		fontFamily: '"Trebuchet MS", "Lucida Grande", Lucida, Verdana, sans-serif',
	      		maxWidth: 200,
	      		background: 'transparent',
			    tip: { 
		        	corner: 'leftMiddle',
		        	color: '#ccc'
		        },
			    border: {
		        	width: 1,
		        	color: '#ccc'
		      	},
		      
			}
		});
	}
	
	//Thickbox on linked images
	$('.#main .hentry a,#ausgabe a').filter('[href$=.png],[href$=.jpg],[href$=.gif]').addClass('thickbox');
    
    //Search term highlighting init
	if(typeof(hls_query) != 'undefined'){
      $('#content').highlight(hls_query, 1, 'hls');
    }
    
    //Open pdf links and external links in new window
    $('a[href*=.pdf], a.external').click(function(){
		window.open(this.href);
	return false;
	});
	
	//Basic content accordion
	var $content = $('.accordionContent');
	var $contentFirst = $('.accordionContent:first');
	var $trigger = $('.accordionButton')
	
	$content.hide();
	$contentFirst.show();
	$trigger.css('cursor', 'pointer');
	
	$trigger.hover(function() {
  		$(this).css('backgroundColor','#e0e2e5');
  	}, function() {
  		$(this).css('backgroundColor','transparent');
  	});
	
  	$trigger.click(function() {
  		var $nextDiv = $(this).next();
    	var $visibleSiblings = $nextDiv.siblings('div:visible');
 
    	if ($visibleSiblings.length ) {
      		$visibleSiblings.slideUp('normal', function() {
        	$nextDiv.slideToggle('normal');
      		});
    	} else {
       		$nextDiv.slideToggle('normal');
    	}
  	});
	

}); //don't delete me or the DOM will collaps

//Finally load all this after the content has loaded
//$(window).load(function() {

	//scrolltotop.init();
	
//});