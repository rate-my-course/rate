<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="search.css">

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </head>

  <body>
  	<div class="container">
<?php
 	// Get the course name and course Number
	if (isset($_GET["courseName"])) {
		$courseName = $_GET["courseName"];
	}
	if (isset($_GET["courseNumber"])) {
		$courseNumber = $_GET["courseNumber"];
	}
	
	// Connect to the database
	$mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'LhmDick0202', 'mysql', 2048);
	if($mysqli_connection->connect_error){
	   echo "Not connected, error: ".$mysqli_connection->connect_error;
	}

	// Get the result
	$rows = mysqli_query($mysqli_connection, "SELECT * 
							   FROM courses
							   WHERE '$courseName' = CourseName
							   AND '$courseNumber' = CourseNum;");

	// Check the result
	if (mysqli_num_rows($rows) < 1) {
		header("Location: notFound.html");
	}

	if (mysqli_num_rows($rows) > 1) {
		// do something
	}

	// Show the result
	foreach ($rows as $row) {
?>
		<h1><?= $row["CourseName"] ?> <?= $row["CourseNum"] ?></h1>
<?php
	}
?>
	</div>

	<form action="index.html" method="get">
		<button type="submit" class="btn btn-information">back</button>
 	</form>
  </body>
</html>