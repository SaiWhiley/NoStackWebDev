<html>

<head>
    <meta charset="utf-8"/>
    <title>Brisbane Parks - Login</title>
    <link href="globalStyles.css" rel="stylesheet" type="text/css">
    <script type = "text/javascript" src ="registrationScript.js"></script>
    <link href="loginStyles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
        include "includes/header.php";
        include "includes/footer.php";
    ?>
</body>
</html>

<?php

    session_destroy();

    echo '<div class="login_post">';
    echo '<h1 style="color: green; text-shadow: 3px 3px 2px black;"> Logging Out</h1>';
    echo '<h3> Redirecting ... </h3>';
    echo '</div>';


    header("Refresh: 3; index.php");
    exit();

?>




