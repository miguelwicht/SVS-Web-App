<? 
$cachefile ="svs3_stats_gameday.html";
ob_start();

?>
<?
include("../mysql/dbConnect.php");
mysql_query("set names utf8;"); 

$query="SELECT * FROM svs3_1112_player ORDER BY lastName ASC";
$result=mysql_query($query);
$num=mysql_numrows($result);

?>

<? 
//get number of gamedays
$gamedays_count_query="SELECT COUNT(*) FROM svs3_1112_gamedays";
$gamedays_count_result=mysql_query($gamedays_count_query);
$gamedays_count=mysql_result($gamedays_count_result,0);

?>


<ul>

		<?
		$opponent_query="SELECT * FROM svs3_1112_opponents ORDER BY id ASC";
		$opponent_result=mysql_query($opponent_query);
		$opponent_num=mysql_numrows($opponent_result);
		
		$opponents = array(); /* initialize empty array */
		while($opponent = mysql_fetch_assoc($opponent_result)) { /* iterating only once over the result set! */
			$opponents[] = $opponent;
		}
		?>





<?

for ($z=1; $z<=$gamedays_count; $z++){

$gameday_opponent_query="SELECT * FROM svs3_1112_gamedays WHERE gameday ='$z'";
$gameday_opponent_result=mysql_query($gameday_opponent_query);



$gegner=mysql_result($gameday_opponent_result,0,'opponent');


$gameday_opponent[$z]['opponent']= $opponents[$gegner-1]['club'];
$gameday_opponent[$z]['date']=mysql_result($gameday_opponent_result,0,'date');
$gameday_opponent[$z]['home']=mysql_result($gameday_opponent_result,0,'home');
$gameday_opponent[$z]['opponentGoals']=mysql_result($gameday_opponent_result,0,'opponentGoals');


$ownGoals_query="SELECT COUNT(*) FROM svs3_1112_ownGoals WHERE gameday ='$z'";
$ownGoals_result=mysql_query($ownGoals_query);
$ownGoals_count=mysql_result($ownGoals_result,0);



$goals_result_query="SELECT COUNT(*) FROM svs3_1112_goals WHERE gameday_id = '$z'";
$goals_result_result=mysql_query($goals_result_query);
$goals_result_count=mysql_result($goals_result_result,0);





?>





<li>

<? 


if ($gameday_opponent[$z]['home']){

echo '<h3 class="gameday_headline">Spieltag '.$z.' - ['.($goals_result_count+$ownGoals_count).' : '.$gameday_opponent[$z]['opponentGoals'].'] SVS III  gg. '.$gameday_opponent[$z]['opponent'].'</h3>'; 
} else {
echo '<h3 class="gameday_headline">Spieltag '.$z.' - ['.$gameday_opponent[$z]['opponentGoals'].' : '.($goals_result_count+$ownGoals_count).'] '.$gameday_opponent[$z]['opponent'].' gg. SVS III</h3>';


}

?>
</li>
<li class="gameday_li">
	<table>
	<tr>
		<th>Nr.</th>
		<th>Name</th>
		<th>T</th>
		<th>V</th>
		<th>G</th>
		<th>R</th>
	</tr>




<?
$i=0;
$count=1;


//get number of participants
$participants_count_query="SELECT COUNT(*) FROM svs3_1112_gamedayParticipants WHERE gameday_id = '$z'";
$participants_count_result=mysql_query($participants_count_query);
$participants_count=mysql_result($participants_count_result,0);




while ($i <= $participants_count-1) { //limit loop to number of participants

//$id=mysql_result($result,$i,"id");



//get participants for specific game
$participants_query="SELECT * FROM svs3_1112_gamedayParticipants WHERE gameday_id = '$z'";
$participants_result=mysql_query($participants_query);
$participants[] = mysql_result($participants_result,$i,"player_id");


$participants_names_query = "SELECT * FROM svs3_1112_player WHERE id = '$participants[$i]'";
$participants_names_result = mysql_query($participants_names_query);
$firstName = mysql_result($participants_names_result,0,"firstName");
$lastName = mysql_result($participants_names_result,0,"lastName");
$participants_names[$participants[$i]] = $lastName.', '.$firstName;


$goals_query="SELECT COUNT(*) FROM svs3_1112_goals WHERE player_id = '$participants[$i]' && gameday_id = '$z'";
$goals_result=mysql_query($goals_query);
$goals_count=mysql_result($goals_result,0);

$participants_goals[$participants[$i]] = $goals_count;

$assists_query="SELECT COUNT(*) FROM svs3_1112_assists WHERE player_id = '$participants[$i]' && gameday_id = '$z'";
$assists_result=mysql_query($assists_query);
$assists_count=mysql_result($assists_result,0);

$participants_assists[$participants[$i]] = $assists_count;


$yellow_query="SELECT COUNT(*) FROM svs3_1112_yellow WHERE player_id = '$participants[$i]' && gameday_id = '$z'";
$yellow_result=mysql_query($yellow_query);
$yellow_count=mysql_result($yellow_result,0);

$participants_yellow[$participants[$i]] = $yellow_count;

$red_query="SELECT COUNT(*) FROM svs3_1112_red WHERE player_id = '$participants[$i]' && gameday_id = '$z'";
$red_result=mysql_query($red_query);
$red_count=mysql_result($red_result,0);

$participants_red[$participants[$i]] = $red_count;

//$trikots_query="SELECT COUNT(*) FROM svs3_1112_trikots WHERE player_id = '$participants[$i]' && gameday_id = '1'";
//$trikots_result=mysql_query($trikots_query);
//$trikots_count=mysql_result($trikots_result,0);


?>
			
		<?  if ($participants_count > 0) { ?>

        	<? if ($count&1) $class = "odd";?>
            <tr class="<? echo $class;?>">
           		<td><? echo $count ?></td>
           		<td><? echo $participants_names[$participants[$i]];?></td>
          		<td><? echo $participants_goals[$participants[$i]];?></td>
          		<td><? echo $participants_assists[$participants[$i]];?></td>
          		<td><? echo $participants_yellow[$participants[$i]];?></td>
          		<td><? echo $participants_red[$participants[$i]];?></td>
            </tr>
            
            <? $class = "even" ?>
	
		<? 
		$count++;
		} 
		?>
<?
$i++;
}

?>
</table>

<? 


unset($participants);
unset($particioants_names);
unset($particioants_goals);
unset($particioants_assists);
unset($particioants_yellow);
unset($particioants_red);
echo '</li>';
} //for $z end
mysql_close();
?>
</ul>

<? 

$fp =fopen($cachefile,'w');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush();

?>