<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$_SESSION['title'] = 'List of Users';
	
	include 'header.php';
	include 'classes/suser.php';
	include 'GetFromMySQL.php';
	
	if(isset($_GET['succ']) && $_GET['succ'] == 1){
		echo '<script type="text/javascript">',
			 'toastr_user_success();',
			 '</script>'
		;
	}
	if(isset($_GET['errf']) && $_GET['errf'] == 1){
		echo '<script type="text/javascript">',
			 'toastr_user_error();',
			 '</script>'
		;
	}
	
?>

	<!-- Modal -->
	<div class="modal fade" tabindex= "-1" id="empModal" role="dialog" >
		<div class="modal-dialog" role = "document">

			<!-- Modal content-->
			<div class="modal-content">
			
				<!--<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>-->
			</div>
		</div>
	</div>


<div id = "page-wrap" class="container container-rel min-width1020px">
	<div class = "jumbotron text-center vertical-center-list">
		<?php
			if(isset($_SESSION['logged_in'])) {
				if($_SESSION['user_role'] == 'SUPERADMIN'){
		?>
				<div class = "row text-center">
					<div class = "col-sm-4">
					</div>
					
					<div class = "col-sm-4">
						<h2 class = "text-center">User List</h2>
					</div>
					
					<div class = "col-sm-4">
					</div>
				</div>

				
				<?php

					$UsersArray = array();
					while($row = $usersData->fetch_assoc()){	
						$UsersArray[] = new SUser($row['ID'], $row['FirstName'], $row['LastName'], $row['PhoneNumber'], $row['Email'], $row['Role']);
					}
				?>

				<br>
					<table id = "ListofUsers" class=" table-striped table-bordered table"  class = "width100 min-width765px">
						<thead>
							 <tr>
								<th>First name</th>
								<th>Last name</th>
								<th>Phone Number</th>
								<th>E-mail</th>
								<th>Role</th>
								<?php
								if($_SESSION['user_role'] == 'SUPERADMIN'){
								?>
									<th>Edit user</th>
								<?php
									}
								?>
							 </tr>
						</thead>
						<tbody id="myTable">
							<?php
						
								foreach($UsersArray as $tmpUser){
									$userData = $tmpUser->Get();
									echo '<tr>';
									for($i = 1; $i <= 5; $i++){
										echo "<td>". $userData[$i] ."</td>";
									}  
									if($_SESSION['user_role'] == 'SUPERADMIN'){
										echo "<td class = \"text-center\"><a id = \"user_".$userData[0]."\" class = \"user_edit\"><img src=\"imgs\\editIcon.png\" title = \"Edit user\" alt=\"CommentIcon\" width=\"20\" height=\"20\"></a>   </td>";
									}
									echo '</tr>';
								}
								
							?>
								</tbody>
							</table>
						
				
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
	
	
	<?php include 'footer.php';?>
</div>
