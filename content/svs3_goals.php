<? 
$cachefile ="svs3_goals.html";
ob_start();

?>
<?
include("../mysql/dbConnect.php");
mysql_query("set names utf8;"); 

$query="SELECT * FROM svs3_1112_player ORDER BY lastName ASC";
$result=mysql_query($query);
$num=mysql_numrows($result);

?>
<ul>
	<li>
	<table>
	<colgroup>
    	<col width="10">
    	<col width="50%">
    	<col >
 	 </colgroup>
	<tr style="background-color:silver">
		<th class="num"></th>
		<th>Name</th>
		<th>Vorlagen</th>
	</tr>




<?
$i=0;
$count=1;

while ($i < $num) {

$id=(string)mysql_result($result,$i,"id");

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


$lastName=mysql_result($result,$i,"lastName");
$firstName=mysql_result($result,$i,"firstName");

$fullName[$id] = $lastName.', '.$firstName;
$ids[]=$id;
$goals[$id]=$goals_count;

$allGoals[$id]['name'] = $fullName[$id];
$allGoals[$id]['goals'] = $goals_count;

$allAssists[$id]['name'] = $fullName[$id];
$allAssists[$id]['assists'] = $assists_count;

$mostCards[$id]['name'] = $fullName[$id];
$mostCards[$id]['yellow'] = $yellow_count;
$mostCards[$id]['red'] = $red_count;

$i++;
}
mysql_close();
?>


<? 
	foreach ($allAssists as $key => $row) {
    $newAssists[$key]    = $row['assists'];
    $newAssistNames[$key] = $row['name'];
	}
	
	array_multisort($newAssists, SORT_DESC, $newAssistNames, SORT_ASC, $allAssists);
	for($i=0; $i<5; $i++){ ?>
	<? if ($i+1&1) $class = "odd";?>
	<tr class="<? echo $class;?>">
		<td><? echo $i+1; ?></td>
		<td><? echo $allAssists[$i]['name'];?></td>
		<td><? echo $allAssists[$i]['assists'];?></td>
	
	
	</tr>
	<? $class = "even" ?>
	<? } ?>
</table>
</li>
<li>

<table>
		<colgroup>
    	<col width="10">
    	<col width="50%">
    	<col >
 	 </colgroup>
	<tr style="background-color:silver">
		<th></th>
		<th>Name</th>
		<th>Tore</th>
	</tr>
	<? 
	foreach ($allGoals as $key => $row) {
    $newGoals[$key]    = $row['goals'];
    $newNames[$key] = $row['name'];
	}
	
	array_multisort($newGoals, SORT_DESC, $newNames, SORT_ASC, $allGoals);
	for($i=0; $i<5; $i++){ ?>
	<? if ($i+1&1) $class = "odd";?>
	<tr class="<? echo $class;?>">
		<td><? echo $i+1; ?></td>
		<td><? echo $allGoals[$i]['name'];?></td>
		<td><? echo $allGoals[$i]['goals'];?></td>
	</tr>
	<? $class = "even" ?>
	<? } ?>
</table>
</li>
<li>
<table>
	<colgroup>
    	<col width="10">
    	<col width="50%">
    	<col >
 	 </colgroup>
	<tr style="background-color:silver">
		<th></th>
		<th>Name</th>
		<th>Gelbe</th>
	</tr>
	<? 
	foreach ($mostCards as $key => $row) {
    $newYellow[$key]    = $row['yellow'];
    $newYellowNames[$key] = $row['name'];
	}
	
	array_multisort($newYellow, SORT_DESC, $newYellowNames, SORT_ASC, $mostCards);
	for($i=0; $i<5; $i++){ ?>
	<? if ($i+1&1) $class = "odd";?>
	<tr class="<? echo $class;?>">
		<td><? echo $i+1; ?></td>
		<td><? echo $mostCards[$i]['name'];?></td>
		<td><? echo $mostCards[$i]['yellow'];?></td>
	</tr>
	<? $class = "even" ?>
	<? } ?>
</table>
</li>
<li>
<table>
	<colgroup>
    	<col width="10">
    	<col width="50%">
    	<col >
 	 </colgroup>
	<tr style="background-color:silver">
		<th></th>
		<th>Name</th>
		<th>Rote</th>
	</tr>
	<? 
	foreach ($mostCards as $key => $row) {
    $newRed[$key]    = $row['red'];
    $newRedNames[$key] = $row['name'];
	}
	
	array_multisort($newRed, SORT_DESC, $newRedNames, SORT_ASC, $mostCards);
	for($i=0; $i<5; $i++){ ?>
	<? if ($i+1&1) $class = "odd";?>
	<tr class="<? echo $class;?>">
		<td><? echo $i+1; ?></td>
		<td><? echo $mostCards[$i]['name'];?></td>
		<td><? echo $mostCards[$i]['red'];?></td>
	</tr>
	<? $class = "even" ?>
	<? } ?>
</table>
</li>
</ul>
<? 

$fp =fopen($cachefile,'w');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush();

?>