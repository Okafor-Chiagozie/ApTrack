
<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "leader_dashboard";

include("header.php");
if($_SESSION["status"] !== "leader"){
   redirect("dashboard.php");
}
?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
         <section class="Heading">
            <h1>All Users</h1>
            <hr>
         </section>

         <nav>
            <span onclick="navHandle(1)">All Users</span>
            <span onclick="navHandle(2)">Team Leaders</span>
            <hr id="navLine">
         </nav>

         <!-- All Users Section -->
         <section class="container" id="con1">
            <?php 
            $num = -1;
            $all_users = getAllUsers(); 
            if($all_users):
               foreach ($all_users as $user):
            ?>
            <section class="teamBox outside">
               <section class="imgSec inside">
                  <img src="../../uploads/user-pictures/<?= $user['picture'] ?>" alt="Profile picture" class="outside">
               </section>

               <span class="infoSec">
                  <h1><?= ucwords("{$user['firstname']} {$user['lastname']}") ?></h1>
                  <span><?= $user["specialty"] ?></span>
               </span>

               <span class="<?= ($user['team_id'] || getTeamUserNotification($user['email'], $user_details["team_id"])) ? 'noButton' : 'teamButton requestButton' ?>">
                  <?php if(!getTeamUserNotification($user['email'], $user_details["team_id"])): ?>
                  <span 
                     <?php if(!$user['team_id']): $num++ ?>
                     onclick="teamMemberRequest(<?= $num ?>, <?= $user['id'] ?>, <?= $user_details['team_id'] ?>)"
                     <?php endif; ?>
                  >Send Request</span>
                  <?php else: ?>
                  <span>Request Sent &#10003;</span>
                  <?php endif; ?>
               </span>
            </section>
            <?php 
               endforeach;
               if($user_details['disqualify']):
            ?>
            <div class="removed">
               <p>Disqualified</p>
            </div>
            <?php 
               endif; 
            else:
            ?>
            <p class="info"> <span>No User Available</span> </p>
            <?php endif; ?>
         </section>

         <!-- Team Leaders Section -->
         <section class="container" id="con2">
            <?php  
            $team_leaders = getAllTeamLeaders();
            if($team_leaders):
               foreach ($team_leaders as $team_leader):
            ?>
            <section class="teamBox outside">
               <section class="imgSec inside">
                     <img src="../../uploads/user-pictures/user.jfif" alt="Profile picture" class="outside">
               </section>

               <span class="infoSec">
                     <h1><?= ucwords("{$team_leader['firstname']} {$team_leader['lastname']}") ?></h1>
                     <span><?= $team_leader["specialty"] ?></span>
               </span>

               <span class="teamName"><?= ucfirst($team_leader["name"]) ?></span>

               <p><i class="fa-solid fa-star"></i></p>
            </section>
            <?php 
               endforeach;
            else:
            ?>
            <p class="info"> <span>No Team Leader Available</span> </p>
            <?php endif; ?>
         </section>
      </section>

      <section class="secondSec">
         <section class="Heading">
            <h1>Latest Task</h1>
            <hr>
         </section>
         
         <?php 
         $tasks = getAllTask(1);
         if($tasks):
            foreach ($tasks as $task):
         ?>
         <section class="container outside">
            <h1>Project description</h1>

            <p> 
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat cum tenetur 
               officia molestiae perspiciatis temporibus odio atque excepturi placeat nemo. 
               Quisquam cum quam at et suscipit ut consectetur neque reprehenderit?
            </p>

            <section>
               <span>Start Date:  </span>
               <span>End Date:  </span>
               <span>Duration: </span>
            </section>
         </section>
         <?php
            endforeach;
         else:
         ?>
         <p class="info"> <span>No task available</span> </p>
         <?php endif; ?>
      </section>

      <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
   </section>
   
   <script src="../../assets/js/dashboard.js"></script>
   <script src="../../assets/libraries/jquery.js"></script>
</div>
            
<script>
   var navLine = document.getElementById("navLine");
   var con1 = document.getElementById("con1");
   var con2 = document.getElementById("con2");
   

   function navHandle(num){
      if (num == 1){
            navLine.style.left = "0%";
            con1.style.display = "flex";
            con2.style.display = "none";

      }else if(num == 2){
            navLine.style.left = "50%";
            con1.style.display = "none";
            con2.style.display = "flex";
      }
   }


   async function teamMemberRequest(num, user_id, team_id){
      
      var result = await fetch(`../../scripts/async.php?action=teamMemberRequest&userId=${user_id}&teamId=${team_id}`);
      var response = await result.text();

      if(response == "Done"){
         var requestButtons = document.getElementsByClassName("requestButton");
         requestButtons[num].firstElementChild.onclick = "";
         requestButtons[num].firstElementChild.textContent = "Request Sent ✓";
         requestButtons[num].firstElementChild.style.backgroundColor = "silver";
         requestButtons[num].firstElementChild.style.border = "1px solid silver";
         requestButtons[num].firstElementChild.style.color = "grey";
      }
   }
</script>

</body>
</html>