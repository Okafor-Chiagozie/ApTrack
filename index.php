<?php

require("scripts/dbConnect.php");
include("scripts/functions.php");

session_start();


$username = $firstname = $lastname = $email = $password = $confirm = "";

// Setting up the variables ================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if (isset($_POST["create"])) {

      // Username ============
      if (!empty($_POST["username"])) {
         $username = $_POST["username"];

         if (count(explode(" ", $username)) > 1) {
            $nameList = explode(" ", $username);

            $firstname = clean($nameList[0]);
            $lastname = clean($nameList[1]);
         } else if (count(explode(" ", $username)) == 1) {
            $firstname = clean($username);
            $lastname = "Lastname";
         }
      }

      // Email ===============
      if (!empty($_POST["email"])) {
         $emailCheck = clean($_POST["email"]);

         emailChecker($emailCheck, "user_login");
      }

      // Password ==============
      if (!empty($_POST["password"]) && !empty($_POST["confirm"])) {

         if ($_POST["password"] != $_POST["confirm"]) {
            $_SESSION['differentPassword'] = "Yes";
         } else {
            $password = passwordLocker(clean($_POST["password"]));
            $confirm = clean($_POST["confirm"]);
         }
      }
   }
}


// Inserting into the database ==================================================
if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {

   dbInsert($firstname, $lastname, $email, $password);
}



?>


<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ApTrack</title>
      <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.css">
      <link rel="stylesheet" href="css/sign_up.css">
      <link rel="stylesheet" href="fmworks/toastr.css">
   </head>

   <body>
      <div class="mainDiv">
         <section class="section1">
            <section class="mainPart">
               <section class="logoSec">
                  <img src="photos/light.png" alt="Logo Image"> ApTrack
               </section>

               <section class="introText">
                  <p>Unlock your <br>Team Performance</p>
               </section>

               <section class="imgSec">
                  <img src="photos/Creative team-amico.png" alt="Introduction Image">
               </section>
            </section>
         </section>

         <section class="section2">
            <section class="logoSec">
               <section>
                  <img src="photos/light.png" alt="Logo Image">
               </section>
            </section>


            <!-- form action -->
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="myForm">
               <section class="formHeading">
                  <h1>Create an account</h1>
                  <span>Already have an account? <a href="auth_pages/sign_in.php">Login</a></span>
               </section>

               <section class="formItem">
                  <label for="username">Username</label>
                  <input type="text" name="username" required placeholder="Firstname Lastname" maxlength="40">
               </section>

               <section class="formItem">
                  <label for="email">Email</label>
                  <input type="email" name="email" required placeholder="Your Email" maxlength="40">
                  <?php if (isset($_SESSION["emailExists"]) && ($_SESSION["emailExists"] == "Yes")) {
                     echo "<span class='error'>Email already exits</span>";
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
                        of Service and Conditions and Privacy Policy</span>
                     </span>
               </section>

               <section class="submitButton">
                  <input type="submit" value="Create account" name="create">
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
               <img src="photos/Design community-amico.png" alt="Footer Image">
            </section>
         </section>

      </div>

      <script src="fmworks/jquery.js"></script>
      <script src="fmworks/toastr.min.js"></script>

      <!-- Toast alert  -->
      <?php
      if (isset($_SESSION["regSuccess"]) && ($_SESSION["regSuccess"] == "Yes")) {
         echo "<script> toastr.success('You will be redirected shortly.', 'Registration Successful', {timeOut: 5000}) </script>";
         $_SESSION["regSuccess"] = "No";
      }

      if (isset($_SESSION["regFailed"]) && ($_SESSION["regFailed"] == "Yes")) {
         echo "<script> toastr.error('You were unable to be registered.', 'Registration Unsuccessful', {timeOut: 5000}) </script>";
         $_SESSION["regFailed"] = "No";
      }
      ?>

   </body>

</html>