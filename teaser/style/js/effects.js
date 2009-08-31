$(function () {
	
	$.countdown.regional['de'] = {
		labels: ['Jahren', 'Monate', 'Wochen', 'Tage', 'Stunden', 'Minuten', 'Sekunden'],
		labels1: ['Jahre', 'Monat', 'Woche', 'Tag', 'Stunde', 'Minute', 'Sekunde'],
		compactLabels: ['J', 'M', 'W', 'T'],
		timeSeparator: ':', isRTL: false};
	$.countdown.setDefaults($.countdown.regional['de']);
	
	var launch = new Date(); 
		launch = new Date(launch.getFullYear(), 9, 1);
	$('#defaultCountdown').countdown({until: launch}); 
});