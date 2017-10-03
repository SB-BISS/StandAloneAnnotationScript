<?php
//echo ($_POST['filename']);
//echo ($_POST['emotion']);

$myfile = fopen("data.txt", "a") or die("Unable to open file!");
$txt = $_POST['filename'] . ',' . $_POST['emotion'] . "\r\n";
fwrite($myfile, $txt);

fclose($myfile);

?>