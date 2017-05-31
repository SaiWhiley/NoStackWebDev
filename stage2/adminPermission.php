<?php
	//session_start();
	if (!isset($_SESSION['isAdmin'])) {
		header("login.php");
		exit();
	}
?>