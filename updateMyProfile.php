<?php
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include 'DBConnection.php';
	
	$connection = new DBConnection();
	$conn = $connection->connect();
	
	if ($connection->updateMyProfile($conn)) {
		header("location:myProfile.php?ID=".$_SESSION['updateID']."&succ=1");
	} else {
		header("location:myProfile.php?errf=1");
	}
?>

