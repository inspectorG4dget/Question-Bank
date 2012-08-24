<?php
	include 'header.php';
	include 'connect.php';
	
	mysql_query("INSERT INTO dummy (id, name) VALUES (2, 'blah')");
	
	if (mysql_errno() == 1062) {
		echo "no dups";
	}
	
	include 'footer.php';
?>