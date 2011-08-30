<?
$user="s123072_1322454";
$password="QX96aC";
$database="db123072x1322454";
mysql_connect("mysql11.1blu.de",$user,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="CREATE TABLE svs3_stats (id int(6) NOT NULL auto_increment,lastName varchar(20),firstName varchar(20),played int(6), goals int(6), assists int(6), yellow int(6), red int(6), trikotsCount int(6),trikotsLoc1 varchar(50),trikotsLoc2 varchar(50), trikotsLoc3 varchar(50),PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
mysql_query($query);
mysql_close();
?> 