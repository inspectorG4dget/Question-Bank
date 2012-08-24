<?php
	$_REQUEST['title'] = "Main";
	include 'connect.php';
	include 'header.php';
	include 'lib.php';
?>

<form action='list.php' method='POST'>
	<table border=1>
		<tr>
			<th colspan=4>List Questions</th>
		</tr>
		<tr>
			<th>Technology</th>		<th>Diff_low</th>	<th>Diff_high</th>		<th>Limit</th>
		</tr>
		
		<tr>
			<td> <?php listTechs("tech"); ?> </td>
			<td> <?php listDiffs('diff_low'); ?>
			<td> <?php listDiffs('diff_high'); ?> </td>
			<td><input name="limit" type='text' /></td>
		</tr>
		<tr>
			<td colspan="4">				
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
		<tr>
			<th>Tech1</th>		<td><?php listTechs('tech1'); ?> </td>
			<th>Difficulty</th>	<td><?php listDiffs('diff1'); ?> </td>
		</tr>
		
		<tr>
			<th>Tech2</th>		<td> <?php listTechs('tech2'); ?> </td>
			<th>Difficulty</th>	<td> <?php listDiffs('diff2'); ?> </td>
		</tr>
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