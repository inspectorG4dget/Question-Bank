<?php include 'header.php'; ?>
<div id="contenu">
	<form action=main.php method=POST>
		<?php
			echo "<input type=hidden name=title value=Main />\n
			<input type=submit value=Connection name=GO/>\n";
		?>
	</form>
</div>

<?php include 'footer.php'; ?>