<?php
	// Get course id
	if (isset($_POST["courseId"])) {
		$courseId = $_POST["courseId"];
	} else {
		echo "error";
	}

	if (isset($_POST["username"])) {
		$username = $_POST["username"];
	} else {
		echo "error";
	}

	if (isset($_POST["reviewContent"])) {
		$reviewContent = $_POST["reviewContent"];
	} else {
		echo "error";
	}

	// Connect to the database
	$mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'LhmDick0202', 'mysql', 2048);
	if($mysqli_connection->connect_error){
	   echo "Not connected, error: ".$mysqli_connection->connect_error;
	}

	// Insert the review
	mysqli_query($mysqli_connection, "INSERT INTO reviews(CreateDate, UserName, Content, CourseId) 
									  VALUES (now(), '$username', '$reviewContent', '$courseId');");
	$rows = mysqli_query($mysqli_connection, "SELECT * 
							   FROM courses
							   WHERE '$courseId' = CourseId;");
	foreach ($rows as $row) {
		$courseName = $row["CourseName"];
		$courseNumber = $row["CourseNum"];
		header("Location: search.php?courseName=" . $courseName . "&courseNumber=" . $courseNumber);
	}
?>
