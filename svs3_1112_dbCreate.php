<?
$user="s123072_1322454";
$password="QX96aC";
$database="db123072x1322454";
mysql_connect("mysql11.1blu.de",$user,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="CREATE TABLE svs3_1112_player (id int(6) NOT NULL auto_increment,lastName varchar(20),firstName varchar(20),PRIMARY KEY (id),UNIQUE id (id))";
mysql_query($query);

$query="CREATE TABLE svs3_1112_gamedays (gameday int(6) NOT NULL auto_increment,date varchar(20),home varchar(20),opponent varchar(20),opponentGoals varchar(20),PRIMARY KEY (gameday),UNIQUE id (gameday))";
mysql_query($query);

mysql_close();
?> 