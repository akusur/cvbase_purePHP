<!--header-->

<html>
	<?php
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
	}
		include 'DBConnection.php';
		
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
	<script type = "text/javascript" src = "js/ajaxApplicantView.js"></script>
	<script type = "text/javascript" src = "js/ajaxApplicantEdit.js"></script>
	<script type = "text/javascript" src = "js/ajaxUserEdit.js"></script>
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
						