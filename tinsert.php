<?php
	include 'connect.php';
	include 'header.php';
	
	$tech = strtolower($_REQUEST['tech']);
	
	if(strcmp($tech, '') != 0) {
		// not auto-incrementing question IDs. So get the max and add one for insertion
		$tid = mysql_fetch_array(mysql_query("SELECT MAX(T.id) as id FROM TECH T"))['id'] +1;
		
// 	 	$insert1 = PDO::prepare("INSERT INTO TECH (id, name) VALUES (:id, :tech)");
// 	 	$insert1->bindParam(":id", $tid); $insert1->bindParam(":tech", $tech);
//	 	$insert1->execute();
		
		mysql_query("INSERT INTO TECH (id, name) VALUES ($tid, '$tech')");
		if (mysql_errno() == 1062) {
			$inserted = 0; // already exists
		} else {
			$inserted = 1;	// inserted
		}
		
	} else {
		$inserted = -1; // empty string
	}
?>
<table border=1>
	<tr>
		<th>Insert Results</th>
	</tr>
	<tr>
		<td>
			<?php
				switch ($inserted) {
					case -1:
						echo "Empty string will not be inserted";
						break;
					case 0:
						echo "'$tech' already exists. Will not be re-inserted";
						break;
					case 1:
						echo "'$tech' successfully inserted with ID='$tid'";
						break;
				}
			?>
		</td>
	</tr>
</table>
<?php
	include 'footer.php';
?>