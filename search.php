<?php
 	// Get the course name and course Number
	if (isset($_GET["courseName"])) {
		$courseName = $_GET["courseName"];
	} else {
		header("Location: notFound.html");
	}

	if (isset($_GET["courseNumber"])) {
		$courseNumber = $_GET["courseNumber"];
	} else {
		header("Location: notFound.html");
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
?>
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
	// Show the result
	foreach ($rows as $row) {
?>
		<h1><?= $row["CourseName"] ?> <?= $row["CourseNum"] ?></h1>
<?php
		$courseId = $row["CourseId"];
	}

	// Find the reviews
	$reviews = mysqli_query($mysqli_connection, "SELECT * 
							   				     FROM reviews
							  				     WHERE $courseId = CourseId;");
?>
	<ul>
<?php

	// Show the reviews
	foreach ($reviews as $review) {
?>
		<li>
			<h2><?= $review["UserName"] ?></h2>
			<h3><?= $review["CreateDate"] ?></h3>
			<p><?= $review["Content"] ?></p>
		</li>
<?php
	}
?>
	</ul>

	<form action="add-review.php" method="post">
		<div class="form-group">
			  <label for="Username">UserName:</label>
			  <input name="username" type="text" class="form-control" id="username" /> <br/>
			  <input name="courseId" type="hidden" value=<?php echo $courseId; ?> />

			  <textarea name="reviewContent" rows="4" cols="50">Type your review here...</textarea>

			  <button type="submit" class="btn btn-warning">submit</button>
		</div> 
	</form>

	</div>

	<form action="index.html" method="get">
		<button type="submit" class="btn btn-primary">back</button>
 	</form>
  </body>
</html>