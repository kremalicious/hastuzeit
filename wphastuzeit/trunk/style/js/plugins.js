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