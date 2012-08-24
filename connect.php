<?php
$con = mysql_connect("localhost","root","root");
if (!$con) {
	die('Could not connect: ' . mysql_error());
} else {
	$selected = mysql_select_db("RI", $con);
	if (!$selected) {
		die('Cannot use database: ' . mysql_error());
	} else {
		$_REQUEST['dbh'] = $con;
	}
}
?>