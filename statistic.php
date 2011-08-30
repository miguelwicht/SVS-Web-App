<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html manifest="svs.appcache">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="apple-mobile-web-app-capable" 
      content="yes" />
      <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;"/>
<title>Statistik der 3. Mannschaft</title>
<link rel="stylesheet" type="text/css" href="statistic.css" />
<style type="text/css">

</style>
</head>

<body>

<?
include("dbConnect.php");
$query="SELECT * FROM svs3_stats ORDER BY lastName ASC";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>


	<table>
	<tr>
		<th>Nachname</th>
		<th>Vorname</th>
		<th>E</th>
		<th>T</th>
		<th>V</th>
		<th>G</th>
		<th>R</th>
		<th>Tr.W</th>
		<th>Tr.W1</th>
		<th>Tr.W2</th>
		<th>Tr.W3</th>
	</tr>




<?
$i=0;
while ($i < $num) {
$id=mysql_result($result,$i,"id");
$lastName=mysql_result($result,$i,"lastName");
$firstName=mysql_result($result,$i,"firstName");
$played=mysql_result($result,$i,"played");
$goals=mysql_result($result,$i,"goals");
$assists=mysql_result($result,$i,"assists");
$yellow=mysql_result($result,$i,"yellow");
$red=mysql_result($result,$i,"red");
$trikotsCount=mysql_result($result,$i,"trikotsCount");
$trikotsLoc1=mysql_result($result,$i,"trikotsLoc1");
$trikotsLoc2=mysql_result($result,$i,"trikotsLoc2");
$trikotsLoc3=mysql_result($result,$i,"trikotsLoc3");
?>


        	<? if ($i&1) $class = "odd";?>
            <tr class="<? echo $class;?>">
            <td><? echo $lastName;?></td>
            <td><? echo $firstName;?></td>
            <td><? echo $played;?></td>
            <td><? echo $goals;?></td>
            <td><? echo $assists;?></td>
            <td><? echo $yellow;?></td>
            <td><? echo $red;?></td>
            <td><? echo $trikotsCount;?></td>
            <td><? echo $trikotsLoc1;?></td>
            <td><? echo $trikotsLoc2;?></td>
            <td><? echo $trikotsLoc3;?></td>
            </tr>
            
            <? $class = "even" ?>

<?
$i++;
}

?>


</table>

</br>

<form action="addPlayer.php" method="post">
<fieldset>
	<legend>Neuer Spieler</legend>
	<table>
	<tr>
		<th>Nachname</th>
		<th>Vorname</th>
		<th>E</th>
		<th>T</th>
		<th>V</th>
		<th>G</th>
		<th>R</th>
		<th>Tr.W</th>
		<th>Tr.W1</th>
	</tr>
	<tr>
	<td><input type="text" name="lastName"></td>
	<td><input type="text" name="firstName"></td>
	<td>
		<select name="played">
			<? for ($games = 1; $games <= 30; $games++) {
	    	echo '<option value="',$games,'">', $games, '</option>';
			};
			?>
		</select>
	</td>
	<td>
		<select name="goals">
			<? for ($goals = 0; $goals <= 30; $goals++) {
	   		echo '<option value="',$goals,'">', $goals, '</option>';
			};
			?>
		</select>
	</td>
	
	<td>
		<select name="assists">
			<? for ($assists = 0; $assists <= 30; $assists++) {
	   		echo '<option value="',$assists,'">', $assists, '</option>';
			};
			?>
		</select>
	</td>
	<td>
		<select name="yellow">
			<? for ($yellow = 0; $yellow <= 30; $yellow++) {
	  		 echo '<option value="',$yellow,'">', $yellow, '</option>';
			};
			?>
		</select>
	</td>
	
	<td>
		<select name="red">
			<? for ($red = 0; $red <= 30; $red++) {
	    	echo '<option value="',$red,'">', $red, '</option>';
			};
			?>
		</select>
	</td>
	
	<td>
		<select name="trikotsCount">
			<? for ($trikotsCount = 0; $trikotsCount <= 3; $trikotsCount++) {
	   	 	echo '<option value="',$trikotsCount,'">', $trikotsCount, '</option>';
			};
			?>
		</select>
	</td>
	
	<td>
		<input type="text" name="trikotsLoc1">  
	</td>
		
	
	</tr>
	</table>
	<input type="Submit" title="Hinzuf&uuml;gen" value="Hinzuf&uuml;gen">
</fieldset>
</form>

</div>


</body>
</html>