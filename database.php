<?php

//CREDENTIALS: mysql://b78345c8d54fe5:0cc498f1@eu-cdbr-west-01.cleardb.com/heroku_2182253aee23bd0?reconnect=true
//DB_HOST: eu-cdbr-west-01.cleardb.com
//DB_DATABSE: heroku_2182253aee23bd0
//DB_USERNAME: b78345c8d54fe5
//DB_PASSWORD: 0cc498f1

//get data passed from Voice Browser
$user = $_POST['user'];
$tree = $_POST['tree'];
$seeds = $_POST['seeds'];


$date = Date('Y-m-d'); //current date at server
$time = time(); //current time (in seconds format)
$id = $user . $time; //concatenation of contact ID (phone number) and time used as unique key

//get files from $_FILES array using variable(s) from namelist
$wav_file_name = $_FILES["messageName"]["tmp_name"];
$wav_file_village = $_FILES["messageVillage"]["tmp_name"];

//each file will have a unique name so no more overwriting of information
//we store the name of the file in the database and then save the file itself as before
//so if you want to look the file up you have to do it manually
$name = $id.'_name.wav'
$village = $id.'_village.wav'

//save to files
move_uploaded_file($wav_file_name, $name);
move_uploaded_file($wav_file_village, $village);

//connect to MYSQL database

$con = new mysqli("eu-cdbr-west-01.cleardb.com","b78345c8d54fe5","0cc498f1", "heroku_2182253aee23bd0");
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}


//insert data into the specific table - name our table KisiJiri
// for now insert file name into database, then they can look up that file on the system
$sql = $con -> query("INSERT INTO KisiJiri(ID, user, tree, seeds, name, village, date) VALUES ('$id','$user','$tree', $seeds, $name, $village, Now())");

//sanity check
if (!$sql)
{
echo "Failed to perfom SQL operation"
}

//close database
mysqli_close($con);
?>
