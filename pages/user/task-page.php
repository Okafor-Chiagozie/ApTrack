<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "task";

include("header.php");
?>

   <section class="mainSection inside" id="mainSection">
      <section class="firstSec">
            <section class="Heading">
               <h1>Tasks</h1>
               <hr>
            </section>

            <?php 
            $tasks = getAllTask();
            if($tasks):
               foreach ($tasks as $task):
            ?>
            <section class="container outside">
               <h1>Project description</h1>

               <p>
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae, deserunt rerum 
                  architecto quasi ut aut tenetur itaque praesentium voluptatibus labore ipsum cum 
                  reiciendis vero. Molestias tenetur aperiam earum quos repellendus.
               </p>

               <section>
                  <span>Start Date: </span>
                  <span>End Date: </span>
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

</body>
</html>