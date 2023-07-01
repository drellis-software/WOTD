<!DOCTYPE html>
<html lang=en>
  <head>
    <title>Pickle Score</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
<?php include "nav.html" ?>
  <h1>ITS THE PICKLE OF THE DAY</h1>
  <a href="https://mlbpickle.com/"> Play Pickle</a>
  <form action="pickle.php" method="post">
    <label>Name:
		<select name="name">
		<option value="Dylan" <?php print $s_year ? "selected" : ""; ?> >Dylan</option>
		<option value="Stevie" <?php print $s_win ? "selected" : ""; ?> >Stevie</option>
		<option value="Trey" <?php print $s_loss ? "selected" : ""; ?> >Trey</option>
		<option value="Devin" <?php print $s_ploffs ? "selected" : ""; ?> >Devin</option>
		</select>
	</label>
  <label class="block">Date: <input type="date" name="day" required></label>
    <label class="block">Wins: <input type="number" name="pw" required></label>
    <label class="block">Losses: <input type="number" name="pl" required></label>
	<label class="block">Ties: <input type="number" name="pt" required></label>
	<label class="block">Guesses: <input type="number" name="pg" required></label>
    <input type="hidden" name="operation" value="pickle">
    <input type="submit" value="Pickle">
  </form>
  </body>
    <?php
	require_once("functions.php");
	print "<h1>PICKLE STANDINGS</h1>";
		
	// SQL PDO call for printing records in database
	$db = new PDO("sqlite:standings.db");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->query("select name, SUM(W) as Wins, SUM(L) as Losses, SUM(T) as Ties, SUM(G) as Guesses
	from pickle 
	group by name");
	$records = $stmt->fetchall(PDO::FETCH_ASSOC);
	printTable($records);	
	if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];
	
		if ($operation === 'pickle'
        && isset($_POST['name'])
		&& isset($_POST['day'])
        && isset($_POST['pw'])
        && isset($_POST['pl'])
        && isset($_POST['pt'])
		&& isset($_POST['pg'])
    ){
		// Function call to create record
		insertPickle($_POST['name'], $_POST['day'], $_POST['pw'], $_POST['pl'], $_POST['pt'], $_POST['pg']);
		header("location:index.php");
		exit;
	}
}
	?>
</html>
