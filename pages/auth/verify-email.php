<?php
require("../../scripts/config.php");
include("../../scripts/functions.php");

session_start();

if (isset($_POST['verifyEmailButton'])) {
   if (!empty($_POST['emailToCheck'])) {

      $emailToCheck = clean($_POST["emailToCheck"]);
      emailVerifier($emailToCheck, "user_login");
   }
}

?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Verify Email - ApTrack</title>
      <link rel="stylesheet" href="../../assets/css/user/sign-in.css">
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
                  <img src="../../assets/images/Login-rafiki.png" alt="Introduction Image" id="loginImage">
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
                  <h1>Verify Email</h1>
               </section>

               <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="myForm">
                  <section class="duoFormItem">
                     <section class="formItem">
                        <label for="email">Email</label>
                        <input type="email" name="emailToCheck" id="email" required placeholder="Your Email">
                     </section>
                     <?php if (isset($_SESSION["emailNotFound"]) && ($_SESSION["emailNotFound"] == "Yes")) {
                        echo "<span class='error'>Email not found</span>";
                        $_SESSION["emailNotFound"] = "No";
                     } ?>

                     <span>
                        <span></span>

                        <a href="../../sign-in.php">⇽ Back</a>
                     </span>
                  </section>

                  <section class="submitButton">
                     <input type="submit" value="Verify" name="verifyEmailButton">

                     <span>
                        <span>Don't have an account? <a href="../../index.php">Register</a></span>
                     </span>
                  </section>
               </form>
               
            </div>
         </section>

      </div>
   </body>
</html>