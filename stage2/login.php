<head>
    <meta charset="utf-8"/>
    <title>Brisbane Parks - Login</title>
    <link href="globalStyles.css" rel="stylesheet" type="text/css">
    <script type = "text/javascript" src ="loginScript.js"></script>
    <link href="loginStyles.css" rel="stylesheet" type="text/css">
</head>

    <?php
      include "includes/header.php";
      include "includes/footer.php";
      include "includes/PDO.php";
      //require "adminPermission.php";
    
      //checking if user is logged in
      // if (isset($_GET['logout'])) {
      //   if (isset($_SESSION['username'])) {
      //     unset($_SESSION['username']);
      //     header("Location: index.php");
      //   }
      // }


// USER LOGIN FORM
    echo '<div id="loginFormContainer">
      <form id="loginForm" action="login.php" method="POST">
        <div class="usernameBox">
          <p>Username:</p> <p><input type="text" name="username" id="username" onkeypress="usernameChanged()"><span class="error-message" id="usernameMissing" style="visibility: hidden;"> Username is required.</span></p>
        </div>
        <div class="passwordBox">
          <p>Password:</p> <p><input type="password" name="password" id="password" onkeypress="passwordChanged()"><span class="error-message" id="passwordMissing" style="visibility: hidden;"> Password is required.</span></p>
        </div>
        <p><input type="submit" name="loginButton" id="loginButton" value="Login!"></p>
        <span class="error-message" id="incorrectDetails" style="visibility: hidden;"> Incorrect details, please try again.</span>
      </form>
    </div>';


//checks if username is in SQL database. if so, redirects to home page. if not, displays error

    if (isset($_POST['username']) && isset($_POST['password'])) {
      $stmt = $pdo->prepare('SELECT * FROM users WHERE Username = :username AND Password = SHA2(CONCAT(:pass, "e3b0c44298f" ),0);');
      $stmt->bindValue(':username', $_POST['username']);
      $stmt->bindValue(':pass', $_POST['password']);
      $stmt->execute();

      if ( $stmt->rowCount() > 0 ) {
        // if details match, login works
        $result = $stmt->fetch();
        //session_start();
        $_SESSION['username'] = $result['Username'];
        //if ($result['isAdmin'] == true) {
        //  $_SESSION['isAdmin'] = true;
        //}
        //header("Location: index.php");
      } else {
        echo '
        <script>
          document.getElementById("incorrectDetails").style.visibility = "visible";
        </script>';
      }
    }
  ?>
