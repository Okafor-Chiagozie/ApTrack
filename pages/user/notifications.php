<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "notifications";

$user_details = fetchUserDetails($_SESSION["userEmail"]);
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
            <section class="container outside">
               <span>
                  <span class="one">Team Name:</span>
                  <span></span>
               </span>

               <span>
                  <span class="one">Team Leader:</span>
                  <span></span>
               </span>

               <span>
                  <span>Sent you a membership request 😎</span>
               </span>

               <section>
                  <span class="accept" onclick="">Accept</span>
                  <!-- accept( $num , '$notifyDetails['User_email']', '$notifyDetails['Id']', '$notifyDetails['Team_name']') -->

                  <span class="decline" onclick="">Decline</span>
                  <!-- decline($num>, '$notifyDetails['User_email']', '$notifyDetails['Id']') -->
               </section>
            </section>

         <!-- <p class="info"> <span>No notification available</span> </p> -->
      </section>



      <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
   </section>
</div>


<script src="../../assets/js/dashboard.js"></script>
<script src="../../assets/libraries/jquery.js"></script>
<script>
   async function accept(num, email, id, teamName) {
      var container = document.getElementsByClassName("container")
      container[num].style.display = "none"

      var result = await fetch(`../../scripts/async.php?action=accept&email=${email}&id=${id}&teamName=${teamName}`);
      var req = await result.text();

      window.location.href = req.toString();
   }

   async function decline(num, email, id) {
      var container = document.getElementsByClassName("container")
      container[num].style.display = "none"

      var result = await fetch(`../../scripts/async.php?action=decline&email=${email}&id=${id}`);
   }
</script>

</body>
</html>