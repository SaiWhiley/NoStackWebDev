<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Brisbane Parks</title>
    <link href="globalStyles.css" rel="stylesheet" type="text/css">
    <script type = "text/javascript" src ="registrationScript.js"></script>
    <link href="registrationStyles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        include "includes/header.php";
        include "includes/PDO.php";
        include "includes/footer.php";


        if(isset($_POST['username'])){
            //The problem is here
            //echo "yes";
            // $teststmt = $pdo->prepare('INSERT INTO users (FirstName,Surname) VALUES ("jordy", "bloop")');
            // $teststmt->execute();
            try{
               $stmt = $pdo->prepare('INSERT INTO users (FirstName,Surname,Email/*,DOB*/,Postcode,Username,Salt,Password) VALUES(:fname, :sname :email, :dob, :postcode, :username, "e3b0c44298f", SHA2(CONCAT(:pass, "e3b0c44298f"), 0));');
                $stmt->bindValue(':fname', $_POST['firstName']);
                $stmt->bindValue(':sname', $_POST['surname']);
                $stmt->bindValue(':email', $_POST['email']);
                //$stmt->bindValue(':dob', $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']);
                $stmt->bindValue(':postcode',$_POST['postcode']);
                $stmt->bindValue(':username', $_POST['username']);
                $stmt->bindValue(':pass', $_POST['password']);
                $stmt->execute(); 
            }
            catch(PDOException $e){
                $stmt = $pdo->prepare('SELECT * FROM users WHERE Username = :user');
				$stmt->bindValue(':user', $_POST['username']);
				$stmt->execute();
				if ($stmt->rowCount() > 0)
				{
					//Username exists
				}
            }
        }
?>

<div id = "formContainer">
    <form id = "userForm" onsubmit = "return validate();" method = "post">

        <p>First Name: <input type="text" id="firstName" value="" onkeypress="firstNameChanged()" />
        <span id="firstNameMissing" class="error-message">Please enter a valid first name.</span></p>

        <p>Surname: <input type="text" id="surname" value="" onkeypress="surnameChanged()" />
        <span id="surnameMissing" class="error-message">Please enter a valid surname.</span></p>

        <p>Email address: <input type="email" id="email" placeholder="email@example.com" onkeypress="emailChanged()" />
        <span id="emailMissing" class="error-message" value="">Please enter a valid email.</span></p>

        <p>D.O.B (dd/mm/yyyy): <input type="text" id="DOB" placeholder="dd/mm/yyyy" onchange="DOBChanged()" />
        <span id="DOBMissing" class="error-message">Please enter a valid D.O.B.</span></p>

        <p>Postcode: <input type="text" id="postcode" value="" onkeypress="postcodeChanged()" />
        <span id="postcodeMissing" class="error-message">Please enter a valid postcode.</span></p>

        <p>Create username: <input type="text" id="username" value="" onkeypress="usernameChanged()" />
        <span id="usernameMissing" class="error-message">Username is a required field.</span></p>

        <p>Create password: <input type="password" id="password" value="" onkeypress="passwordChanged()" />
        <span id="passwordMissing" class="error-message">Password is a required field.</span></p>

        <p>Confirm password: <input type="password" id="confirmPassword" onkeypress="password2Changed()" />
        <span id="passwordsNotMatch" class="error-message">Passwords do not match.</span></p>

        <p>Do you agree to our terms and conditions? <input type="checkbox" id="terms" onclick="termsChecked()" />
        <span id="termsNotAgreed" class="error-message">You must agree to continue.</span></p>

        <p><input type="submit" name = "submitButton" value="Submit"/></p>

        </form>
    </div>




