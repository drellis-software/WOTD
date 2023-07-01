<!DOCTYPE html>
<html lang=en>
  <head>
    <title>Pickle Score</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
<?php include "nav.html" ?>
  <h1>ITS THE WEDDLE HARD OF THE DAY</h1>
  <a href="https://www.weddlegame.com/"> Play Weddle</a>
  <form action="hard.php" method="post">
  <label>Name:
		<select name="name">
		<option value="Dylan" <?php print $s_year ? "selected" : ""; ?> >Dylan</option>
		<option value="Stevie" <?php print $s_win ? "selected" : ""; ?> >Stevie</option>
		<option value="Trey" <?php print $s_loss ? "selected" : ""; ?> >Trey</option>
		<option value="Devin" <?php print $s_ploffs ? "selected" : ""; ?> >Devin</option>
		</select>
	</label>
	<label class="block">Date: <input type="date" name="day" required></label>
    <label class="block">Wins: <input type="number" name="hw" required></label>
    <label class="block">Losses: <input type="number" name="hl" required></label>
	<label class="block">Ties: <input type="number" name="ht" required></label>
	<label class="block">Guesses: <input type="number" name="hg" required></label>
    <input type="hidden" name="operation" value="hard">
    <input type="submit" value="Hard">
  </form>
  </body>
  <?php

	require_once("functions.php");
	print "<h1>WEDDLE HARD STANDINGS</h1>";
		
	// SQL PDO call for printing records in database
	$db = new PDO("sqlite:standings.db");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->query("select name, SUM(W) as Wins, SUM(L) as Losses, SUM(T) as Ties, SUM(G) as Guesses
	from hard 
	group by name");
	$records = $stmt->fetchall(PDO::FETCH_ASSOC);
	printTable($records);	
	if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];
	
	if ($operation === 'hard'
        && isset($_POST['name'])
		&& isset($_POST['day'])
        && isset($_POST['hw'])
        && isset($_POST['hl'])
        && isset($_POST['ht'])
		&& isset($_POST['hg'])
    ){
		// Function call to create record
		insertHard($_POST['name'], $_POST['day'], $_POST['hw'], $_POST['hl'], $_POST['ht'], $_POST['hg']);
		header("location:index.php");
		exit;
    }
		
}
  ?>
</html>