<?php
	include 'classes/applicant.php';
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$_SESSION['title'] = 'Edit applicant';
	$ID = $_GET["ID"];
	$_SESSION['updateID'] = $ID;
	
	include 'header.php';
	
	if (isset($_GET["errf"]) && $_GET["errf"] == 'upl') {
			$err = "File could not be uploaded.";
		}else if (isset($_GET["errf"]) && $_GET["errf"] == 'pdf') {
			$err = "Uploaded file must be .pdf.";
				}else if(isset($_GET["errf"])){
					$err = 'Application failed, please try again.';
						}else{
							$err = '';
								}
	if($_GET['errf'] == 1){
		echo '<script type="text/javascript">',
			 'toastr_applicant_error();',
			 '</script>'
		;
	}
		
	$sql = "SELECT * FROM applicationbase WHERE ID = \"".$ID."\"";
	$applicant = mysqli_query($conn, $sql);
	$applicant = $applicant->fetch_assoc();
	$neko = new Applicant($applicant['ID'], $applicant['FirstName'], $applicant['Surname'], $applicant['PhoneNumber'], $applicant['Email'], $applicant['InterviewDate'], $applicant['Comment'] , $applicant['ResumeFileURL']);
?>

			
<div class="container container-rel">
	<div class = "jumbotron jumbotron-index jumbotron-edit-applicant form-align text-center vertical-center-edit-app max-width765px ">
		<?php
			if(isset($_SESSION['logged_in'])) {
				if($_SESSION['user_role'] == 'SUPERADMIN'){
		?>
					<div class = "row">
						<h2 class = "text-center">Edit applicant</h2>
						<br>
								<?php
									$applicant = $neko->Get();
									$firstname = $applicant[1];
									$lastname = $applicant[2];
									$phnumber = $applicant[3];
									$email = $applicant[4];
									$intdate = $applicant[5];
									$comment = $applicant[6];
									$pdfurl = $applicant[7];
								?>		
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
										<input type="text" name = "firstname" id="firstname" onkeypress="enterCalls(this)" onblur="checkApplicantEditField(this)" class = "width100 width250px login-input" value=<?php echo $firstname; ?>>
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
										<input type="text" name = "lastname" id="lastname"  onkeypress="enterCalls(this)" onblur="checkApplicantEditField(this)" class = "width100 width250px login-input" value=<?php echo $lastname; ?>>
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
										<input type="text" name = "phoneNumber" id="phoneNumber"  onkeypress="enterCalls(this)" onblur="checkApplicantEditField(this)" class = "width100 width250px login-input"  value=<?php echo $phnumber; ?>>
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
										<input type="text" name = "email" id="email" disabled class = "width100 width250px login-input"  value=<?php echo $email; ?>>
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
											<input type="date" name = "interviewDate" id="interviewDate" value = <?php if($intdate != 0){echo date('Y-m-d', $intdate);} ?> >
											<br>
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
										<textarea class="form-control" rows="5" name = "comment" id="comment" onblur="checkField(this)" onkeypress="enterCalls(this)" class = "form-control comment-box" maxlength="255" rows = 5><?php if($comment != ''){
											print_r($comment);
										}
										else{
											$comment;
										}
										?> </textarea> 
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
										<?php echo "<a href=", "\"", $pdfurl, "\"", "target= ", "\"","_blank", "\"", ">Open PDF","</a>" ?>
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
									<input type="button" id = "submit_btn" class="btn btn-default btn-lg" value = "Update" onclick="validateApplicantEdit()">
									<a class="btn btn-default btn-lg" href = "ApplicationsList.php" style = "color:black;">Cancel</a><br><br>
									<span id = "edit_applicant_error" class = "error"></span>
								</div>
							</form>
						</div>
					</div>
					<?php	
				}else{ 
					echo "You do not have the permission to see this page!";
					} 
			}
			else{
				echo "Please sign up to see this page.";
			}
			?>
	</div>
</div>
<?php include 'footer.php';?>