<?php

session_start();
require("config.php");
include("functions.php");
include("database-functions.php");

// Admin email = aptrackadmin@gmail.com
// Admin password = aptrack123


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_login'])) {

   if (empty($_POST["email"]) || empty($_POST["password"]) ) {
      
      $_SESSION["loginFailed"] = true;
      redirect("../index.php");
      return;
   }

   $email = dataSanitizer($_POST["email"]);
   $password = passwordLock(dataSanitizer($_POST["password"]));
   $password_from_database = emailChecker($email);
   
   if ($password !== $password_from_database){
      $_SESSION["adminWrongInfo"] = true;
      redirect("../sign-in.php");
      return;
   }

   // For Remember me
   if (isset($_POST["adminRemember"])) {
      $_SESSION["adminRemember"] = true;
   }


   // For knowing if the user went through the sign in
   $_SESSION["adminEmail"] = $email;
   $_SESSION["status"] = "admin";

   // Going to the dashboard
   redirect("../pages/admin/dashboard.php");
}


