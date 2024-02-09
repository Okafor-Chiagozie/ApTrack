<?php

require("dbConnect.php");
include("functions.php");

session_start();

// Admin email = aptechadmin2022@gmail.com
// Admin password = admin2022

$adminEmail = clean($_POST["adminEmail"]);
$adminPassword = passwordLocker(clean($_POST["adminPassword"]));

if(isset($_POST['adminLogin'])){
    adminLogin($adminEmail, $adminPassword, "admin_login");

}








?>