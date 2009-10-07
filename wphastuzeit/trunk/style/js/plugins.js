/*
 * jQuery plugins for hastuzeit.de
 * Copyright (c) 2009 Matthias Kretschmann | krema@jpberlin.de
 * http://matthiaskretschmann.com
 * http://kremalicious.com
 */
	
//Label inside form elements
this.label2value = function(){	
	var inactive = "inactive";
	var active = "active";
	var focused = "focused";
	$("label").each(function(){		
		obj = document.getElementById($(this).attr("for"));
		if(($(obj).attr("type") == "text") || ($(obj).attr("type") == "password") || (obj.tagName.toLowerCase() == "textarea")){
			$(obj).addClass(inactive);			
			var text = $(this).text();
			$(this).css("display","none");			
			$(obj).val(text);
			$(obj).focus(function(){	
				$(this).addClass(focused);
				$(this).removeClass(inactive);
				$(this).removeClass(active);								  
				if($(this).val() == text) $(this).val("");
			});	
			$(obj).blur(function(){	
				$(this).removeClass(focused);													 
				if($(this).val() == "") {
					$(this).val(text);
					$(this).addClass(inactive);
				} else {
					$(this).addClass(active);		
				};				
			});				
		};	
	});		
};

/***
@title:
Live Search

@version:
2.0

@author:
Andreas Lagerkvist

@date:
2008-08-31

@url:
http://andreaslagerkvist.com/jquery/live-search/

@license:
http://creativecommons.org/licenses/by/3.0/

***/
jQuery.fn.liveSearch = function (conf) {
	var config = jQuery.extend({
		url:			'/?module=SearchResults&q=', 
		id:				'jquery-live-search', 
		duration:		400, 
		typeDelay:		200,
		loadingClass:	'loading', 
		onSlideUp:		function () {}
	}, conf);
	var liveSearch	= jQuery('#' + config.id);

	if (!liveSearch.length) {
		liveSearch = jQuery('<div id="' + config.id + '"></div>').appendTo(document.body).hide().slideUp(0);

		jQuery(document.body).click(function(event) {
			var clicked = jQuery(event.target);

			if (!(clicked.is('#' + config.id) || clicked.parents('#' + config.id).length || clicked.is('input'))) {
				liveSearch.slideUp(config.duration, function () {
					config.onSlideUp();
				});
			}
		});
	}

	return this.each(function () {
		var input		= jQuery(this).attr('autocomplete', 'off');
		var resultsShit	= parseInt(liveSearch.css('paddingLeft'), 10) + parseInt(liveSearch.css('paddingRight'), 10) + parseInt(liveSearch.css('borderLeftWidth'), 10) + parseInt(liveSearch.css('borderRightWidth'), 10);

		input
			.focus(function () {
				if (this.value !== '') {
					if (liveSearch.html() == '') {
						this.lastValue = '';
						input.keyup();
					}
					else {
						liveSearch.slideDown(config.duration);
					}
				}
			})
			.keyup(function () {
				if (this.value != this.lastValue) {
					input.addClass(config.loadingClass);

					var q = this.value;

					if (this.timer) {
						clearTimeout(this.timer);
					}

					this.timer = setTimeout(function () {
						jQuery.get(config.url + q, function (data) {
							input.removeClass(config.loadingClass);

							if (data.length && q.length) {
								var tmpOffset	= input.offset();
								var inputDim	= {
									left:		tmpOffset.left, 
									top:		tmpOffset.top, 
									width:		input.outerWidth(), 
									height:		input.outerHeight()
								};

								inputDim.topNHeight	= inputDim.top + inputDim.height;
								inputDim.widthNShit	= inputDim.width - resultsShit;

								liveSearch.css({
									position:	'absolute', 
									left:		inputDim.left + 'px', 
									top:		inputDim.topNHeight + 'px',
									width:		inputDim.widthNShit + 'px'
								});

								liveSearch.html(data).slideDown(config.duration);
							}
							else {
								liveSearch.slideUp(config.duration, function () {
									config.onSlideUp();
								});
							}
						});
					}, config.typeDelay);

					this.lastValue = this.value;
				}
			});
	});
};

