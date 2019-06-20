<?php
	
	if (session_status() == PHP_SESSION_NONE) {
			session_start();
	}
	include 'DBConnection.php';
	$baseName = "userlist";
	
	$connection = new DBConnection();
	$conn = $connection->connect();

	$password = '';
	$email = $_POST["email"];

	$sql = "SELECT * FROM userlist WHERE Email = \"".$email."\"";
		if (mysqli_query($conn, $sql)) {
			//echo "<br>";
			//echo "Username is valid <br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			 }
	echo '<pre>';		 
	$result = mysqli_query($conn, $sql);
	//print_r($result);
	$result = $result->fetch_assoc();
	//print_r($result);
	$hash = $result['Password'];
	$role = $result['Role'];
	$id = $result['ID'];
	$_SESSION['IDB'] = $id;
	if(password_verify($_POST["password"], $hash)){
		//echo 'Password is correct.';	
		$_SESSION["logged_in"] = true;
		$_SESSION["ID"] = session_id();
		$_SESSION["user_role"] = $role;
		if($role == 'USER'){
			header("location:myProfile.php");
		}
		else if($role == 'ADMIN'){
			header("location:ApplicationsList.php");
		}
		else if($role == 'SUPERADMIN'){
			header("location:ApplicationsList.php");
		}
	}
	else{
	header("location:index.php?err=failed");
	}
	echo '</pre>';

?>