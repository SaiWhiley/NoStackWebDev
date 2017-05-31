<div id="header">
    <h1>Brisbane's Public Parks</h1>
    <div id="menu">
        <a href = "index.php">Home</a><a href="locations.php">Locations</a>
        <?php
        include_once "includes/session_start.php";
        if (!isset($_SESSION['username'])) {
            //Display Login Button
            echo '<a href="registration.php">Register</a>';
            echo '<a href="login.php">Login</a>';
        }
        else {
            //Display Logout Button
            echo '<a href="logout.php">Logout</a>';
        }        
        if (isset($_SESSION['username'])){echo '<h3>Welcome back, '.$_SESSION['username'].'!</h3>';}
         ?>

    </div>
</div>