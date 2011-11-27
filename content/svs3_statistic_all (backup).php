<? 
$cachefile ="svs3_statistic_all.html";
ob_start();

?>
<?
include("../mysql/dbConnect.php");
mysql_query("set names utf8;"); 

$query="SELECT * FROM svs3_1112_player ORDER BY lastName ASC";
$result=mysql_query($query);
$num=mysql_numrows($result);

?>


	<table>
	<tr>
		<th>Nr.</th>
		<th>Nachname</th>
		<th>Vorname</th>
		<th>E</th>
		<th>T</th>
		<th>V</th>
		<th>G</th>
		<th>R</th>
		<th>Tr.</th>
	</tr>




<?
$i=0;
$count=1;

while ($i < $num) {

$id=mysql_result($result,$i,"id");

$participations_query="SELECT COUNT(*) FROM svs3_1112_gamedayParticipants WHERE player_id = '$id'";
$participations_result=mysql_query($participations_query);
$participations_count=mysql_result($participations_result,0);

$goals_query="SELECT COUNT(*) FROM svs3_1112_goals WHERE player_id = '$id'";
$goals_result=mysql_query($goals_query);
$goals_count=mysql_result($goals_result,0);

$assists_query="SELECT COUNT(*) FROM svs3_1112_assists WHERE player_id = '$id'";
$assists_result=mysql_query($assists_query);
$assists_count=mysql_result($assists_result,0);

$yellow_query="SELECT COUNT(*) FROM svs3_1112_yellow WHERE player_id = '$id'";
$yellow_result=mysql_query($yellow_query);
$yellow_count=mysql_result($yellow_result,0);

$red_query="SELECT COUNT(*) FROM svs3_1112_red WHERE player_id = '$id'";
$red_result=mysql_query($red_query);
$red_count=mysql_result($red_result,0);

$trikots_query="SELECT COUNT(*) FROM svs3_1112_trikots WHERE player_id = '$id'";
$trikots_result=mysql_query($trikots_query);
$trikots_count=mysql_result($trikots_result,0);

$lastName=mysql_result($result,$i,"lastName");
$firstName=mysql_result($result,$i,"firstName");

?>
			
		<? if ($participations_count > 0) { ?>

        	<? if ($count&1) $class = "odd";?>
            <tr class="<? echo $class;?>">
           		<td><? echo $count;?></td>
          	 	<td><? echo $lastName;?></td>
          	 	<td><? echo $firstName;?></td>
          	 	<td><? echo $participations_count;?></td>
          	 	<td><? echo $goals_count;?></td>
          	 	<td><? echo $assists_count;?></td>
          	 	<td><? echo $yellow_count?></td>
          	 	<td><? echo $red_count?></td>
          	 	<td><? echo $trikots_count?></td>
            </tr>
            
            <? $class = "even" ?>
	
		<? 
		$count++;
		} ?>
<?
$i++;
}
mysql_close();
?>
</table>


<? 

$fp =fopen($cachefile,'w');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush();

?>
