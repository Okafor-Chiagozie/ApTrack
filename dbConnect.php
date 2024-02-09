<?php

// Declaring the database variables
$serverName = "localhost";
$serverUser = "root";
$serverPass = "";
$db_name = "aptech_project";
// Creating the connection
$db_connection = mysqli_connect($serverName, $serverUser, $serverPass, $db_name);


// Checking if the connection was successful or not
if (!$db_connection){
    die("Error: Could not connect to database!");
}





?>