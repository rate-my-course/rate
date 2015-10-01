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
	$rows = $mysqli_connection->query("SELECT * 
							   FROM courses
							   WHERE '$courseName' = CourseName
							   AND '$courseNumber' = CourseNum;");

	// Check the result
	if (mysql_num_rows($rows) < 1) {
		header("Location: notFound.html");
		die();
	}

	if (mysql_num_rows($rows) > 1) {
		// do something
	}

	// Show the result
	foreach ($rows as $row) {
		
	}
?>