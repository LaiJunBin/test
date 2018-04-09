$(function(){
	var title = $("#container>h1").text();
	document.title = title;
	$("button").button();
	$("button").removeClass("ui-widget");
});