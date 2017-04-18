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
        return true;
    }else{
        return false;
    }
}

function checkFirstName(){
    var form = document.getElementById("userForm")
    var name = document.getElementById("firstName")

    if(/^[a-z]+/i.test(name)){
        return true;
    }else if(form.firstName.value == ""){
        document.getElementById("firstNameMissing").style.visibility = "visible";
        return false;
    }

}

function firstNameChanged(){
     document.getElementById("firstNameMissing").style.visibility = "hidden";
}

function checkSurname(){
    var form = document.getElementById("userForm")
    if(form.surname.value == ""){
        document.getElementById("surnameMissing").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

function surnameChanged(){
     document.getElementById("surnameMissing").style.visibility = "hidden";
}


function checkEmail(){
    if(document.getElementById("userForm").email.value == ""){
        document.getElementById("emailMissing").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

function emailChanged(){
    document.getElementById("emailMissing").style.visibility = "hidden";
}


function checkDOB(){
    if(document.getElementById("userForm").DOB.value == ""){
        document.getElementById("DOBMissing").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

function DOBChanged(){
    document.getElementById("DOBMissing").style.visibility = "hidden";
}

function checkPostcode(){
    if(document.getElementById("userForm").postcode.value == ""){
        document.getElementById("postcodeMissing").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

function postcodeChanged(){
    document.getElementById("postcodeMissing").style.visibility = "hidden";
}


function checkUsername(){
    var form = document.getElementById("userForm")
    if(form.username.value == ""){
        document.getElementById("usernameMissing").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

function usernameChanged(){
     document.getElementById("usernameMissing").style.visibility = "hidden";
}

function checkPassword(){
    var form = document.getElementById("userForm")
    if(form.password.value == ""){
        document.getElementById("passwordMissing").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

function passwordChanged(){
     document.getElementById("passwordMissing").style.visibility = "hidden";
}

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

function password2Changed(){
    document.getElementById("passwordsNotMatch").style.visibility = "hidden";
}


function checkTerms(){
    var form = document.getElementById("userForm")
    if(!form.terms.checked){
        document.getElementById("termsNotAgreed").style.visibility = "visible";
        return false;
    }else{
        return true;
    }
}

function termsChecked(){
    document.getElementById("termsNotAgreed").style.visibility = "hidden";
}


