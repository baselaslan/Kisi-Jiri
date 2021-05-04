<?php
//get files from $_FILES array using variable(s) from namelist
$wav_file_name = $_FILES["messageName"]["tmp_name"];
$wav_file_village = $_FILES["messageVillage"]["tmp_name"];

//save to files
move_uploaded_file($wav_file_name, "Caller_name.wav");
move_uploaded_file($wav_file_village, "Caller_village.wav");
?>