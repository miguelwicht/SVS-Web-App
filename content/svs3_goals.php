<?php 
$cachefile ="svs3_goals.html";
ob_start();

include("../mysql/dbConnect.php");
mysql_query("set names utf8;"); 

$queries = array();
$queries['participations']	= "SELECT p.firstName, p.lastName, COUNT(pa.participant_id) AS participations FROM svs3_1112_gamedayParticipants AS pa LEFT JOIN svs3_1112_player AS p ON pa.player_id = p.id GROUP BY p.id ORDER BY participations DESC LIMIT 5";
$queries['goals']		= "SELECT p.firstName, p.lastName, COUNT(g.goal_id) AS goals FROM svs3_1112_goals AS g LEFT JOIN svs3_1112_player AS p ON g.player_id = p.id GROUP BY p.id ORDER BY goals DESC LIMIT 5";
$queries['assists']		= "SELECT p.firstName, p.lastName, COUNT(a.assist_id) AS assists FROM svs3_1112_assists AS a LEFT JOIN svs3_1112_player AS p ON a.player_id = p.id GROUP BY p.id ORDER BY assists DESC LIMIT 5";
$queries['yellow']		= "SELECT p.firstName, p.lastName, COUNT(y.yellow_id) AS yellow FROM svs3_1112_yellow AS y LEFT JOIN svs3_1112_player AS p ON y.player_id = p.id GROUP BY p.id ORDER BY yellow DESC LIMIT 5";
$queries['red']			= "SELECT p.firstName, p.lastName, COUNT(r.red_id) AS red FROM svs3_1112_red AS r LEFT JOIN svs3_1112_player AS p ON r.player_id = p.id GROUP BY p.id ORDER BY red DESC LIMIT 5";

$headers = array(
	'participations'=> 'Teilnamen', // not used?!
	'assists'	=> 'Vorlagen',
	'goals'		=> 'Tore',
	'yellow'	=> 'Gelbe',
	'red'		=> 'Rote'
);
?>

<ul>

<?php

foreach ($queries as $section => $query) {
	$result = mysql_query($query);

	echo mysql_error();

?>

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
			<th><?php echo $headers[$section]; ?></th>
		</tr>

<?php
	$i = 0;
	while ($row = mysql_fetch_assoc($result)) {
?>

		<tr class="<?php echo ($i++ % 2) ? "even" : "odd"; ?>">
			<td><?php echo $i; ?></td>
			<td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
			<td><?php echo $row[$section]; ?></td>
		</tr>

<?php } ?>
	</table>
</li>

<?php } ?>

</ul>

<?php

mysql_close();

$fp=fopen($cachefile,'w');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush();

?>
