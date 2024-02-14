<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");

$_SESSION["userMenu"] = "notifications";

identity();

?>


<?php

include("header.php");

?>

<section class="mainSection inside" id="mainSection">

   <section class="firstSec">
      <section class="Heading">
         <h1>My Notifications</h1>
         <hr>
      </section>

      <?php
      $sqlNotify = "SELECT * FROM notify WHERE User_email = '{$userDetails['Email']}' ORDER BY Id DESC ";
      $sqlNotifyInsert = mysqli_query($db_connection, $sqlNotify);

      if (mysqli_num_rows($sqlNotifyInsert)) {
         $num = 0;
         while ($notifyDetails = mysqli_fetch_assoc($sqlNotifyInsert)) {

      ?>

            <section class="container outside">
               <span>
                  <span class="one">Team Name:</span>
                  <span><?= strtoupper($notifyDetails["Team_name"]) ?></span>
               </span>

               <span>
                  <span class="one">Team Leader:</span>
                  <span><?= ucwords($notifyDetails["Team_leader"]) ?></span>
               </span>

               <span>
                  <span>Sent you a membership request 😎</span>
               </span>

               <section>
                  <span class="accept" onclick="accept(<?= $num ?>, '<?= $notifyDetails['User_email'] ?>', '<?= $notifyDetails['Id'] ?>', '<?= $notifyDetails['Team_name'] ?>')">Accept</span>



                  <span class="decline" onclick="decline(<?= $num ?>, '<?= $notifyDetails['User_email'] ?>', '<?= $notifyDetails['Id'] ?>')">
                     Decline</span>



               </section>

            </section>

         <?php $num++;
         }
      } else { ?>
         <p class="info"> <span>No notification available</span> </p>
      <?php } ?>


   </section>



   <p class="footer">All Rights Reserved @Beta Group 2022</p>

</section>
</div>


<script src="../../assets/js/dashboard.js"></script>
<script src="../../assets/libraries/jquery.js"></script>
<script>
   async function accept(num, email, id, teamName) {
      var container = document.getElementsByClassName("container")
      container[num].style.display = "none"

      var result = await fetch(`asynchro.php?action=accept&email=${email}&id=${id}&teamName=${teamName}`);
      var req = await result.text();
   }

   function decline(num, email, id) {
      var container = document.getElementsByClassName("container")
      container[num].style.display = "none"

      $.post(`./user_notification_handler.php?action=decline&email=${email}&id=${id}`, (res) => {
         if (res == "successful") {

            console.log("Working")
         }
      })
   }
</script>

</body>

</html>