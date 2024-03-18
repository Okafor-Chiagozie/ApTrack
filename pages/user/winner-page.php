<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");
include("../../scripts/database-functions.php");

$_SESSION["userMenu"] = "winner";

include("header.php");
?>

   <section class="mainSection inside" id="mainSection">
      
      <section class="firstSec">
            <section class="Heading">
               <h1>Winner's Compilation</h1>
               <hr>
            </section>

            <section class="container outside">
               <h1>Winners of the 2023 January to June Project</h1>

               <span><b>Team Name:</b> </span>
               <span><b>Team Leader:</b> </span>

               <span><b>Team Members:</b> </span>


               <p class="left"><i class="fa-solid fa-star"></i></p>
               <p class="right"><i class="fa-solid fa-star"></i></p>
            </section>

            <!-- <p class="info"> <span>No Winner(s) available</span> </p> -->
      </section>

      <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
   </section>


   <script src="../../assets/js/dashboard.js"></script>
   <script src="../../assets/libraries/jquery.js"></script>
</div>

</body>
</html>