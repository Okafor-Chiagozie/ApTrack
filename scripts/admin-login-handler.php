<?php

require("config.php");
include("functions.php");
session_start();

// Admin email = aptechadmin2022@gmail.com
// Admin password = admin2022

$adminEmail = dataSanitizer($_POST["adminEmail"]);
$adminPassword = passwordLock(dataSanitizer($_POST["adminPassword"]));

if(isset($_POST['adminLogin'])){
    adminLogin($adminEmail, $adminPassword, "admin_login");
}
