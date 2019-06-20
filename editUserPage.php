<?php
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$_SESSION['title'] = "Edit user";
	
	$ID = $_GET["ID"];
	
	include 'header.php';
	include 'classes/suser.php';
	
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
	
	if($_GET['errf'] == 1){
		echo '<script type="text/javascript">',
			 'toastr_user_error();',
			 '</script>'
		;
	}
	
	$_SESSION['updateUserID'] = $id;
?>
			
<div class="container container-rel">
	<div class = "jumbotron jumbotron-index form-align text-center vertical-center-edit-app max-width765px ">
		<?php
			if(isset($_SESSION['logged_in'])) {
				if($_SESSION['user_role'] == 'SUPERADMIN'){
		?>	
		<div class = "row">
		
		<h2 class = "text-center">Edit user</h2>	
		<br>					
		<form method="post" id = "update_form" action="updateUserList.php" enctype="multipart/form-data" style = "text-align:left; width : 100%;">  
			
			<div class="row">

				<div class = "col-xs-2 col-sm-1 col-md-3">
				</div>

				<div class = "col-xs-10 col-sm-3 col-md-2">
					<label for = "lastname"> First name: </label> 	
					<br>
					<br>
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
				
				<div class = "col-xs-5 col-sm-2 col-md-3">
					<input type="text" name = "firstname" id="firstname"  value=<?php echo $firstname; ?> onkeypress="enterCalls(this)" onblur="checkEditUserField(this)" style = "width = 100%;">
					<span id = "firstnameerror" class = "error"></span>
				</div>

			</div>
		  
			<div class = "row">
		  
				<div class = "col-xs-2 col-sm-1 col-md-3">
				</div>

				
				<div class = "col-xs-10 col-sm-3 col-md-2">
					<label for = "lastname"> Last name: </label> 		
					<br>
					<br>
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
				
				<div class = "col-xs-10 col-sm-2 col-md-3">
					<input type="text" name = "lastname" id="lastname"  value=<?php echo $lastname; ?>  onkeypress="enterCalls(this)" onblur="checkEditUserField(this)">
					<span id="lastnameerror" class = "error"></span>
				</div>
				  
				
			</div>
			
			<div class = "row">
				
				<div class = "col-xs-2 col-sm-1 col-md-3">
				</div>
				
				<div class = "col-xs-10 col-sm-3 col-md-2">
					<label for = "email"> E-mail: </label> 	
					<br>
					<br>  
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
											
				<div class = "col-xs-10 col-sm-2 col-md-2">
					<input type="text" name =  "email" id="email" value=<?php echo $email; ?> disabled>
					<span id="emailerror" class = "error"></span>
				</div>
				  
			</div>
		  
			<div class = "row">
				 
				<div class = "col-xs-2 col-sm-1 col-md-3">
				</div>
				 
				<div class = "col-xs-10 col-sm-3 col-md-2">
					<label for = "phoneNumber"> Phone number: </label> 	
					<br>
					<br>
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
				<div class = "col-xs-10 col-sm-2 col-md-3">
					<input type="text" name = "phoneNumber" id="phoneNumber" value=<?php echo $phnumber; ?> disabled>
					<span id="phonenrerror" class = "error"></span>
				</div>
			</div>
			
			<div class = "row">
				<div class = "col-xs-2 col-sm-1 col-md-3">
				</div>
				 
				<div class = "col-xs-10 col-sm-3 col-md-2">
					<label for = "lastname"> New password: </label> 
					<br>
					<br>									
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
				 
				<div class = "col-xs-10 col-sm-2 col-md-3">
					<input type="password" name = "password" id="password" onkeypress="enterCalls(this)" onblur="checkEditUserField(this)" style = "width:250px;">
					<span id = "passworderror" class = "error"></span>
				</div>
			</div>
			
			<div class = "row">
				<div class = "col-xs-2 col-sm-1 col-md-3">
				</div>
				 
				<div class = "col-xs-10 col-sm-3 col-md-2">
					<label for = "lastname"> Re-type new password: </label>
					<br>
					<br>	
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
				 
				<div class = "col-xs-10 col-sm-2 col-md-3">
					<input type="password" name = "repassword" id="repassword" onkeypress="enterCalls(this)" onblur="checkEditUserField(this)" style = "width:250px;">
					<span id = "repassworderror" class = "error"></span>
				</div>
			</div>
			
			<div class = "row">
				<div class = "col-xs-2 col-sm-1 col-md-3">
				</div>
				 
				<div class = "col-xs-10 col-sm-3 col-md-2">
					<label for = "lastname"> Assign role: </label>
					<br>
					<br>	
				</div>
				
				<div class = "col-xs-2 col-sm-1 col-md-1">
				</div>
				 
				<div class = "col-xs-10 col-sm-2 col-md-3">
					<select name="Select_role">
					  <option <?php if($user_role == 'USER'){echo("selected");}?> value="USER">User</option>
					  <option <?php if($user_role == 'ADMIN'){echo("selected");}?> value="ADMIN">Admin</option>
					  <option <?php if($user_role == 'SUPERADMIN'){echo("selected");}?> value="SUPERADMIN">Superadmin</option>
					</select> 
				</div>
			</div>
			<div class = "row text-center">
					<input type="button" id="submit_btn" class="btn btn-default btn-lg" value = "Update" onclick="validateUserEdit()">
					<a class="btn btn-default btn-lg" href = "userList.php" style = "color:black;">Cancel</a>
						<span id = "edit_user_error" class = "error"></span>
			</div>
		</form>
		<?php	
				}else{ 
					echo "You do not have the permission to see this page!";
					} 
			}
			else{
				echo "Please sign up to see this page.";
			}?>
</div>
<?php include 'footer.php';?>
