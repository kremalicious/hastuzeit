/* DOCUMENT INFORMATION
===========================================
Document		: main js Document hastuzeit Teaser
Version			: 1.0.0
Client			: hastuzeit
Author			: Matthias Kretschmann
Author Contact	: krema@jpberlin.de
Author WebSite	: matthiaskretschmann.com
*/

$(function () {
	
	//the counter
	$.countdown.regional['de'] = {
		labels: ['Jahren', 'Monate', 'Wochen', 'Tage', 'Stunden', 'Minuten', 'Sekunden'],
		labels1: ['Jahre', 'Monat', 'Woche', 'Tag', 'Stunde', 'Minute', 'Sekunde'],
		compactLabels: ['J', 'M', 'W', 'T'],
		timeSeparator: ':', isRTL: false};
	$.countdown.setDefaults($.countdown.regional['de']);
	
	var launch = new Date(); 
		launch = new Date(launch.getFullYear(), 9, 1);
	$('#defaultCountdown').countdown({until: launch});
	
	//Open pdf links and external links in new window
    $('a[href*=.pdf], a.external').click(function(){
		window.open(this.href);
	return false;
	});
	
});