/*
/ Checks validation of the form and then submits form if all checks are passed.
/ Returns false if a check fails otherwise returns true.
*/
function validate() {
  var checkFailed = false;
  if (!checkUsername()) checkFailed = true;
  if (!checkPassword()) checkFailed = true;
  if (!checkConfirmPassword()) checkFailed = true;
  if (checkFailed == true) return false;
  window.alert("Form submitted");
  return true;
}

/*
/ Checks the validation of the username field.
/ Returns false if username is empty otherwise returns true.
*/
function checkUsername() {
  var username = document.forms["registrationForm"]["username"];
  if (username.value == "") {
    username.focus();
    document.getElementById("usernameRequired").style.visibility = "visible";
    return false;
  }
  return true;
}

/*
/ Resets the username required message to hidden.
*/
function resetusernameRequired() {
  document.getElementById("usernameRequired").style.visibility = "hidden";
}

/*
/ Checks the validation of the password field.
/ Returns false if password is empty otherwise returns true.
*/
function checkPassword() {
  var password = document.forms["registrationForm"]["password"];
  if (password.value == "") {
    password.focus();
    document.getElementById("passwordRequired").style.visibility = "visible";
    return false;
  }
  return true;
}

/*
/ Resets the password required message to hidden.
*/
function resetPasswordRequired() {
  document.getElementById("passwordRequired").style.visibility = "hidden";
}

/*
/ Checks if both passwords are the same.
/ Returns fase if confirm password != password otheriwse returns true.
*/
function checkConfirmPassword() {
  var password = document.forms["registrationForm"]["password"];
  var confirmPassword = document.forms["registrationForm"]["confirmPassword"];
  if (confirmPassword.value != password.value) {
    confirmPassword.focus();
    document.getElementById("passwordIncorrect").style.visibility = "visible";
    return false;
  }
  return true;
}

/*
/ Resets the password incorrect massage to hidden.
*/
function resetPasswordIncorrect() {
  document.getElementById("passwordIncorrect").style.visibility = "hidden";
}
