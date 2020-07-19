<!-- connection to database -->
<!-- Eduonix - quiz -->

<?php

	// to connect to database, we need to iunclude 4 parameters
	// i.e servername, username, password and database name.

	$dbServername = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "quiz";
	
	$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

	// test connection

	if(mysqli_connect_errno($conn))
	{
		echo "Failed to connect ! ".mysqli_connect_error(); // shows script after error

		// die("Failed to connect ! ".mysqli_connect_error()); not gonna show script after error
	}

