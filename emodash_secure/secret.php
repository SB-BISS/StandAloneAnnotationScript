<?php
require('access.php');

if(!isset($_SESSION['loggedIn']))
{
	header("Location: access.php"); 
	exit();
}
else
{
	if( $_SESSION['loggedIn'] != true)
	{
		header("Location: access.php"); 
		exit();
	}
	else
	{
		echo 'folder:';
		echo $_SESSION['inputFolder'];
	}
}
?>
<a href="logout.php">Logout</a>