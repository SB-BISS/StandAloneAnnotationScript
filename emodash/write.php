<?php
//echo ($_POST['filename']);
//echo ($_POST['emotion']);

$myfile = fopen("data.txt", "a") or die("Unable to open file!");

$timestamp = date("Y-m-d H:i:s");
$file_annotated = $_POST['filename'];
$emotions_raw = $_POST['emotion'];

$anger = '0';
$disgust = '0';
$sadness = '0';
$fear = '0';
$surprise = '0';
$happiness = '0';
$neutral = '0';

if (strpos($emotions_raw, 'anger') !== false) 
{
    $anger = '1';
}
if (strpos($emotions_raw, 'disgust') !== false) 
{
    $disgust = '1';
}
if (strpos($emotions_raw, 'sadness') !== false) 
{
    $sadness = '1';
}
if (strpos($emotions_raw, 'fear') !== false) 
{
    $fear = '1';
}
if (strpos($emotions_raw, 'surprise') !== false) 
{
    $surprise = '1';
}
if (strpos($emotions_raw, 'happiness') !== false) 
{
    $happiness = '1';
}
if (strpos($emotions_raw, 'neutral') !== false) 
{
    $neutral = '1';
}

$emotions_csv = $anger . ',' . $disgust . ',' . $sadness . ',' . $fear . ',' . $surprise . ',' . $happiness . ',' . $neutral;

$txt = $file_annotated . ',' . $timestamp . ',' . $emotions_csv . "\r\n";
fwrite($myfile, $txt);

fclose($myfile);

?>