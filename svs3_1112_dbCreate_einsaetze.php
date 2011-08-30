<?
$user="s123072_1322454";
$password="QX96aC";
$database="db123072x1322454";
mysql_connect("mysql11.1blu.de",$user,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query="CREATE TABLE svs3_1112_gamedayParticipants (participant_id int(6) NOT NULL auto_increment, gameday_id int(6) , player_id varchar(14))";
mysql_query($query);


$query="CREATE TABLE svs3_1112_assists (assist_id int(6) NOT NULL auto_increment, gameday_id int(6),player_id varchar(14),PRIMARY KEY (assist_id))";
mysql_query($query);


$query="CREATE TABLE svs3_1112_goals (goal_id int(6) NOT NULL auto_increment, gameday_id int(6),player_id varchar(14),PRIMARY KEY (goal_id))";
mysql_query($query);


$query="CREATE TABLE svs3_1112_trikots (trikots_id int(6) NOT NULL auto_increment, gameday_id int(6),player_id varchar(14),PRIMARY KEY (trikots_id))";
mysql_query($query);



mysql_close();
?> 