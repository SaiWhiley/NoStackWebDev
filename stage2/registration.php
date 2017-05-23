<!DOCTYPE html>
<html>
<head>
    <title>Brisbane Parks</title>
    <link href="globalStyles.css" rel="stylesheet" type="text/css">
    <link href="registrationStyles.css" rel="stylesheet" type="text/css">
    <script src="registration.js"></script>
</head>

<body>
    <?php
        include "includes/header.php";
        include "includes/PDO.php";

        if(isset($_POST['username'])){
            try{
               $stmt = $pdo->prepare('INSERT INTO users (Username,FirstName,Email,DOB,State,Salt) VALUES(:username, :name, :email, :dob, :state, SHA2(CONCAT(:pass, "e3b0c44298f"), 0),"e3b0c44298f");');
                $stmt->bindValue(':username', $_POST['username']);
                $stmt->bindValue(':name', $_POST['firstName']);
                $stmt->bindValue(':email', $_POST['email']);
                $stmt->bindValue(':dob', $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']);
                $stmt->bindValue(':state',$_POST['state']);
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