<?
include("mysql/dbConnect.php");

mysql_query("set names utf8;"); 
$gameday=$_POST['gameday'];
$date=$_POST['date'];
$home=$_POST['home'];
$opponent=$_POST['opponent'];
$opponentGoals=$_POST['opponentGoals2'];

$query="UPDATE `svs3_1112_gamedays` SET  `opponentGoals` ='$opponentGoals' WHERE `gameday` ='$gameday'";
$sql = "UPDATE `db123072x1322454`.`svs3_1112_gamedays` SET `gameday` = \'4\' WHERE `svs3_1112_gamedays`.`gameday` = 0;";
mysql_query($query) or die(mysql_error());
echo mysql_error();
echo 'test'.$opponentGoals2;
for ($z=0; $z<=14; $z++){
	
	
	
	$gameday=$_POST['gameday'];
	$player=$_POST['player'.$z];
	$query="INSERT INTO svs3_1112_gamedayParticipants VALUES ('','$gameday','$player')";
	
	if ($player!='-leer-'){
	
	mysql_query("set names utf8;"); 
	mysql_query($query);



	$player=$_POST['player'.$z];
	$goals=$_POST['goals'.$z];
	for ($i=1; $i<=$goals; $i++){
		$query="INSERT INTO svs3_1112_goals VALUES ('','$gameday','$player')";
	
		mysql_query("set names utf8;"); 
		mysql_query($query);
	}



	$player=$_POST['player'.$z];
	$assists=$_POST['assists'.$z];
	for ($i=1; $i<=$assists; $i++){
		$query="INSERT INTO svs3_1112_assists VALUES ('','$gameday','$player')";

		mysql_query("set names utf8;"); 
		mysql_query($query);
	}

	
	$player=$_POST['player'.$z];
	$red=$_POST['red'.$z];
	for ($i=1; $i<=$red; $i++){
		$query="INSERT INTO svs3_1112_red VALUES ('','$gameday','$player')";

		mysql_query("set names utf8;"); 
		mysql_query($query);
	}

	$player=$_POST['player'.$z];
	$yellow=$_POST['yellow'.$z];
	for ($i=1; $i<=$yellow; $i++){
		$query="INSERT INTO svs3_1112_yellow VALUES ('','$gameday','$player')";

		mysql_query("set names utf8;"); 
		mysql_query($query);
	}
	$trikots=$_POST['trikots'.$z];
	if ($trikots=='1'){
		$query="INSERT INTO svs3_1112_trikots VALUES ('','$gameday','$player')";

		mysql_query("set names utf8;"); 
		mysql_query($query);
	}
	
	
	
	
	
	}
}

mysql_close();
?>
<?
include("svs3_charts.php");
include("svs3_goals.php");
include("svs3_statistic_all.php");
include("svs3_stats_gameday.php");
?>
