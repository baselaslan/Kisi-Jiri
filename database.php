<?php

//get data passed from Voice Browser
$user = $_POST['user'];
$product = $_POST['tree'];
$quantity = $_POST['seeds'];


$date = Date('Y-m-d'); //current date at server
$time = time(); //current time (in seconds format)
$id = $user . $time; //concatenation of contact ID (phone number) and time used as unique key

//get files from $_FILES array using variable(s) from namelist
$wav_file_name = $_FILES["messageName"]["tmp_name"];
$wav_file_village = $_FILES["messageVillage"]["tmp_name"];

//each file will have a unique name so no more overwriting of information
$name = $id.'_name.wav'
$village = $id.'_village.wav'

//save to files
move_uploaded_file($wav_file_name, $name);
move_uploaded_file($wav_file_village, $village);

//connect to MYSQL database
// REPLACE WITH OUR OWN DATABASE CREDENTIALS
$con = mysql_connect("mysql7.000webhost.com","a7049946_fsd","thepassword123");
if (!$con)
{
die('Could not connect: ' . mysql_error());
}

//open the specific database
// REPLACE WITH OUR OWN DATABASE CREDENTIALS
mysql_select_db("a7049946_stuff", $con);

//insert data into the specific table - name our table KisiJiri
// for now insert file name into database, then they can look up that file on the system
$sql = "INSERT INTO KisiJiri(ID, user, product, quantity, price, duration, date) VALUES ('$id','$user','$tree', $seeds, $name, $village, Now())";

//sanity check
if (!mysql_query($sql,$con))
{
die('Error: ' . mysql_error());
}

//close database
mysql_close($con);
?>
