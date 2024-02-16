<?php


// Data Purifier ==============
function clean($data)
{
   return stripslashes(strip_tags(trim(htmlspecialchars($data))));
}


// Password Security ==============
function passwordLocker($password)
{
   return md5(md5(str_ireplace("a", "z", md5($password))) . strlen($password));
}


// Database Insertion for Sign up form ==============
function dbInsert($first, $last, $em, $pass)
{

   global $db_connection;

   $time = time();

   $sql = "INSERT INTO user_login(Firstname, Lastname, Email, Password, Regdate)
    VALUES('$first', '$last', '$em', '$pass', '$time')";

   $sqlInsert = mysqli_query($db_connection, $sql);

   if ($sqlInsert) {
      $_SESSION["regSuccess"] = "Yes";
      header("Refresh:2, url=sign-in.php");
   } else {
      $_SESSION["regFailed"] = "Yes";
   }

   mysqli_close($db_connection);
}

function userFormEdit($picture, $first, $last, $specialty)
{
   global $db_connection;

   $sql = "INSERT INTO user_login(Picture, Firstname, Lastname, Specialty)
    VALUES('$picture', '$first', '$last', '$specialty')";

   $sqlInsert = mysqli_query($db_connection, $sql);

   if ($sqlInsert) {
      header("Location: profile.php");
   }

   mysqli_close($db_connection);
}

// Email Checker ==============
function emailChecker($emailCheck, $table)
{
   global $db_connection;

   $sql = "SELECT Firstname FROM " . $table . " WHERE Email = '$emailCheck'";
   $sqlInsert = mysqli_query($db_connection, $sql);

   if (mysqli_num_rows($sqlInsert)) {
      $_SESSION['emailExists'] = "Yes";
   } else {
      global $email;

      $email = $emailCheck;
   }
}

// User Login Function ==============
function userLogin($email, $password, $table)
{
   global $db_connection;

   $sql = "SELECT Password FROM " . $table . " WHERE Email = '$email'";
   $sqlInsert = mysqli_query($db_connection, $sql);

   if (mysqli_num_rows($sqlInsert)) {
      // mysqli_fetch_assoc();
      $row = mysqli_fetch_assoc($sqlInsert);

      if ($row["Password"] == $password) {
         // For Remember me
         if (isset($_POST["userRemember"])) {
            $_SESSION["userRemember"] = "Yes";
         }

         $sqlUser = "SELECT Tl FROM user_login WHERE Email = '$email' ";
         $sqlInsertUser = mysqli_query($db_connection, $sqlUser);
         $userCheck = mysqli_fetch_assoc($sqlInsertUser);

         if ($userCheck["Tl"] == "0") {
            // For knowing if the user went through the sign in
            $_SESSION["userEmail"] = $email;
            $_SESSION["status"] = "user";

            // Going to the dashboard
            header("Location: ../pages/user/dashboard.php");
         } else {
            // For knowing if the user went through the sign in
            $_SESSION["userEmail"] = $email;
            $_SESSION["status"] = "leader";

            // Going to the dashboard
            header("Location: ../pages/user/team-leader-dashboard.php");
         }
      } else {
         $_SESSION["userWrongInfo"] = "Yes";
         header("Location: ../sign-in.php");
      }
   } else {
      $_SESSION["userWrongInfo"] = "Yes";
      header("Location: ../sign-in.php");
   }
}


// Admin Login
function adminLogin($email, $password, $table)
{
   global $db_connection;

   $sql = "SELECT Password FROM " . $table . " WHERE Email = '$email'";
   $sqlInsert = mysqli_query($db_connection, $sql);

   if (mysqli_num_rows($sqlInsert)) {
      // mysqli_fetch_assoc();
      $row = mysqli_fetch_assoc($sqlInsert);

      if ($row["Password"] == $password) {
         // For Remember me
         if (isset($_POST["adminRemember"])) {
            $_SESSION["adminRemember"] = "Yes";
         }

         // For knowing if the user went through the sign up
         $_SESSION["adminEmail"] = $email;
         $_SESSION["status"] = "admin";

         // Going to the dashboard
         header("Location: ../pages/admin/dashboard.php");
      } else {
         $_SESSION["adminWrongInfo"] = "Yes";
         header("Location: ../sign-in.php");
      }
   } else {
      $_SESSION["adminWrongInfo"] = "Yes";
      header("Location: ../sign-in.php");
   }
}


// Email Verifier
function emailVerifier($emailCheck, $table)
{
   global $db_connection;

   $sql = "SELECT Firstname FROM " . $table . " WHERE Email = '$emailCheck'";
   $sqlInsert = mysqli_query($db_connection, $sql);

   if (mysqli_num_rows($sqlInsert)) {
      $_SESSION["verifiedUserEmail"] = $emailCheck;
      header("Location: change-password.php");
   } else {

      $sql2 = "SELECT Firstname FROM admin_login WHERE Email = '$emailCheck'";
      $sqlInsert2 = mysqli_query($db_connection, $sql2);

      if (mysqli_num_rows($sqlInsert2)) {
         $_SESSION["verifiedAdminEmail"] = $emailCheck;
         header("Location: change-password.php");
      } else {
         $_SESSION["emailNotFound"] = "Yes";
      }
   }
}


//Password Changer
function passwordChanger($email, $newPassword, $table)
{
   global $db_connection;

   $sql = "UPDATE " . $table . " set Password = '$newPassword' WHERE Email = '$email'";
   $sqlInsert = mysqli_query($db_connection, $sql);

   if ($sqlInsert) {
      $_SESSION["passChangeSuccess"] = "Yes";
      header("Refresh:2, url=../../sign-in.php");
   } else {
      $_SESSION["passChangeFail"] = "Yes";
   }

   mysqli_close($db_connection);
}


function identity()
{
   global $db_connection;

   // Getting all the users details
   $sql = "SELECT * FROM user_login WHERE Email = '{$_SESSION["userEmail"]}' ";
   $sqlInsert = mysqli_query($db_connection, $sql);

   global $userDetails;
   $userDetails = mysqli_fetch_assoc($sqlInsert);
}


function month($num)
{
   $correctMonth = "";
   if ($num == "01") {
      $correctMonth = "January";
   } else if ($num == "02") {
      $correctMonth = "Febuary";
   } else if ($num == "03") {
      $correctMonth = "March";
   } else if ($num == "04") {
      $correctMonth = "April";
   } else if ($num == "05") {
      $correctMonth = "May";
   } else if ($num == "06") {
      $correctMonth = "June";
   } else if ($num == "07") {
      $correctMonth = "July";
   } else if ($num == "08") {
      $correctMonth = "August";
   } else if ($num == "09") {
      $correctMonth = "September";
   } else if ($num == "10") {
      $correctMonth = "October";
   } else if ($num == "11") {
      $correctMonth = "November";
   } else if ($num == "12") {
      $correctMonth = "December";
   }

   return $correctMonth;
}



/**
 * duration
 *
 * @param  mixed $dateOne
 * @param  mixed $dateTwo
 * @return string
 */
//Ctrl + shift + i => for DocComment
function duration($dateOne, $dateTwo): string
{
   $firstDate = explode("-", $dateOne);
   $secondDate = explode("-", $dateTwo);

   $days = ceil((mktime(0, 0, 0, $secondDate[1], $secondDate[2], $secondDate[0]) - mktime(0, 0, 0, $firstDate[1], $firstDate[2], $firstDate[0])) / 60 / 60 / 24);

   return intdiv($days, 7) . " week(s) and " . ($days % 7) . " days(s)";
}
