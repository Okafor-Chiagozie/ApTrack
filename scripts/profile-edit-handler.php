<?php

session_start();
require("config.php");
include("functions.php");
include("database-functions.php");

$user_details = getUserDetails($_SESSION["userEmail"]);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {

   if($_FILES["picture"]["size"] == 0){

      $picture_name = $user_details["picture"];
   }else{

      $picture_file = $_FILES["picture"];

      // Check for file type
      if(!imageTypeVerifier($picture_file["type"])) {
   
         $_SESSION["fileSupport"] = "Yes";
      }else {

         // $picture_name = explode(".", $picture_file["name"])[1];
         $picture_name = uniqid().time();
         $extension = explode(".", $picture_file["name"])[1];

         $picture_name .= ".$extension";

         $fileDestination = "../uploads/user-pictures/";
         $tmpFile = $picture_file['tmp_name'];

         // The function to upload the file to the destination
         if(file_exists($fileDestination.$user_details["picture"]) && $user_details["picture"] != "user.jfif" ){

            unlink($fileDestination.$user_details["picture"]);                
         }

         move_uploaded_file($tmpFile, $fileDestination.$picture_name);
      }
   }


   if (empty($_POST["firstname"]) || empty($_POST["lastname"]) 
   || empty($_POST["specialty"]) || empty($picture_name)) {
      
      $_SESSION["updateFailed"] = "Yes";
      redirect("../pages/user/profile-edit.php");
   }


   $firstname = strtolower(dataSanitizer($_POST["firstname"]));
   
   $lastname = strtolower(dataSanitizer($_POST["lastname"]));

   $specialty = dataSanitizer($_POST["specialty"]);
  

   // Inserting to the database
   if(updateUserProfile($picture_name, $firstname, $lastname, 
   $specialty, $user_details["email"])){

      $_SESSION["updateSuccess"] = "Yes";
      redirect("../pages/user/profile.php");
   }
}