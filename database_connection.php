<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	$dbname = 'assign6';
	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error){
		die("Connection failed, try again :" . $conn->connect_error);
	}

	// echo "Connected to database successfully";
?>
