<?php
	include 'connect.php';
	include 'header.php';
	
	$query = "SELECT Q.question FROM question as Q";
	$result = mysql_query($query);
?>

<table border=1>
<tr><th>Questions</th></tr>
<?php
	while ($row = mysql_fetch_array($result)) {
		$q = $row['question'];
		echo "<tr><td>$q</td></tr>";
	}
?>
</table>

<?php include 'footer.php'; ?>