<?php
	include 'connect.php';
	include 'header.php';
	
	$techid = $_REQUEST['tech'];
	$techd = $_REQUEST['diff_low'];
	$techD = $_REQUEST['diff_high'];
	$lim = $_REQUEST['limit'];
	
	$query = "SELECT * FROM (
				SELECT Q.question 
				FROM QUESTION Q, TECH T, DIFFICULTY D 
				WHERE 	D.question = Q.id AND 
						D.tech = T.id AND 
						D.tech = $techid AND 
						D.degree BETWEEN $techd AND $techD
				) as Temp
				ORDER BY RAND()
				LIMIT $lim";
	$result = mysql_query($query);
?>

<table border='1'>
<tr><th>Question</th></tr>
<?php
	while($row=mysql_fetch_array($result)) {
		$question = $row['question'];
		echo "<tr><td>$question</td></tr>";
	}
?>
</table>

<?php
	include 'footer.php';
?>