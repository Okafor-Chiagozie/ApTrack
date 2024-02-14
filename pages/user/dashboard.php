
<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");

$_SESSION["userMenu"] = "dashboard";

identity();

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

                <!-- Starting the conditional Staement -->
                <?php if($userDetails["Team_name"] == "user_login"){ ?>
                    <p class="info"> <span>Not in any Team</span> </p>
                <?php }else{ 
                    
                    $sqlTeamLeader = "SELECT * FROM user_login WHERE Team_name = '{$userDetails['Team_name']}' AND Tl = '1' ";
                    $sqlTeamLeaderInsert = mysqli_query($db_connection, $sqlTeamLeader);
                    $teamLeader = mysqli_fetch_assoc($sqlTeamLeaderInsert);

                    $sqlTeam = "SELECT * FROM user_login WHERE Team_name = '{$userDetails['Team_name']}' AND Tl = '0' ";
                    $sqlTeamInsert = mysqli_query($db_connection, $sqlTeam);
                ?>

                <section class="container">

                    <section class="teamBox outside" title="Team Leader">
                        <section class="imgSec inside">
                            <img src="../../uploads/user-pictures/<?= $teamLeader["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($teamLeader["Firstname"])." ".ucfirst($teamLeader["Lastname"]) ?></h1>
                            <span><?= $teamLeader["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($teamLeader["Team_name"]) ?>
                        </span>

                        <p><i class="fa-solid fa-star"></i></p>

                    </section>

                    <section class="teamIcon outside">
                       <span> <?= (mysqli_num_rows($sqlTeamInsert) + 1) ?> &nbsp;&nbsp;Members&nbsp;&nbsp; <i class="fa fa-users"></i> </span>
                    </section>

                    <hr>
                        

                    <?php
                    while( $teamDetails = mysqli_fetch_assoc($sqlTeamInsert) ){
                    ?>
                    
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="../../uploads/user-pictures/<?= $teamDetails["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($teamDetails["Firstname"])." ".ucfirst($teamDetails["Lastname"]) ?></h1>
                            <span><?= $teamDetails["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($teamDetails["Team_name"]) ?>
                        </span>

                    </section> 

                    <?php } ?>
                    
                    
                    


                    <?php
                    $sqlDisqualify = "SELECT * FROM teams WHERE Team_name = '{$userDetails['Team_name']}' ";
                    $sqlInsertDisqualify = mysqli_query($db_connection, $sqlDisqualify);
                    $disqualify = mysqli_fetch_assoc($sqlInsertDisqualify);

                    if($disqualify["Disqualify"] == "1"){
                    ?>

                    <div class="removed"> 
                        <p>Disqualified</p> 
                    </div>

                    <?php } ?>                    

                </section> 
                
                <?php } ?>
                <!-- Ending the conditional statement -->
                         
            </section>




            <section class="secondSec">
                <section class="Heading">
                    <h1>Latest Task</h1>
                    <hr>
                </section>
                
                <?php
                    $sqlTask = "SELECT * FROM task ORDER BY Id DESC LIMIT 1";
                    $sqlTaskInsert = mysqli_query($db_connection, $sqlTask);

                    if(mysqli_num_rows($sqlTaskInsert)){
                        $taskDetails = mysqli_fetch_assoc($sqlTaskInsert);
                ?>

                <section class="container outside">
                    <h1>Project description</h1>

                    <p> <?= $taskDetails["Description"] ?></p>

                    <section>
                        <span>Start Date: <?= $taskDetails["Startdate"] ?> </span>
                        <span>End Date: <?= $taskDetails["Enddate"] ?> </span>
                        <span>Duration: <?= duration($taskDetails["Startdate"], $taskDetails["Enddate"]) ?></span>
                    </section>

                </section>
                <?php }else{ ?>
                <p class="info"> <span>No task available</span> </p>
                <?php } ?>
                
            </section>


            <!-- <section class="secondSec">
                <section class="Heading">
                    <h1>Current Task</h1>
                    <hr>
                </section>


                <section class="teamSec">
                    
                </section>

            </section> -->


            <p class="footer">All Rights Reserved @Beta Group 2022</p>

        </section>

        
        <script src="../../assets/js/dashboard.js"></script>
        <script src="../../assets/libraries/jquery.js"></script>
    </div>


</body>
</html>