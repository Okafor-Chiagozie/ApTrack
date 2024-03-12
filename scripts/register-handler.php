<?php

session_start();
require("config.php");
include("functions.php");
include("database-functions.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {

   if (empty($_POST["username"]) || empty($_POST["email"]) 
   || empty($_POST["password"]) || empty($_POST["confirm"]) ) {
      
      $_SESSION["regFailed"] = "Yes";
      redirect("../index.php");
   }

   // === Username ============
   $username =  strtolower(dataSanitizer($_POST["username"]));

   $firstname = usernameSplitter($username)[0] ?? "";
   $lastname = usernameSplitter($username)[1] ?? "";
   
   // === Email ===============
   $email = dataSanitizer($_POST["email"]);

   if (emailChecker($email, "users")){
      $_SESSION['emailExists'] = "Yes";
      redirect("../index.php");
   }

   // === Password ==============
   $password = passwordLock(dataSanitizer($_POST["password"]));

   if ($_POST["password"] != $_POST["confirm"]) {
      $_SESSION['differentPassword'] = "Yes";
      redirect("../index.php");
   }
   

   // === Inserting user data to database =============
   if(addNewUserToDatabase($firstname, $lastname, $email, $password)){
      $_SESSION["regSuccess"] = "Yes";
      redirect("../sign-in.php");
   }else {
      $_SESSION["regFailed"] = "Yes";
      redirect("../index.php");
   }
}
