
<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "leader_page";

$user_details = getUserDetails($_SESSION["userEmail"]);


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $documentName = "";

   if (isset($_POST["upload"])) {

      if ($_FILES["teamDocument"]["size"] == 0) {
         $_SESSION["documentUploadFalse"] = "Yes";
      } else {
         $teamDocumentFile = $_FILES["teamDocument"];
         $allowedTypes = ["application/x-zip-compressed", "application/octet-stream"];

         // Check for file type
         if (!in_array($teamDocumentFile["type"], $allowedTypes)) {
            $_SESSION["fileSupport"] = "Yes";
         } else {
            $documentName = explode(".", $teamDocumentFile["name"])[0];
            $ext = explode(".", $teamDocumentFile["name"])[1];

            $documentName .= time();
            $documentName .= "." . $ext;

            $fileDestination = "../../../uploads/team-document/";
            $tmpFile = $teamDocumentFile['tmp_name'];

            $sqlDocument = "SELECT Document FROM teams WHERE Team_name = '{$user_details['Team_name']}' ";
            $sqlInsertDocument = mysqli_query($db_connection, $sqlDocument);
            $documentCheck = mysqli_fetch_assoc($sqlInsertDocument);

            // The function to upload the file to the destination
            if ($documentCheck["Document"] != " ") {

               if (file_exists($fileDestination . $documentCheck["Document"])) {

                  unlink($fileDestination . $documentCheck["Document"]);
                  move_uploaded_file($tmpFile, $fileDestination . $documentName);
               } else {
                  move_uploaded_file($tmpFile, $fileDestination . $documentName);
               }
            }
         }
      }
   }



   if (!empty($documentName)) {

      $sql = "UPDATE teams set Document = '$documentName' WHERE Team_name = '{$user_details['Team_name']}'";

      $sqlInsert = mysqli_query($db_connection, $sql);

      if ($sqlInsert) {
         $_SESSION["documentUpload"] = "Yes";
      }
   }
}

?>


<?php
   include("header.php");
   if($_SESSION["status"] !== "leader"){
      header("Location: dashboard.php");
   }
?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
         <section class="Heading">
            <h1>Alpha Team</h1>
            <hr>
         </section>

         <!-- Team Members section -->
         <section class="container" id="alphaCon">
            
            <!-- <p class="info"> <span>No Team Leader</span> </p> -->

            <section class="teamBox outside">
               <section class="imgSec inside">
                  <img src="../../uploads/user-pictures/user.jfif" alt="Profile picture" class="outside">
               </section>

               <span class="infoSec">
                  <h1>Chiagozie Okafor</h1>
                  <span>Backend Developer</span>
               </span>

               <p><i class="fa-solid fa-star"></i></p>
            </section> 

            <!-- Team Info -->
            <section class="teamBox outside">
               <span class="totalMembers"> 3 Member(s) <i class="fa fa-users"></i></span>
            </section>

            <hr>

            <!-- <p class="info"> <span>No Team Members</span> </p> -->
            
            <section class="teamBox outside">
               <section class="imgSec inside">
                  <img src="../../uploads/user-pictures/user.jfif" alt="Profile picture" class="outside">
               </section>

               <span class="infoSec">
                  <h1>Chiagozie okafor</h1>
                  <span>Backend Developer</span>
               </span>
            </section>                                                      
         </section>              
      </section>

      <!-- Second Partttttttttttt -->
      <section class="secondSec">
            <section class="Heading">
               <h1>Project Submission</h1>
               <hr>
            </section>
            
            <section class="container">
               
               <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="myForm">
                  <section class="projectUpload">
                        <label for="teamDocument">Project Upload</label>
                        <input type="file" id="file" name="teamDocument" size="10" class="inside">
                  </section>

                  <input type="submit" name="upload" value="&#8593; Upload">
               </form>
            </section>  
      </section>

      <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>

      <!-- <div class="removed"> 
            <p>Disqualified</p> 
      </div> -->
   </section>
   
   <script src="../../assets/js/dashboard.js"></script>
   <script src="../../assets/libraries/jquery.js"></script>
   <script src="../../assets/libraries/toastr.min.js"></script>

   <?php
      if(isset($_SESSION["fileSupport"]) && ($_SESSION["fileSupport"] == "Yes")){
            echo "<script> toastr.error('Unsupported file format.', 'File Error', {timeOut: 5000}) </script>";
            $_SESSION["fileSupport"] = "No";
      }

      if(isset($_SESSION["documentUpload"]) && ($_SESSION["documentUpload"] == "Yes")){
            echo "<script> toastr.success('Team project upload was successful.', 'Upload Successful', {timeOut: 5000}) </script>";
            $_SESSION["documentUpload"] = "No";
      }
   ?>
</div>
                
<script>
   var navLine = document.getElementById("navLine")
   var con1 = document.getElementById("con1")
   var con2 = document.getElementById("con2")
   

   function navHandle(num){
      if (num == 1){
            navLine.style.left = "0%"
            con1.style.display = "flex"
            con2.style.display = "none"

      }else if(num == 2){
            navLine.style.left = "50%"
            con1.style.display = "none"
            con2.style.display = "flex"
      }
   }


   async function teamMemberRequest(num, leaderTeam, leaderName, userEmail){

      var requestButton = document.getElementsByClassName("requestButton")
      requestButton[num].firstElementChild.onclick = ""
      requestButton[num].firstElementChild.textContent = "Request Sent ✓"
      requestButton[num].firstElementChild.style.backgroundColor = "silver"
      requestButton[num].firstElementChild.style.border = "1px solid silver"
      requestButton[num].firstElementChild.style.color = "grey"

      var result = await fetch(`asynchro.php?action=teamMemberRequest&leaderTeam=${leaderTeam}&leaderName=${leaderName}&userEmail=${userEmail}`);
   }
</script>

</body>
</html>