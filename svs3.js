function addNextPlayerRow(tableRef) {
	var myTable = document.getElementById(tableRef);
	var tBody = myTable.getElementsByTagName('tbody')[0];
	var newTR = document.createElement('tr');
	newTR.innerHTML = '<tr>
			<td>
				<select name="player">
				
					<?
						include("dbConnect.php");
						mysql_query("set names utf8;"); 
						$query="SELECT * FROM svs3_1112_player ORDER BY lastName ASC";
						$result=mysql_query($query);
						$num=mysql_numrows($result);
						mysql_close();
					?>
				
					<? 
						$i=0;
						while ($i < $num) {
					
						$id=mysql_result($result,$i,"id");
						$lastName=mysql_result($result,$i,"lastName");
						$firstName=mysql_result($result,$i,"firstName");
						$name=$lastName.', '.$firstName;
					
					
	    				echo '<option value="',$id,'">', $name, '</option>';
						$i++;
						}
					?>
				</select>
			</td>
			
			<td><input type="text" name="goals"></td>
			<td><input type="text" name="assists"></td>
			<td><input type="text" name="yellow"></td>
			<td><input type="text" name="red"></td>
';



}