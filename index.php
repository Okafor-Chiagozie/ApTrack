<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register - ApTrack</title>
      <link rel="stylesheet" href="assets/fontawesome-free-6.1.1-web/css/all.css">
      <link rel="stylesheet" href="assets/css/user/sign-up.css">
      <link rel="stylesheet" href="assets/libraries/toastr.css">
   </head>

   <body>
      <div class="mainDiv">
         <section class="section1">
            <section class="mainPart">
               <section class="logoSec">
                  <img src="assets/images/light.png" alt="Logo Image"> 
                  <h1>ApTrack</h1>
               </section>

               <section class="introText">
                  <p>Unlock your <br>Team Performance</p>
               </section>

               <section class="imgSec">
                  <img src="assets/images/Creative team-amico.png" alt="Introduction Image">
               </section>
            </section>
         </section>

         <section class="section2">
            <section class="logoSec">
               <section>
                  <img src="assets/images/dark.png" alt="Logo Image">
               </section>
               <h1>ApTrack</h1>
            </section>

            <form action="scripts/register-handler.php" method="post" class="myForm">
               <section class="formHeading">
                  <h1>Create an account</h1>
                  <span>Already have an account? <a href="sign-in.php">Login</a></span>
               </section>

               <section class="formItem">
                  <label for="username">Username</label>
                  <input type="text" name="username" required placeholder="Firstname Lastname" maxlength="40">
               </section>

               <section class="formItem">
                  <label for="email">Email</label>
                  <input type="email" name="email" required placeholder="Your Email" maxlength="40">
                  <?php if (isset($_SESSION["emailExists"]) && ($_SESSION["emailExists"] == "Yes")) {
                     echo "<span class='error'>Email already exists</span>";
                     $_SESSION["emailExists"] = "No";
                  } ?>
               </section>

               <section class="duoFormItem">
                  <section>
                     <section class="pass">
                        <label for="password">Password</label>
                        <input type="password" name="password" required placeholder="Your Password" autocomplete maxlength="20" minlength="6">
                     </section>

                     <section>
                        <label for="confirm">Confirm</label>
                        <input type="password" name="confirm" required placeholder="Confirm your Password" autocomplete maxlength="20" minlength="6">
                     </section>
                  </section>
                  <?php 
                     if (isset($_SESSION['differentPassword']) && ($_SESSION["differentPassword"] == "Yes")) {
                     echo "<span class='error'>Both passwords do not match</span>";
                     $_SESSION["differentPassword"] = "No";
                  }  ?>

                  <span>
                     <input type="checkbox" name="policy" value="true">

                     <span>
                        By creating an account you agree to the Terms
                        of Service and Conditions and Privacy Policy
                     </span>
                  </span>
               </section>

               <section class="submitButton">
                  <input type="submit" value="Create account" name="register">
               </section>

               <section class="orSection">
                  <hr> <span>OR</span>
                  <hr>
               </section>

               <section class="otherOption">
                  <span class="google"> <i class="fab fa-google"></i> <span>Continue with Google</span></span>

                  <span class="facebook"> <i class="fab fa-facebook-f"></i> <span>Continue with Facebook</span></span>
               </section>
            </form>

            <section class="footerImg">
               <img src="assets/images/Design community-amico.png" alt="Footer Image">
            </section>
         </section>
      </div>

      <script src="assets/libraries/jquery.js"></script>
      <script src="assets/libraries/toastr.min.js"></script>

      <!-- Toast alert  -->
      <?php
      if (isset($_SESSION["regFailed"]) && ($_SESSION["regFailed"] == "Yes")) {
         echo "<script> toastr.error('You were unable to be registered.', 'Registration Unsuccessful', {timeOut: 5000}) </script>";
         $_SESSION["regFailed"] = "No";
      }
      ?>
   </body>
</html>