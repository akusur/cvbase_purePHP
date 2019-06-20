<?php

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	$_SESSION['title'] = 'Sign up';
	
	include 'header.php';
?>

	

<div class="container container-rel">
	<div id = "jumbotron-signup" class = "jumbotron jumbotron-index form-align text-center vertical-center-form max-width765px ">
		<?php 
			if(!(isset($_SESSION['logged_in'])) || $_SESSION['logged_in'] == false){
		?>
		<h2 class = "text-center">Sign up</h2>
		<br>
		<br>
		<div class = "row" style = "width : 100%;">
			<form method="post" id = "signup_form" action="uploadSignup.php" enctype="multipart/form-data" class= "width100 alignleft ">  
				<div class = "row">
				
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
						<input type="text" name = "firstname" id="firstname" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "width100 width250px login-input">
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
					<input type="text" name = "lastname" id="lastname" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "width100 width250px login-input">
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
					<input type="text" name =  "email" id="email" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "width100 width250px login-input">
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
					<input type="text" name = "phoneNumber" id="phoneNumber" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "width100 width250px login-input">
					<span id="phonenrerror" class = "error"></span>
				</div>
				  
				
			</div>
				<div class = "row">
					<div class = "col-xs-2 col-sm-1 col-md-2">
					</div>

					<div class = "col-xs-10 col-sm-3 col-md-3">
						<label for = "lastname"> Password: </label> 
						<br>
						<br>									
					</div>
					
					<div class = "col-xs-2 col-sm-1 col-md-1">
					</div>
				
					<div class = "col-xs-10 col-sm-6 col-md-6">
						<input type="password" name = "password" id="password" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "width100 width250px login-input">
						<span id = "passworderror" class = "error"></span>
					</div>
				</div>
				
				<div class = "row">
					<div class = "col-xs-2 col-sm-1 col-md-2">
					</div>

					<div class = "col-xs-10 col-sm-3 col-md-3">
						<label for = "repassword"> Re-type password: </label>
						<br>
						<br>	
					</div>
					
					<div class = "col-xs-2 col-sm-1 col-md-1">
					</div>
				
					<div class = "col-xs-10 col-sm-6 col-md-6">
						<input type="password" name = "repassword" id="repassword" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "width100 width250px login-input">
						<span id = "repassworderror" class = "error"></span>
					</div>
				</div>
				<br>
				
				<div class = "text-center">
					<input type="button" id="submit_btn" class="btn btn-default btn-lg" value = "Sign up" onclick="validateSignup()"> 
					<br><br>
					<div id = "signupError" class="left-align-text"></div>
				</div>
			</form>
		</div>
		<?php
			}else{
				echo "You are not allowed to see this page.";
			}
		?>
	</div>
</div>
<?php include 'footer.php';?>
