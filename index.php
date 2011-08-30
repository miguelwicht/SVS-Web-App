<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;"/>
	
	<title>Statistik der 3. Mannschaft</title>
	
	
	<link rel="stylesheet" type="text/css" href="statistic.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation : portrait)" href="resources/css/ipad_portrait.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation : landscape)" href="resources/css/ipad_landscape.css" />
	
		<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px) and (orientation : landscape)" href="resources/css/iphone_landscape.css" />
		<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px) and (orientation : portrait)" href="resources/css/iphone_portrait.css" />
		
		<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2) and (orientation : portrait)" href="resources/css/iphone_portrait.css" />
		<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2) and (orientation : landscape)" href="resources/css/iphone_landscape.css" />
	
	<script> 
    (function () {
      var filename = navigator.platform === 'iPad' ?
        'splash-big.png' : 'splash.png';
      document.write(
        '<link rel="apple-touch-startup-image" ' +
              'href="resources/design/' + filename + '" />' );
    })();
  	</script> 
	<link rel="apple-touch-icon" href="resources/design/iphone_web_clip.png"/>
	<script type="text/javascript" src="jquery-1.5.2.js"></script>
	<script type="text/javascript" src="jquery.form.js"></script>
	<script src="highcharts.js" type="text/javascript"></script>
	<script src="resources/js/iscroll.js" type="text/javascript"></script>
	

	

	<script type="text/javascript">
	var myScroll;
		$(document).ready(function(){
			
			
			$("#content").load("content/svs3_statistic_all.html", function(){
				myScroll = new iScroll('content');
			});
			
		
		
			$("#stats").click(function(event){
				event.preventDefault()
				$("#content").load("content/svs3_statistic_all.html", function(){
					myScroll = new iScroll('content');
					setTimeout(function () {
							myScroll.refresh();
						}, 0);
					
				});
			});
			
			$("#reports").click(function(event){
				event.preventDefault()
				$("#content").load("content/svs3_charts.html", function(){
					myScroll = new iScroll('content');
					setTimeout(function () {
							myScroll.refresh();
						}, 0);
					
				});	
			});
		
			$("#rankings").click(function(event){
				event.preventDefault()
				$("#content").load("content/svs3_goals.html", function(){
					myScroll = new iScroll('content');
					setTimeout(function () {
							myScroll.refresh();
						}, 0);
					
				});
			});
		
			$("#gamedays").click(function(event){
				event.preventDefault()
				$("#content").load("content/svs3_stats_gameday.html", function(){
					myScroll = new iScroll('content');
					setTimeout(function () {
							myScroll.refresh();
						}, 0);
					
				});
			});
		
			$("#fussball_de").click(function(event){
				event.preventDefault()
				$("#content").load("content/svs3_fussball_de.php")
			});
		
		
		
			$("#print").click(function(){
				window.print();
		
			});
		
		

		$('#newPlayer').ajaxForm(function() { 
                alert("New Player Added!"); 
            }); 
        $('#newTeam').ajaxForm(function() { 
                alert("New Team!"); 
            }); 
		$('#update').ajaxForm(function() { 
                alert("Updated!"); 
            }); 
		
		
		
		});
	
	</script>

</head>

<body>
	<div class="navbar">
		<ul>
			
			<li><a href="content/svs3_statistic_all.php" id="stats" alt="Statistik"><img src="resources/design/reports.png" /></a></li>
			<li><a href="content/svs3_charts.php" id="reports" alt="Berichte"><img src="resources/design/taskManager.png" /></a></li>
			<li><a href="content/svs3_stats_gameday.php" id="gamedays" alt="Spieltage"><img src="resources/design/calendar.png" /></a></li>
			<li><a href="content/svs3_goals.php" id="rankings" alt="Tore">Rankings</a></li>


		<!--	<li><a href="content/svs3_fussball_de.php" id="fussball_de">Fu&szlig;ball.de</a></li> -->

		</ul>
	<div class="clear"></div>
	</div>

<div id="content">
	<div id="scroller"></div>
</div>
<div id="footer">
<img src="resources/design/printer.png" id="print" height="40" width="auto"/>
</div>



</body>
</html>