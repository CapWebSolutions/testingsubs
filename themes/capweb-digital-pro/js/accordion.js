
jQuery(document).ready(function($) {
	$("body").show();
	$( "#accordion" ).accordion({
		collapsible: true,
		active: false,
		header: '> div.my-accordion-section > h3',
		heightStyle: 'content'
	});
});