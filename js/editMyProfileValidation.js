function checkField(input) {
			
		
    var namecheck = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
	if (input.id == "firstname") {
		
		if(!/^[a-zA-Z]+$/.test(input.value)  && input.value.length != 0){
			document.getElementById('firstnameerror').innerHTML = "First name can only include letters";
			input.style.borderColor = "#e74c3c";
			}
		
		else{
			document.getElementById('firstnameerror').innerHTML = "";
			input.style.borderColor = "";
		}
	}
	if (input.id == "lastname") {
	
		if(!/^[a-zA-Z]+$/.test(input.value)  && input.value.length != 0){
			document.getElementById('lastnameerror').innerHTML = "Last name can only include letters";
			input.style.borderColor = "#e74c3c";
			}
		else{
				document.getElementById('lastnameerror').innerHTML = "";
				input.style.borderColor = "";
			}
    }
	
	if (input.id == "phoneNumber"){
		if(!/^[0-9\+\s-]{8,13}$/.test(input.value) && input.value.length != 0){
			input.style.borderColor = "#e74c3c";
			document.getElementById('phonenrerror').innerHTML = "Phone number format is not valid.";
        }
		else{
			document.getElementById('phonenrerror').innerHTML = "";
			input.style.borderColor = "";
		}
	}
}

function validateMyProfileEdit(){
	var firstNameCheck = document.getElementById('firstnameerror').innerHTML;
	var lastNameCheck = document.getElementById('lastnameerror').innerHTML;
	var phoneNumberCheck = document.getElementById('phonenrerror').innerHTML;
	//var passwordCheck = document.getElementById('passworderror').innerHTML;
	//var repasswordCheck = document.getElementById('repassworderror').innerHTML;
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var phoneNumber = document.getElementById("phoneNumber").value;
	//var passwrd = document.getElementById('password').value;
	//var repasswrd = document.getElementById('repassword').value;
	
	if(firstNameCheck == "" && lastNameCheck == "" && phoneNumberCheck == ""  && !(firstname == "" && lastname == "" && phoneNumber == ""))
	{
		//window.open("MYSqlInsert.php");
		document.getElementById("edit_myprofile_error").innerHTML = "";
		document.getElementById("update_form").submit(); 
	}
	else if(firstname == "" && lastname == "" && phoneNumber == "" && passwrd == ""){
		document.getElementById('edit_myprofile_error').innerHTML = "All fields are empty, nothing to update.";
	}
	else{
		document.getElementById('edit_myprofile_error').innerHTML = "Please fill missing fields";
	}
}