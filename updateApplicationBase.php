<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include 'DBConnection.php';
	
	$connection = new DBConnection();
	$conn = $connection->connect();

	if($connection->updateApplicant($conn)) {
		header("location:ApplicationsList.php?succ=1");
	} else {
		header("location:location:ApplicationsList.php?errf=1");
	}
	
?>

