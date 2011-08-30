
<?
include("../mysql/dbConnect.php");
mysql_query("set names utf8;"); 

?>


<? //Tore -> Spiele  Daten aus DB holen
$gamedays_count_query="SELECT COUNT(*) FROM svs3_1112_gamedays";
$gamedays_count_result=mysql_query($gamedays_count_query);
$gamedays_count=mysql_result($gamedays_count_result,0);

for ($i=1; $i <= $gamedays_count; $i++){
	$goals_query="SELECT COUNT(*) FROM svs3_1112_goals WHERE gameday_id = '$i'";
	$goals_result=mysql_query($goals_query);
	$goals_count=mysql_result($goals_result,0);

	$goals_all_games[]=$goals_count;
	$goals_string=$goals_string.$goals_count.', ';


	$opponent_query="SELECT * FROM svs3_1112_gamedays WHERE gameday = '$i'";
	$opponent_result=mysql_query($opponent_query);
	$opponent_goals=mysql_result($opponent_result,0,'opponentGoals');

	$opponent_goals_string=$opponent_goals_string.$opponent_goals.', ';

}


//******************************Spieleranzahl -> Spiele**********************************************

for ($i=1; $i <=$gamedays_count; $i++){
	$player_count_query="SELECT COUNT(*) FROM svs3_1112_gamedayParticipants WHERE gameday_id = '$i'";
	$player_count_result=mysql_query($player_count_query);
	$player_count=mysql_result($player_count_result,0);

	$player_count_string=$player_count_string.$player_count.', ';

}



//****************************** Test ***********************************
	
	$player_count_query="SELECT COUNT(*) FROM svs3_1112_player";
	$player_count_result=mysql_query($player_count_query);
	$player_count=mysql_result($player_count_result,0);
	
	$gamedays_count_query="SELECT COUNT(*) FROM svs3_1112_gamedays";
	$gamedays_count_result=mysql_query($gamedays_count_query);
	$gamedays_count=mysql_result($gamedays_count_result,0);
	

	
	
	$i=0;
	$count=1;
 	while ($i <= $player_count-1) { //limit loop to players
		
		$participants_query="SELECT * FROM svs3_1112_player";
		$participants_result=mysql_query($participants_query);
		$participants[] = mysql_result($participants_result,$i, "id");
		
		
		$participants_names_query = "SELECT * FROM svs3_1112_player WHERE id = '$participants[$i]'";
		$participants_names_result = mysql_query($participants_names_query);
		$firstName = mysql_result($participants_names_result,0,"firstName");
		$lastName = mysql_result($participants_names_result,0,"lastName");
		$participants_names[$participants[$i]] = $lastName.', '.$firstName;
		
		
		for ($j=1; $j <=$gamedays_count; $j++){
		
			$player_goals_query="SELECT COUNT(*) FROM svs3_1112_goals WHERE gameday_id = '$j' AND player_id = '$participants[$i]'";
			$player_goals_result=mysql_query($player_count_query);
			$player_goals_count=mysql_result($player_count_result,0);
		
		
			$player_goals[$participants[$i]] =$player_goals[$participants[$i]].$player_goals_count.', ';
		}

		$i++;
	 }





























//***************************************************************************


/*


for ($z=1; $z<=$gamedays_count; $z++){

	//get number of participants for specific game
	$participants_count_query="SELECT COUNT(*) FROM svs3_1112_gamedayParticipants WHERE gameday_id = '$z'";
	$participants_count_result=mysql_query($participants_count_query);
	$participants_count=mysql_result($participants_count_result,0);




	$i=0;
	$count=1;
 	while ($i <= $participants_count-1) { //limit loop to number of participants


		//get participant_ids for specific game
		$participants_query="SELECT * FROM svs3_1112_gamedayParticipants WHERE gameday_id = '$z'";
		$participants_result=mysql_query($participants_query);
		$participants[] = mysql_result($participants_result,$i,"player_id");


		$participants_names_query = "SELECT * FROM svs3_1112_player WHERE id = '$participants[$i]'";
		$participants_names_result = mysql_query($participants_names_query);
		$firstName = mysql_result($participants_names_result,0,"firstName");
		$lastName = mysql_result($participants_names_result,0,"lastName");
		$participants_names[$participants[$i]] = $lastName.', '.$firstName;

		$player_id = $participants[$i];
		for ($j=1; $j <=$gamedays_count; $j++){
			$player_goals_query="SELECT COUNT(*) FROM svs3_1112_goals WHERE gameday_id = '$j' && player_id= '$participants[$i]'";
			$player_goals_result=mysql_query($player_count_query);
			$player_goals_count=mysql_result($player_count_result,0);

		
			$player_goals[$participants[$i]] =$player_goals[$participants[$i]].$player_goals_count.', ';
		}
		
		
	$i++;
 	}

} //for $z */

mysql_close();
?>

<!- Tore Spiele Javascript ->
<div id="chart-container-1" style="width: 100%; height: 400px"></div>
<div id="chart-container-2" style="width: 100%; height: 400px"></div>
<script type="text/javascript">
chart1 = new Highcharts.Chart({
        			 chart: {
           				 renderTo: 'chart-container-1',
          				  defaultSeriesType: 'line'
        			 },
        			 title: {
           			 text: 'Tore -> Spiele'
       				  },
       				  xAxis: {
            			categories: ['1','2','3','4','5','6','7','8','9'],
            			tickPosition: "inside"
        			 },
        			  yAxis: {
     					  min: 0,
      					  tickInterval: 1,
      					  tickPosition: "inside",
      					  min: -1,
      					  labels: {
                  				y: -1
        						}, 
           					endOnTick: false,
           					maxPadding: 0.2, 
        					title: {
           				 text: null
           				 }
        			},
        			 series: [{
           			 name: 'Tore',
            			data: [<? echo $goals_string; ?>]
        			 }, {
          			  name: 'Gegentore',
            		data: [<? echo $opponent_goals_string; ?>]
        			 },
        			 {
           			 name: 'Spieler',
            			data: [<? echo $player_count_string; ?>]
        			 }
        			 
        			 ]
     				});


chart2 = new Highcharts.Chart({
        			 chart: {
           				 renderTo: 'chart-container-2',
          				  defaultSeriesType: 'line'
        			 },
        			 title: {
           			 text: 'Spieler -> Spiele'
       				  },
       				  xAxis: {
            			categories: ['1','2','3','4','5','6','7','8','9'],
            			tickPosition: "inside"
        			 },
        			  yAxis: {
     					  min: 0,
      					  tickInterval: 1,
      					  tickPosition: "inside",
      					  min: -1,
      					  labels: {
                  				y: -1
        						}, 
           					endOnTick: false,
           					maxPadding: 0.2, 
        					title: {
           				 text: null
           				 }
        			},
        			 series: [{
           			 name: 'Spieler',
            			data: [<? echo $player_count_string; ?>]
        			 }, {
          			  name: '<? echo $participants_names[$participants[5]]; ?>',
            		data: [<? echo $player_goals[$participants[5]]; ?>]
        			 }]
     				});



</script>

<? 
print_r($participants);
print_r($player_goals_count);
?>



