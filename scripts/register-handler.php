<?php

session_start();
require("config.php");
include("functions.php");
include("database-functions.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {

   if (empty($_POST["username"]) || empty($_POST["email"]) 
   || empty($_POST["password"]) || empty($_POST["confirm"]) ) {
      
      $_SESSION["regFailed"] = true;
      redirect("../index.php");
      return;
   }

   // === Username ============
   $username =  strtolower(dataSanitizer($_POST["username"]));

   $firstname = usernameSplitter($username)[0] ?? "";
   $lastname = usernameSplitter($username)[1] ?? "";
   
   // === Email ===============
   $email = dataSanitizer($_POST["email"]);

   if (emailChecker($email)){
      $_SESSION['emailExists'] = true;
      redirect("../index.php");
      return;
   }

   // === Password ==============
   $password = passwordLock(dataSanitizer($_POST["password"]));

   if ($_POST["password"] != $_POST["confirm"]) {
      $_SESSION['differentPassword'] = true;
      redirect("../index.php");
      return;
   }
   

   // === Inserting user data to database =============
   if(addNewUserToDatabase($firstname, $lastname, $email, $password)){
      $_SESSION["regSuccess"] = true;
      redirect("../sign-in.php");
      return;
   }else {
      $_SESSION["regFailed"] = true;
      redirect("../index.php");
      return;
   }
}
