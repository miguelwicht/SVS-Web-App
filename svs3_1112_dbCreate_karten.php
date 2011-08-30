<?
$user="s123072_1322454";
$password="QX96aC";
$database="db123072x1322454";
mysql_connect("mysql11.1blu.de",$user,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query="CREATE TABLE svs3_1112_yellow (yellow_id int(6) NOT NULL auto_increment,gameday_id int(6),player_id varchar(14))";
mysql_query($query);


$query="CREATE TABLE svs3_1112_red (red_id int(6) NOT NULL auto_increment,gameday_id int(6),player_id varchar(14))";
mysql_query($query);


mysql_close();
?> 