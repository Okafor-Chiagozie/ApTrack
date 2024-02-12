<?php

session_start();
require("dbConnect.php");
include("functions.php");

$_SESSION["adminMenu"] = "create_task";

?>


<?php

include("admin_header.php");

?>


      <section class="mainSection inside" id="mainSection">

         <section class="firstSec">
            <section class="Heading">
               <h1>Create Task</h1>
               <hr>
            </section>

            <nav>
               <span onclick="navHandle(1)">Create task</span>
               <span onclick="navHandle(2)">View task</span>
               <hr id="navLine">
            </nav>

            <section class="container" id="con1">
               <form action="admin_createTask_handler.php" method="post" class="myForm">

                  <section class="description">
                     <label for="description">Description</label>
                     <textarea name="description" cols="30" rows="10" class="inside" required></textarea>
                  </section>

                  <section>
                     <label for="start_date">Start Date</label>
                     <input type="date" name="start_date" required class="inside">
                  </section>

                  <section>
                     <label for="end_date">End Date</label>
                     <input type="date" name="end_date" required class="inside">
                  </section>

                  <input type="submit" name="create" value="&#8593; Create">

               </form>

            </section>

            <section class="container con2" id="con2">
               <?php
               $sqlTask = "SELECT * FROM task ORDER BY Id DESC";
               $sqlTaskInsert = mysqli_query($db_connection, $sqlTask);

               if (mysqli_num_rows($sqlTaskInsert)) {
                  $num = 0;
                  while ($taskDetails = mysqli_fetch_assoc($sqlTaskInsert)) {
               ?>
                  <section class="taskCon outside taskBox">
                     <h1>Project description</h1>

                     <p> <?= $taskDetails["Description"] ?></p>

                     <section>
                        <span>Start Date: <?= $taskDetails["Startdate"] ?> </span>
                        <span>End Date: <?= $taskDetails["Enddate"] ?> </span>
                        <span>Duration: <?= duration($taskDetails["Startdate"], $taskDetails["Enddate"]) ?></span>

                        <button onclick="deleteTask(<?= $num ?>, <?= $taskDetails['Id'] ?>)">Delete</button>
                     </section>
                  </section>
               <?php 
                  $num++; }
                  } else { 
               ?>
                  <p class="info"> <span>No task available</span> </p>
               <?php } ?>
            </section>

         </section>

         <p class="footer">All Rights Reserved @Beta Group 2022</p>

      </section>




      <script src="general.js"></script>
      <script src="fmworks/jquery.js"></script>

      </div>


      <script>
         var navLine = document.getElementById("navLine")
         var con1 = document.getElementById("con1")
         var con2 = document.getElementById("con2")


         function navHandle(num) {
            if (num == 1) {
               navLine.style.left = "0%"
               con1.style.display = "flex"
               con2.style.display = "none"

            } else if (num == 2) {
               navLine.style.left = "50%"
               con1.style.display = "none"
               con2.style.display = "flex"
            }
         }

         async function deleteTask(number, Id) {
            var taskBox = document.getElementsByClassName("taskBox")
            taskBox[number].style.display = "none"

            var result = await fetch(`asynchro.php?action=deleteTask&id=${Id}`);

         }
      </script>

   </body>

</html>