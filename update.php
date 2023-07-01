<!DOCTYPE html>
<html lang=en>
  <head>
    <title>Update Season Record</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <?php include "nav.html" ?>
	<h2>Update Overall</h2>
	<form action="update.php" method="post">
  <label>Name:
		<select name="name">
		<option value="Dylan" <?php print $s_year ? "selected" : ""; ?> >Dylan</option>
		<option value="Stevie" <?php print $s_win ? "selected" : ""; ?> >Stevie</option>
		<option value="Trey" <?php print $s_loss ? "selected" : ""; ?> >Trey</option>
		<option value="Devin" <?php print $s_ploffs ? "selected" : ""; ?> >Devin</option>
		</select>
	</label>
	<label class="block">Date: <input type="date" name="day" required></label>
    <label class="block">Wins: <input type="number" name="W" required></label>
    <label class="block">Losses: <input type="number" name="L" required></label>
	<label class="block">Ties: <input type="number" name="T" required></label>
	<label class="block">Points: <input type="number" name="P" required></label>
    <input type="hidden" name="operation" value="overall">
    <input type="submit" value="Overall">
  </form>
  </body>

<?php
	require_once("functions.php"); 
	if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];
	
	if ($operation === 'overall'
        && isset($_POST['name'])
		&& isset($_POST['day'])
        && isset($_POST['W'])
        && isset($_POST['L'])
        && isset($_POST['T'])
		&& isset($_POST['P'])
    ){
		
		insertOverall($_POST['name'], $_POST['day'], $_POST['W'], $_POST['L'], $_POST['T'], $_POST['P']);
		header("location:index.php");
		exit;
		
	}
		
}

?>
    
  
 </body>
</html>