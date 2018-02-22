<!DOCTYPE html>
<html lang="en">
<HEAD>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="main.css">
	
	<!--<title>Audio Annotator: Discrete by Bin Zihnin Sesi | Voice of a Thousand Minds</title>-->
	<title>ED Audio Annotator</title>
</HEAD>
<BODY>
	<div class="container" style="width: 100%;">
	
	<H2>Annoteren!</H2>		
	<br>
	<!--<P>Please listen to the audio file and try to understand the emotion in the voice. Then, select the corresponding emotion from the list below.-->
	<P style="padding-left: 25%; padding-right: 25%;">Luister aandachtig naar elk fragment en geef daarna de emotie die u in het fragment gehoord heeft aan door op de emoji te klikken. Het is al voldoende als u nuanceverschillen van een van de onderstaande emoties kunt identificeren. Ga uit van uw eerste ingeving. Let vooral op intonatie, de inhoud is van ondergeschikt belang. Ook kunt u meerdere emoties tegelijk aangeven, als u meer dan een emotie in een fragment identificeert. Selecteer "Neutraal" als er geen specifieke emotie te horen is. Klik op "SUBMIT" om het volgende fragment te beluisteren.
	<P style="padding-left: 25%; padding-right: 25%;"><u>Belangrijk:</u> Wanneer u meer dan één persoon hoort praten of wanneer u geen stem hoort gedurende een fragment, selecteer dan "SKIP" in plaats van een emotie. 
	<br><br>
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
		$loadPage = true;
		//echo 'folder:';
		$dir_extension = $_SESSION['inputFolder'];
		//echo $dir_extension;
	}
}
//session_start();

$passList = array("deniz", "bas", "stefano", "visara"); ///// USRNAME

if($loadPage)
{
$dir    = 'input/' . $dir_extension . '/';
//echo $dir;
$files1 = scandir($dir);
natsort($files1);
//print_r ($files1);
$files1 = array_values($files1);
//print_r ($files1);
$log_array = array();
$myfile = fopen("data.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  //echo fgets($myfile) . "<br>";
  $line = fgets($myfile); 
  $pieces = explode(",", $line);
  if(strlen($pieces[0])>3)
  {
	array_push($log_array, $pieces[0]);
  }
   
}
  
fclose($myfile);

$arrlen_files = count($files1);

echo "<ul class='audioPlayer'>";
$moreFiles = false;
for($x = 0; $x < $arrlen_files; $x++) 
{
	if(strlen($files1[$x])>3)
	{
		//echo $files1[$x] . "<br>";
		if (in_array($files1[$x], $log_array)) 
		{
			// Do nothing.
		}
		else
		{
			$pieces = explode("_", $files1[$x]);
			$main_file = $pieces[0];
			if(isset($_SESSION['lastmainfilename']))
			{
				if($main_file != $_SESSION['lastmainfilename'])
				{
					 
					//echo "<B>You are now beginning to listen a new conversation.</B><BR><BR>";
					echo "<B>U luistert nu naar een nieuw gesprek.</B><BR><BR>";
				}
				else
				{
					echo "<BR><BR>";
				}
			}
			else
			{
				echo "<BR><BR>";
			}
			$_SESSION['lastmainfilename'] = $main_file;
			$moreFiles = true;
			//echo $dir . $files1[$x];
			echo "<form action='write.php' method=POST><input type='hidden' id='filename' name='filename' value='". $files1[$x] ."'>";
			echo "<audio src='" . $dir . $files1[$x] .  "' controls='controls' id='player'></audio><br><br><br>";
			
			echo "<div class='item'><label><input type='checkbox' id='opt_anger' name='emotion' value='anger'><img src='img/anger.png' class='emotions'><span class='caption'>Boosheid</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_disgust' name='emotion' value='disgust'><img src='img/disgust.png' class='emotions'><span class='caption'>Afkeer</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_sad' name='emotion' value='sadness'><img src='img/sadness.png' class='emotions'><span class='caption'>Verdriet</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_fear' name='emotion' value='fear'><img src='img/fear.png' class='emotions'><span class='caption'>Angst</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_surprise' name='emotion' value='surprise'><img src='img/surprise.png' class='emotions'><span class='caption'>Verbazing</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_happy' name='emotion' value='happiness'><img src='img/happiness.png' class='emotions'><span class='caption'>Happiness</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_neutral' name='emotion' value='neutral'><img src='img/neutral.png' class='emotions'><span class='caption'>Neutraal</span></label></div>
			
			<br>
			<div class='item'><label><input type='checkbox' id='opt_onzekerheid' name='emotion' value='onzekerheid'><img src='img/onzekerheid.png' class='emotions'><span class='caption'>Onzekerheid</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_wantrouwen' name='emotion' value='wantrouwen'><img src='img/wantrouwen.png' class='emotions'><span class='caption'>Wantrouwen</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_opluchting' name='emotion' value='opluchting'><img src='img/opluchting.png' class='emotions'><span class='caption'>Opluchting</span></label></div>
			</form>";

			break;		
		}
	}
}
echo "</ul>";
if(!$moreFiles)
{
	//echo 'no more files left to annotate.';
	echo 'Hartelijk dank! U heeft alle gesprekken beluisterd. U kunt de laptop nu teruggeven.';
}
else
{
	echo "<br><button id='silent' class='btn btn-lg btn-danger' style='width:150px;'>
      SKIP
</button>
<button type='button' id='submit' class='btn btn-primary btn-lg submit' style='width:150px;'>SUBMIT</button>";
}
echo '<br><br><progress class="progress_bottom" max="' . ($arrlen_files - 2) . '" value="' . count($log_array) . '"></progress></div>';
}
?>
	<div class="help"><A href="index.html">Instructions</A></div>
	<div class="logout"><a href="logout.php">Logout</a></div>
	<script src="script.js"></script>
</BODY>
</HTML>