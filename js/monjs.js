$(document).ready(function(){
	// zoombox
  	$('a.zoombox').zoombox();	
	// maps
	$("#mapsv").click(function(){
		var lieu = $("#lieu").val();
		$("#maps").html("<iframe frameborder='0' height='500' marginheight='0' marginwidth='0' scrolling='no' src='http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q="+lieu+"&amp;output=embed' width='500'></iframe><br /></div>");
	});
	//acccompog acccompod
	$(".acccompog").mouseover(function() {
  		$(this).animate({backgroundColor: '#ddb'}, { duration: 500, queue: false });
	}).mouseout(function() {
  		$(this).animate({backgroundColor: '#FFF'},  { duration: 500, queue: false });
	});
	$(".acccompod").mouseover(function() {
  		$(this).animate({backgroundColor: '#ddb'}, { duration: 500, queue: false });
	}).mouseout(function() {
  		$(this).animate({backgroundColor: '#FFF'},  { duration: 500, queue: false });
	});
	// menu
	$("#menuDeroulant li a, #menu-droit li a").mouseover(function() {
  		$(this).animate({backgroundColor: '#A9FE9C'}, { duration: 500, queue: false });
  		$(this).animate({color: '#1d5f1d'}, { duration: 500, queue: false });
	}).mouseout(function() {
  		$(this).animate({backgroundColor: '#1d5f1d'},  { duration: 500, queue: false });
  		$(this).animate({color: '#FFF'},  { duration: 500, queue: false });
	});
	// galery index
	$("#fin-galery-artist a").mouseover(function() {
  		$(this).animate({backgroundColor: '#1d5f1d'}, { duration: 200, queue: false });
  		$(this).animate({color: '#FFF'}, { duration: 200, queue: false });
	}).mouseout(function() {
  		$(this).animate({backgroundColor: '#ddb'},  { duration: 200, queue: false });
  		$(this).animate({color: '#1d5f1d'},  { duration: 200, queue: false });
	});
	$("#sel").mouseover(function() {
  		$(this).animate({backgroundColor: '#A9FE9C'}, { duration: 500, queue: false });
  		$(this).animate({color: '#1d5f1d'}, { duration: 500, queue: false });
	}).mouseout(function() {
  		$(this).animate({backgroundColor: '#fff'},  { duration: 500, queue: false });
  		$(this).animate({color: '#000'},  { duration: 500, queue: false });
	});
});