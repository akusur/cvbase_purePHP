	<?php
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';

	echo '<pre>';
	print_r($_FILES);
	echo '</pre>';

	if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

	$currentTime = date_create();
	$currentTime = date_timestamp_get($currentTime);
	$currentTime = (string)$currentTime;
	$pdf_true = 0;
	include 'DBConnection.php';
	
	$connection = new DBConnection();
	$conn = $connection->connect();

	if(isset($_FILES) && !empty($_FILES['file']['name']) && $_FILES['file']['type'] == 'application/pdf'){
		$pdf = ".pdf";
		$fileName = "";
		$fileName .=  $_POST["firstname"]; 
		$fileName .= "-";
		$fileName .= $_POST["lastname"];
		$fileName .= "-";
		$fileName .= $currentTime;
		$fileName .= $pdf;
		$pdf_true = 1;
	}else{
		header("location:ApplicationForm.php?errf=pdf");
		}

	if($pdf_true){
		try {
			$targetfolder = "Uploads/";
			$targetfolder = $targetfolder . basename($fileName) ;
			
			if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
				echo "The file ". basename($_FILES['file']['name']) ." is uploaded";
			 } else {
				header("location:ApplicationForm.php?errf=upl");
			 }
			
		}
		catch(Exception $e) {
			header("location:ApplicationForm.php?errf=upl");
		}


		$tableName = "ApplicationBase";
		$uploadsFolder = "\cvbase\Uploads";
		$fileURL = $uploadsFolder;
		$fileURL .= "\\";
		$fileURL .= $fileName;

		$fileURL = addslashes($fileURL);

		$firstname = test_input($_POST["firstname"]);
		$lastname = test_input($_POST["lastname"]);
		$email = test_input($_POST["email"]);
		$phoneNumber = test_input($_POST["phoneNumber"]);
	 
		if ($connection->addApplicant($tableName, $conn, $firstname, $lastname, $phoneNumber, $email, $fileURL)) {
			if(isset($_SESSION['logged_in'])){
				header("location:ApplicationForm.php?succ=1");
			}else{
				header("location:ApplicationForm.php?succ=2");
			}
		}else if($conn->error == 'Duplicate entry \''.$email.'\' for key \'Email\''){
			header("location:ApplicationForm.php?errf=email");
		}else{
			header("location:ApplicationForm.php?errf=1");
		}
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

 ?>