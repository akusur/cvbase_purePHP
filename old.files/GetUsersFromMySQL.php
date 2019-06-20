<?php

	$tableName = "userlist";
	$SQLGetAll = "SELECT ID, FirstName, LastName, PhoneNumber, Email, Role FROM ". $tableName ;
	$appData = $conn->query($SQLGetAll);

?>