<?php
function getFolder($text)
{
	$retval = ""; 
    $array = array(
    "deniz" => "folder_den",
    "bas" => "folder_bas",
	"stefano" => "folder_ste",
	"visara" => "folder_vis",
);
	$retval = $array[$text];
    return $retval;
}

$passList = array("deniz", "bas", "stefano", "visara");


//put sha1() encrypted password here - example is 'hello'
//$password = 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d';
$password = 'deniz';

session_start();
if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}

if (isset($_POST['password'])) {
    //if (sha1($_POST['password']) == $password) {
	//if ($_POST['password'] == $password) {
	  if (in_array($_POST['password'], $passList)) {
        $_SESSION['loggedIn'] = true;
		$_SESSION['inputFolder'] = getFolder($_POST['password']);
		echo '<a href="logout.php">Logout</a>';
		header('Location: main.php');
		exit();
    } else {
		echo '<a href="access.php">Login</a><br>';
        die ('Incorrect password, please try logging in again');
    }
} 
echo '<a href="logout.php">Logout</a>';
if (!$_SESSION['loggedIn']): ?>

<HTML lang="en">
<HEAD>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Welcome| Voice of a Thousand Minds</title>
</HEAD>
<BODY>
	<DIV class="container"><BR>
	<H2>Please login</H2><BR>

    <form method="post">
      Password: <input type="password" name="password"> 
      <input class='btn btn-primary submit' height='30' type="submit" name="submit" value="Submit" >
    </form>
	
	</DIV>
  </body>
</html>

<?php
exit();
endif;
?>