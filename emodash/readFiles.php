<HTML>
<HEAD>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<link rel="stylesheet" type="text/css" href="intro/introjs.min.css">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://use.fontawesome.com/f0f3d079bf.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">
    
	<title>Bin Zihnin Sesi</title>
</HEAD>
<BODY>
	<div>
	
	<H2>Annotate!</H2>
			<!--<H2 class="header"><a href="index.html"><img src="votm_logo.png" width="45" height="45" style="float:left; margin-left: 10px;"></img></a>SESLENDÝR</H2>-->
			<br>
<br><br>
<?php
$dir    = 'input/';
$files1 = scandir($dir);
//$files2 = scandir($dir, 1);
//print_r($files1);
//print_r($files2);

$log_array = array();
$myfile = fopen("data.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  //echo fgets($myfile) . "<br>";
  $line = fgets($myfile); 
  $pieces = explode(",", $line);
  if(strlen($pieces[0])>3)
  {
	// print_r($pieces[0]);
	array_push($log_array, $pieces[0]);
  }
   
}
// echo 'pieces: ';
// print_r($pieces);
  
fclose($myfile);

//print_r($log_array);

$arrlen_files = count($files1);


echo "<ul class='audioPlayer'>";
$moreFiles = false;
for($x = 0; $x < $arrlen_files; $x++) 
{
	if(strlen($files1[$x])>3)
	{
		if (in_array($files1[$x], $log_array)) 
		{
			// Do nothing.
		}
		else
		{
			$moreFiles = true;
			echo "<audio src='input/" . $files1[$x] .  "' controls='controls' id='player'></audio><br><br>";
			echo "<form action='write.php' method=POST><input type='hidden' id='filename' name='filename' value='". $files1[$x] ."'>
			<label><input type='radio' id='opt_anger' name='emotion' value='anger'><img src='fear.png'></label>
			
			<input type='radio' id='opt_contempt' name='emotion' value='contempt'><label for='opt_contempt'>Contempt</label>
			<input type='radio' id='opt_fear' name='emotion' value='fear'><label for='opt_fear'>Fear</label>
			<input type='radio' id='opt_disgust' name='emotion' value='disgust'><label for='opt_disgust'>Disgust</label>
			<input type='radio' id='opt_happy' name='emotion' value='happy'><label for='opt_happy'>Happiness</label>
			<input type='radio' id='opt_sad' name='emotion' value='sad'><label for='opt_sad'>Sad</label>
			<input type='radio' id='opt_surprise' name='emotion' value='surprise'><label for='opt_surprise'>Surprise</label>
			</form>";
			//echo $files1[$x];
			echo '<br><br><ul class="audioPlayer" id="recordingslist"></ul><h2 style="display:none;">Log</h2><pre id="log"  style="display:none;"></pre>';
			echo "<br>";
			break;		
		}
	}
}
// <input type='radio' id='opt_anger' name='emotion' value='anger'><label for='opt_anger'>Anger</label>
echo "</ul>";
if(!$moreFiles)
{
	echo 'no more files left to annotate.';
}
else
{
echo "<input id='submit' type='submit' value='Submit'>";
}
?>
<script>
$('#submit').click(function() {
    $.ajax({
        url: 'write.php',
        type: 'POST',
        data: {
            emotion: $('input[name=emotion]:checked').val(),
            filename: $('#filename').val()
        },
        success: function(msg) {
            //alert('Done');
			//alert($('input[name=emotion]:checked').val());
			location.reload();
        }               
    });
});
$(window).load(function() {
// alert('body loaded');
var audioPlayer = document.getElementById('player');
audioPlayer.play();
});
</script>
</BODY>
</HTML>