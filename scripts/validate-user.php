<?php

require("config.php");
include("functions.php");

session_start();

$userEmail = clean($_POST["userEmail"]);
$userPassword = passwordLocker(clean($_POST["userPassword"]));

if (isset($_POST['userLogin'])) {
   userLogin($userEmail, $userPassword, "user_login");
}
