window.onload = function() {
	function nonEmptyField(field){
		if(field.value.length > 1){
			return true;
		} else {
			return false;
		}
	}

	document.getElementById("loginButton").addEventListener("click", function(){
		var notEmpty = 0;

		if nonEmptyField(document.getElementById("username")){
			notEmpty++;
		} else {
			document.getElementById("usernameMissing").style.visibility = "visible";
			return 0;
		}

		if nonEmptyField(document.getElementById("password")){
			notEmpty++;
		} else {
			document.getElementById("passwordMissing").style.visibility = "visible";
			return 0;
		}

		if (notEmpty == 2){
			document.getElementById("loginForm").submit();
		}

	});

	//hides error message
	function emailChanged(){
	    document.getElementById("emailMissing").style.visibility = "hidden";
	}

	//hides error message
	function passwordChanged(){
	     document.getElementById("passwordMissing").style.visibility = "hidden";
	}
}

