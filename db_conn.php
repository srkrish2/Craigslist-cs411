<?php

function connect_to_db(){
	$conn = mysqli_connect("localhost","craigslist","Password!234","track1");
	if(!$conn) {
		die("DB connection failed: ".mysqli_connect_error());
	}

	return $conn;
}

?>
