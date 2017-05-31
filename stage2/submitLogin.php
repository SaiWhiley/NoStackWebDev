<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>Brisbane Parks - Login</title>
    <link href="globalStyles.css" rel="stylesheet" type="text/css">
    <script type = "text/javascript" src ="registrationScript.js"></script>
    <link href="loginStyles.css" rel="stylesheet" type="text/css">
</head>

    <?php
      include "includes/header.php";
      include "includes/footer.php";
      include "includes/PDO.php";


      $usernameArray = array($_POST['username']);
      //SQL Query preparation
      try {
        $statement = $pdo->prepare('SELECT password FROM users WHERE username = ?');
        $statement->execute($usernameArray);
      } catch (PDOException $e) {
          echo $e->getMessage();
      }

      //resulting variable
      $storedpass = $statement->fetchAll(PDO::FETCH_COLUMN);
      $inputpasshash = CONCAT(':pass', "e3b0c44298f");

      // if (isset($_POST['username']) && isset($_POST['password']))
      //   $stmt = $pdo->prepare('SELECT * FROM users WHERE Username = :username AND Password = SHA2(CONCAT(:pass, "e3b0c44298f" ),0);')
      //   $stmt->bindValue(':username', $_POST['username']);
      //   $stmt->bindValue(':pass', $_POST['password']);
      //   $stmt->execute();
      //   if ( $stmt->rowCount() > 0 ) {
      //     // if details match, login works
      //     $result = $stmt->fetch();
      //     $_SESSION['username'] = $result['Username'];

      //   } else {
      //     echo '
      //     <script>
      //       document.getElementById("incorrectDetails").style.visibility = "visible";
      //     </script>';
      // }
      

      //if the login failed
        if( $storedpass == NULL OR $inputpasshash != $storedpass[0]){
          $redirect = 'login.php';
          echo '<div class="login_post">';
          echo '<h1 style="color:red">Wrong Username Or Password</h1>';
          echo '<h3> Redirecting ... </h3>';
          echo '</div>';

          header("Refresh: 3; $redirect");
          exit();
        }

      //start session here as they passed login
      session_start();

      $_SESSION['username'] = $_POST['username'];
      $_SESSION['loggedIn'] = True;

      echo '<div class="login_post">';
      echo '<h1> Successful Login!</h1>';
      echo '<h3> Redirecting ... </h3>';
      echo '</div>';


      $test = '../index.php';

      header("Refresh: 5; $test");
      exit();

    ?>
