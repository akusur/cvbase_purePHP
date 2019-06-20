<?php
	if (session_status() == PHP_SESSION_NONE) {
	session_start();
	}
	include 'DBConnection.php';
	
	$connection = new DBConnection();
	$conn = $connection->connect();

	if ($connection->updateUser($conn);) {
		header("location:userList.php?succ=1");
	} else {
		header("location:userList.php?ID=".$id."&errf=1");
	}
?>

