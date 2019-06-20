function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function requiredField(input) {
	if (input.id == "email") {
          if(!validateEmail(input.value) && input.value.length > 0){
				//red border
				input.style.borderColor = "#e74c3c";
				document.getElementById('emailerror').innerHTML = "E-mail format is not valid.";
			} else {
				document.getElementById('emailerror').innerHTML = "";
				input.style.borderColor = "";
			}
    } 
	
	if (input.id == "password"){
		if(input.value.length < 8 && input.value.length > 0){
			input.style.borderColor = "#e74c3c";
			document.getElementById('passworderror').innerHTML = "Password too short.<br>";
        }
		else{
			document.getElementById('passworderror').innerHTML = "";
			input.style.borderColor = "";
		}
	}	
}

function closeLoginError(input){
	input.parentElement.style.display='none';
	document.getElementById("jumbotron-index").classList.remove('jumbotron-index-with-error');	
}

function validateLogIn(){
	
	var emailCheck = document.getElementById("emailerror").innerHTML;
	var passwordCheck = document.getElementById('passworderror').innerHTML;
	var email = document.getElementById("email").value;
	var passwrd = document.getElementById('password').value;

	if(emailCheck == "" && passwordCheck == "" && email != "" && passwrd != ""){
		//window.open("MYSqlInsert.php");
		document.getElementById("login_form").submit(); 
		document.getElementById('loginerror').innerHTML = "";
	}
	else{
		document.getElementById("loginerror").classList.add('alert');	
		document.getElementById("jumbotron-index").classList.add('jumbotron-index-with-error');	
		document.getElementById('loginerror').innerHTML = "<span class=\"closebtn\" onclick=\"closeLoginError(this);\">&times;</span>  Please fill missing fields.";
		document.getElementById("loginerror").style.display='';
	}
	
}