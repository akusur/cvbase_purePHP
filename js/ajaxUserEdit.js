$(document).on('click', '.user_edit',function(){
	var id = this.id;
	var splitid = id.split('_');
	var user_id = splitid[1];
	
	console.log('clicked');
	
	// AJAX request
	$.ajax({
		url: 'editUserModal.php',
		type: 'post',
		data: {user_id: user_id},
		success: function(response){ 
			// Add response in Modal body
			$('.modal-content').html(response);

			// Display Modal
			$('#empModal').modal('show'); 
		}
	});
});
