$(document).ready(function()
{
	// konami
	var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65"; // haut haut bas bas gauche droite gauche droite b a
	$(document).keydown(function(e) 
	{
		kkeys.push( e.keyCode );
		if ( kkeys.toString().indexOf( konami ) >= 0 )
		{
			$(document).unbind('keydown',arguments.callee);
			//le konami a ete entree
			$('#musique').html('<span style="position:absolute; height:0px; top:-500px;"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/..." width="200" height="20" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="sources/dewplayera.swf?mp3=sources/b5s.mp3&autostart=1&bgcolor=#000000" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" /><embed src="sources/dewplayera.swf?mp3=sources/b5s.mp3&autostart=1&bgcolor=#000000"  quality="high" bgcolor="#000000" width="200" height="25" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash pluginspage="http://www.macromedia.com/go/getflashplayer"></object></span>');
			$('#musiquekonami').show(1500).delay(7000).hide(1200);
		}
	});
	// zoombox
  	$('a.zoombox').zoombox();
  	//subscribe
  	$("#subface a").mouseover(function() 
  	{
  		$("#subface img").stop(true, true).fadeIn(500);
	}).mouseout(function() {
  		$("#subface img").stop(true, true).fadeOut(500);
	});
  	$("#subrss a").mouseover(function() 
  	{
  		$("#subrss img").stop(true, true).fadeIn(500);
	}).mouseout(function() {
  		$("#subrss img").stop(true, true).fadeOut(500);
	});
	$("#submail a").mouseover(function() 
	{
  		$("#submail img").stop(true, true).fadeIn(500);
	}).mouseout(function() {
  		$("#submail img").stop(true, true).fadeOut(500);
	});
	// maps
	$("#mapsv").click(function()
	{
		var lieu = $("#lieu").val();
		$("#maps").html("<iframe frameborder='0' height='500' marginheight='0' marginwidth='0' scrolling='no' src='http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q="+lieu+"&amp;output=embed' width='500'></iframe><br /></div>");
	});
	//acccompog acccompod
	$(".acccompog").mouseover(function() 
	{
  		$(this).animate({backgroundColor: '#ddb'}, { duration: 500, queue: false });
	}).mouseout(function() 
	{
  		$(this).animate({backgroundColor: '#FFF'},  { duration: 500, queue: false });
	});
	$(".acccompod").mouseover(function() 
	{
  		$(this).animate({backgroundColor: '#ddb'}, { duration: 500, queue: false });
	}).mouseout(function() 
	{
  		$(this).animate({backgroundColor: '#FFF'},  { duration: 500, queue: false });
	});
	// menu
	$("#menuDeroulant li a, #menu-droit li a").mouseover(function() 
	{
  		$(this).animate({backgroundColor: '#A9FE9C'}, { duration: 500, queue: false });
  		$(this).animate({color: '#1d5f1d'}, { duration: 500, queue: false });
	}).mouseout(function() 
	{
  		$(this).animate({backgroundColor: '#1d5f1d'},  { duration: 500, queue: false });
  		$(this).animate({color: '#FFF'},  { duration: 500, queue: false });
	});
	// galery index
	$("#fin-galery-artist a").mouseover(function() 
	{
  		$(this).animate({backgroundColor: '#1d5f1d'}, { duration: 200, queue: false });
  		$(this).animate({color: '#FFF'}, { duration: 200, queue: false });
	}).mouseout(function() 
	{
  		$(this).animate({backgroundColor: '#ddb'},  { duration: 200, queue: false });
  		$(this).animate({color: '#1d5f1d'},  { duration: 200, queue: false });
	});
	$("#sel").mouseover(function() 
	{
  		$(this).animate({backgroundColor: '#A9FE9C'}, { duration: 500, queue: false });
  		$(this).animate({color: '#1d5f1d'}, { duration: 500, queue: false });
	}).mouseout(function() 
	{
  		$(this).animate({backgroundColor: '#fff'},  { duration: 500, queue: false });
  		$(this).animate({color: '#000'},  { duration: 500, queue: false });
	});
//-----------------------------------------------------------------------------------------------------------
	//datepicker
	var latestMDPver = $.ui.multiDatesPicker.version;
	var lastMDPupdate = '2012-03-28';
	
	$(function() {
		// Version //
		//$('title').append(' v' + latestMDPver);
		$('.mdp-version').text('v' + latestMDPver);
		$('#mdp-title').attr('title', 'last update: ' + lastMDPupdate);
		
		// Documentation //
		$('i:contains(type)').attr('title', '[Optional] accepted values are: "allowed" [default]; "disabled".');
		$('i:contains(format)').attr('title', '[Optional] accepted values are: "string" [default]; "object".');
		$('#how-to h4').each(function () {
			var a = $(this).closest('li').attr('id');
			$(this).wrap('<'+'a href="#'+a+'"></'+'a>');
		});
		$('#demos .demo').each(function () 
		{
			var id = $(this).find('.box').attr('id') + '-demo';
			$(this).attr('id', id)
				.find('h3').wrapInner('<'+'a href="#'+id+'"></'+'a>');
		});
		
		// Run Demos
		$('.demo .code').each(function() 
		{
			eval($(this).attr('title','NEW: edit this code and test it!').text());
			this.contentEditable = true;
		}).focus(function() 
		{
			if(!$(this).next().hasClass('test'))
				$(this)
					.after('<button class="test">test</button>')
					.next('.test').click(function() 
					{
						$(this).closest('.demo').find('.box').removeClass('hasDatepicker').empty();
						eval($(this).prev().text());
						$(this).remove();
					});
		});
	});
//-----------------------------------------------------------------------------------
	// mydatepicker
	if(document.getElementById('dateaffiche'))
	{
		var datelist = document.getElementById('dateaffiche').value;
		var dateblist = datelist.split(',');
	}
	if(document.getElementById('dateanne'))
	{
		var datelist = document.getElementById('dateanne').value;
		var dateblist = datelist.split(',');
	}
	// formulaire compositeur
	$('#neele').multiDatesPicker({
		maxPicks : 1
	});
	$('#mortle').multiDatesPicker({
		maxPicks : 1
	});
	// date evenement
	$('#dateevent').multiDatesPicker().click(function()
	{
		var dates = $('#dateevent').multiDatesPicker('getDates');
		document.getElementById('date').value = dates;
	});
	$('#dateeventaffiche').multiDatesPicker(
	{
		defaultDate: dateblist[0],
		maxPicks: dateblist.length
	});
	$('#datemodevent').multiDatesPicker(
	{
		defaultDate: dateblist[0]
	}).click(function()
	{
		var dates = $('#datemodevent').multiDatesPicker('getDates');
		document.getElementById('dateaffiche').value = dates;
	});
	// boucle d'affichage
	var i = 0;
	while(i != dateblist.length)
	{
		$('#dateeventaffiche').multiDatesPicker(
		{
			addDates: [ dateblist[i] ]
		});
		$('#datemodevent').multiDatesPicker(
		{
			addDates: [ dateblist[i] ]
		});
		i++;
	}
});