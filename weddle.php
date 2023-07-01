<!DOCTYPE html>
<html lang=en>
  <head>
    <title>Pickle Score</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
<?php include "nav.html" ?>
  <h1>ITS THE WEDDLE OF THE DAY</h1>
  <a href="https://www.weddlegame.com/"> Play Weddle</a>
  <form action="weddle.php" method="post">
    <label>Category:
		<select name="name">
		<option value="Dylan" <?php print $s_year ? "selected" : ""; ?> >Dylan</option>
		<option value="Stevie" <?php print $s_win ? "selected" : ""; ?> >Stevie</option>
		<option value="Trey" <?php print $s_loss ? "selected" : ""; ?> >Trey</option>
		<option value="Devin" <?php print $s_ploffs ? "selected" : ""; ?> >Devin</option>
		</select>
	</label>
  <label class="block">Date: <input type="date" name="day" required></label>
    <label class="block">Wins: <input type="number" name="ww" required></label>
    <label class="block">Losses: <input type="number" name="wl" required></label>
	<label class="block">Ties: <input type="number" name="wt" required></label>
	<label class="block">Guesses: <input type="number" name="wg" required></label>
    <input type="hidden" name="operation" value="weddle">
    <input type="submit" value="Weddle">
  </form>
  </body>
    <?php
	require_once("functions.php");
	print "<h1>WEDDLE STANDINGS</h1>";
		
	// SQL PDO call for printing records in database
	$db = new PDO("sqlite:standings.db");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->query("select name, SUM(W) as Wins, SUM(L) as Losses, SUM(T) as Ties, SUM(G) as Guesses
	from weddle 
	group by name");
	$records = $stmt->fetchall(PDO::FETCH_ASSOC);
	printTable($records);	
	if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];
	if ($operation === 'weddle'
        && isset($_POST['name'])
		&& isset($_POST['day'])
        && isset($_POST['ww'])
        && isset($_POST['wl'])
        && isset($_POST['wt'])
		&& isset($_POST['wg'])
    ){
	
		// Function call to create record
		insertWeddle($_POST['name'], $_POST['day'], $_POST['ww'], $_POST['wl'], $_POST['wt'], $_POST['wg']);
		header("location:index.php");
		exit;
	}
   }
  ?>
</html>