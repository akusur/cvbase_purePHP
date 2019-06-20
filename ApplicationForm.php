<!--Application form-->

<?php

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$_SESSION['title'] = 'Application Form';
	
	if (isset($_GET["errf"]) && $_GET["errf"] == 'upl') {
			$err = "File could not be uploaded.";
		}else if (isset($_GET["errf"]) && $_GET["errf"] == 'pdf') {
			$err = "Uploaded file must be .pdf.";
				}else if(isset($_GET["errf"]) && $_GET["errf"] == 'email'){
					$err = "You have already applied, please sign up to change your application";
						}else if(isset($_GET["errf"])){
							$err = 'Application failed, please try again.';
								}else{
									$err = '';
										}
	include 'header.php';	
	
	if(isset($_GET['succ'])){
		if($_GET['succ'] == 1){
			echo '<script type="text/javascript">',
				 'toastr_applicant_admin_success();',
				 '</script>'
			;
		}if($_GET['succ'] == 2){
			echo '<script type="text/javascript">',
				 'toastr_new_applicant_success();',
				 '</script>'
			;
		}
	}
	
	$SUPERADMIN = isset($_SESSION['user_role']) && ($_SESSION['user_role'] == "SUPERADMIN");
	

	
?>



<div class="container container-rel">
	<div id = "jumbotron-form" class = "jumbotron jumbotron-form <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "SUPERADMIN"){echo "jumbotron-edit-applicant";} ?> form-align text-center vertical-center-form max-width765px ">
		<h2 class = "text-center">CV Application Form</h2>
		<br>
		<br>
		<form method="post" id = "submit_form2" action="upload_script.php" enctype="multipart/form-data" class= "width100 alignleft ">  
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
					<input type="text" name = "firstname" id="firstname" placeholder = "ex: Clit" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "width100 width250px login-input">
					<span id = "firstnameerror" class = "error"></span>
				</div>
				  
			
			</div>
		  
			<div class = "row">
		  
				<div class = "col-xs-2 col-sm-1 col-md-2">
				</div>

				
				<div class = "col-xs-10 col-sm-3 col-md-3">
					<label for = "lastname"> Last name: </label> 		
					<br>
					<br>
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
				
				<div class = "col-xs-10 col-sm-6 col-md-6">
					<input type="text" name = "lastname" id="lastname" placeholder= "ex: Eastwood" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "width100 width250px login-input">
					<span id="lastnameerror" class = "error"></span>
				</div>
				  
				
			</div>
		  
			<div class = "row">
				
				<div class = "col-xs-2 col-sm-1 col-md-2">
				</div>
				
				<div class = "col-xs-10 col-sm-3 col-md-3">
					<label for = "email"> E-mail: </label> 	
					<br>
					<br>  
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
											
				<div class = "col-xs-10 col-sm-6 col-md-6">
					<input type="text" name =  "email" id="email" onkeypress="enterCalls(this)" onblur="requiredField(this)" placeholder = "ex: mail@example.com" class = "width100 width250px login-input">
					<span id="emailerror" class = "error"></span>
				</div>
				  
			</div>
			
			<div class = "row">
				 
				<div class = "col-xs-2 col-sm-1 col-md-2">
				</div>
				 
				<div class = "col-xs-10 col-sm-3 col-md-3">
					<label for = "phoneNumber"> Phone number: </label> 	
					<br>
					<br>
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
				<div class = "col-xs-10 col-sm-6 col-md-6">
					<input type="text" name = "phoneNumber" id="phoneNumber" placeholder="ex: +38761234567; 061234567" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "width100 width250px login-input">
					<span id="phonenrerror" class = "error"></span>
				</div>
			
			</div>
			<?php if($SUPERADMIN){ ?>
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
						<input type="date" name = "interviewDate" id="interviewDate">
				</div>
			</div>
			<br>
			<div class = "row">
			
				<div class = "col-xs-2 col-sm-1 col-md-2">
				</div>

				<div class = "col-xs-10 col-sm-3 col-md-3">
					<label for = "comment"> Comment:</label> 
													
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
				
				<div class = "col-xs-10 col-sm-6 col-md-6">
					<textarea class="form-control comment-box" rows="5" name = "comment" id="comment" onblur="checkField(this)" onkeypress="enterCalls(this)" class = "comment-box form-control"></textarea> 
				</div>
			</div>
			<br>
			 <?php
			}
			 ?>
			<div class = "row">
			  
				<div class = "col-xs-2 col-sm-1 col-md-2">
				</div>

				<div class = "col-xs-10 col-sm-3 col-md-3">
					<label for = "file"> Upload your CV in .pdf: </label> 	
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
											
				<div class = "col-xs-10 col-sm-6 col-md-6 text-center">
					<input type="file" name="file" id = "file" size="50" />
					<br>
					
				</div>
				
			</div>
			
			<div class = "row text-center">
					<input type="button" id="submit_btn" class="btn btn-default btn-lg" value = "Submit" onclick="<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] != "SUPERADMIN"){ ?>validateSubmit()<?php }else{ echo "validateSubmit_SUPERUSER()";} ?>">
					<br><br>					
					<?php if (isset($_GET["errf"])){ ?>
					
					<div class="alert left-align-text">
						<span class="closebtn" onclick="closeFormError(this)">&times;</span> 
						<?php echo $err;?>
						<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] != "SUPERADMIN"){ ?>
						<script>document.getElementById("jumbotron-form").classList.add('jumbotron-form-with-error');</script>
						<?php } ?>
					</div>
					<?php } ?>
			</div>
			
			<div class = "row text-center">
					<div id = "submitError" class="left-align-text">
						<!--<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> -->
					</div>
					<!--<span class = "error" id = "submitError"></span>-->
			</div>
		</form>
	</div>
<?php include 'footer.php'; ?>
