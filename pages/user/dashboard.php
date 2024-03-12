
<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "dashboard";
$user_details = getUserDetails($_SESSION["userEmail"]);

include("header.php");
?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
            <section class="Heading">
               <h1>Team Members</h1>
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
                     <h1><?= ucwords($team_leader['firstname']." ".$team_leader['lastname']) ?></h1>
                     <span><?= $team_leader['specialty'] ?></span>
                  </span>

                  <span class="teamName"><?= ucfirst($user_details['name']) ?></span>

                  <p><i class="fa-solid fa-star"></i></p>
               </section>

               <?php $team_members = getTeamMembers($user_details['team_id'], getTeamLeaderId($user_details['team_id'])); ?>
               <section class="teamIcon outside">
                  <span><?= count($team_members) + 1 ?> &nbsp;Members&nbsp; <i class="fa fa-users"></i> </span>
               </section>

               <hr>
               
               <?php foreach ($team_members as $team_member):?>
               <section class="teamBox outside">
                  <section class="imgSec inside">
                     <img src="../../uploads/user-pictures/<?= $team_member['picture'] ?>" alt="Profile picture" class="outside">
                  </section>

                  <span class="infoSec">
                     <h1><?= ucwords($team_member['firstname']." ".$team_member['lastname']) ?></h1>
                     <span>Backend Developer</span>
                  </span>

                  <span class="teamName"><?= ucfirst($user_details['name']) ?></span>
               </section>
               <?php endforeach; ?>

               <?php if($user_details['disqualify']): ?>
               <div class="removed"> 
                  <p>Disqualified</p> 
               </div>
               <?php endif; ?>      
            </section>
            <?php else: ?>
            <p class="info"> <span>Not in any Team</span> </p>                       
            <?php endif; ?>
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

      <!-- <section class="secondSec">
            <section class="Heading">
               <h1>Current Task</h1>
               <hr>
            </section>


            <section class="teamSec">
               
            </section>

      </section> -->

      <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
   </section>

   
   <script src="../../assets/js/dashboard.js"></script>
   <script src="../../assets/libraries/jquery.js"></script>
</div>

</body>
</html>