<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
		
	include 'DBParameters.php';

	class DBConnection {
		private $servername;
		private $username;
		private $password;
		private $dataBaseName;
		
	
		
		public function __construct() {
			$this->servername = DBParameters::SERVERNAME . ':' . DBParameters::PORT;
			$this->username = DBParameters::USERNAME;
			$this->password = DBParameters::PASSWORD;
			$this->dataBaseName = DBParameters::DATABASENAME;
		}
		
		public function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		function getServername() {
			return array($this->servername, $this->username, $this->password, $this->dataBaseName);
		}
		
		public function connect() {
			return mysqli_connect($this->servername, $this->username, $this->password, $this->dataBaseName);
		}
		
		public function executeSQL($sql, $conn) {
			$fetchedData = $conn->query($sql);
			return ;
		}
		
		public function getUsers($usersTableName, $conn) {
			$SQLGetAllUsers = "SELECT ID, FirstName, LastName, PhoneNumber, Email, Role FROM ". $usersTableName;
			$usersData = $conn->query($SQLGetAllUsers);
			return $usersData;
		}
		
		public function getApplicants($applicantsTableName, $conn) {
			$SQLGetAllApplicants = "SELECT ID, FirstName, Surname, PhoneNumber, Email, InterviewDate, Comment, ResumeFileURL FROM ". $applicantsTableName ;
			$appData = $conn->query($SQLGetAllApplicants);
			return $appData;
		}
		
		public function addUser($TableName, $conn, $firstname, $lastname, $phoneNumber, $email, $conn) {
			$currentDate = date_create();
			$currentDate = date_timestamp_get($currentDate);

			
			$firstname = $this->test_input($_POST["firstname"]);
			$lastname = $this->test_input($_POST["lastname"]);
			$email = $this->test_input($_POST["email"]);
			$phoneNumber = $this->test_input($_POST["phoneNumber"]);
			$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$role = 'USER';

			$sql = "INSERT INTO ".$TableName." (FirstName, LastName, PhoneNumber, Email, TimeStamp, Password, Role)
					VALUES ('$firstname', '$lastname', '$phoneNumber', '$email', '$currentDate', '$password', '$role')";
			return mysqli_query($conn, $sql);
		}
		
		public function addApplicant($applicantsTableName, $conn, $firstname, $lastname, $phoneNumber, $email, $fileURL) {
			
			$sql = "INSERT INTO ". $tableName ." (FirstName, Surname, PhoneNumber, Email, ResumeFileURL)
			VALUES ('$firstname', '$lastname', '$phoneNumber', '$email', '$fileURL')";
			return	mysqli_query($conn, $sql);
			
		}
		
		public function updateUser($conn) {
			
			$firstname = $this->test_input($_POST["firstname"]);
			$lastname = $this->test_input($_POST["lastname"]);
			$pwd = $_POST["change_password"];
			$role = $_POST["Select_role"];
			$id = $_SESSION['updateUserID'];
			
			if($pwd != ''){
			$pwd = password_hash($pwd, PASSWORD_DEFAULT);
			}
			$count = 0;
			
			$sql = "UPDATE userlist SET ";
			if($firstname != ''){
				$sql .= "FirstName = '".$firstname."'";
				$count++;
			}
			
			if($lastname != ''){
				if($count != 0){
					$sql .= ',';
				}
				$sql .= "LastName = '".$lastname."'";
				$count++;
			}
			if($pwd != ''){
				if($count != 0){
					$sql .= ',';
				}
				$sql .= "Password = '".$pwd."'";
			}
			
			if($count != 0){
					$sql .= ',';
				}
			$sql .= " Role = '".$role."'";
			
			if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
			
			$sql .= " WHERE ID = '".$id."'";
			
			return mysqli_query($conn, $sql);
		}
		
		public function updateApplicant($conn) {
			
			$currentTime = date_create();
			$currentTime = date_timestamp_get($currentTime);

			$currentTime = (string)$currentTime;
			$pdf_true = 0;
			
			if(isset($_FILES) && !(empty($_FILES['file']['name'])) && $_FILES['file']['type'] == 'application/pdf'){
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
				header("location:ApplicationsList.php?errf=pdf");
			}
			
			$firstname = $this->test_input($_POST["firstname"]);
			$lastname = $this->test_input($_POST["lastname"]);
			$phoneNumber = $this->test_input($_POST["phoneNumber"]);
			$intdate = $_POST["interviewDate"];

			if($intdate != ''){
				$timestampdate= strtotime($intdate);
				echo $timestampdate;
			}
			$comment = $_POST["comment"];
			
			$count = 0;
			$sql = "UPDATE applicationbase SET ";
			if($firstname != ''){
				$sql .= "FirstName = '".$firstname."'";
				$count++;
			}
			
			if($lastname != ''){
				if($count != 0){
					$sql .= ',';
				}
				$sql .= "Surname = '".$lastname."'";
				$count++;
			}
			
			if($phoneNumber != ''){
				if($count != 0){
					$sql .= ',';
				}
				$sql .= "PhoneNumber = '".$phoneNumber."'";
				$count++;
			}
			
			if($intdate != 0){
				if($count != 0){
					$sql .= ',';
				}
				$sql .= "InterviewDate = '".$timestampdate."'";
				$count++;
			}
			
			if($comment != '' && ctype_space($comment)){
				
			}else{
				if($count != 0){
					$sql .= ',';
				}
				$sql .= "Comment = '".$comment."'";
				$count++;
			}
			
			if($pdf_true){
				if($count != 0){
					$sql .= ',';
				}
				try {
					$targetfolder = "Uploads/";
					$targetfolder = $targetfolder . basename($filename) ;
					if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
						echo "The file ". basename($_FILES['file']['name']) ." is uploaded";
					 }else {
						header("location:ApplicationsList.php?errf=upl");
					 }
				}
				catch(Exception $e) {
					header("location:ApplicationsList.php?errf=upl");
				}
				$uploadsFolder = "\cvbase\Uploads";
				$fileURL = $uploadsFolder;
				$fileURL .= "\\";
				$fileURL .= $filename;

				$fileURL = addslashes($fileURL);
				
				$sql .= "ResumeFileURL = '".$fileURL."'";
				$count++;
			}
			
			
			$sql .= " WHERE ID = '".$_SESSION['updateID']."'";
			
			return mysqli_query($conn, $sql);
		}
		
		public function updateMyProfile($conn) {
					
			$firstname = $this->test_input($_POST["firstname"]);
			$lastname = $this->test_input($_POST["lastname"]);
			$phoneNumber = $this->test_input($_POST["phoneNumber"]);
			$email = $_SESSION['email'];
			$applied = $_SESSION['applied'];
			
			
			$currentTime = date_create();
			$currentTime = date_timestamp_get($currentTime);
			$currentTime = (string)$currentTime;
			
			
			//Update userlist
			$count = 0;
			
		
			
			//update applicationbase if existing applicant
			
			if($applied){
				$count = 0;
				$sql = "UPDATE applicationbase SET ";
				if($firstname != ''){
					$sql .= "FirstName = '".$firstname."'";
					$count++;
				}
				
				if($lastname != ''){
					if($count != 0){
						$sql .= ',';
					}
					$sql .= "Surname = '".$lastname."'";
					$count++;
				}
				
				if($phoneNumber != ''){
					if($count != 0){
						$sql .= ',';
					}
					$sql .= "PhoneNumber = '".$phoneNumber."'";
					$count++;
				}
				
				if($email != ''){
					if($count != 0){
						$sql .= ',';
					}
					$sql .= "Email = '".$email."'";
					$count++;
				}
				
				$pdftrue = 0;
				if(isset($_FILES) && !(empty($_FILES['file']['name'])) && $_FILES['file']['type'] == 'application/pdf'){
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
					header("location:myProfile.php?errf=pdf");
					break;
				}
				
				if(isset($pdf_true) && $pdf_true){
					$oldCV = $_SESSION['oldCV'];
					$oldCVs = $_SESSION['oldCVs'];
					if($count != 0){
						$sql .= ',';
					}
						try {
							$targetfolder = "Uploads/";
							$targetfolder = $targetfolder . basename($fileName) ;
							if($_FILES['file']['type'] == 'application/pdf'){
							if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
								echo "The file ". basename($_FILES['file']['name']) ." is uploaded";
							 } else {
								header("location:myProfile.php?errf=upl");
							 }
							}
							else{
								header("location:myProfile.php?errf=pdf");
							}
						}
						catch(Exception $e) {
							header("location:myProfile.php?errf=upl");
						}
						$uploadsFolder = "\cvbase\Uploads";
						$fileURL = $uploadsFolder;
						$fileURL .= "\\";
						$fileURL .= $fileName;

						$fileURL = addslashes($fileURL);
						$oldCV = addslashes($oldCV);
						
						$sql .= "ResumeFileURL = '".$fileURL."'";
						$count++;
						$sql .= ',';
						if(!empty($oldCVs)){
						$oldCVs = addslashes($oldCVs);
						}
						$oldCV .= ',';
						$oldCV .= $oldCVs;
						$sql .= "PreviousResumeFileURLs = '".$oldCV."'";
						
						
				}
				$sql .= " WHERE Email = '".$email."'";
				echo '<pre>';
				print_r($sql);
				echo '</pre>';
				
				// if (mysqli_query($conn, $sql)) {
					// header("location:myProfile.php?succ=1");
				// } else {
					// header("location:myProfile.php?errf=1");
				// }
			}
			
			//add new applicant
			
			else{
				$sql = "UPDATE userlist SET ";
				if($firstname != ''){
					$sql .= "FirstName = '".$firstname."'";
					$count++;
				}
				
				if($lastname != ''){
					if($count != 0){
						$sql .= ',';
					}
					$sql .= "LastName = '".$lastname."'";
					$count++;
				}
				
				if($phoneNumber != ''){
					if($count != 0){
						$sql .= ',';
					}
					$sql .= "PhoneNumber = '".$phoneNumber."'";
					$count++;
				}
				
				if (session_status() == PHP_SESSION_NONE) {
						session_start();
					}
				
				$sql .= " WHERE ID = '".$_SESSION['IDB']."'";
			}
			return mysqli_query($conn, $sql);
		}
		
		public function getUserApplicant($conn, $email){
			$sql = "SELECT * FROM applicationbase WHERE Email = \"".$email."\"";
			$applicant = mysqli_query($conn, $sql);
			$applicant = $applicant->fetch_assoc();
			return $applicant;
			
		}
		
		public function getUser($conn, $ID){
			$sql = "SELECT * FROM userlist WHERE ID = '".$ID."'";
			$user = mysqli_query($conn, $sql);
			$user = $user->fetch_assoc();
			return $user;
		}			
	
	}
	
	// echo '<pre>';
	// print_r($connection);
	// echo '</pre>';
	// $conn = $connection->connect();
	// echo '<pre>';
	// print_r($conn);
	// echo '</pre>';
	
	
	
?>
