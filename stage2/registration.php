<html>
<head>
    <meta charset="utf-8"/>
    <title>Brisbane Parks - Register</title>
    <link href="globalStyles.css" rel="stylesheet" type="text/css">
    <script type = "text/javascript" src ="registrationScript.js"></script>
    <link href="registrationStyles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        include "includes/header.php";
        include "includes/footer.php";

        //link to database
        include "includes/PDO.php";

        // attempting to insert user inputed values into users table in database
        if(isset($_POST['username'])){
                    try{
                        $stmt = $pdo->prepare('INSERT INTO users (FirstName,Surname,Email/*,DOB*/,Postcode,Username,Salt,Password) VALUES(:fname, :sname, :email, :postcode, :username, "e3b0c44298f", SHA2(CONCAT(:pass, "e3b0c44298f"), 0));');
                        $stmt->bindValue(':fname', $_POST['firstName']);
                        $stmt->bindValue(':sname', $_POST['surname']);
                        $stmt->bindValue(':email', $_POST['email']);
                        //$stmt->bindValue(':dob', $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']);
                        $stmt->bindValue(':postcode',$_POST['postcode']);
                        $stmt->bindValue(':username', $_POST['username']);
                        $stmt->bindValue(':pass', $_POST['password']);
                        $stmt->execute(); 
                    }
                    //throws an error if the username is already taken
                    catch(PDOException $e){
                        $stmt = $pdo->prepare('SELECT * FROM users WHERE Username = :user');
                        $stmt->bindValue(':user', $_POST['username']);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0)
                        {
                            echo "username already exists";
                        }
                    }
                }
?>


<!-- USER FORM -->
<div id = "formContainer">
    <form id = "userForm" onsubmit = "return validate();" method = "POST">

        <div class="fNameTextbox">
            <p>First Name:</p><p> <input type="text" name = "firstName" id="firstName" value="" onkeypress="firstNameChanged()" />
            <span id="firstNameMissing" class="error-message">Please enter a valid first name.</span></p>
        </div>

        <div class="sNameTextbox">
            <p>Surname:</p><p> <input type="text" name = "surname" id="surname" value="" onkeypress="surnameChanged()" />
            <span id="surnameMissing" class="error-message">Please enter a valid surname.</span></p>
        </div>

        <div class="textbox">
            <p>Email address:</p><p> <input type="email" name="email" id="email" placeholder="email@example.com" onkeypress="emailChanged()" />
            <span id="emailMissing" class="error-message" value="">Please enter a valid email.</span></p>
        </div>

        <div class="DOBtextbox">
            <p>D.O.B (dd/mm/yyyy):</p><p> <input type="text" name="DOB" id="DOB" placeholder="dd/mm/yyyy" onchange="DOBChanged()" />
            <span id="DOBMissing" class="error-message">Please enter a valid D.O.B.</span></p>
        </div>

        <div class="pTextbox">
            <p>Postcode:</p><p> <input type="text" name= "postcode" id="postcode" value="" onkeypress="postcodeChanged()" />
            <span id="postcodeMissing" class="error-message">Please enter a valid postcode.</span></p>
        </div>

        <div class="uNameTextbox">
            <p>Create username:</p><p> <input type="text" name = "username" id="username" value="" onkeypress="usernameChanged()" />
            <span id="usernameMissing" class="error-message">Username is a required field.</span></p>
        </div>

        <div class="textbox">
            <p>Create password:</p><p> <input type="password" name= "password" id="password" value="" onkeypress="passwordChanged()" />
            <span id="passwordMissing" class="error-message">Password is a required field.</span></p>
        </div>

        <div class="textbox">
            <p>Confirm password:</p><p> <input type="password" name="confirmPassword" id="confirmPassword" onkeypress="password2Changed()" />
            <span id="passwordsNotMatch" class="error-message">Passwords do not match.</span></p>
        </div>

        <p>Do you agree to our terms and conditions? <input type="checkbox" id="terms" onclick="termsChecked()" />
        <span id="termsNotAgreed" class="error-message">You must agree to continue.</span></p>


        <p><input type="submit" name = "submitButton" value="Submit" id="submitButton"/></p>

        </form>
    </div>
</body>
</html>




