
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
            $num = 0;
            $all_users = getAllUsers(); 
            if($all_users):
               foreach ($all_users as $user):
                  $num++;
            ?>
            <section class="teamBox outside">
               <section class="imgSec inside">
                  <img src="../../uploads/user-pictures/<?= $user['picture'] ?>" alt="Profile picture" class="outside">
               </section>

               <span class="infoSec">
                  <h1><?= ucwords("{$user['firstname']} {$user['lastname']} $num") ?></h1>
                  <span><?= $user["specialty"] ?></span>
               </span>

               <!-- <span class="noButton">
                  <span>Send Request</span>
               </span> -->
         
               <!-- <span class="noButton">
                  <span>Request Sent &#10003;</span>
               </span> -->

               <span class="<?= ($user['team_id']) ? 'noButton' : 'teamButton requestButton' ?>">
                  <span onclick="teamMemberRequest()">Send Request</span>
                  <!-- $num , $user_details['Team_name'] , 'ucwords($user_details['Firstname'].' '.$user_details['Lastname']), $allUsers['Email']  -->
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
            <section class="teamBox outside">
               <section class="imgSec inside">
                     <img src="../../uploads/user-pictures/user.jfif" alt="Profile picture" class="outside">
               </section>

               <span class="infoSec">
                     <h1>Chiagozie Okafor</h1>
                     <span>Backend Developer</span>
               </span>

               <span class="teamName">Alpha</span>

               <p><i class="fa-solid fa-star"></i></p>
            </section>
         </section>
      </section>

      <section class="secondSec">
         <section class="Heading">
            <h1>Latest Task</h1>
            <hr>
         </section>

         <section class="container outside">
            <h1>Project description</h1>

            <p>
               Lorem ipsum, dolor sit amet consectetur adipisicing elit. In suscipit fugit sed esse, 
               a deserunt vel praesentium cum quae! Ipsam ipsum mollitia placeat quo ullam 
               voluptatibus a, consectetur officia maiores?
            </p>

            <section>
               <span>Start Date: </span>
               <span>End Date: </span>
               <span>Duration: </span>
            </section>
         </section>
            
            <!-- <p class="info"> <span>No task available</span> </p> -->
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


   async function teamMemberRequest(leaderId, userEmail){

      var result = await fetch(`../../scripts/async.php?action=teamMemberRequest&leaderId=${leaderId}&userEmail=${userEmail}`);

      var requestButtons = document.getElementsByClassName("requestButton");

      for (const requestButton of requestButtons) {
         requestButton.addEventListener('click', () => {
            requestButton.style.display = "none";
         });
      }
      requestButton[num].firstElementChild.onclick = "";
      requestButton[num].firstElementChild.textContent = "Request Sent ✓";
      requestButton[num].firstElementChild.style.backgroundColor = "silver";
      requestButton[num].firstElementChild.style.border = "1px solid silver";
      requestButton[num].firstElementChild.style.color = "grey";
   }
</script>

</body>
</html>