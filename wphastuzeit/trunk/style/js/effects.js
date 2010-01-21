/*
 * main JS Document for hastuzeit.de
 * Copyright (c) 2009 Matthias Kretschmann | krema@jpberlin.de
 * http://matthiaskretschmann.com
 * http://kremalicious.com
 */

//Equal height trick to get equal height for the two boxes, must be initiated later
//Example: equalHeight(jQuery("#wrapper .box"));
function equalHeight(group) {
	var tallest = 0;
	group.each(function() {
		var thisHeight = jQuery(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
}
	
//On with the real fun
$(function () { //DOMdiDOM
	
	//initiate the label replacement
	label2value();
	
	//Heft Category Badge
	$("#main .category-link a:contains('Nr')").addClass('heftbadge');
	
	//AJAX Live Search
    $('#s').liveSearch({url: '/index.php?ajax=1&s='});
    
    //initiate our equal height magic
	equalHeight($("body.search-results #main .hentry"));
    
    /*
	//Laaacyyyy content images
    $('#main img').lazyload({ 
    	placeholder : '/wp-content/themes/wphastuzeit/style/images/lazyload-grey.png',
    	effect 		: 'fadeIn' 
	});
	*/
	
	//Tab interface
	$("#tabs .tabNavigation li a").click(function() {
    
        var curList = $("#tabs .tabNavigation li a.current").attr("rel");
        var curListHeight = $("#list-wrap").height();
        
        $("#list-wrap").height(curListHeight);
    
        $("#tabs .tabNavigation li a").removeClass("current");
        $(this).addClass("current");
        
        var listID = $(this).attr("rel");
        
        if (listID != curList) {
            $("#"+curList).fadeOut(200, function() {
    
                $("#"+listID).fadeIn(200);
                
                var newHeight = $("#"+listID).height();
                
                $("#list-wrap").animate({
                    height: newHeight
                });
            
            });
        }        
        
        return false;
    });
		
	//Thickbox on linked images
	$('#main .hentry a,#ausgabe a').filter('[href$=.png],[href$=.jpg],[href$=.gif],[href$=.PNG],[href$=.JPG],[href$=.GIF]').addClass('thickbox');
	$('#ausgabe a.thickbox, .page-template-page-heftarchiv-php a.thickbox, .wp-caption a.thickbox').append('<span class="zoom"></span>');
	
	//Style external links
	$('#main .post a').not(":has(img)").filter(function() {
    	return this.hostname && this.hostname !== location.hostname;
  	}).addClass('external').attr({rel:'external'});
    
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
	
	//qTip Rest
	$('a.infopopup').qtip({
		show: {
      		delay: 10,
      		effect: {
      			type: 'fade', 
      			length: 100 } 
      	},
		position: {
      		corner: { 
      			target: 'bottomLeft', 
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
	        	corner: 'topLeft',
	        	color: '#ccc'
	        },
		    border: {
	        	width: 1,
	        	color: '#ccc'
	      	},
	      
		}
	});
	
	//Twitter integration
	//http://tweet.seaofclouds.com/
	$("#tweet").tweet({
		username: "hastuzeit",
        query: "hastuzeit",
        join_text: "",
        avatar_size: 25,
        count: 4,
        loading_text: "tweets werden geladen..."
    });
	
	//Front-End login and admin, with cookie magic
	var $panel = $('#front-admin > *:not(#login-link)')
	$('#login-link').click(function(){
		if ($panel.is(":hidden")) {
			$panel.slideDown('normal');
			$.cookie('panelState', 'expanded');
		return false;
	} else {
		$panel.slideUp('normal');
		$.cookie('panelState', 'collapsed');
	return false;
	}
	});
    var panelCookie = $.cookie('panelState');
    if (panelCookie == 'collapsed') {
 		$panel.hide();
 	}
 	
 	//Password input, a bit iPhone style
	$('input[type=password]').each(function(i,v) {
		var input = $(v);
		var last = input.val();
		var pop = {
			timer:null,
			letter:null,
			clear:function() {
				if (pop.timer) { window.clearTimeout(pop.timer); }
				if (pop.letter) { pop.letter.remove(); }
			},
			show:function(letter, position) {
				pop.clear();
				pop.letter = $('<div/>').addClass("letter")
					.css("marginTop", -10)
					.animate({marginTop:-30})
					.insertBefore(input);				
				pop.letter.css(
					"marginLeft", 
					Math.min(
					(input.width() - pop.letter.width()), 
					(position * 4)) + 
					"px"
					);	
				if (letter == " ") {
					pop.letter.html("&nbsp;");
				}
				else {
					pop.letter.text(letter);
				}
				pop.timer = window.setTimeout(function() { pop.letter.fadeOut(); }, 500);
			}};

		input.keyup(function(e) {
			var current = input.val();
			if (current.length < last.length) {
				last = input.val();
				return;
			}
			for (var i = 0; i < Math.min(last.length, current.length); i++) {
				if (current[i] != last[i]) {
					pop.show(current.charAt(i), i);
					last = input.val();
					return;
				}
			
			}
			if (current.length > last.length) {
				var end = current.length - 1;
				pop.show(current.charAt(end), end);
			}
			last = input.val();
		});
	});
    
    //Search term highlighting init
	if(typeof(hls_query) != 'undefined'){
      $('#main').highlight(hls_query, 1, 'hls');
    }
    
    //Open pdf links in new window
    $('a[href*=.pdf]').click(function(){
		window.open(this.href);
	return false;
	});
	
	//Basic content accordion
	var $content = $('.accordionContent');
	var $contentFirst = $('.accordionContent:first');
	var $trigger = $('.accordionButton')
	
	$content.hide();
	$contentFirst.show();
	$contentFirst.prev('h2,h4').addClass('open');
	$trigger.css({
		cursor: 'pointer',
		background: 'url(/wp-content/themes/wphastuzeit/style/images/triangle-closed.png) no-repeat 5px center',
		paddingLeft: '25px',
		});
	
	$trigger.hover(function() {
  		$(this).css('backgroundColor','#e0e2e5');
  	}, function() {
  		$(this).css('backgroundColor','transparent');
  	});
	
  	$trigger.click(function() {
  		var $nextDiv = $(this).next();
    	var $visibleSiblings = $nextDiv.siblings('.accordionContent:visible');
 
    	if ($visibleSiblings.length ) {
      		$visibleSiblings.slideUp('normal', function() {
      		$visibleSiblings.prev('h2,h4').toggleClass('open')
        	$nextDiv.slideToggle('normal').prev('h2,h4').toggleClass('open');
      		});
    	} else {
       		$nextDiv.slideToggle('normal').prev('h2,h4').toggleClass('open');
    	}
  	});
  	
  	//Hover link animation
  	var $animatedlinks = ('#frisch a, #beliebt a, .widget_rss a, .widget_links a');
  	$($animatedlinks).hover(function () {
    	$(this).stop().animate({ paddingLeft: '15px' }, 400);  
    	}, function() { 
        $(this).stop().animate({ paddingLeft: '5px' }, 400);
    });
    
    //sidebar fading
    $('#sidebar .widget').css({opacity: '0.6'});
    $('#sidebar .widget').hover(function () {
    	$(this).stop().animate({ opacity: '1' }, 400);  
    	}, function() { 
        $(this).stop().animate({ opacity: '0.6' }, 400);
    return false;
    });
    
    //the warning toggle for IE 7 and below users	
    $('#warning-toggle').click(function() {
    	$('#iewarning').slideUp(500);
    	$('#warning-toggle').fadeOut('normal')
    	$.cookie('panelState', 'collapsed');
    	return false;
    });
    var panelCookie = $.cookie('panelState');
    if (panelCookie == 'collapsed') {
 		$('#iewarning,#warning-toggle').hide();
 	}
    
}); //don't delete me or the DOM will collaps

//Finally load all this after the content has loaded
//$(window).load(function() {
	
	//scrolltotop.init();
	
//});