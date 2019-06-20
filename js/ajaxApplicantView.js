$(document).on('click', '.applicant_info',function(){
	var id = this.id;
	var splitid = id.split('_');
	var userid = splitid[1];
	console.log('clicked');
	
	// AJAX request
	$.ajax({
		url: 'viewApplicantModal.php',
		type: 'post',
		data: {userid: userid},
		success: function(response){ 
			// Add response in Modal body
			$('.modal-content').html(response);

			// Display Modal
			$('#empModal').modal('show'); 
		}
	});
});