<?php
session_start();
require("config.php");
include("functions.php");
include("database-functions.php");

$user_details = getUserDetails($_SESSION["userEmail"]);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload"])) {

   if($_FILES["document"]["size"] == 0){

      $document_name = $user_details["document"];
   }else{

      $document_file = $_FILES["document"];

      // Check for file type
      if(!zipFileVerifier($document_file["type"])) {
   
         $_SESSION["fileSupport"] = "Yes";
      }else {

         // $document_name = explode(".", $document_file["name"])[1];
         $document_name = uniqid().time();
         $extension = explode(".", $document_file["name"])[1];

         $document_name .= ".$extension";

         $fileDestination = "../uploads/team-document/";
         $tmpFile = $document_file['tmp_name'];

         // The function to upload the file to the destination
         if(file_exists($fileDestination.$user_details["document"]) && $user_details["document"] != "Nothing" ){

            unlink($fileDestination.$user_details["document"]);                
         }

         move_uploaded_file($tmpFile, $fileDestination.$document_name);
      }
   }


   if (empty($document_name)) {
      
      $_SESSION["uploadFailed"] = "Yes";
      redirect("../pages/user/team-leader-team-page.php");
   }


   // Inserting to the database
   if(uploadTeamDocument($document_name, $user_details["team_id"])){

      $_SESSION["uploadSuccess"] = "Yes";
      redirect("../pages/user/team-leader-team-page.php");
   }
}