<?
include("mysql/dbConnect.php");
$id=$_POST['id'];
$lastName=$_POST['lastName'];
$firstName=$_POST['firstName'];
$query="INSERT INTO svs3_1112_player VALUES ('$id','$lastName', '$firstName')";
mysql_query("set names utf8;"); 
mysql_query($query);

mysql_close();
?>



