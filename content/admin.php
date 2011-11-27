<ul>
	<li>
<form id="newPlayer" action="svs3_addPlayer.php" method="post">
<fieldset>
	<legend>Neuer Spieler</legend>
	<table>
		<tr>
			<th>Passnummer</th>
			<th>Nachname</th>
			<th>Vorname</th>
		</tr>
		<tr>
			<td><input type="text" name="id" class="inputs"></td>
			<td><input type="text" name="lastName" class="inputs"></td>
			<td><input type="text" name="firstName" class="inputs"></td>
	</table>
	<input type="Submit" title="Hinzuf&uuml;gen" value="Hinzuf&uuml;gen" class="inputs">
</fieldset>
</form>

</li>

<li>



<form id="newGameday" action="svs3_addGameday.php" method="post">
<fieldset>
	<legend>Neuer Spieltag</legend>
	<table>
		<tr>
			<th>Nr.</th>
			<th>Datum</th>
			<th>Heim</th>
			<th>Gegner</th>
			<th>Gegentore</th>
		</tr>
		<tr>
			<td>
				<select name="<? echo 'gameday2';?>" class="inputs">
					<? for ($i=1; $i<=30; $i++){
					echo '<option value="',$i,'">',$i,'</option>';
					} ?>
				</select>
			
			</td>
			<td><input type="date" name="date" class="inputs"></td>
			<td><select name="home" class="inputs">
					<option value="1">Ja</option>
					<option value="0">Nein</option>
				</select>
			
			
			</td>
			
			
			<td>
				<?
				include("../mysql/dbConnect.php");
				mysql_query("set names utf8;"); 

				$query="SELECT * FROM svs3_1112_opponents ORDER BY id ASC";
				$result=mysql_query($query);
				$num=mysql_numrows($result);
				
				$opponents = array(); /* initialize empty array */
				while($opponent = mysql_fetch_assoc($result)) { /* iterating only once over the result set! */
					$opponents[] = $opponent;
				}
				?>
				
				
				<select name="<? echo 'opponent'.$z;?>" class="inputs">
						<option value="-leer-">-leer-</option>
					<? 
						$i=1;
						while ($i < $num) {
						$gegner=$opponents[$i]['club'];
	    				echo '<option value="',$opponents[$i]['id'],'">',$opponents[$i]['club'],'</option>';
						$i++;
						}
					?>
				</select>
				
			</td>	
				
			<td>
				<select name="<? echo 'opponentGoals';?>" class="inputs">
					<? for ($i=0; $i<=20; $i++){
					echo '<option value="',$i,'">',$i,'</option>';
					} ?>
				</select>
			</td>
	</table>
	<input type="Submit" title="Hinzuf&uuml;gen" value="Hinzuf&uuml;gen" class="inputs">
</fieldset>

</form>
</li>
<li>
<form id="newTeam" action="svs3_addGamedayTeam.php" method="post">

<fieldset>
	<legend>Neuer Spieltag (Mannschaft)</legend>
		
	
					<?
					include("../mysql/dbConnect.php");
					mysql_query("set names utf8;"); 

					$query="SELECT * FROM svs3_1112_gamedays ORDER BY gameday ASC";
					$result=mysql_query($query);
					$num=mysql_numrows($result);
					mysql_close();
					$gamedays = array(); /* initialize empty array */
					while($gameday = mysql_fetch_assoc($result)) { /* iterating only once over the result set! */
						$gamedays[] = $gameday;
					}
					?>
	
					<select name="<? echo 'gameday';?>" class="inputs">
							<option value="-leer-">-leer-</option>
						<?  
						 	for ($i=0; $i<$num; $i++){ 
		    				if ($gamedays[$i]['home']==1) {
								echo '<option value="',$gamedays[$i]['gameday'],'">',$gamedays[$i]['date'],' - SVS III gg. ',$opponents[$gamedays[$i]['opponent']-1]['club'],'</option>';
							} else {
								echo '<option value="',$gamedays[$i]['gameday'],'">',$gamedays[$i]['date'],' - ',$opponents[$gamedays[$i]['opponent']-1]['club'],' gg. SVS III','</option>';
							}
							
							
							}
						?>
					</select>
					
					<select name="<? echo 'opponentGoals2';?>" class="inputs">
						<? for ($i=0; $i<=20; $i++){
						echo '<option value="',$i,'">',$i,'</option>';
						} ?>
					</select>
					
					
					
	<?
		include("../mysql/dbConnect.php");
		mysql_query("set names utf8;"); 
		$query="SELECT * FROM svs3_1112_player ORDER BY lastName ASC";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		mysql_close();

		$players = array(); /* initialize empty array */
		while($player = mysql_fetch_assoc($result)) { /* iterating only once over the result set! */
			$players[] = $player;
		}

	?>
					
					
					
	<table>
		<tr>
			<th>Nr.</th>
			<th>Spieler</th>
			
			<th>Tore</th>
			<th>Vorlagen</th>
			<th>Gelbe Karten</th>		
			<th>Rote Karte</th>
			<th>Trikots</th>
		</tr>
		
		<? for ($z=0; $z<=14; $z++){ ?>
		<tr>
			<td><? echo $z+1; ?></td>
			<td>
				<select name="<? echo 'player'.$z;?>" class="inputs">
						<option value="-leer-">-leer-</option>
					<? 
						$i=0;
						while ($i < $num) {
						$name=$players[$i]['lastName'].', '.$players[$i]['firstName'];
	    				echo '<option value="',$players[$i]['id'],'">',$name,'</option>';
						$i++;
						}
					?>
				</select>
			</td>
			
			<td>
				<select name="<? echo 'goals'.$z;?>" class="inputs">
					<? for ($i=0; $i<=10; $i++){
					echo '<option value="',$i,'">',$i,'</option>';
					} ?>
				</select>
			</td>
			<td>
				<select name="<? echo 'assists'.$z;?>" class="inputs">
					<? for ($i=0; $i<=10; $i++){
					echo '<option value="',$i,'">',$i,'</option>';
					} ?>
				</select>
			</td>
			<td>
				<select name="<? echo 'yellow'.$z;?>" class="inputs">
					<? for ($i=0; $i<=2; $i++){
					echo '<option value="',$i,'">',$i,'</option>';
					} ?>
				</select>
			</td>
			<td>
				<select name="<? echo 'red'.$z;?>" class="inputs">
					<? for ($i=0; $i<=1; $i++){
					echo '<option value="',$i,'">',$i,'</option>';
					} ?>
				</select>
			</td>
			<td>
				<select name="<? echo 'trikots'.$z;?>" class="inputs">
					<option value="0">Nein</option>
					<option value="1">Ja</option>
				</select>
			</td>
			
			</tr>
			
			<? } ?>
	</table>
	<input type="Submit" title="Hinzuf&uuml;gen" value="Hinzuf&uuml;gen" class="inputs">
</fieldset>
</form>
<form id="update" action="content/update.php" method="post">
<input type="submit" title="Update" name="submit" value="Update" class="inputs">
</form>
</li>
</ul>