//Search term highlighting
jQuery.fn.extend({ 
	highlight: function(search, insensitive, hls_class){ 
		var regex = new RegExp("(<[^>]*>)|(\\b"+ search.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +")", insensitive ? "ig" : "g"); 
		return this.html(this.html().replace(regex, function(a, b, c){ 
		return (a.charAt(0) == "<") ? a : "<strong class=\""+ hls_class +"\">" + c + "</strong>"; 
		})); 
	} 
});

//** jQuery Scroll to Top Control script- (c) Dynamic Drive DHTML code library: http://www.dynamicdrive.com.
//** Available/ usage terms at http://www.dynamicdrive.com (March 30th, 09')
//** v1.1 (April 7th, 09'):
//** 1) Adds ability to scroll to an absolute position (from top of page) or specific element on the page instead.
//** 2) Fixes scroll animation not working in Opera. 

var scrolltotop={
	//startline: Integer. Number of pixels from top of doc scrollbar is scrolled before showing control
	//scrollto: Keyword (Integer, or "Scroll_to_Element_ID"). How far to scroll document up when control is clicked on (0=top).
	setting: {startline:300, scrollto: 0, scrollduration:1000, fadeduration:[500, 100]},
	controlHTML: '', //HTML for control, which is auto wrapped in DIV w/ ID="topcontrol"
	controlattrs: {offsetx:0, offsety:0}, //offset of control relative to right/ bottom of window corner
	anchorkeyword: '#top', //Enter href value of HTML anchors on the page that should also act as "Scroll Up" links

	state: {isvisible:false, shouldvisible:false},

	scrollup:function(){
		if (!this.cssfixedsupport) //if control is positioned using JavaScript
			this.$control.css({opacity:0}) //hide control immediately after clicking it
		var dest=isNaN(this.setting.scrollto)? this.setting.scrollto : parseInt(this.setting.scrollto)
		if (typeof dest=="string" && jQuery('#'+dest).length==1) //check element set by string exists
			dest=jQuery('#'+dest).offset().top
		else
			dest=0
		this.$body.animate({scrollTop: dest}, this.setting.scrollduration);
	},

	keepfixed:function(){
		var $window=jQuery(window)
		var controlx=$window.scrollLeft() + $window.width() - this.$control.width() - this.controlattrs.offsetx
		var controly=$window.scrollTop() + $window.height() - this.$control.height() - this.controlattrs.offsety
		this.$control.css({left:controlx+'px', top:controly+'px'})
	},

	togglecontrol:function(){
		var scrolltop=jQuery(window).scrollTop()
		if (!this.cssfixedsupport)
			this.keepfixed()
		this.state.shouldvisible=(scrolltop>=this.setting.startline)? true : false
		if (this.state.shouldvisible && !this.state.isvisible){
			this.$control.stop().animate({opacity:1}, this.setting.fadeduration[0])
			this.state.isvisible=true
		}
		else if (this.state.shouldvisible==false && this.state.isvisible){
			this.$control.stop().animate({opacity:0}, this.setting.fadeduration[1])
			this.state.isvisible=false
		}
	},
	
	init:function(){
		jQuery(document).ready(function($){
			var mainobj=scrolltotop
			var iebrws=document.all
			mainobj.cssfixedsupport=!iebrws || iebrws && document.compatMode=="CSS1Compat" && window.XMLHttpRequest //not IE or IE7+ browsers in standards mode
			mainobj.$body=(window.opera)? (document.compatMode=="CSS1Compat"? $('html') : $('body')) : $('html,body')
			mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+'</div>')
				.css({position:mainobj.cssfixedsupport? 'fixed' : 'absolute', bottom:mainobj.controlattrs.offsety, right:mainobj.controlattrs.offsetx, opacity:0, cursor:'pointer'})
				.attr({title:'Beam me up, Scotty'})
				.click(function(){mainobj.scrollup(); return false})
				.appendTo('body')
			if (document.all && !window.XMLHttpRequest && mainobj.$control.text()!='') //loose check for IE6 and below, plus whether control contains any text
				mainobj.$control.css({width:mainobj.$control.width()}) //IE6- seems to require an explicit width on a DIV containing text
			mainobj.togglecontrol()
			$('a[href="' + mainobj.anchorkeyword +'"]').click(function(){
				mainobj.scrollup()
				return false
			})
			$(window).bind('scroll resize', function(e){
				mainobj.togglecontrol()
			})
		})
	}
}

