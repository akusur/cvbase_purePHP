<?php
	include 'DBConnection.php';
	
	$connection = new DBConnection();
	$conn = $connection->connect();

	$TableName = "userlist";
	
	if ($connection->addUser($TableName, $conn, $firstname, $lastname, $phoneNumber, $email, $conn)){
		echo "<br>";
		header("location:index.php?user=new");
	}else{
		header("location:signup.php?err=1");
	}
 ?>