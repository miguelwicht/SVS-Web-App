<?
$user="root";
$password="";
$database="svs3";

mysql_connect("localhost",$user,$password);
@mysql_select_db($database) or die( "Unable to select database");
?>