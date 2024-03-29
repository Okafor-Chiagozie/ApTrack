<?php
session_start();
$_SESSION["forgotPassword"] = true;
$_SESSION["changePassword"] = false;
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login - ApTrack</title>
      <link rel="stylesheet" href="assets/fontawesome-free-6.1.1-web/css/all.css">
      <link rel="stylesheet" href="assets/css/user/sign-in.css">
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
                  <img src="assets/images/Collab-pana.png" alt="Introduction Image" id="loginImage">
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

            <div class="myFormSection">
               <section class="formHeading">
                  <h1>Welcome back</h1>
                  <span>
                     <span class="toggle" id="toggle" onclick="change()">
                        <span class="flow" id="flow"></span>
                        <span>Admin</span>
                        <span class="userButton">User</span>
                     </span>
                  </span>
               </section>

               <form action="scripts/user-login-handler.php" method="post" id="user" class="myForm">
                  <section class="formItem">
                     <label for="userEmail">Email</label>
                     <input type="email" name="email" required placeholder="Your Email" 
                     value="<?php if (isset($_SESSION["userRemember"])) {echo $_SESSION["userEmail"]; } ?>">
                  </section>

                  <section class="duoFormItem">
                     <section class="formItem">
                        <label for="userPassword">Password</label>
                        <input type="password" name="password" required placeholder="Your Password" autocomplete>
                     </section>

                     <?php if (isset($_SESSION["userWrongInfo"]) && $_SESSION["userWrongInfo"]) {
                        echo "<span class='error'>Incorrect email or password</span>";
                        $_SESSION["userWrongInfo"] = false;
                     } ?>

                     <span>
                        <span>
                           <input type="checkbox" name="remember_me">
                           <span>Remember me</span>
                        </span>

                        <a href="pages/auth/verify-email.php">Forgot Password?</a>
                     </span>
                  </section>

                  <section class="submitButton">
                     <input type="submit" value="Login" name="user_login">

                     <span>
                        <span>Don't have an account? <a href="index.php">Register</a></span>
                     </span>
                  </section>

                  <section class="orSection">
                     <hr> <span>OR</span>
                     <hr>
                  </section>

                  <section class="otherOption">
                     <span class="google"> <i class="fab fa-google"></i> <span>Log in with Google</span></span>

                     <span class="facebook"> <i class="fab fa-facebook-f"></i> <span>Log in with Facebook</span></span>
                  </section>
               </form>


               <form action="scripts/admin-login-handler.php" method="post" id="admin" class="myForm">
                  <section class="formItem">
                     <label for="adminEmail">Email</label>
                     <input type="email" name="email" required placeholder="Your Email" 
                     value="<?php if (isset($_SESSION["adminRemember"])) {echo $_SESSION["adminEmail"]; } ?>">
                  </section>

                  <section class="duoFormItem">
                     <section class="formItem">
                        <label for="adminPassword">Password</label>
                        <input type="password" name="password" required placeholder="Your Password" autocomplete>
                     </section>

                     <?php if (isset($_SESSION["adminWrongInfo"]) && $_SESSION["adminWrongInfo"]): ?>
                     <span class='error'>Incorrect email or password</span>
                     <?php
                     $_SESSION["adminWrongInfo"] = false;
                     endif;
                     ?>

                     <span>
                        <span>
                           <input type="checkbox" name="adminRemember">
                           <span>Remember me</span>
                        </span>

                        <a href="pages/auth/verify-email.php">Forgot Password?</a>
                     </span>
                  </section>

                  <section class="submitButton">
                     <input type="submit" value="Login" name="admin_login">
                  </section>

                  <section class="orSection">
                     <hr> <span>OR</span> <hr>
                  </section>

                  <section class="otherOption">
                     <span class="google"> <i class="fab fa-google"></i> <span>Log in with Google</span></span>

                     <span class="facebook"> <i class="fab fa-facebook-f"></i> <span>Log in with Facebook</span></span>
                  </section>
               </form>
            </div>

            <section class="footerImg">
               <img src="assets/images/Design community-amico.png" alt="Footer Image">
            </section>
         </section>
      </div>

      <script src="assets/libraries/jquery.js"></script>
      <script src="assets/libraries/toastr.min.js"></script>
      <script src="assets/js/sign-in.js"></script>
      <?php
      if (isset($_SESSION["regSuccess"]) && $_SESSION["regSuccess"]) {
         echo "<script> toastr.success('Kindly login to continue.', 'Registration Successful', {timeOut: 5000}) </script>";
         $_SESSION["regSuccess"] = false;
      }

      if (isset($_SESSION["loginFailed"]) && $_SESSION["loginFailed"]) {
         echo "<script> toastr.error('Try logging in again.', 'Login Unsuccessful', {timeOut: 5000}) </script>";
         $_SESSION["loginFailed"] = false;
      }

      if(isset($_SESSION["changePasswordSuccess"]) && $_SESSION["changePasswordSuccess"]){
         echo "<script> toastr.success('Your password have been changed successfully.', 'Password Changed Successfully', {timeOut: 5000}) </script>";
         $_SESSION["changePasswordSuccess"] = false;
      }
      ?>
   </body>
</html>