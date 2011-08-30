<?
include("dbConnect.php");

$lastName=$_POST['lastName'];
$firstName=$_POST['firstName'];
$played=$_POST['played'];
$goals=$_POST['goals'];
$assists=$_POST['assists'];
$yellow=$_POST['yellow'];
$red=$_POST['red'];
$trikotsCount=$_POST['trikotsCount'];
$trikotsLoc1=$_POST['trikotsLoc1'];
$trikotsLoc2=$_POST['trikotsLoc2'];
$trikotsLoc3=$_POST['trikotsLoc3'];
$query="INSERT INTO svs3_stats VALUES ('','$lastName', '$firstName', '$played', '$goals', '$assists', '$yellow', '$red', '$trikotsCount', '$trikotsLoc1', '$trikotsLoc2', '$trikotsLoc3')";
mysql_query($query);

mysql_close();
?>



