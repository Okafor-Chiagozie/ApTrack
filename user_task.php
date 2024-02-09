<?php

session_start();
require("dbConnect.php");
include("functions.php");

$_SESSION["userMenu"] = "task";

identity();

?>


<?php

include("user_header.php");

?>




        <section class="mainSection inside" id="mainSection">
            
            <section class="firstSec">
                <section class="Heading">
                    <h1>Tasks</h1>
                    <hr>
                </section>

                <?php
                    $sqlTask = "SELECT * FROM task ORDER BY Id DESC";
                    $sqlTaskInsert = mysqli_query($db_connection, $sqlTask);

                    if(mysqli_num_rows($sqlTaskInsert)){
                        while($taskDetails = mysqli_fetch_assoc($sqlTaskInsert)){                     
                ?>

                <section class="container outside">
                    <h1>Project description</h1>

                    <p> <?= $taskDetails["Description"] ?></p>

                    <section>
                        <span>Start Date: <?= $taskDetails["Startdate"] ?> </span>
                        <span>End Date: <?= $taskDetails["Enddate"] ?> </span>
                        <span>Duration: <?= duration($taskDetails["Startdate"], $taskDetails["Enddate"]) ?> </span>
                    </section>

                </section>
                <?php }}else{ ?>
                <p class="info"> <span>No task available</span> </p>
                <?php } ?>


            </section>



            <p class="footer">All Rights Reserved @Beta Group 2022</p>

        </section>

        
        <script src="general.js"></script>
        <script src="fmworks/jquery.js"></script>
    </div>


</body>
</html>