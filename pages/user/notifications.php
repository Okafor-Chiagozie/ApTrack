<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "notifications";

include("header.php");
?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
         <section class="Heading">
            <h1>My Notifications</h1>
            <hr>
         </section>
            <?php
            $num = -1;
            $notifications = getUserNotifications($user_details["email"]);
            if($notifications):
               foreach ($notifications as $notification):
                  $num++;
            ?>
            <section class="container outside">
               <span>
                  <span class="one">Team Name:</span>
                  <span><?= ucfirst($notification["name"]) ?></span>
               </span>

               <span>
                  <?php $team_leader = getTeamLeaderDetails($notification['leader_id']); ?>
                  <span class="one">Team Leader:</span>
                  <span><?= ucwords("{$team_leader['firstname']} {$team_leader['lastname']}") ?></span>
               </span>

               <span>
                  <span>Sent you a team membership request 😎</span>
               </span>

               <section>
                  <span class="accept" onclick="accept(<?= $num ?>, '<?= $user_details['email'] ?>', <?= $notification['team_id'] ?>)">Accept</span>

                  <span class="decline" onclick="decline(<?= $num ?>, '<?= $user_details['email'] ?>', <?= $notification['team_id'] ?>)">Decline</span>
               </section>
            </section>
            <?php 
               endforeach;
            else: 
            ?>

         <p class="info"> <span>No notification available</span> </p>
         <?php endif; ?>
      </section>

      <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
   </section>
</div>


<script src="../../assets/js/dashboard.js"></script>
<script src="../../assets/libraries/jquery.js"></script>
<script>
   async function accept(num, user_email, team_id) {
      var container = document.getElementsByClassName("container");
      
      var request = await fetch(`../../scripts/async.php?action=accept&userEmail=${user_email}&teamId=${team_id}`);
      var response = await request.text();

      if(response == "Done"){
         container[num].style.display = "none";
         window.location.href = "dashboard.php";
      }      
   }

   async function decline(num, user_email, team_id) {
      var container = document.getElementsByClassName("container");
      
      var request = await fetch(`../../scripts/async.php?action=decline&userEmail=${user_email}&teamId=${team_id}`);
      var response = await request.text();

      if(response == "Done"){
         container[num].style.display = "none";
      }
   }
</script>

</body>
</html>