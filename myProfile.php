<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	$err = '';
	$_SESSION['title'] = 'My profile';
	
	include 'classes/suser.php';
	include 'header.php';
	
	$connection = new DBConnection();
	$conn = $connection->connect();
	
	if (isset($_GET["errf"]) && $_GET["errf"] == 'upl') {
		echo '<script type="text/javascript">',
			 'toastr_profile_update_error();',
			 '</script>';
	}else if(isset($_GET["errf"]) && $_GET["errf"] == 'pdf') {
		echo '<script type="text/javascript">',
			 'toastr_profile_update_error();',
			 '</script>';
	}else if(isset($_GET["errf"])){
		echo '<script type="text/javascript">',
			'toastr_profile_update_error();',
			'</script>';
	}else{
		
	}				
	if(isset($_GET['succ']) && $_GET['succ'] == 1){
		echo '<script type="text/javascript">',
			 'toastr_profile_update_success();',
			 '</script>';
	}
	
	
	$ID = $_SESSION['IDB'];
	$user = $connection->getUser($conn, $ID);
	$neko = new SUser($user['ID'], $user['FirstName'], $user['LastName'], $user['PhoneNumber'], $user['Email'], $user['Role']);
	
	
	// try{
		// $user = mysqli_query($conn, $sql);
		// $user = $user->fetch_assoc();
		// $neko = new SUser($user['ID'], $user['FirstName'], $user['LastName'], $user['PhoneNumber'], $user['Email'], $user['Role']);
	// }
	// catch(Exception $e)
	// {
		 // echo 'Caught exception: ',  $e->getMessage(), "\n";
	// }
	
	$userData = $neko->Get();
	$firstname = $userData[1];
	$lastname = $userData[2];
	$phnumber = $userData[3];
	$email = $userData[4];
	$user_role = $userData[5];
	
	$applied = 0;
	$_SESSION['applied'] = $applied;
	
	$applicant = $connection->getUserApplicant($conn, $email);
	
	if($applicant>=1){
		$applied = 1;
		
		include 'classes/applicant.php';
		
		$nekoApp = new Applicant($applicant['ID'], $applicant['FirstName'], $applicant['Surname'], $applicant['PhoneNumber'], $applicant['Email'], $applicant['InterviewDate'], $applicant['Comment'] , $applicant['ResumeFileURL'], $applicant['PreviousResumeFileURLs']);
		$appData = $nekoApp->Get();
		
		$_SESSION['oldCVs'] = $appData[8];
		$_SESSION['oldCV'] = $appData[7];
	}
		$_SESSION['applied'] = $applied;
		$_SESSION['email'] = $email;
?>
	
<div class="container container-rel">
	<div class = "jumbotron jumbotron-index form-align text-center vertical-center-edit-app max-width765px ">
	<h2 class = "text-center">My profile</h2>
		<br>					
		<div class = "row" class = "width100">
			<form method="post" id = "update_form" action="updateMyProfile.php" enctype="multipart/form-data" class= "width100 alignleft ">  
			
				<div class="row">

					<div class = "col-xs-2 col-sm-2">
					</div>

					<div class = "col-xs-10 col-sm-3">
						<label for = "lastname"> First name: </label> 	
						<br>
						<br>
					</div>
					
					<div class = "col-xs-2 col-sm-1">
					</div>
					
					<div class = "col-xs-5 col-sm-3">
						<input type="text" name = "firstname" id="firstname"  onkeypress="enterCalls(this)" onblur="checkField(this)" style = "width = 100%;" value=<?php echo $firstname; ?> >
						<span id = "firstnameerror" class = "error"></span>
					</div>
					  
					<div class = "col-sm-3">
					</div>
				  
				</div>
			  
				<div class = "row">
			  
					<div class = "col-xs-2 col-sm-2">
					</div>

					
					<div class = "col-xs-10 col-sm-3">
						<label for = "lastname"> Last name: </label> 		
						<br>
						<br>
					</div>
					
					<div class = "col-xs-2 col-sm-1">
					</div>
					
					<div class = "col-xs-10 col-sm-2">
						<input type="text" name = "lastname" id="lastname" onkeypress="enterCalls(this)" onblur="checkField(this)" value=<?php echo $lastname; ?>  >
						<span id="lastnameerror" class = "error"></span>
					</div>
					  
					
				</div>
			  
				<div class = "row">
					 
					<div class = "col-xs-2 col-sm-2">
					</div>
					 
					<div class = "col-xs-10 col-sm-3">
						<label for = "phoneNumber"> Phone number: </label> 	
						<br>
						<br>
					</div>
					
					<div class = "col-xs-2 col-sm-1">
					</div>
					<div class = "col-xs-10 col-sm-2">
						<input type="text" name = "phoneNumber" id="phoneNumber" value=<?php echo $phnumber; ?>>
						<span id="phonenrerror" class = "error"></span>
					</div>
				</div>
				
				<div class = "row">
					 
					<div class = "col-xs-2 col-sm-2">
					</div>
					 
					<div class = "col-xs-10 col-sm-3">
						<label for = "email">E-mail: </label> 	
						<br>
						<br>
					</div>
					
					<div class = "col-xs-2 col-sm-1">
					</div>
					<div class = "col-xs-10 col-sm-2">
						<input type="text" name = "email" id="email"  onkeypress="enterCalls(this)" onblur="checkField(this)" disabled value=<?php echo $email; ?>>
						<span id="phonenrerror" class = "error"></span>
					</div>
				</div>
			
				<?php if($applied){	?>
						<div class = "row">
						  
							<div class = "col-xs-2 col-sm-2">
							</div>
 
							<div class = "col-xs-10 col-sm-3">
								<label for = "file"> Open your last uploaded CV: </label> 	
								<br>
								<br>
							</div>
							
							<div class = "col-xs-2 col-sm-1">
							</div>
														
							<div class = "col-xs-10 col-sm-2">
								<?php echo "<a href=", "\"", $appData[7], "\"", "target= ", "\"","_blank", "\"", ">Open PDF","</a>" ?>
							</div>
							
						</div>
						
				<?php
					}
				?>
				
				<div class = "row">
				  
					<div class = "col-xs-2 col-sm-2">
					</div>

					<div class = "col-xs-10 col-sm-3">
						<label for = "file"> Upload your<?php if($applied){echo " new";} ?> CV in .pdf: </label> 	
						<br>
						<br>
					</div>
					
					<div class = "col-xs-2 col-sm-1">
					</div>
												
					<div class = "col-xs-10 col-sm-2 text-center">
						<input type="file" name="file" id = "file" size="50" />
						<br>
						<?php
							if(isset($errf) && !empty($errf)){ 
						?>
						<span id = "fileerror" class = "error"><?php echo $errf;?></span>
						<?php
							}
						?>
					</div>
					
				</div>
				
				<div class = "row text-center">
						<input type="button" id="submit_btn" class="btn btn-default btn-lg" value = "Update" onclick="validateMyProfileEdit()"> <br>
						<?php
							if(isset($_GET['succ']) && $_GET['succ'] == 1){
						?>
							<span id = 'newuser' style = "color: green;"></span>		
						<?php
							}
						?>
							<div id = "edit_myprofile_error" class = "left-align-text">
							
				</div>
			</form>
		</div>
	</div>
<?php include 'footer.php';?>