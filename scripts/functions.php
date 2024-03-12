<?php

/**
 * Clean user input
 *
 * @param  mixed $data
 * @return mixed
 */
function dataSanitizer($data) :mixed
{
   return stripslashes(strip_tags(trim(htmlspecialchars($data))));
}


/**
 * Redirect to specified location
 *
 * @param  mixed $location
 * @return void
 */
function redirect(string $location) :void
{
   header("Location: $location");
}


/**
 * Split the username into firstname and lastname
 *
 * @param  string $username
 * @return array
 */
function usernameSplitter($username) :array
{
   return explode(" ", $username);
}


/**
 * Encrypt and salt user password
 *
 * @param  string $password
 * @return string
 */
function passwordLock($password) :string
{
   return md5(md5(str_ireplace("a", "z", md5($password))) . strlen($password));
}


/**
 * Convert MYSQL dateTime to PHP dateTime
 *
 * @param  string $dateTime
 * @return string
 */
function toDateTime(string $dateTime): string
{
   $dateTime = explode(" ", $dateTime);
   $date = explode("-", $dateTime[0]);
   $time = explode(":", $dateTime[1]);

   $result = mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]);

   return $result;
}


/**
 * Verify the file type is an image format
 *
 * @param  string $file_type
 * @return bool
 */
function imageTypeVerifier(string $file_type) :bool
{
   $allowedTypes = ["image/jpeg", "image/png", "image/jpg", "image/jfif", "image/webp"];
   
   return in_array($file_type, $allowedTypes);
}





// Admin Login
function adminLogin($email, $password, $table)
{
   global $connection;

   $sql = "SELECT Password FROM " . $table . " WHERE Email = '$email'";
   $sqlInsert = mysqli_query($connection, $sql);

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
         redirect("../pages/admin/dashboard.php");
      } else {
         $_SESSION["adminWrongInfo"] = "Yes";
         redirect("../sign-in.php");
      }
   } else {
      $_SESSION["adminWrongInfo"] = "Yes";
      redirect("../sign-in.php");
   }
}


// Email Verifier
function emailVerifier($emailCheck, $table)
{
   global $connection;

   $sql = "SELECT Firstname FROM " . $table . " WHERE Email = '$emailCheck'";
   $sqlInsert = mysqli_query($connection, $sql);

   if (mysqli_num_rows($sqlInsert)) {
      $_SESSION["verifiedUserEmail"] = $emailCheck;
      redirect("change-password.php");
   } else {

      $sql2 = "SELECT Firstname FROM admin_login WHERE Email = '$emailCheck'";
      $sqlInsert2 = mysqli_query($connection, $sql2);

      if (mysqli_num_rows($sqlInsert2)) {
         $_SESSION["verifiedAdminEmail"] = $emailCheck;
         redirect("change-password.php");
      } else {
         $_SESSION["emailNotFound"] = "Yes";
      }
   }
}


//Password Changer
function passwordChanger($email, $newPassword, $table)
{
   global $connection;

   $sql = "UPDATE " . $table . " set Password = '$newPassword' WHERE Email = '$email'";
   $sqlInsert = mysqli_query($connection, $sql);

   if ($sqlInsert) {
      $_SESSION["passChangeSuccess"] = "Yes";
      header("Refresh:2, url=../../sign-in.php");
   } else {
      $_SESSION["passChangeFail"] = "Yes";
   }

   mysqli_close($connection);
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
function duration($dateOne, $dateTwo): string
{
   $firstDate = explode("-", $dateOne);
   $secondDate = explode("-", $dateTwo);

   $days = ceil((mktime(0, 0, 0, $secondDate[1], $secondDate[2], $secondDate[0]) - mktime(0, 0, 0, $firstDate[1], $firstDate[2], $firstDate[0])) / 60 / 60 / 24);

   return intdiv($days, 7) . " week(s) and " . ($days % 7) . " days(s)";
}