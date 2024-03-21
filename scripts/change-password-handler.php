<?php

session_start();
require("config.php");
include("functions.php");
include("database-functions.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["change_password"])) {

   if (empty($_POST["password"]) || empty($_POST["confirm_password"])) {

      $_SESSION["changePasswordFailed"] = true;
      redirect("../pages/auth/chnage_password.php");
      return;
   }

   $password = dataSanitizer($_POST["password"]);
   $confirm_password = dataSanitizer($_POST["confirm_password"]);
   

   if ($password !== $confirm_password) {

      $_SESSION["differentPassword"] = true;
      redirect("../pages/auth/change-password.php");
      return;
   }


   if(updateUserPassword($_SESSION["verifiedEmailTable"], 
   passwordLock($password), $_SESSION["verifiedEmail"])){

      $_SESSION["changePasswordSuccess"] = true;
      redirect("../sign-in.php");
      return;
   }
   
   
}