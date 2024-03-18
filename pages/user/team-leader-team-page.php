
<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "leader_page";

include("header.php");
if($_SESSION["status"] !== "leader"){
   redirect("dashboard.php");
}
?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
         <section class="Heading">
            <h1>Alpha Team</h1>
            <hr>
         </section>

         <?php if($user_details["team_id"]): ?>
         <section class="container">
            <?php $team_leader = getTeamLeaderDetails($user_details["leader_id"]); ?>
            <section class="teamBox outside" title="Team Leader">
               <section class="imgSec inside">
                  <img src="../../uploads/user-pictures/<?= $team_leader['picture'] ?>" alt="Profile picture" class="outside">
               </section>

               <span class="infoSec">
                  <h1><?= ucwords("{$team_leader['firstname']} {$team_leader['lastname']}") ?></h1>
                  <span><?= $team_leader['specialty'] ?></span>
               </span>

               <span class="teamName"><?= ucfirst($user_details['name']) ?></span>

               <p><i class="fa-solid fa-star"></i></p>
            </section>

            <?php $team_members = getTeamMembers($user_details['team_id'], getTeamLeaderId($user_details['team_id'])); ?>
            <section class="teamBox outside">
               <span class="totalMembers"><?= count($team_members) + 1 ?> &nbsp;Member(s)&nbsp; <i class="fa fa-users"></i> </span>
            </section>

            <hr>
            
            <?php foreach ($team_members as $team_member):?>
            <section class="teamBox outside">
               <section class="imgSec inside">
                  <img src="../../uploads/user-pictures/<?= $team_member['picture'] ?>" alt="Profile picture" class="outside">
               </section>

               <span class="infoSec">
                  <h1><?= ucwords("{$team_member['firstname']} {$team_member['lastname']}") ?></h1>
                  <span>Backend Developer</span>
               </span>

               <span class="teamName"><?= ucfirst($user_details['name']) ?></span>
            </section>
            <?php endforeach; ?>    
         </section>
         <?php else: ?>
         <p class="info"> <span>Not in any Team</span> </p>
         <?php endif; ?>              
      </section>

      <!-- Projetc Submission -->
      <section class="secondSec">
         <section class="Heading">
            <h1>Project Submission</h1>
            <hr>
         </section>
         
         <section class="container">
            <form action="../../scripts/upload-team-document-handler.php" method="post" enctype="multipart/form-data" class="myForm">
               <section class="projectUpload">
                     <label for="document">Project Upload</label>
                     <input type="file" id="file" name="document" size="10" class="inside">
               </section>

               <input type="submit" name="upload" value="&#8593; Upload">
            </form>
         </section>
      </section>

      <?php if($user_details["team_id"] && $user_details['disqualify']): ?>
      <div class="removed">
         <p>Disqualified</p>
      </div>
      <?php endif; ?>  

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

      if(isset($_SESSION["uploadSuccess"]) && ($_SESSION["uploadSuccess"] == "Yes")){
            echo "<script> toastr.success('Team project upload was successful.', 'Upload Successful', {timeOut: 5000}) </script>";
            $_SESSION["uploadSuccess"] = "No";
      }
      
      if(isset($_SESSION["uploadFailed"]) && ($_SESSION["uploadFailed"] == "Yes")){
            echo "<script> toastr.error('Team project upload was unsuccessful.', 'Upload Unsuccessful', {timeOut: 5000}) </script>";
            $_SESSION["uploadFailed"] = "No";
      }
   ?>
</div>
                
</body>
</html>