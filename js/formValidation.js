function validateSubmit(){
	var firstNameCheck = document.getElementById('firstnameerror').innerHTML;
	var lastNameCheck = document.getElementById('lastnameerror').innerHTML;
	var emailCheck = document.getElementById('emailerror').innerHTML;
	var phoneNumberCheck = document.getElementById('phonenrerror').innerHTML;
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var email = document.getElementById("email").value;
	var phoneNumber = document.getElementById("phoneNumber").value;
	var fileName =  document.getElementById("file").value;
	
	if((firstNameCheck == "" && lastNameCheck == "" && emailCheck == "" && phoneNumberCheck == "") && firstname != "" && lastname != "" && email != "" && phoneNumber != "" && fileName != ""){
		//window.open("MYSqlInsert.php");
		document.getElementById('submitError').innerHTML = "";
		document.getElementById("submit_form2").submit(); 
	}else if(fileName == ""){

		document.getElementById("submitError").classList.add('alert');	
		document.getElementById("jumbotron-form").classList.add('jumbotron-form-with-error');	
		document.getElementById('submitError').innerHTML = "<span class=\"closebtn\" onclick=\"closeFormError(this)\">&times;</span>  Please upload your resume file.";
		document.getElementById("submitError").style.display='';
		
	}else{
		document.getElementById("submitError").classList.add('alert');	
		document.getElementById("jumbotron-form").classList.add('jumbotron-form-with-error');	
		document.getElementById('submitError').innerHTML = "<span class=\"closebtn\" onclick=\"closeFormError(this)\">&times;</span> Please fill missing fields";
		document.getElementById("submitError").style.display='';
	}
}
function validateSubmit_SUPERUSER(){
	var firstNameCheck = document.getElementById('firstnameerror').innerHTML;
	var lastNameCheck = document.getElementById('lastnameerror').innerHTML;
	var emailCheck = document.getElementById('emailerror').innerHTML;
	var phoneNumberCheck = document.getElementById('phonenrerror').innerHTML;
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var email = document.getElementById("email").value;
	var phoneNumber = document.getElementById("phoneNumber").value;
	var fileName =  document.getElementById("file").value;
	
	if((firstNameCheck == "" && lastNameCheck == "" && emailCheck == "" && phoneNumberCheck == "") && firstname != "" && lastname != "" && email != "" && phoneNumber != "" && fileName != ""){
		//window.open("MYSqlInsert.php");
		document.getElementById('submitError').innerHTML = "";
		document.getElementById("submit_form2").submit(); 
	}else if(fileName == ""){

		document.getElementById("submitError").classList.add('alert');	
		//document.getElementById("jumbotron-form").classList.add('jumbotron-form-with-error');	
		document.getElementById('submitError').innerHTML = "<span class=\"closebtn\" onclick=\"closeFormError(this)\">&times;</span>  Please upload your resume file.";
		document.getElementById("submitError").style.display='';
		
	}else{
		document.getElementById("submitError").classList.add('alert');	
		//document.getElementById("jumbotron-form").classList.add('jumbotron-form-with-error');	
		document.getElementById('submitError').innerHTML = "<span class=\"closebtn\" onclick=\"closeFormError(this)\">&times;</span> Please fill missing fields";
		document.getElementById("submitError").style.display='';
	}
}
function closeFormError(input){
	input.parentElement.style.display='none';
	document.getElementById("jumbotron-form").classList.remove('jumbotron-form-with-error');	
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function requiredField(input) {
	
	
    var namecheck = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
	if (input.id == "firstname") {
		if(input.value.length < 1){
        document.getElementById('firstnameerror').innerHTML = "First name must have at least 1 letter";
		input.style.borderColor = "#e74c3c";
		}
		
	else if(!/^[a-zA-Z]+$/.test(input.value)){
		document.getElementById('firstnameerror').innerHTML = "First name can only include letters";
		input.style.borderColor = "#e74c3c";
		}
		
		else{
			document.getElementById('firstnameerror').innerHTML = "";
			input.style.borderColor = "";
		}
	}
	if (input.id == "lastname") {
		if(input.value.length < 1){
        document.getElementById('lastnameerror').innerHTML = "Last name must have at least 1 letter";
		input.style.borderColor = "#e74c3c";
		}
	else if(!/^[a-zA-Z]+$/.test(input.value)){
		document.getElementById('lastnameerror').innerHTML = "Last name can only include letters";
		input.style.borderColor = "#e74c3c";
		}
	else{
			document.getElementById('lastnameerror').innerHTML = "";
			input.style.borderColor = "";
		}
    }
	if (input.id == "email") {
          if(!validateEmail(input.value)){
		  //red border
          input.style.borderColor = "#e74c3c";
		  document.getElementById('emailerror').innerHTML = "E-mail format is not valid.";
		  }
		  else{
			document.getElementById('emailerror').innerHTML = "";
			input.style.borderColor = "";
		}
    } 
	if (input.id == "phoneNumber"){
		if(!/^[0-9\+\s-]{8,13}$/.test(input.value)){
			input.style.borderColor = "#e74c3c";
			document.getElementById('phonenrerror').innerHTML = "Phone number format is not valid.";
        }
		else{
			document.getElementById('phonenrerror').innerHTML = "";
			input.style.borderColor = "";
		}
	}	
}

