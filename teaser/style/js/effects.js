$(function () {
	
	$.countdown.regional['de'] = {
		labels: ['Jahren', 'Monate', 'Wochen', 'Tage', 'Stunden', 'Minuten', 'Sekunden'],
		labels1: ['Jahre', 'Monat', 'Woche', 'Tag', 'Stunde', 'Minute', 'Sekunde'],
		compactLabels: ['J', 'M', 'W', 'T'],
		timeSeparator: ':', isRTL: false};
	$.countdown.setDefaults($.countdown.regional['de']);
	
	var austDay = new Date();
	austDay = new Date(austDay.getFullYear(), 9 - 10, 01);
	$('#defaultCountdown').countdown({until: austDay});
	$('#year').text(austDay.getFullYear());
});