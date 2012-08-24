<?php
	include 'connect.php';
	include 'header.php';
	
	$maxTech = mysql_fetch_array(mysql_query("SELECT MAX(T.id) AS id FROM tech AS T"))['id']; // highest `tech` index in TECH
	$lim = $_REQUEST['limit'];	// upper bound on number of questions to display
	
	$queryIn = "SELECT Q.question, Q.ID FROM question AS Q";
	$queryOut = "SELECT Q.question, Q.id FROM question AS Q";
	
	if (in_array('strictness', $_REQUEST)) { // strict filtering
		
		// extract TECH.id and the associated difficulty from $_REQUEST
		// this is done for each TECH.id in TECH
		// $_REQUEST contains keys "techN" and "diffN", where N is each TECH.id
		for ($t=1; $t<=$maxTech; $t++) {
			$techd = $_REQUEST["diff_low$t"];	// difficulty lower bound
			$techD = $_REQUEST["diff_high$t"];	// difficulty upper bound
			
			if ($techd != 0 && $techD != 0) {	// if set to defaults, do not consider that `tech`
				$queryIn = "$query
					WHERE question IN (			-- intersect
					SELECT Q.question, Q.id
					FROM QUESTION Q, TECH T, DIFFICULTY D 
					WHERE 	D.question = Q.id AND 
							D.tech = T.id AND 
							D.tech = $t AND 
							D.degree BETWEEN $techd AND $techD
					)
					";
			} else {	// `tech` set to defaults. SetMinus the tech from results
				$queryOut = "$query
							WHERE question NOT IN (	-- setminus. Doesn't work
								SELECT Q.question, Q.id
								FROM QUESTION Q, TECH T, DIFFICULTY D 
								WHERE 	D.question = Q.id AND 
										D.tech = T.id AND 
										D.tech = $t
							)";
			}
		
		// randomized selection and limiting
		$query = "SELECT * FROM (
				$queryIn AS Qin
				WHERE Qin.id NOT IN (SELECT Qout.id from ($queryOut) as Qout ) ) as Temp
				ORDER BY RAND()
				LIMIT $lim";
		}

	} else {	// lenient filtering. Don't have to worry about setMinus
		
		// extract TECH.id and the associated difficulty from $_REQUEST
		// this is done for each TECH.id in TECH
		// $_REQUEST contains keys "techN" and "diffN", where N is each TECH.id
		for ($t=1; $t<=$maxTech; $t++) {
			$techd = $_REQUEST["diff_low$t"];	// difficulty lower bound
			$techD = $_REQUEST["diff_high$t"];	// difficulty upper bound
			
			if ($techd != 0 && $techD != 0) {	// if set to defaults, do not consider that `tech`
				$query = "$query
					WHERE question IN (
					SELECT Q.question 
					FROM QUESTION Q, TECH T, DIFFICULTY D 
					WHERE 	D.question = Q.id AND 
							D.tech = T.id AND 
							D.tech = $t AND 
							D.degree BETWEEN $techd AND $techD
					)
					";
			}
		}
		
		// randomized selection and limiting
		$query = "SELECT * FROM (
				$query ) as Temp
				ORDER BY RAND()
				LIMIT $lim";
	}
	
	$result = mysql_query($query);
?>

<table border='1'>
<tr><th>Question</th></tr>
<?php
	while($row=mysql_fetch_array($result)) { // display all questions from the query result
		$question = $row['question'];
		echo "<tr><td>$question</td></tr>";
	}
?>
</table>

<?php
	include 'footer.php';
?>