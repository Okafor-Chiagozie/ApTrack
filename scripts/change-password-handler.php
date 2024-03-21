<?php

session_start();
require("config.php");
include("functions.php");
include("database-functions.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verifyEmail'])) {

   if (empty($_POST['user_email'])) {

      $_SESSION["emailVerifyFailed"] = true;
      redirect("../pages/auth/verify-email.php");
      return;
   }

   $email = dataSanitizer($_POST["user_email"]);
   

   if (!emailChecker($email)) {

      $_SESSION["emailNotFound"] = true;
      echo $_SESSION["emailNotFound"];
      redirect("../pages/auth/verify-email.php");
      return;
   }
   
   $_SESSION["verifiedEmail"] = $email;
   $_SESSION["emailVerifySuccess"] = true;
   redirect("../pages/auth/change-password.php");
}