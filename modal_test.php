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
	/*if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	if (isset($_GET["err"]) && $_GET["err"] == 'failed') {
		$err = "Wrong E-mail / Password";
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
	}*/
	
	if(isset($_GET['user']) && $_GET['user'] == 'new'){
		echo '<script type="text/javascript">',
			 'toastr_index_success();',
			 '</script>'
		;
	}
	$_SESSION['title'] = 'Login';
?>

<!--header-->

<html>
	<?php
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
	}
		include 'DBConnection.php';
		include 'GetFromMySQL.php';
		if(!(isset($_SESSION['title']))){ $_SESSION['title'] = 'Login'; }
	?>
	
	<head>
	<link rel="stylesheet" href="css/lib/bootstrap-3.3.7/dist/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/3.3.2.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="css/toastr.min.css">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<script type = "text/javascript" src = "js/3.1.0.jquery.min.js"></script>
	<script type = "text/javascript" src = "js/logInValidation.js"></script>
	<script type = "text/javascript" src = "js/dropdownMenu.js"></script>
	<script type="text/javascript" src="js/formValidation.js"></script>
	<script type="text/javascript" charset="utf8" language="javascript" src="js/DataTables-1.10.7.jquery.js"></script>
	<script type="text/javascript" charset="utf8" language="javascript" src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
	<?php if($_SESSION['title'] == 'List of applications'){ ?>
	<script type="text/javascript" language="javascript" src="js/interviewFilter.js"></script>
	<?php } ?>
	<script type = "text/javascript" src = "js/signupValidation.js"></script>
	<script type="text/javascript" src="js/jscript.js"></script>
	<script type = "text/javascript" src = "js/editApplicantValidation.js"></script>
	<script type = "text/javascript" src = "js/editUserValidation.js"></script>
	<script type = "text/javascript" src = "js/editMyProfileValidation.js"></script>
	<script type = "text/javascript" src = "js/enterListener.js"></script>
	<?php if($_SESSION['title'] == 'List of Users'){ ?>
	<script type = "text/javascript" src = "js/userlistTable.js"></script>
	<?php } ?>
	<script type = "text/javascript" src = "js/toastr.min.js"></script>
	<script type = "text/javascript" src = "js/toastr.js"></script>
	<script type = "text/javascript" src = "js/ajaxApplicantEdit.js"></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
	
	<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<link rel="stylesheet" href="css/datatables/datatables.css">-->
	
	<title><?php echo $_SESSION['title']?></title>
	</head>
	

	<body  class = "backphoto">
	

	
		<div class = "header-nav width100">
		
			<ul class="text-center left-align width100">
			
				<?php
				
					if (!function_exists('isSecure')){
						function isSecure() {
						return ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')) || $_SERVER['SERVER_PORT'] == 443;
						}
					}
					$httpProtocol = isSecure() ? 'https' : 'http';
					$domain = $_SERVER['HTTP_HOST'];
					$url = $httpProtocol . '://' . $domain . '/';
				
					if(isset($_SESSION['logged_in'])) {
						if($_SESSION['user_role'] == 'USER'){
							?>
							<li><a class= "left-align logo-img disappearing-logo transparentbackground paddingleft16px width100" href="https://www.systech.ba/"><img class = "width100 "  src="imgs/systechLogo.png"  alt="SystechLogo"></a></li>
							<li class = "right-align"><a class = "disappearing-div-list linkblock" href="<?php echo $url ?>cvbase/index.php?signout=true">Sign out</a></li>
							<li class = "right-align"><a class = "disappearing-div-list linkblock" href="<?php echo $url ?>cvbase/myProfile.php">My profile</a></li>
							<div class="left-align dropdown appearing-dropdown-list">
								<button class="dropbtn dropblock" onclick="myFunction()">
									&#9776; Menu
								</button>
								<div class="dropdown-content" id="myDropdown">
								
									<a href="<?php echo $url ?>cvbase/myProfile.php">My profile</a>
									<a href="<?php echo $url ?>cvbase/index.php?signout=true">Sign out</a>
								</div>
							</div> 
							
						<?php
							} else if($_SESSION['user_role'] == 'ADMIN'){
						?>
							
							<li><a class= "left-align logo-img disappearing-logo transparentbackground paddingleft16px width100" href="https://www.systech.ba/"><img class = "width100 "  src="imgs/systechLogo.png"  alt="SystechLogo"></a></li>
							<li class = "right-align"><a class = "disappearing-div-list linkblock" href="<?php echo $url ?>cvbase/index.php?signout=true">Sign out</a></li>
							<li class = "right-align"><a class = "disappearing-div-list linkblock" href="<?php echo $url ?>cvbase/ApplicationForm.php">Upload form</a></li>
							<li class = "right-align"><a class = "disappearing-div-list linkblock" href="<?php echo $url ?>cvbase/ApplicationsList.php">Applications</a></li>
							<div class="left-align dropdown appearing-dropdown-list">
								<button class="dropbtn dropblock" onclick="myFunction()">
									&#9776; Menu
								</button>
								<div class="dropdown-content" id="myDropdown">
								
									<a href="<?php echo $url ?>cvbase/ApplicationForm.php">Upload form</a>
									<a href="<?php echo $url ?>cvbase/ApplicationsList.php">Applications</a>
									<a href="<?php echo $url ?>cvbase/index.php?signout=true">Sign out</a>
								</div>
							</div> 
							
						<?php
							} else if($_SESSION['user_role'] == 'SUPERADMIN'){
						?>
							
								<li><a class= "left-align logo-img disappearing-logo transparentbackground paddingleft16px width100" href="https://www.systech.ba/"><img class = "width100 "  src="imgs/systechLogo.png"  alt="SystechLogo"></a></li>
								<li class = "right-align"><a class = "disappearing-div-list linkblock" href="<?php echo $url ?>cvbase/index.php?signout=true">Sign out</a></li>
								<li class = "right-align"><a class = "disappearing-div-list linkblock" href="<?php echo $url ?>cvbase/ApplicationForm.php">Upload form</a></li>
								<li class = "right-align"><a class = "disappearing-div-list linkblock" href="<?php echo $url ?>cvbase/ApplicationsList.php">Applications</a></li>
								<li class = "right-align"><a class = "disappearing-div-list linkblock" href="<?php echo $url ?>cvbase/userList.php">Users</a></li>
								<div class="left-align dropdown appearing-dropdown-list">
									<button class="dropbtn dropblock" onclick="myFunction()">
										&#9776; Menu
									</button>
									<div class="dropdown-content" id="myDropdown">
									
										<a href="<?php echo $url ?>cvbase/ApplicationForm.php">Upload form</a>
										<a href="<?php echo $url ?>cvbase/ApplicationsList.php">Applications</a>
										<a href="<?php echo $url ?>cvbase/userList.php">Users</a>
										<a href="<?php echo $url ?>cvbase/index.php?signout=true">Sign out</a>
									</div>
								</div> 
							
						
					<?php
						}
					}
					else{
						?>
						<li><a class= "left-align logo-img disappearing-logo transparentbackground paddingleft16px width100" href="https://www.systech.ba/"><img class = "width100"  src="imgs/systechLogo.png"  alt="SystechLogo"></a></li>
						<li class = "right-align"><a class = "disappearing-div-index linkblock" href="<?php echo $url ?>cvbase/"><b>SIGN IN!</b></a></li>
						<li class = "right-align"><a class = "disappearing-div-index linkblock" href="<?php echo $url ?>cvbase/ApplicationForm.php"><b>APPLY!</b></a></li>
						<div class="left-align dropdown appearing-dropdown-index">
							<button class="dropbtn dropblock" onclick="myFunction()">
								&#9776; Menu
							</button>
							<div class="dropdown-content" id="myDropdown">
								<a href="<?php echo $url ?>cvbase/">SIGN IN!</a>
								<a href="<?php echo $url ?>cvbase/ApplicationForm.php">APPLY!</a>
							</div>
						</div> 
						<br>
				<?php
				
				}
				?>
			</ul>
			
		</div>
					
	
<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
					
<!--
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>-->


<!--
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
-->
<?php include 'footer.php';?>
