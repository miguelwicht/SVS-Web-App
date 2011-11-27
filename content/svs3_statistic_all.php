<?php
include("../mysql/dbConnect.php");
mysql_query("set names utf8;"); 


$query = "SELECT p.firstName AS firstName, p.lastName AS lastName, COUNT(DISTINCT pa.participant_id) AS participations, COUNT(DISTINCT g.goal_id) AS goals, COUNT(DISTINCT a.assist_id) AS assists, COUNT(DISTINCT y.yellow_id) AS yellow, COUNT(DISTINCT r.red_id) AS red, COUNT(DISTINCT t.trikots_id) AS trikots FROM svs3_1112_gamedayParticipants AS pa LEFT JOIN svs3_1112_player AS p ON pa.player_id = p.id LEFT JOIN svs3_1112_goals AS g ON p.id = g.player_id LEFT JOIN svs3_1112_assists AS a ON p.id = a.player_id LEFT JOIN svs3_1112_yellow AS y ON p.id = y.player_id LEFT JOIN svs3_1112_red AS r ON p.id = r.player_id LEFT JOIN svs3_1112_trikots AS t ON p.id = t.player_id GROUP BY p.id ORDER BY lastName ASC";

$result=mysql_query($query);
echo mysql_error();

$statistic = array();
	while ($row = mysql_fetch_assoc($result)) {
	$statistic[]= $row;
}
mysql_close();
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

<?php
$i=0;
$count=1;
$max = count($statistic);
while ($i < $max) {

?>
<?php if ($count&1) $class = "odd";?>
  <tr class="<? echo $class;?>">
 		<td><?php echo $count;?></td>
	 	<td><?php echo $statistic[$i]['lastName'];?></td>
	 	<td><?php echo $statistic[$i]['firstName'];?></td>
	 	<td><?php echo $statistic[$i]['participations'];?></td>
	 	<td><?php echo $statistic[$i]['goals'];?></td>
	 	<td><?php echo $statistic[$i]['assists'];?></td>
	 	<td><?php echo $statistic[$i]['yellow']?></td>
	 	<td><?php echo $statistic[$i]['red']?></td>
	 	<td><?php echo $statistic[$i]['trikots']?></td>
  </tr>
<?php 
	$class = "even"; 	
	$count++;
	$i++;
	}
?>
</table>


