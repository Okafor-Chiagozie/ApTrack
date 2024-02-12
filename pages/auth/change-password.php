<?php
require("../../scripts/config.php");
include("../../scripts/functions.php");

session_start();

if(isset($_SESSION["verifiedUserEmail"])){

    if(isset($_POST["newPasswordButton"])){

        // Email has been cleaned by email_verification
        $email = $_SESSION["verifiedUserEmail"];
    
        if(!empty($_POST["newPassword"]) && !empty($_POST["confirmNewPassword"]) && ($_POST["newPassword"] == $_POST["confirmNewPassword"])){
    
            $newPassword = passwordLocker(clean($_POST["newPassword"]));
    
            passwordChanger($email, $newPassword, "user_login");
    
        }else{
            $_SESSION["passwordDiffer"] = "Yes";
        }
    
    }
}else if(isset($_SESSION["verifiedAdminEmail"])){
    if(isset($_POST["newPasswordButton"])){

        // Email has been cleaned by email_verification
        $email = $_SESSION["verifiedAdminEmail"];
    
        if(!empty($_POST["newPassword"]) && !empty($_POST["confirmNewPassword"]) && ($_POST["newPassword"] == $_POST["confirmNewPassword"])){
    
            $newPassword = passwordLocker(clean($_POST["newPassword"]));
    
            passwordChanger($email, $newPassword, "admin_login");
    
        }else{
            $_SESSION["passwordDiffer"] = "Yes";
        }
    
    }
}else
{
   header("Location: verify-email.php");
}

?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Change Password - ApTrack</title>
      <link rel="stylesheet" href="../../assets/css/user/sign-in.css">
      <link rel="stylesheet" href="../../assets/libraries/toastr.css">
   </head>

   <body>
      <div class="mainDiv">
         <section class="section1">
            <section class="mainPart">
               <section class="logoSec">
                  <img src="../../assets/images/light.png" alt="Logo Image">
                  <h1>ApTrack</h1>
               </section>

               <section class="introText">
                  <p>Unlock your <br>Team Performance</p>
               </section>

               <section class="imgSec">
                  <img src="../../assets/images/Reset password-pana.png" alt="Introduction Image" id="loginImage">
               </section>
            </section>
         </section>

         <section class="section2">
            <section class="logoSec">
               <section>
                  <img src="../../assets/images/dark.png" alt="Logo Image">
               </section>
               <h1>ApTrack</h1>
            </section>

            <div class="myFormSection">
               <section class="formHeading">
                  <h1>Change Password</h1>
               </section>

               <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="myForm">
                  <section class="formItem">
                     <label for="newPassword">New Password</label>
                     <input type="password" name="newPassword" id="newPassword" required placeholder="New Password" autocomplete maxlength="20" minlength="6">
                  </section>
                  
                  <section class="duoFormItem">
                     <section class="formItem">
                        <label for="confirmNewPassword">Confirm Password</label>
                        <input type="password" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm Password" autocomplete maxlength="20" minlength="6">
                     </section>
                     <?php 
                        if(isset($_SESSION["passwordDiffer"]) && ($_SESSION["passwordDiffer"] == "Yes")){ 
                           echo "<span class='error'>Both passwords do not match</span>";
                           $_SESSION["passwordDiffer"] = "No"; 
                     } ?>

                     <span>
                        <span></span>

                        <a href="verify-email.php">⇽ Back</a>
                     </span>
                  </section>

                  <section class="submitButton">
                     <input type="submit" value="Change" name="newPasswordButton">

                     <span>
                        <span>Don't have an account? <a href="../../index.php">Register</a></span>
                     </span>
                  </section>
               </form>
            </div>
         </section>

      </div>

      <script src="../../assets/libraries/jquery.js"></script>
      <script src="../../assets/libraries/toastr.min.js"></script>

      <!-- Toast Alert -->
      <?php
      if(isset($_SESSION["passChangeSuccess"]) && ($_SESSION["passChangeSuccess"] == "Yes")){
         echo "<script> toastr.success('You will be redirected shortly.', 'Password Change Successful', {timeOut: 5000}) </script>";
         $_SESSION["passChangeSuccess"] = "No";
      }

      if(isset($_SESSION["passChangeFail"]) && ($_SESSION["passChangeFail"] == "Yes")){
         echo "<script> toastr.error('You were unable to change your password.', 'Password Change Unsuccessful', {timeOut: 5000}) </script>";
         $_SESSION["passChangeFail"] = "No";
      }

      ?>
   </body>
</html>