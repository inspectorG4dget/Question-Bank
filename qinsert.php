<?php
	include 'connect.php';
	include 'header.php';
	
	$q = $_REQUEST['question'];
	$tech1 = $_REQUEST['tech1'];
	$diff1 = $_REQUEST['diff1'];
	$tech2 = $_REQUEST['tech2'];
	$diff2 = $_REQUEST['diff2'];
	$dbh = $_REQUEST['dbh'];
	$t1 = false;
	$t2 = false;
// 	$msg = "insertion complete: '$q' at ID";
	
	// not auto-incrementing question IDs. So get the max and add one for insertion
	$qid = mysql_fetch_array(mysql_query("SELECT MAX(Q.id) as id FROM QUESTION Q"))['id'] +1;
// 	$msg = "$msg $qid.";
		
//  	$insert1 = $dbh->prepare("INSERT INTO QUESTION (id, question) VALUES (:id, :name)");
//  	$insert1->bindParam(":id", $qid); $insert1->bindParam(":question", $q);
//  	$insert1->execute();
 	mysql_query("INSERT INTO QUESTION (id, question) VALUES ($qid, '$q')");

	if (mysql_errno() == 1062) {
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
	} else {
		if ($diff1 != 0) {
			$t1 = true;
// 	  		$insert2 = $dbh->prepare("INSERT INTO DIFFICULTY (question, tech, degree) VALUES (:question, :tech, :degree)");
// 	  		$insert2->bindParam(":question", $qid); $insert2->bindParam(":tech", $tech1); $insert2->bindParam(":degree", $diff1);
// 	  		$insert2->execute();
			mysql_query("INSERT INTO DIFFICULTY (question, tech, degree) VALUES ($qid, $tech1, $diff1)");
			
			$tech1 = mysql_fetch_array(mysql_query("SELECT name FROM TECH where id=$tech1"))['name'];
// 		$msg = "$msg With $t1 difficulty = $diff1.";
		}
		
		if($diff2 != 0) {
			$t2 = true;
//  		$insert3 = $dbh->prepare("INSERT INTO DIFFICULTY (question, tech, degree) VALUES (:question, :tech, :degree)");
//  		$insert3->bindParam(":question", $qid); $insert3->bindParam(":tech", $tech2); $insert3->bindParam(":degree", $diff2);
			mysql_query("INSERT INTO DIFFICULTY (question, tech, degree) VALUES ($qid, $tech2, $diff2)");
			
			$tech2 = mysql_fetch_array(mysql_query("SELECT name FROM TECH where id=$tech2"))['name'];
// 		$msg = "$msg With $t2 difficulty = $diff2.";
		}
?>

<table border=1>
	<tr>
		<th colspan=4>Insertion Complete</th>
	<tr>
	<tr>
		<th>Question ID</th>
		<td colspan=3><?= $qid ?></td>
	</tr>
	<tr>
		<th>Question</th>
		<td colspan=3><?= $q ?></td>
	</tr>
	<?php if($t1) { ?>
		<tr>
			<th>Tech 1</th>
			<td><?= $tech1 ?></td>
			<th>Difficulty 1</th>
			<td><?= $diff1 ?></td>
		</tr>
	<?php } ?>
	<?php if($t2) { ?>
		<tr>
			<th>Tech 2</th>
			<td><?= $tech2 ?></td>
			<th>Difficulty 2</th>
			<td><?= $diff2 ?></td>
		</tr>
	<?php } ?>
</table>

<?php } include 'footer.php'; ?>