				
				<html>
	<?php
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
	}
	?>
	<title>Login</title>
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="/cvbase/css/lib/bootstrap-3.3.7/dist/css/bootstrap.min.css" type="text/css">
	<script type = "text/javascript" src = "js/logInValidation.js"></script>
	
	<title><?php echo $_SESSION['title']?></title>
	
	<div class="container container-rel">
			<body>
			<ul class="nav navbar-default text-center width100">
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
							<br>
							<div class = "col-sm-6">
								<li><a href="<?php echo $url ?>cvbase/myProfile.php">My profile</a></li>
							</div>
							   
							
							
							<div class = "col-sm-6">
								<li><a href="<?php echo $url ?>cvbase/index.php?signout=true">Sign out</a></li>	
								<br>					
							</div>
						<?php
							} else if($_SESSION['user_role'] == 'ADMIN'){
						?>
							<br>
							<div class = "col-sm-4">
								<li><a href="<?php echo $url ?>cvbase/ApplicationForm.php">Upload form</a></li>
							</div>
							
							<div class = "col-sm-4">
								<li><a href="<?php echo $url ?>cvbase/ApplicationsList.php">Applications</a></li>
							</div>
						
							<div class = "col-sm-4">
								<li><a href="<?php echo $url ?>cvbase/index.php?signout=true">Sign out</a></li>
								<br>
							</div>
						<?php
							} else if($_SESSION['user_role'] == 'SUPERADMIN'){
						?>
							<br>
							<div class = "col-sm-3">
								<li><a href="<?php echo $url ?>cvbase/ApplicationForm.php">Upload form</a></li>
							</div>
							<div class = "col-sm-3">
								<li><a href="<?php echo $url ?>cvbase/ApplicationsList.php">Applications</a></li>
							</div>
							  
							<div class = "col-sm-3">
								<li><a href="<?php echo $url ?>cvbase/userList.php">Users</a></li>
							</div>
							  
							<div class = "col-sm-3">
								<li><a href="<?php echo $url ?>cvbase/index.php?signout=true">Sign out</a></li>
								<br>
							</div>
					<?php
						}
					}
					else{
						?>
						<br>
						<div class = "col-sm-4">
							<li><a href="<?php echo $url ?>cvbase/ApplicationForm.php">Apply!</a></li>
						</div>
						  
						<div class = "col-sm-4">
						</div>
						
						<div class = "col-sm-4">
						
							<li><a href="<?php echo $url ?>cvbase/">Sign in!</a></li>
							<br>				
						</div>
				<?php
				
				}
				?>
			</ul>
			
			<div class="centered-content">
				<div class = "row display-inline width480px">
					<div class = "row" >
					</div>
				</div>
				<div class="footer" style = "width:100%;">
					Systech doo 2019
				</div>	
			</div>
		</body>
	</div>
</html>