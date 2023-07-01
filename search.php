
<!DOCTYPE html>
<html lang=en>
  <head>
    <title>Search</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>


<?php
	require_once("functions.php");
	include "nav.html";
?>
	<h1>Search</h1>
	<p1>Search Names: Devin | Dylan | Stevie | Trey</p1>
	<form action="search.php" method="get">
	<label>Category:
		<select name="category">
		<option value="weddle" <?php print $s_date ? "selected" : ""; ?> >Weddle</option>
		<option value="hard" <?php print $s_name ? "selected" : ""; ?> >Weddle Hard</option>
		<option value="pickle" <?php print $s_name ? "selected" : ""; ?> >Pickle</option>
		<option value="overall" <?php print $s_name ? "selected" : ""; ?> >Overall</option>
		</select>
	</label>
	<label>Term: <input type="text" name="term"></label>
	<input type="submit">
	</form>
	
	<?php
	
	// Set variables to form data
	$s_year = isset($_GET['category']) && $_GET['category'] === 'year';
	$s_win = isset($_GET['category']) && $_GET['category'] === 'win';
	$s_loss = isset($_GET['category']) && $_GET['category'] === 'loss';
	$s_ploffs = isset($_GET['category']) && $_GET['category'] === 'ploffs';


	// open a database connection
	$db = new PDO("sqlite:standings.db");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (isset($_GET['category']) && isset($_GET['term'])) {
		// TODO SELECT the appropriate records in ascending order of user name
		
		// Variables from form post for category and term to search for
		$category = $_GET['category'];
		$term = $_GET['term'];
			
		
		print "<h2>Entries for $term in $category</h2>";
		// TODO print the table
		// If statement for search category name
		if($category === 'weddle'){
			// SQL statement for preparation for name using Positional PDO
			$srch = "SELECT * FROM weddle WHERE name = ? ORDER BY day ASC";
			// SQL statement for preparation 
			$stmt = $db->prepare($srch);
		}
		// If statement for search category email
		if($category === 'hard'){
			// SQL statement for preparation for email using Positional PDO
			$srch = "SELECT * FROM hard WHERE name = ? ORDER BY day ASC";;
			// SQL statement for preparation 
			$stmt = $db->prepare($srch);

		}
		// If statement for search category Date of Birth
		if($category === 'pickle'){
			// SQL statement for preparation for Date of Birth using Positional PDO
			$srch = "SELECT * FROM pickle WHERE name = ? ORDER BY day ASC";;
			// SQL statement for preparation 
			$stmt = $db->prepare($srch);

		}
		
		if($category === 'overall'){
			// SQL statement for preparation for Date of Birth using Positional PDO
			$srch = "SELECT * FROM standings WHERE name = ? ORDER BY D ASC";;
			// SQL statement for preparation 
			$stmt = $db->prepare($srch);

		}
	
		// execute and fetch calls
		$stmt->execute([$term]);
		$out = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		// print table
		printTable($out);
		// Close database
		$db = null;
	}


?>
  </body>
</html>
