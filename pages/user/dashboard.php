
<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "dashboard";

$user_details = fetchUserDetails($_SESSION["userEmail"]);
?>


<?php

include("header.php");

?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
            <section class="Heading">
               <h1>Team Members</h1>
               <hr>
            </section>

         <!-- <p class="info"> <span>Not in any Team</span> </p> -->

            <section class="container">
               <section class="teamBox outside" title="Team Leader">
                  <section class="imgSec inside">
                        <img src="../../uploads/user-pictures/user.jfif" alt="Profile picture" class="outside">
                  </section>

                  <span class="infoSec">
                        <h1>Chiagozie Okafor</h1>
                        <span>Backend Developer</span>
                  </span>

                  <span class="teamName">
                     Alpha
                  </span>

                  <p><i class="fa-solid fa-star"></i></p>

               </section>

               <section class="teamIcon outside">
                  <span>3 &nbsp;&nbsp;Members&nbsp;&nbsp; <i class="fa fa-users"></i> </span>
               </section>

               <hr>
               
               <section class="teamBox outside">
                  <section class="imgSec inside">
                        <img src="../../uploads/user-pictures/user.jfif" alt="Profile picture" class="outside">
                  </section>

                  <span class="infoSec">
                        <h1>Chiagozie Okafor</h1>
                        <span>Backend Developer</span>
                  </span>

                  <span class="teamName">
                  Alpha
                  </span>

               </section> 

               <!-- <div class="removed"> 
                  <p>Disqualified</p> 
               </div> -->               
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
            
            <!-- <p class="info"> <span>No task available</span> </p>                 -->
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