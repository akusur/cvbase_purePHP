<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$_SESSION['title'] = 'List of applications';
	
	include 'classes/applicant.php';
	include 'header.php';
	include 'GetFromMySQL.php';
	
	/*$ses = session_id();
	echo "<pre>";
	print_r($ses);
	echo "</pre>";
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";*/
	if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'SUPERADMIN'){
		$tableid = "ListofApplications";
	}else if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'ADMIN'){
		$tableid = "ListofApplicationsAdmin";
	}
	if(isset($_GET['succ']) && $_GET['succ'] == 1){
		echo '<script type="text/javascript">',
			 'toastr_applicant_success();',
			 '</script>'
		;
	}
	if(isset($_SESSION['logged_in'])) {
		if($_SESSION['user_role'] == 'SUPERADMIN'){
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
	<?php
		}
	}
	?>
	
<div id = "page-wrap" class="container container-rel min-width1020px">
	<div class = "jumbotron text-center vertical-center-list">
		<?php
			if(isset($_SESSION['logged_in'])) {
				if($_SESSION['user_role'] == 'SUPERADMIN' || $_SESSION['user_role'] == 'ADMIN'){
		?>
					<div class = "row text-center">
						<div class = "col-sm-4">
						</div>
						
						<div class = "col-sm-4">
							<h2 class = "text-center">Application List</h2>
						</div>
						
						<div class = "col-sm-4">
						</div>
					</div>
		<?php
					$ApplicantsArray = array();
					while($row = $appData->fetch_assoc()){
						$ApplicantsArray[] = new Applicant($row['ID'], $row['FirstName'], $row['Surname'], $row['PhoneNumber'], $row['Email'], $row['InterviewDate'], $row['Comment'] , $row['ResumeFileURL']);
					}
		?>

					
					<table id = <?php echo $tableid;?> class=" table-striped table-bordered table" class = "width100 min-width765px">
						<thead>
							 <tr>
								<th>First name</th>
								<th>Last name</th>
								<th>Phone number</th>
								<th>E-mail</th>
								<th>Interview date</th>	
								<?php
									if($_SESSION['user_role'] == 'SUPERADMIN'){
								?>
									<th>Comment</th>	
								<?php
									}
								?>		
								<th>Resume</th>
								<?php
									if($_SESSION['user_role'] == 'SUPERADMIN'){
								?>
										<th>Edit/View</th>
								<?php
									}
								?>
							 </tr>
						</thead>
						<tbody id="myTable">
							<?php
								foreach($ApplicantsArray as $tmpApplicant){
									$applicantData = $tmpApplicant->Get();
									echo '<tr>';
									for($i = 1; $i <= 6; $i++){
										if($i == 5){
											if($applicantData[$i] == 0){
												echo "<td>Not interviewed</td>";
											}
											else{
												echo "<td>".date('m/d/Y', $applicantData[$i])."</td>";
											}
										}else if($i == 6 && $_SESSION['user_role'] == 'SUPERADMIN'){
											if($applicantData[$i] == '' || ctype_space($applicantData[$i])){
												echo "<td></td>";
											}
											else{
												echo "<td class = \"text-center\"> <img src=\"imgs\\commentIcon.png\" alt=\"CommentIcon\" title = '".$applicantData[6]."' width=\"30\" height=\"20\"> </td>";
											}
										}else if($i != 6){
											echo "<td>". $applicantData[$i] ."</td>";
										}
										
									}  
									$pdfURL = $applicantData[7];
									echo "<td class = \"text-center\">", "<a href=", "\"", $applicantData[7], "\"", "target= ", "\"","_blank", "\"", "><img src=\"imgs\\pdfIcon.png\" alt=\"CommentIcon\" title = \"Open resume\" width=\"20\" height=\"20\"></a> </td>";
									if($_SESSION['user_role'] == 'SUPERADMIN'){
										echo "<td class = \"text-center\"><a id = \"app_".$applicantData[0]."\" class = \"applicant_edit\"><img src=\"imgs\\editIcon.png\" title = \"Edit user\" alt=\"CommentIcon\" width=\"20\" height=\"20\"></a>  
										<a id = \"app_".$applicantData[0]."\" class = \"applicant_info\"> <img src=\"imgs\\viewUserIcon.png\" srcset=\"imgs\\viewUserIcon.svg\" title = \"View user info\" alt=\"CommentIcon\" width=\"20\" height=\"20\"></a></td>";
									}
									echo '</tr>';
								}
								
							?>
						</tbody>
					</table>
				<?php
					}else if($_SESSION['user_role'] == 'ADMIN'){
						
							
					}
					}else {
						echo "Please sign up to see this page.";
					}
				?>
	</div>
</div>
<?php include 'footer.php';?>
