<?php
require_once 'class.mp3.php';
$mp3 = new mp3;
$mp3->cut_mp3('input.mp3', 'output.mp3', 0, -1, 'frame', false);
?>