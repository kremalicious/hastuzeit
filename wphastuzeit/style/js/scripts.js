/*
 * main JS Document for hastuzeit.de
 * Copyright (c) 2009 Matthias Kretschmann | krema@jpberlin.de
 * http://matthiaskretschmann.com
 * http://kremalicious.com
 */

var $ = jQuery.noConflict();

// ALL THE PLUGINS, minified
this.label2value=function(){var a="inactive";var c="active";var b="focused";$("label").each(function(){obj=document.getElementById($(this).attr("for"));if(($(obj).attr("type")=="text")||($(obj).attr("type")=="password")||(obj.tagName.toLowerCase()=="textarea")){$(obj).addClass(a);var d=$(this).text();$(this).css("display","none");$(obj).val(d);$(obj).focus(function(){$(this).addClass(b);$(this).removeClass(a);$(this).removeClass(c);if($(this).val()==d){$(this).val("")}});$(obj).blur(function(){$(this).removeClass(b);if($(this).val()==""){$(this).val(d);$(this).addClass(a)}else{$(this).addClass(c)}})}})};jQuery.fn.liveSearch=function(b){var a=jQuery.extend({url:"/?module=SearchResults&q=",id:"jquery-live-search",duration:400,typeDelay:200,loadingClass:"loading",onSlideUp:function(){}},b);var c=jQuery("#"+a.id);if(!c.length){c=jQuery('<div id="'+a.id+'"></div>').appendTo(document.body).hide().slideUp(0);jQuery(document.body).click(function(e){var d=jQuery(e.target);if(!(d.is("#"+a.id)||d.parents("#"+a.id).length||d.is("input"))){c.slideUp(a.duration,function(){a.onSlideUp()})}})}return this.each(function(){var d=jQuery(this).attr("autocomplete","off");var e=parseInt(c.css("paddingLeft"),10)+parseInt(c.css("paddingRight"),10)+parseInt(c.css("borderLeftWidth"),10)+parseInt(c.css("borderRightWidth"),10);d.focus(function(){if(this.value!==""){if(c.html()==""){this.lastValue="";d.keyup()}else{c.slideDown(a.duration)}}}).keyup(function(){if(this.value!=this.lastValue){d.addClass(a.loadingClass);var f=this.value;if(this.timer){clearTimeout(this.timer)}this.timer=setTimeout(function(){jQuery.get(a.url+f,function(i){d.removeClass(a.loadingClass);if(i.length&&f.length){var h=d.offset();var g={left:h.left,top:h.top,width:d.outerWidth(),height:d.outerHeight()};g.topNHeight=g.top+g.height;g.widthNShit=g.width-e;c.css({position:"absolute",left:g.left+"px",top:g.topNHeight+"px",width:g.widthNShit+"px"});c.html(i).slideDown(a.duration)}else{c.slideUp(a.duration,function(){a.onSlideUp()})}})},a.typeDelay);this.lastValue=this.value}})})};jQuery.fn.extend({highlight:function(b,a,c){var d=new RegExp("(<[^>]*>)|(\\b"+b.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1")+")",a?"ig":"g");return this.html(this.html().replace(d,function(f,e,g){return(f.charAt(0)=="<")?f:'<strong class="'+c+'">'+g+"</strong>"}))}});(function(a){a.fn.tipTip=function(c){var g={maxWidth:"200px",edgeOffset:3,delay:400,fadeIn:200,fadeOut:200,enter:function(){},exit:function(){}};var e=a.extend(g,c);if(a("#tiptip_holder").length<=0){var b=a('<div id="tiptip_holder" style="max-width:'+e.maxWidth+';"></div>');var d=a('<div id="tiptip_content"></div>');var f=a('<div id="tiptip_arrow"></div>');a("body").append(b.html(d).prepend(f.html('<div id="tiptip_arrow_inner"></div>')))}else{var b=a("#tiptip_holder");var d=a("#tiptip_content");var f=a("#tiptip_arrow")}return this.each(function(){var i=a(this);var j=i.attr("title");if(j!=""){i.removeAttr("title");var h=false;i.hover(function(){e.enter.call(this);d.html(j);b.hide().removeAttr("class").css("margin","0");f.removeAttr("style");var u=parseInt(i.offset()["top"]);var n=parseInt(i.offset()["left"]);var r=parseInt(i.outerWidth());var v=parseInt(i.outerHeight());var t=b.outerWidth();var o=b.outerHeight();var s=Math.round((r-t)/2);var m=Math.round((v-o)/2);var l=Math.round(n+s);var k=Math.round(u+v+e.edgeOffset);var p="";var w="";var q=Math.round(t-12)/2;if(s<0){if((s+n)<parseInt(a(window).scrollLeft())){p="_right";w=Math.round(o-13)/2;q=-12;l=Math.round(n+r+e.edgeOffset);k=Math.round(u+m)}else{if((t+n)>parseInt(a(window).width())){p="_left";w=Math.round(o-13)/2;q=Math.round(t);l=Math.round(n-(t+e.edgeOffset+5));k=Math.round(u+m)}}}if((u+v+e.edgeOffset+o+8)>parseInt(a(window).height()+a(window).scrollTop())){p=p+"_top";w=o;k=Math.round(u-(o+5+e.edgeOffset))}else{if(((u+v)-(e.edgeOffset+o))<0||p==""){p=p+"_bottom";w=-12;k=Math.round(u+v+e.edgeOffset)}}if(p=="_right_top"||p=="_left_top"){k=k+5}else{if(p=="_right_bottom"||p=="_left_bottom"){k=k-5}}if(p=="_left_top"||p=="_left_bottom"){l=l+5}f.css({"margin-left":q+"px","margin-top":w+"px"});b.css({"margin-left":l+"px","margin-top":k+"px"}).attr("class","tip"+p);if(h){clearTimeout(h)}h=setTimeout(function(){b.stop(true,true).fadeIn(e.fadeIn)},e.delay)},function(){e.exit.call(this);if(h){clearTimeout(h)}b.fadeOut(e.fadeOut)})}})}})(jQuery);(function(d){var c=location.href.replace(/#.*/,""),b=d.localScroll=function(e){d("body").localScroll(e)};b.defaults={duration:1000,axis:"y",event:"click",stop:1};b.hash=function(e){e=d.extend({},b.defaults,e);e.hash=0;if(location.hash){setTimeout(function(){a(0,location,e)},0)}};d.fn.localScroll=function(e){e=d.extend({},b.defaults,e);return(e.persistent||e.lazy)?this.bind(e.event,function(h){var g=d([h.target,h.target.parentNode]).filter(f)[0];g&&a(h,g,e)}):this.find("a,area").filter(f).bind(e.event,function(g){a(g,this,e)}).end().end();function f(){var g=this;return !!g.href&&!!g.hash&&g.href.replace(g.hash,"")==c&&(!e.filter||d(g).is(e.filter))}};function a(j,h,g){var l=h.hash.slice(1),k=document.getElementById(l)||document.getElementsByName(l)[0],i;if(k){j&&j.preventDefault();i=d(g.target||d.scrollTo.window());if(g.lock&&i.is(":animated")||g.onBefore&&g.onBefore.call(h,j,k,i)===!1){return}if(g.stop){i.queue("fx",[]).stop()}i.scrollTo(k,g).trigger("notify.serialScroll",[k]);if(g.hash){i.queue(function(){location=h.hash;d(this).dequeue()})}}}})(jQuery);(function(b){var c=b.scrollTo=function(e,d,f){c.window().scrollTo(e,d,f)};c.defaults={axis:"y",duration:1};c.window=function(){return b(b.browser.safari?"body":"html")};b.fn.scrollTo=function(e,d,f){if(typeof d=="object"){f=d;d=0}f=b.extend({},c.defaults,f);d=d||f.speed||f.duration;f.queue=f.queue&&f.axis.length>1;if(f.queue){d/=2}f.offset=a(f.offset);f.over=a(f.over);return this.each(function(){var k=this,i=b(k),l=e,p,o={},j=i.is("html,body");switch(typeof l){case"number":case"string":if(/^([+-]=)?\d+(px)?$/.test(l)){l=a(l);break}l=b(l,this);case"object":if(l.is||l.style){p=(l=b(l)).offset()}}b.each(f.axis.split(""),function(h,r){var q=r=="x"?"Left":"Top",u=q.toLowerCase(),g="scroll"+q,t=k[g],s=r=="x"?"Width":"Height";if(p){o[g]=p[u]+(j?0:t-i.offset()[u]);if(f.margin){o[g]-=parseInt(l.css("margin"+q))||0;o[g]-=parseInt(l.css("border"+q+"Width"))||0}o[g]+=f.offset[u]||0;if(f.over[u]){o[g]+=l[s.toLowerCase()]()*f.over[u]}}else{o[g]=l[u]}if(/^\d+$/.test(o[g])){o[g]=o[g]<=0?0:Math.min(o[g],m(s))}if(!h&&f.queue){if(t!=o[g]){n(f.onAfterFirst)}delete o[g]}});n(f.onAfter);function n(g){i.animate(o,d,f.easing,g&&function(){g.call(this,e)})}function m(h){var g=j?b.browser.opera?document.body:document.documentElement:k;return g["scroll"+h]-g["client"+h]}})};function a(d){return typeof d=="object"?d:{top:d,left:d}}})(jQuery);(function(f){var e="serialScroll",d="."+e,h="bind",g=f[e]=function(a){f.scrollTo.window()[e](a)};g.defaults={duration:1000,axis:"x",event:"click",start:0,step:1,lock:1,cycle:1,constant:1};f.fn[e]=function(i){i=f.extend({},g.defaults,i);var b=i.event,a=i.step,c=i.lazy;return this.each(function(){var E=i.target?this:document,D=f(i.target||this,E),C=D[0],B=i.items,A=i.start,z=i.interval,y=i.navigation,n;if(!c){B=G()}if(i.force){J({},A)}f(i.prev||[],E)[h](b,-a,K);f(i.next||[],E)[h](b,a,K);if(!C.ssbound){D[h]("prev"+d,-a,K)[h]("next"+d,a,K)[h]("goto"+d,J)}if(z){D[h]("start"+d,function(j){if(!z){H();z=1;I()}})[h]("stop"+d,function(){H();z=0})}D[h]("notify"+d,function(l,j){var k=F(j);if(k>-1){A=k}});C.ssbound=1;if(i.jump){(c?D:G())[h](b,function(j){J(j,F(j.target))})}if(y){y=f(y,E)[h](b,function(j){j.data=Math.round(G().length/y.length)*y.index(this);J(j,this)})}function K(j){j.data+=A;J(j,this)}function J(p,s){if(!isNaN(s)){p.data=s;s=C}var r=p.data,j,q=p.type,o=i.exclude?G().slice(0,-i.exclude):G(),m=o.length,l=o[r],k=i.duration;if(q){p.preventDefault()}if(z){H();n=setTimeout(I,i.interval)}if(!l){j=r<0?0:j=m-1;if(A!=j){r=j}else{if(!i.cycle){return}else{r=m-j-1}}l=o[r]}if(!l||q&&A==r||i.lock&&D.is(":animated")||q&&i.onBefore&&i.onBefore.call(s,p,l,D,G(),r)===!1){return}if(i.stop){D.queue("fx",[]).stop()}if(i.constant){k=Math.abs(k/a*(A-r))}D.scrollTo(l,k,i).trigger("notify"+d,[r])}function I(){D.trigger("next"+d)}function H(){clearTimeout(n)}function G(){return f(B,C)}function F(k){if(!isNaN(k)){return k}var j=G(),l;while((l=j.index(k))==-1&&k!=C){k=k.parentNode}return l}})}})(jQuery);eval(function(h,b,j,f,g,i){g=function(a){return(a<b?"":g(parseInt(a/b)))+((a=a%b)>35?String.fromCharCode(a+29):a.toString(36))};if(!"".replace(/^/,String)){while(j--){i[g(j)]=f[j]||g(j)}f=[function(a){return i[a]}];g=function(){return"\\w+"};j=1}while(j--){if(f[j]){h=h.replace(new RegExp("\\b"+g(j)+"\\b","g"),f[j])}}return h}("o.5=q(b,9,2){7(h 9!='x'){2=2||{};7(9===j){9='';2=$.v({},2);2.3=-1}4 3='';7(2.3&&(h 2.3=='m'||2.3.l)){4 6;7(h 2.3=='m'){6=t u();6.s(6.w()+(2.3*r*p*p*z))}k{6=2.3}3='; 3='+6.l()}4 8=2.8?'; 8='+(2.8):'';4 a=2.a?'; a='+(2.a):'';4 c=2.c?'; c':'';d.5=[b,'=',E(9),3,8,a,c].y('')}k{4 e=j;7(d.5&&d.5!=''){4 g=d.5.F(';');D(4 i=0;i<g.f;i++){4 5=o.C(g[i]);7(5.n(0,b.f+1)==(b+'=')){e=B(5.n(b.f+1));G}}}A e}};",43,43,"||options|expires|var|cookie|date|if|path|value|domain|name|secure|document|cookieValue|length|cookies|typeof||null|else|toUTCString|number|substring|jQuery|60|function|24|setTime|new|Date|extend|getTime|undefined|join|1000|return|decodeURIComponent|trim|for|encodeURIComponent|split|break".split("|"),0,{}));


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
jQuery(function () { //DOMdiDOM
	
	//initiate the label replacement
	label2value();
	
	//Heft Category Badge
	$("#main .category-link a:contains('Nr')").addClass('heftbadge');
	
	//AJAX Live Search
    $('#s').liveSearch({url: '/index.php?ajax=1&s='});
    
    //initiate our equal height magic
	equalHeight($("body.search-results #main .hentry"));
	
	//Thickbox on linked images
	$('#main .hentry a,#ausgabe a').filter('[href$=".png"],[href$=".jpg"],[href$=".gif"],[href$=".PNG"],[href$=".JPG"],[href$=".GIF"]').addClass('thickbox');
	$('#ausgabe a.thickbox, .page-template-page-heftarchiv-php a.thickbox, .wp-caption a.thickbox').append('<span class="zoom"></span>');
	
	//Style external links
	$('#main .post a').not(":has(img)").filter(function() {
    	return this.hostname && this.hostname !== location.hostname;
  	}).addClass('external').attr({rel:'external'});
    
    //Open pdf links in new window
    $('a[href*=".pdf"]').click(function(){
		window.open(this.href);
	return false;
	});
	
	//Schnipsel stuff
  	$('#main .schnipsel').append('<div class="schnipsel_bottom"></div>');
  	
  	//Search term highlighting init
	if(typeof(hls_query) != 'undefined'){
      $('#main').highlight(hls_query, 1, 'hls');
    }
    
    	//TipTip
	//http://code.drewwilson.com/entry/tiptip-jquery-plugin
	var tipTriggers = $('#featured .featured_nav a[title], a.infopopup');
	
	tipTriggers.tipTip({
			maxWidth: "290px", 
			edgeOffset: 5,
			delay: 200
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
	}
	
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
	
	//Basic content accordion
	var $content = $('.accordionContent');
	var $contentFirst = $('.accordionContent:first');
	var $trigger = $('.accordionButton')
	
	$content.hide();
	$contentFirst.show();
	$contentFirst.prev('h2,h3,h4').addClass('open');
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
      		$visibleSiblings.prev('h2,h3,h4').toggleClass('open')
        	$nextDiv.slideToggle('normal').prev('h2,h3,h4').toggleClass('open');
      		});
    	} else {
       		$nextDiv.slideToggle('normal').prev('h2,h3,h4').toggleClass('open');
    	}
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