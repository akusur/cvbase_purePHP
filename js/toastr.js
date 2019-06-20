//toastr
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "swing",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

function toastr_user_success(){
	toastr["success"]("User info updated", "Success");
}

function toastr_user_error(){
	toastr["error"]("Could not update user info", "Failed");
}
function toastr_index_login_failed(){
	toastr["error"]("Please try again.", "Wrong email/password");
}

function toastr_applicant_error(){
	toastr["error"]("Could not update applicant info", "Failed");
}

function toastr_applicant_success(){
	toastr["success"]("Applicant info updated", "Success");
}
function toastr_file_update_error(){
	toastr["error"]("Profile update failed", "Error");
}

function toastr_profile_update_error(){
	toastr["error"]("Profile update failed", "Error");
}

function toastr_profile_update_success(){
	toastr["success"]("Profile updated successfully", "Success");
}

function toastr_applicant_admin_success(){
	toastr["success"]("Record saved", "Success");
}

function toastr_new_applicant_success(){
	toastr["success"]("Thank you for applying", "Application recieved!");
}

function toastr_index_success(){
	toastr["success"]("Please sign in to continue", "Signed up succesfully!");
}
