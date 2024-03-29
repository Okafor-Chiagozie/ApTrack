<?php

session_start();
require("config.php");
include("functions.php");
include("database-functions.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_login'])) {

   if (empty($_POST["email"]) || empty($_POST["password"]) ) {
      
      $_SESSION["loginFailed"] = true;
      redirect("../index.php");
      return;
   }

   $email = dataSanitizer($_POST["email"]);
   $password = passwordLock(dataSanitizer($_POST["password"]));
   $password_from_database = emailChecker($email);
   
   if ($password !== $password_from_database){
      $_SESSION["userWrongInfo"] = true;
      redirect("../sign-in.php");
      return;
   }

   // For Remember me
   if (isset($_POST["userRemember"])) {
      $_SESSION["userRemember"] = true;
   }


   $user_details = getUserDetails($email);

   if ($user_details["team_id"]
   && $_SESSION["userId"] == $user_details['leader_id']) {
         
      // For knowing if the user went through the sign in
      $_SESSION["userEmail"] = $email;
      $_SESSION["status"] = "leader";

      // Going to the dashboard
      redirect("../pages/user/team-leader-dashboard.php");
      return;
   }

   // For knowing if the user went through the sign in
   $_SESSION["userEmail"] = $email;
   $_SESSION["status"] = "user";

   // Going to the dashboard
   redirect("../pages/user/dashboard.php");
}
