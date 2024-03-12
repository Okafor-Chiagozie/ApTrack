<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "profile_edit";

$user_details = getUserDetails($_SESSION["userEmail"]);

// Declaring variables
$pictureName = $firstname = $lastname = $specialty = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["update"])){

        if($_FILES["picture"]["size"] == 0){
            $pictureName = $user_details["Picture"];
        }else{
            $pictureFile = $_FILES["picture"];
            $allowedTypes = ["image/jpeg", "image/png", "image/jpg", "image/jfif"];

            // Check for file type
            if(!in_array($pictureFile["type"], $allowedTypes)) {
                $_SESSION["fileSupport"] = "Yes";
            }  
            else {
                $pictureName = explode(".", $pictureFile["name"])[0];
                $ext = explode(".", $pictureFile["name"])[1];

                $pictureName .= time();
                $pictureName .= "." . $ext;

                $fileDestination = "./user_pictures/";
                $tmpFile = $pictureFile['tmp_name'];
    
                // The function to upload the file to the destination
                if($user_details["Picture"] != " "){

                    if(file_exists($fileDestination.$user_details["Picture"]) && $user_details["Picture"] != "user.jfif" ){

                        unlink($fileDestination.$user_details["Picture"]);
                        move_uploaded_file($tmpFile, $fileDestination.$pictureName);                        
                    }else{
                        move_uploaded_file($tmpFile, $fileDestination.$pictureName);
                    }

                    
                }
                
            }
        }

        if(!empty($_POST["firstname"])){
            $firstname = dataSanitizer($_POST["firstname"]);
        }

        if(!empty($_POST["lastname"])){
            $lastname = dataSanitizer($_POST["lastname"]);
        }

        if(!empty($_POST["specialty"])){
            $specialty = $_POST["specialty"];
        }


    }  

    if(!empty($pictureName) && !empty($firstname) && !empty($lastname) && !empty($specialty)){

        $sql = "UPDATE user_login set Picture = '$pictureName', 
        Firstname = '$firstname', Lastname = '$lastname', Specialty = '$specialty' 
        WHERE Email = '{$user_details['Email']}'";

        $sqlInsert = mysqli_query($db_connection, $sql);

        if($sqlInsert){
            header("Location: profile.php");
        }

        mysqli_close($db_connection);
    }
}
?>


<?php
   include("header.php");
?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
         <section class="Heading">
            <h1>My Profile</h1>
            <hr>
         </section>
         

         <section class="container">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="myForm">
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
                        <option <?php if($user_details["specialty"] == "UI/UX Designer"){?> selected <?php } ?> value="UI/UX Designer">UI/UX Designer</option>
                        <option <?php if($user_details["specialty"] == "Frontend Developer"){?> selected <?php } ?> value="Frontend Developer">Frontend Developer</option>
                        <option <?php if($user_details["specialty"] == "Backend Developer"){?> selected <?php } ?> value="Backend Developer">Backend Developer</option>
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
      if(isset($_SESSION["fileSupport"]) && ($_SESSION["fileSupport"] == "Yes")){
         echo "<script> toastr.error('Unsupported file format.', 'File Error', {timeOut: 5000}) </script>";
         $_SESSION["fileSupport"] = "No";
      }
   ?>
</div>

</body>
</html>
