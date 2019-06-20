<?php

	$applicantsTable = "ApplicationBase";
	
	$connection = new DBConnection();
	$conn = $connection->connect();
	
	$connection->addApplicant($applicantsTable, $conn, $firstname, $lastname, $phoneNumber, $email);

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>