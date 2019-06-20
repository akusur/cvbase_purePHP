<?php
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include 'DBConnection.php';
	include 'classes/suser.php';
	
	$connection = new DBConnection();
	$conn = $connection->connect();
	
	$ID = $_POST['user_id'];
	$_SESSION['updateUserID'] = $ID;
	if(isset($_SESSION['logged_in'])) {
		if($_SESSION['user_role'] == 'SUPERADMIN'){
	$sql = "SELECT * FROM userlist WHERE ID = '".$ID."'";
	$user = mysqli_query($conn, $sql);
	$user = $user->fetch_assoc();
	$neko = new SUser($user['ID'], $user['FirstName'], $user['LastName'], $user['PhoneNumber'], $user['Email'], $user['Role']);

	$userData = $neko->Get();
	$id = $userData[0];
	$firstname = $userData[1];
	$lastname = $userData[2];
	$phnumber = $userData[3];
	$email = $userData[4];
	$user_role = $userData[5];
	
		// echo '<pre>';
		// print_r($applicant);
		// echo '</pre>';
			$html = '
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title text-center">Edit user</h3>
				</div>
		
				<div class="modal-body">

				
				<div class = "row">
						
				<div class = "row" style = "width : 100%;">
					<form method="post" id = "update_form" action="updateUserList.php" enctype="multipart/form-data" class = "left-align width100">  
						
						<div class="row">

							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>

							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "firstname"> First name: </label> 	
								<br>
								<br>
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<input type="text" name = "firstname" id="firstname" onkeypress="enterCalls(this)" onblur="checkApplicantEditField(this)" class = "width100 width250px " value='.$firstname.'>
								<span id = "firstnameerror" class = "error"></span>
							</div>
							  
						
						</div>
					  
						<div class = "row">
					  
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>

							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "lastname">Last name: </label> 		
								<br>
								<br>
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<input type="text" name = "lastname" id="lastname"  onkeypress="enterCalls(this)" onblur="checkApplicantEditField(this)" class = "width100 width250px " value='.$lastname.'>
								<span id="lastnameerror" class = "error"></span>
							</div>
							  
							
						</div>
					  
						<div class = "row">
							 
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>

							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "phoneNumber">Phone number: </label> 	
								<br>
								<br>
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<input type="text" name = "phoneNumber" id="phoneNumber"  onkeypress="enterCalls(this)" onblur="checkApplicantEditField(this)" class = "width100 width250px"  value='.$phnumber.'>
								<span id="phonenrerror" class = "error"></span>
							</div>
						</div>
						
						<div class = "row">
							 
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>

							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "email">E-mail: </label> 	
								<br>
								<br>
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<input type="text" name = "email" id="email" disabled class = "width100 width250px"  value='.$email.'>
								<span id="emailerror" class = "error"></span>
							</div>
						</div>
						
						<div class = "row">
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>
							 
							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "password"> New password: </label> 
								<br>
								<br>									
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							 
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<input type="password" name = "change_password" id="change_password" onkeypress="enterCalls(this)" onblur="checkEditUserField(this)" style = "width:250px;">
								<span id = "passworderror" class = "error"></span>
							</div>
						</div>
			
						<div class = "row">
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>
							 
							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "repassword"> Re-type new password: </label>
								<br>
								<br>	
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							 
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<input type="password" name = "repassword" id="repassword" onkeypress="enterCalls(this)" onblur="checkEditUserField(this)" style = "width:250px;">
								<span id = "repassworderror" class = "error"></span>
							</div>
						</div>
									
						<div class = "row">
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>
							 
							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "lastname"> Assign role: </label>
								<br>
								<br>	
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							 
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<select name="Select_role">
								  <option ';
								if($user_role === "USER"){
									$html.= "selected ";
								}
								$html.= 'value="USER">User</option>
								<option ';
								if($user_role === "ADMIN"){
									$html.= "selected ";
								} 
								$html.= 'value="ADMIN">Admin</option>
								  <option ';
								if($user_role === "SUPERADMIN"){
									$html.= "selected ";
								} 
								$html.= 'value="SUPERADMIN">Superadmin</option>
								</select> 
							</div>
						</div>

						<div class = "row text-center">
							<input type="button" id = "submit_btn" class="btn btn-default btn-lg" value = "Update" onclick="validateApplicantEdit()">
							<button type = "button" class="btn btn-default btn-lg" data-dismiss="modal" style = "color:black;">Close</button><br><br>
							<span id = "edit_applicant_error" class = "error"></span>
						</div>
					</form>
				</div>
			</div>
		</div>';
			
			$txt2html = strip_tags($html);
			echo  html_entity_decode($html, ENT_COMPAT);
			
		}else{ 
			echo "You do not have the permission to see this page!";
			}
	}else{
		echo "Please sign up to see this page.";
	}
	?>