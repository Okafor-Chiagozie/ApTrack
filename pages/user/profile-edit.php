<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "profile-edit";

include("header.php");
?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
         <section class="Heading">
            <h1>Edit Profile</h1>
            <hr>
         </section>
         

         <section class="container">
            <form action="../../scripts/profile-edit-handler.php" method="post" enctype="multipart/form-data" class="myForm">
               <section class="profilePic">
                     <label for="picture">Profile picture</label>
                     <input type="file" id="file" name="picture" size="10" class="inside">
               </section>

               <section>
                     <label for="firstname">Firstname</label>
                     <input type="text" name="firstname" required placeholder="Firstname" maxlength="20" class="inside" value="<?= ucfirst($user_details["firstname"]) ?>">
               </section>

               <section>
                     <label for="lastname">Lastname</label>
                     <input type="text" name="lastname" required placeholder="Lastname" maxlength="20" class="inside" value="<?= ucfirst($user_details["lastname"]) ?>">
               </section>

               <section>
                     <label for="specialty">Area of Specialization</label>
                     <select name="specialty" id="specialty" class="inside">
                        <option value="Not Specified" hidden>Not Specified</option>
                        <option <?php if($user_details["specialty"] == "UI/UX Designer"): ?> selected <?php endif; ?> value="UI/UX Designer">UI/UX Designer</option>
                        <option <?php if($user_details["specialty"] == "Frontend Developer"): ?> selected <?php endif; ?> value="Frontend Developer">Frontend Developer</option>
                        <option <?php if($user_details["specialty"] == "Backend Developer"): ?> selected <?php endif; ?> value="Backend Developer">Backend Developer</option>
                     </select>
               </section>

               <input type="submit" name="update" value="&#8593; Update">
            </form>
         </section>
      </section>

      <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
   </section>

   <script src="../../assets/js/dashboard.js"></script>
   <script src="../../assets/libraries/jquery.js"></script>
   <script src="../../assets/libraries/toastr.min.js"></script>

   <?php
      if(isset($_SESSION["fileSupport"]) && $_SESSION["fileSupport"]){
         echo "<script> toastr.error('Unsupported file format.', 'File Error', {timeOut: 5000}) </script>";
         $_SESSION["fileSupport"] = false;
      }

      if(isset($_SESSION["updateFailed"]) && $_SESSION["updateFailed"]){
         echo "<script> toastr.error('Profile update failed.', 'Update Error', {timeOut: 5000}) </script>";
         $_SESSION["updateFailed"] = false;
      }
   ?>
</div>

</body>
</html>
