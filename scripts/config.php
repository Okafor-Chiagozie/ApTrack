<?php

// Declaring the database variables
$server_name = "localhost";
$server_user = "root";
$server_pass = "";
$db_name = "aptrack";

// Creating the connection
$connection = mysqli_connect($server_name, $server_user, $server_pass, $db_name);

// Checking if the connection was successful or not
if (!$connection){
    die("Error: Could not connect to database!");
}
