function validateSignup(){
			var firstNameCheck = document.getElementById('firstnameerror').innerHTML;
			var lastNameCheck = document.getElementById('lastnameerror').innerHTML;
			var emailCheck = document.getElementById('emailerror').innerHTML;
			var phoneNumberCheck = document.getElementById('phonenrerror').innerHTML;
			var firstname = document.getElementById("firstname").value;
			var lastname = document.getElementById("lastname").value;
			var email = document.getElementById("email").value;
			var phoneNumber = document.getElementById("phoneNumber").value;
			var passwordCheck = document.getElementById('passworderror').innerHTML;
			var passwrd = document.getElementById('password').value;
			var repasswordCheck = document.getElementById('repassworderror').innerHTML;
			var repasswrd = document.getElementById('repassword').value;
			

			console.log('Click');
			
			if((firstNameCheck == "" && lastNameCheck == "" && emailCheck == "" && phoneNumberCheck == "") && firstname != "" && lastname != "" && email != "" && phoneNumber != "" && passwordCheck == "" && passwrd != "" && repasswordCheck == "" && repasswrd != "" ){
				document.getElementById('signupError').innerHTML = "";
				document.getElementById("signup_form").submit(); 
			}
			else{
				document.getElementById("signupError").classList.add('alert');	
				document.getElementById("jumbotron-signup").classList.add('jumbotron-form-with-error');	
				document.getElementById('signupError').innerHTML = "<span class=\"closebtn\" onclick=\"closeSignupError(this);\">&times;</span>  Please fill missing fields.";
				document.getElementById("signupError").style.display='';
			}
		}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function closeSignupError(input){
	input.parentElement.style.display='none';
	document.getElementById("jumbotron-signup").classList.remove('jumbotron-form-with-error');	
}

function requiredField(input) {
	
	
	
	if (input.id == "username") {
		if(input.value.length < 1){
        document.getElementById('usernameerror').innerHTML = "Username must have at least 1 letter";
		input.style.borderColor = "#e74c3c";
		}
	else{
			document.getElementById('usernameerror').innerHTML = "";
			input.style.borderColor = "";
		}
    }
	
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
	if (input.id == "password"){
		if(input.value.length < 8){
			input.style.borderColor = "#e74c3c";
			document.getElementById('passworderror').innerHTML = "Password too short.";
        }
		else{
			document.getElementById('passworderror').innerHTML = "";
			input.style.borderColor = "";
		}
	}
	if (input.id == "repassword"){
		if(input.value.length < 1){
			input.style.borderColor = "#e74c3c";
			document.getElementById('repassworderror').innerHTML = "Field cannot be empty.";
        }
		else if(input.value != document.getElementById('password').value){
			input.style.borderColor = "#e74c3c";
			document.getElementById('repassworderror').innerHTML = "Passwords do not match.";
        }
		else{
			document.getElementById('repassworderror').innerHTML = "";
			input.style.borderColor = "";
		}
	}
}

