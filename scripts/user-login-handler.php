<?php

require("config.php");
include("functions.php");
include("database-functions.php");
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_login'])) {

   if (empty($_POST["email"]) || empty($_POST["password"]) ) {
      
      $_SESSION["loginFail"] = "Yes";
      redirect("../index.php");
   }

   $email = dataSanitizer($_POST["email"]);
   $password = passwordLock(dataSanitizer($_POST["password"]));
   $password_from_database = emailChecker($email, "users");
   
   if (!$password_from_database){
      $_SESSION["userWrongInfo"] = "Yes";
      redirect("../sign-in.php");
   }

   // For Remember me
   if (isset($_POST["userRemember"])) {
      $_SESSION["userRemember"] = "Yes";
   }

   $user_details = fetchUserDetails($email);



   // Checking if the team_id exists
   // and if so checks if the team_id == team.id
   // that's the only thing that should be checked cause
   // even if the team_id exists and the team_id !== team.id (is not equal to)
   // it still will go to the normal dashboard
   if ($user_details["team_id"]) {
   
      // if ($user_details["team_id"] == $user_details['']) {
         
         // For knowing if the user went through the sign in
         $_SESSION["userEmail"] = $email;
         $_SESSION["status"] = "leader";
   
         // Going to the dashboard
         redirect("../pages/user/team-leader-dashboard.php");
         return;
      // }
   }

   // For knowing if the user went through the sign in
   $_SESSION["userEmail"] = $email;
   $_SESSION["status"] = "user";

   // Going to the dashboard
   redirect("../pages/user/dashboard.php");
}
