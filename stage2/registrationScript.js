
// function that checks all fields during registration and allows submition
// if everything okay
function validate(){
    var firstNameOkay = checkFirstName();
    var surnameOkay = checkSurname();
    var emailOkay = checkEmail();
    var DOBOkay = checkDOB();
    var postcodeOkay = checkPostcode();
    var usernameOkay = checkUsername();
    var pwordOkay = checkPassword();
    var pwordMatch = checkPasswordMatch();
    var termsAgreed = checkTerms();
    if(firstNameOkay && surnameOkay && emailOkay && DOBOkay && postcodeOkay && usernameOkay && pwordOkay && pwordMatch && termsAgreed){
        document.getElementById("userForm").submit();
        return true;
    } else {
        return false;
    }
}

// function that checks if the username and password are not blank when logging in
function validateLogin() {
    var loginUsernameOkay = checkUsername();
    var loginPasswordOkay = checkPassword();
    if (loginUsernameOkay && loginPasswordOkay){
        window.alert("Login successful, redirecting...")
        //document.getElementById("loginForm").submit();
        return true;
    }
    else {
        return false;
    }
}

// tests for valid first name
function checkFirstName(){
    var form = document.getElementById("userForm")
    var regex1 = /^[a-z]+/i;
    var regex2 = /^[0-9]+/;

    if(regex1.test(form.firstName.value)){
        return true;
    }else if((form.firstName.value == "")||(regex2.test(form.firstName.value))){
        document.getElementById("firstNameMissing").style.visibility = "visible";
        firstName.focus();
        return false;
    }
}

//hides error message (called on keypress)
function firstNameChanged(){
     document.getElementById("firstNameMissing").style.visibility = "hidden";
}

// tests for valid surname
function checkSurname(){
    var form = document.getElementById("userForm")
    var regex1 = /^[a-z]+/i;
    var regex2 = /^[0-9]+/;

    if (regex1.test(form.surname.value)){
        return true;
    } else if ((form.surname.value == "")||(regex2.test(form.surname.value))){
        document.getElementById("surnameMissing").style.visibility = "visible";
        return false;
    }
}

//hides error message (called on keypress)
function surnameChanged(){
     document.getElementById("surnameMissing").style.visibility = "hidden";
}

// tests for valid email
function checkEmail(){
    var form = document.getElementById("userForm")
    var regex = /\S+@\S+\.\S+/;

    if(regex.test(form.email.value)){
        return true;
    }else {
        document.getElementById("emailMissing").style.visibility = "visible";
        return false;
    }

}

//hides error message (called on keypress)
function emailChanged(){
    document.getElementById("emailMissing").style.visibility = "hidden";
}


// tests for valid date of birth (must be after 1900)
function checkDOB(){
    var form = document.getElementById("userForm")
    var regex = /^(((0[1-9]|[12]\d|3[01])\-(0[13578]|1[02])\-((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\-(0[13456789]|1[012])\-((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\-02\-((19|[2-9]\d)\d{2}))|(29\-02\-((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/;

    if (regex.test(form.DOB.value)){
        return true;
    } else{
        document.getElementById("DOBMissing").style.visibility = "visible";
        return false;
    }

}

//hides error message (called on keypress)
function DOBChanged(){
    document.getElementById("DOBMissing").style.visibility = "hidden";
}

// tests for valid postcode (4 digits)
function checkPostcode(){
    var form = document.getElementById("userForm")
    var regex = /[0-9]{4}/;

    if (regex.test(form.postcode.value)){
        return true;
    } else{
        document.getElementById("postcodeMissing").style.visibility = "visible";
        return false;
    }
}

//hides error message (called on keypress)
function postcodeChanged(){
    document.getElementById("postcodeMissing").style.visibility = "hidden";
}


// tests for valid surname (not blank)
function checkUsername(){
    var form = document.getElementById("userForm")
    if(form.username.value == ""){
        document.getElementById("usernameMissing").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

//hides error message (called on keypress)
function usernameChanged(){
     document.getElementById("usernameMissing").style.visibility = "hidden";
}

// tests for valid password (not blank)
function checkPassword(){
    var form = document.getElementById("userForm")
    if(form.password.value == ""){
        document.getElementById("passwordMissing").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

//hides error message (called on keypress)
function passwordChanged(){
     document.getElementById("passwordMissing").style.visibility = "hidden";
}

// tests for matching passwords
function checkPasswordMatch(){
    var p1 = document.getElementById("userForm").password.value;
    var p2 = document.getElementById("userForm").confirmPassword.value;
    if(p1 === p2){
        return true;
    }else{
        document.getElementById("passwordsNotMatch").style.visibility = "visible";
        return false;
    }
}

//hides error message (called on keypress)
function password2Changed(){
    document.getElementById("passwordsNotMatch").style.visibility = "hidden";
}


// tests if terms and conditions checkbox is ticked
function checkTerms(){
    var form = document.getElementById("userForm")
    if(!form.terms.checked){
        document.getElementById("termsNotAgreed").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

//hides error message (called on keypress)
function termsChecked(){
    document.getElementById("termsNotAgreed").style.visibility = "hidden";
}


