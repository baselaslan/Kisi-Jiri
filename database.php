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
$name = $id.'_name.wav';
$village = $id.'_village.wav';


//save to files
move_uploaded_file($wav_file_name, $name);
move_uploaded_file($wav_file_village, $village);

//connect to MYSQL database
$con = new mysqli("eu-cdbr-west-01.cleardb.com","b78345c8d54fe5","0cc498f1", "heroku_2182253aee23bd0");
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  file_put_contents('db_errors.txt', $con -> connect_error, FILE_APPEND);
  exit();
}

// Need to first create the KisiJiri table once in the database. These are the properties of the table
// This is done only once

// $create_table = $con -> query("CREATE TABLE IF NOT EXISTS kisijiri (
//     ID INT AUTO_INCREMENT PRIMARY KEY,
//     user BIGINT(255) NOT NULL,
//     tree VARCHAR(255) NOT NULL,
//     seeds VARCHAR(255) NOT NULL,
//     name VARCHAR(255) NOT NULL,
//     village VARCHAR(255) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )");
//
// if (!$create_table)
// {
// echo $con -> error;
// exit();
// }


//insert data into the kisijiri table
$sql = $con -> query("INSERT INTO kisijiri(user, tree, seeds, name, village) VALUES ($user,'$tree', '$seeds', '$name', '$village')");

// sanity check
if (!$sql)
{
  echo $con -> error;
  file_put_contents('db_errors.txt', 'error performing query: '.$con ->  error, FILE_APPEND);
  file_put_contents('db_errors.txt', 'inserted with id: '.$id, FILE_APPEND);
}


// Use this code to read the rows from the database

// if ($result = mysqli_query($con, "SELECT * FROM kisijiri")) {
//   /* seek to row */
//
//   while ($row = mysqli_fetch_array($result)) {
//     printf ("ID: %d  User: %d, Tree: %s, Seeds: %s, Name file: %s, Village file: %s\n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
//   }
//
//   /* free result set*/
//   $result->close();
// }


//close database
mysqli_close($con);
?>
