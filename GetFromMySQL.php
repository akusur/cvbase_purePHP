<?php

$connection = new DBConnection();
$conn = $connection->connect();

$applicantsTable = "ApplicationBase";
$appData = $connection->getApplicants($applicantsTable, $conn);

$usersTable = "userlist";
$usersData = $connection->getUsers($usersTable, $conn);


?>