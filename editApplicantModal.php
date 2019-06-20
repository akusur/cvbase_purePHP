<?php
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include 'DBConnection.php';
	include 'classes/applicant.php';
	
	$connection = new DBConnection();
	$conn = $connection->connect();
	
	$ID = $_POST['userid'];
	$_SESSION['updateID'] = $ID;
	$sql = "SELECT * FROM applicationbase WHERE ID = \"".$ID."\"";
	
	$applicant = mysqli_query($conn, $sql);
	$applicant = $applicant->fetch_assoc();
	$neko = new Applicant($applicant['ID'], $applicant['FirstName'], $applicant['Surname'], $applicant['PhoneNumber'], $applicant['Email'], $applicant['InterviewDate'], $applicant['Comment'] , $applicant['ResumeFileURL']);
	if(isset($_SESSION['logged_in'])) {
		if($_SESSION['user_role'] == 'SUPERADMIN'){
			$applicant = $neko->Get();
			$firstname = $applicant[1];
			$lastname = $applicant[2];
			$phnumber = $applicant[3];
			$email = $applicant[4];
			$intdate = $applicant[5];
			$comment = $applicant[6];
			$pdfurl = $applicant[7];
		// echo '<pre>';
		// print_r($applicant);
		// echo '</pre>';
			$html = '
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title text-center">Edit applicant</h3>
				</div>
				<div class="modal-body">

				
				<div class = "row">
							
				<div class = "row" style = "width : 100%;">
					<form method="post" id = "update_form" action="updateApplicationBase.php" enctype="multipart/form-data" class = "left-align width100">  
						
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
								<span id="phonenrerror" class = "error"></span>
							</div>
						</div>

						<div class = "row">
							 
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>

							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "interviewDate">Interview date: </label> 	
								<br>
								<br>
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							
							<div class = "col-xs-10 col-sm-6 col-md-6">
									<input type="date" name = "interviewDate" id="interviewDate" value ="'; 
									
									if($intdate != 0){
										
									$date = date("Y-m-d", $intdate);
									$html .= $date;
									/*echo $date;*/
									}
									$html .= '"><br>
									<br>
							</div>
						</div>
						
						<div class = "row">
						
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>

							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "comment"> Comment: </label> 
								<br>
								<br>									
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<textarea class="form-control comment-box" rows="5" name = "comment" id="comment" onblur="checkField(this)" onkeypress="enterCalls(this)" maxlength="255" rows = 5 >';
								if($comment != ""){
									$html .= $comment;
								}
								else{
									$html .= $comment;
								}
								$html .= '</textarea> 
							</div>
						</div>
						<br>
					
						<div class = "row">
			  
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>

 
							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "file"> Open last uploaded CV: </label> 	
								<br>
								<br>
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
														
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<a href="'.$pdfurl.'" target= "_blank">Open PDF <img src="imgs\pdfIcon.png" alt="CommentIcon" title = "Open resume" width="20" height="20"></a>
							</div>
							
						</div>
						
						<div class = "row">
						
							<div class = "col-xs-2 col-sm-1 col-md-2">
							</div>

							<div class = "col-xs-10 col-sm-3 col-md-3">
								<label for = "CVupload">Upload new CV: </label>
								<br>
								<br>	
							</div>
							
							<div class = "col-xs-2 col-sm-1 col-md-1">
							</div>
							
							<div class = "col-xs-10 col-sm-6 col-md-6">
								<input type="file" name = "file" id="file" >
								<br>';
								
								if(isset($errf) && !empty($errf)){
								$html .= '<span id = "fileerror" class = "error">'.$errf.'</span>';
								}
							$html .= '</div>
							
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