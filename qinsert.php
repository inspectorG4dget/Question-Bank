<?php
	include 'connect.php';
	include 'header.php';
	
	$q = $_REQUEST['question'];	// the actual question text
// 	$dbh = $_REQUEST['dbh'];	// for prepared statements
	
	// not auto-incrementing QUESTION.id. So get the max and add one for insertion
	$qid = mysql_fetch_array(mysql_query("SELECT MAX(Q.id) as id FROM QUESTION Q"))['id'] +1;
		
//  	$insert1 = $dbh->prepare("INSERT INTO QUESTION (id, question) VALUES (:id, :name)");
//  	$insert1->bindParam(":id", $qid); $insert1->bindParam(":question", $q);
//  	$insert1->execute();
 	mysql_query("INSERT INTO QUESTION (id, question) VALUES ($qid, '$q')");

	if (mysql_errno() == 1062) {	// duplicate question
?>

<table border=1>
	<tr>
		<th>Insert Error</th>
	</tr>
	<tr>
		<td>
			MySQL Error 1062<br/>
			Cannot add duplicate values <br/>
			'<?= $q ?>' already exists <br/>
			at ID <?= mysql_fetch_array(mysql_query("SELECT id FROM question WHERE question='$q'"))['id'] ?>
		</td>
	</tr>
</table>

<?php
	} else {	// no duplicate errors. Insert the question
		echo "<table border=1><tr><th colspan=4>Insertion Complete</th></tr>";
		echo "<tr><th>Question</th><td colspan=3>$q</td></tr>";
		echo "<tr><th>ID</th><td>$qid</td></tr>";
		$maxTech = mysql_fetch_array(mysql_query("SELECT MAX(T.id) AS id FROM tech as T"))['id'];
		for ($t=1; $t<=$maxTech; $t++) {
			$tech = $_REQUEST["tech$t"];	// TECH.id
			$diff = $_REQUEST["diff$t"];	// DIFFICULTY.degree
			$techName = mysql_fetch_array(mysql_query("SELECT T.name FROM tech AS T WHERE T.id=$tech"))['name'];	// TECH.name for displaying insertion confirmation
			
			if ($diff != 0) {	// difficulty set. Not to be ignored
				mysql_query("INSERT INTO difficulty (question, tech, degree) VALUES ($qid, $tech, $diff)");
				echo "<tr><th>Tech</th><td>$techName</td><th>Diff</th><td>$diff</td></tr>";
			}
		}
		echo "</table>";
	}
?>

<?php include 'footer.php'; ?>