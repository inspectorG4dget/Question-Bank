<?php
	function listTechs($name) {
		$query = "SELECT id,name from TECH";
		$result = mysql_query($query);
		echo "<select name='$name'>";
		while ($row = mysql_fetch_array($result)) {
			$name = $row['name'];
			$id = $row['id'];
			echo "<option value='$id'>$name</option>";
		}
		echo "</select>";
	}
	
	function listDiffs($name) {
		$diffs = array(0,1,2,3,4,5,6,7,8,9,10);
		echo "<select name='$name'>";
		foreach($diffs as $diff) {
			echo "<option value='$diff'>$diff</option>";
		}
		echo "</select>";
	}
?>