<div id="header">
    <h1>Brisbane's Public Parks</h1>
    <div id="menu">
        <a href = "index.php">Home</a><a href="locations.php">Locations</a>
<<<<<<< HEAD
        <?php
        session_start();
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
=======
        <a href="registration.php">Register</a><a href="login.php">Login</a><a href="logout.php">Logout</a>
>>>>>>> f42eb476d3d492648c71e3d815dd6cec11dc81e5
    </div>
</div>