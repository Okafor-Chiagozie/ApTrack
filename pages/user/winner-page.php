<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");

$_SESSION["userMenu"] = "winner";

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
                $sqlHeros = "SELECT * FROM winners ORDER BY Id DESC ";
                $sqlInsertHeros = mysqli_query($db_connection, $sqlHeros);

                if(mysqli_num_rows($sqlInsertHeros)){
                    while($heroDetails = mysqli_fetch_assoc($sqlInsertHeros)){
                ?>

                <section class="container outside">
                    <h1>Winners of the <?= $heroDetails["The_year"] ?> <?= month($heroDetails["Start_month"]) ?> to <?= month($heroDetails["End_month"]) ?> Project</h1>

                    <span><b>Team Name:</b> <?= $heroDetails["Team_name"] ?></span>
                    <span><b>Team Leader:</b> <?= $heroDetails["Team_leader"] ?></span>

                    <span><b>Team Members:</b> <?= substr_replace(str_replace("&", ",", $heroDetails["Names"]), "", -1) ?></span>


                    <p class="left"><i class="fa-solid fa-star"></i></p>
                    <p class="right"><i class="fa-solid fa-star"></i></p>
                    
                </section>

                <?php }}else{ ?>
                    <p class="info"> <span>No Winner(s) available</span> </p>
                <?php } ?>
            </section>

            <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
        </section>

        <script src="../../assets/js/dashboard.js"></script>
        <script src="../../assets/libraries/jquery.js"></script>
    </div>

</body>
</html>