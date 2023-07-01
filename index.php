
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
	
  <?php
	require_once("functions.php");
// TODO If the session variables exist, then only show a link to the log out
// page, otherwise only show links to the sign in and create account pages.

	// Checks if session variables set and if so only show log out menu option
	include "nav.html";
	print "<h1>OVERALL STANDINGS</h1>";
		
				// SQL PDO call for printing records in database
	$db = new PDO("sqlite:standings.db");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->query("select name, SUM(W) as Wins, SUM(L) as Losses, SUM(T) as Ties, SUM(P) as Points
	from standings 
	group by name
	order by Points");
	$records = $stmt->fetchall(PDO::FETCH_ASSOC);
	printTable($records);
		
	// open a database connection


// Close database
$db = null;
	

?>

</head>
</body>
</html>


