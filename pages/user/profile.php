<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "profile";

include("header.php");
?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
            <section class="Heading">
               <h1>My Profile</h1>
               <hr>
            </section>
            
            <section class="container">
               <section class="imgSec inside">
                  <img src="../../uploads/user-pictures/<?= $user_details["picture"] ?>" alt="Profile Image" class="outside">
               </section>

               <span>
                  <span class="one">Name:</span>
                  <span class="two"><?= ucwords($user_details["firstname"]." ".$user_details["lastname"]) ?></span>
               </span>

               <span>
                  <span class="one">Email:</span>
                  <span class="two"> <?= $user_details["email"] ?> </span>
               </span>
               
               <span>
                  <span class="one">Specialty:</span>
                  <span class="two"> <?= $user_details["specialty"] ?> </span>
               </span>

               <span>
                  <span class="one">Team:</span>
                  <span class="two"><?= isset($user_details["leader_id"]) ? ucfirst($user_details['name']) : "No Team" ?></span>
               </span>

               <span>
                  <span class="one">Reg Date:</span>
                  <span class="two"> <?= date("l - jS M, Y.", toDateTime($user_details["created_at"])) ?> </span>
               </span>

               <a class="edit" href="profile-edit.php"><i class="fas fa-edit"></i> Edit</a>
            </section>
      </section>

      <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
   </section>

   
   <script src="../../assets/js/dashboard.js"></script>
   <script src="../../assets/libraries/jquery.js"></script>
   <script src="../../assets/libraries/toastr.min.js"></script>

   <?php
      if(isset($_SESSION["updateSuccess"]) && $_SESSION["updateSuccess"]){
         echo "<script> toastr.success('Profile updated successfully.', 'Update Successful', {timeOut: 5000}) </script>";
         $_SESSION["updateSuccess"] = false;
      }
   ?>
</div>

</body>
</html>
