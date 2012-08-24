<?php
	$_REQUEST['title'] = "Main";
	include 'connect.php';
	include 'header.php';
	include 'lib.php';
?>

<!------------------------------------------------------------------------------------------------------
 List filtered Questions form
------------------------------------------------------------------------------------------------------->

<form action='list.php' method='POST'>
	<table border=1>
		<tr>
			<th colspan=3>List Questions</th>
		</tr>
		<tr>
			<th>Technology</th>		<th>Diff_low</th>	<th>Diff_high</th>
		</tr>
			<?php
				$maxTech = mysql_fetch_array(mysql_query("SELECT MAX(T.id) AS id from tech AS T"))['id'];
				for ($t=1; $t<=$maxTech; $t++) {
					echo "<tr>";
					echo "<td>"; echo mysql_fetch_array(mysql_query("SELECT T.name FROM tech AS T WHERE T.id=$t"))['name']; echo "</td>";
					echo "<td>"; listDiffs("diff_low$t"); echo "</td>";
					echo "<td>"; listDiffs("diff_high$t"); echo "</td>";
					echo "</tr>";
				}
			?>
		<tr>
			<td>Limit: <input name="limit" type='text' size='4' /></td>
			<td><input type="checkbox" name="strictness" value="strict" /> Strict?</td>
			<td>
				<input type='submit' value='List' />
				<input type='hidden' name='title' value='Listing' />
			</td>
		</tr>
	</table/>
</form>

<!------------------------------------------------------------------------------------------------------
 End of Listing form. Question Insert form follows
------------------------------------------------------------------------------------------------------->

<form action='qinsert.php' method='POST'>
	<table border=1>
		<tr>
			<th colspan=4>Insert Question</th>
		</tr>
		<tr>
		<th>Question</th>	<td colspan="3"><input size="50" type='text' name="question" /></td>
		</tr>
			<?php
				$result = mysql_query("SELECT T.id, T.name from TECH as T");
				while ($row = mysql_fetch_array($result)) {
					$id = $row['id']; $name = $row['name'];
					echo "<tr><th>Tech</th><td><input type='hidden' name='tech$id' value='$id'>$name</td>";
					echo "<th>Diff</th><td>"; listDiffs("diff$id"); echo"</td></tr>";
				}
			?>
			<td colspan="4">
				<input type="submit" value="Insert Question" />
			</td>
		</tr>
	</table>
	<input type='hidden' name='title' value='Insert Question'>
</form>

<!------------------------------------------------------------------------------------------------------
 End of Question Insert form. Tech Insert form follows.
------------------------------------------------------------------------------------------------------->

<form action='tinsert.php' method='POST'>
	<table border=1>
		<tr>
			<th colspan=2>Insert Tech</th>
		</tr>
		<tr>
			<th>Tech</th>	<td><input size="50" type='text' name="tech" /></td>
		</tr>
		<tr>
			<td colspan='2'> <input type='submit' value='Insert Tech' /> </td>
		</tr>
	</table/>
	<input type='hidden' name="title" value='Insert Tech' />
</form>

<!------------------------------------------------------------------------------------------------------
 List all Questions
------------------------------------------------------------------------------------------------------->

<form action='qlist.php' method="POST">
	<input type='hidden' name='title' value='List All Questions' />
	<input type='submit' value="List All Questions" />
</form>

<?php include 'footer.php'; ?>