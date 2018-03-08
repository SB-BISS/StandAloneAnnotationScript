<?php
    session_start();
    $_SESSION['loggedIn'] = false;
	header("Location: access.php"); /* Redirect browser */
	exit();
?>