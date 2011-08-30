<?
include("mysql/dbConnect.php");

mysql_query("set names utf8;"); 
$gameday=$_POST['gameday2'];
$date=$_POST['date'];
$home=$_POST['home'];
$opponent=$_POST['opponent'];
$opponentGoals=$_POST['opponentGoals'];
$query="INSERT INTO svs3_1112_gamedays VALUES ('$gameday','$date','$home','$opponent', '$opponentGoals')";

mysql_query($query);

mysql_close();
?>



