<?php

	if(isset($_GET['signout']) && $_GET['signout'] == 'true'){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		// Unset all of the session variables.
		$_SESSION = array();

		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}

		// Finally, destroy the session.
		session_destroy();
	}
	
	if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
	
	
	
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
		
		switch($_SESSION['user_role']){
			case 'USER':
				header("location:myProfile.php");
				break;
			
			case 'ADMIN':
			case 'SUPERADMIN':
				header("location:ApplicationsList.php");
				break;

		}
	}
	
	include 'header.php'; 
	
	if(isset($_GET['user']) && $_GET['user'] == 'new'){
		echo '<script type="text/javascript">',
			 'toastr_index_success();',
			 '</script>'
		;
	}
	if (isset($_GET["err"]) && $_GET["err"] == 'failed') {
		echo '<script type="text/javascript">',
			 'toastr_index_login_falied();',
			 '</script>'
		;
	}
	
	$_SESSION['title'] = 'Login';
?>

<div class="container container-rel">
	<div id = "jumbotron-index" class = "jumbotron text-center vertical-center max-width450px jumbotron-index">
		<h2 class = "text-center">Sign in</h2>
		<form method="post" id = "login_form" action="login.php" enctype="multipart/form-data" class= "width100 alignleft">  
			<div class="row">
				<div class = "col-sm-10 col-sm-offset-1">
					<label for = "email"> E-mail: </label>
				</div>
			</div>
			<div class = "row">
				<div class = "col-sm-10 col-sm-offset-1 col-8 col-offset-2">
					<input type="text" name = "email" id="email" onkeypress="enterCalls(this)" onblur="requiredField(this)"  class = "login-input" >
				</div>
			</div>
			<div class = "row">
				<div class = "col-sm-10 col-sm-offset-1">
					<span id = "emailerror" class = "error"></span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class = "col-sm-10 col-sm-offset-1">
					<label for = "password"> Password: </label> 	
				</div>
			</div>
			<div class = "row">
				<div class = "col-sm-10 col-sm-offset-1  col-8 col-offset-2">
					<input type="password" name = "password" id="password" onkeypress="enterCalls(this)" onblur="requiredField(this)" class = "login-input">
				</div>
				<div class = "col-sm-10 col-sm-offset-1">
					<span id = "passworderror" class = "error"></span>
						<?php
							if(isset($err) && !empty($err)){
						?>
					<br><span id = "passworderror" class = "error"><?php echo $err;?></span>
					<?php
						}
					?>
				</div>
			</div>
			<div class = "row">
				<div class = "col-sm-1">
				</div>
				<div class = "col-sm-5">
					<a href = "#" style = "font-size: 12px;">
						Forgot password?
					</a>
				</div>
				<div class = "col-sm-6">
				</div>
			</div>
			<div class = "row">
				<div class = "col-sm-1">
				</div>
				<div class = "col-sm-8" style = "font-size: 12px;">
					Not registered? 
					<a href = "signup.php" >
						Sign up!
					</a>
				</div>
				
			</div>
			<br>
			<div class = "row text-center">
				<input type = "button" class="btn btn-default btn-lg" id="submit_btn" value = "Login" onclick="validateLogIn()" style = "width:30%">
				<br><br>
				<div id = "loginerror" class="left-align-text"></div>
			</div>
		</form>
	</div>
</div>
<?php include 'footer.php';?>
