<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ApTrack</title>
      <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.css">
      <link rel="stylesheet" href="../css/sign_in.css">
   </head>

   <body>
      <div class="mainDiv">
         <section class="section1">
            <section class="mainPart">
               <section class="logoSec">
                  <img src="../photos/light.png" alt="Logo Image">
               </section>

               <section class="introText">
                  <p>Unlock your <br>Team Performance</p>
               </section>

               <section class="imgSec">
                  <img src="../photos/Collab-pana.png" alt="Introduction Image" id="loginImage">
               </section>
            </section>
         </section>

         <section class="section2">
            <section class="logoSec">
               <section>
                  <img src="../photos/light.png" alt="Logo Image">
               </section>
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

               <form action="../scripts/validateUser.php" method="post" id="user" class="myForm">
                  <section class="formItem">
                     <label for="userEmail">Email</label>
                     <input type="email" name="userEmail" required placeholder="Your Email" 
                     value="<?php if (isset($_SESSION["userRemember"])) {echo $_SESSION["userEmail"]; } ?>">
                  </section>

                  <section class="duoFormItem">
                     <section class="formItem">
                        <label for="userPassword">Password</label>
                        <input type="password" name="userPassword" required placeholder="Your Password" autocomplete>
                     </section>

                     <?php if (isset($_SESSION["userWrongInfo"]) && ($_SESSION["userWrongInfo"] == "Yes")) {
                        echo "<span class='error'>Incorrect email or password</span>";
                        $_SESSION["userWrongInfo"] = "No";
                     } ?>

                     <span>
                        <span>
                           <input type="checkbox" name="userRemember">
                           <span>Remember me</span>
                        </span>

                        <a href="../auth_pages/email_verification.php">Forgot Password?</a>
                     </span>
                  </section>

                  <section class="submitButton">
                     <input type="submit" value="Login" name="userLogin">

                     <span>
                        <span>Don't have an account? <a href="sign_up.php">Register</a></span>
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


               <form action="../scripts/validateAdmin.php" method="post" id="admin" class="myForm">
                  <section class="formItem">
                     <label for="adminEmail">Email</label>
                     <input type="email" name="adminEmail" required placeholder="Your Email" 
                     value="<?php if (isset($_SESSION["adminRemember"])) {echo $_SESSION["adminEmail"]; } ?>">
                  </section>

                  <section class="duoFormItem">
                     <section class="formItem">
                        <label for="adminPassword">Password</label>
                        <input type="password" name="adminPassword" required placeholder="Your Password" autocomplete>
                     </section>

                     <?php if (isset($_SESSION["adminWrongInfo"]) && ($_SESSION["adminWrongInfo"] == "Yes")) {
                        echo "<span class='error'>Incorrect email or password</span>";
                        $_SESSION["adminWrongInfo"] = "No";
                     } ?>

                     <span>
                        <span>
                           <input type="checkbox" name="adminRemember">
                           <span>Remember me</span>
                        </span>

                        <a href="../auth_pages/email_verification.php">Forgot Password?</a>
                     </span>
                  </section>

                  <section class="submitButton">
                     <input type="submit" value="Login" name="adminLogin">
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
               <img src="../photos/Design community-amico.png" alt="Footer Image">
            </section>
         </section>
      </div>

      <script src="../js/sign_in.js"></script>
   </body>

</html>