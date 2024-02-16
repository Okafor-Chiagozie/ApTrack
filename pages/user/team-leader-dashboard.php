
<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");

$_SESSION["userMenu"] = "leader_dash";

identity();

?>


<?php

include("header.php");

if($_SESSION["status"] !== "leader"){
    header("Location: dashboard.php");
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

                <?php
                  $sqlAll = "SELECT * FROM user_login ORDER BY Firstname";
                  $sqlInsertAll = mysqli_query($db_connection,$sqlAll);

                  $sqlTeamLeader = "SELECT * FROM user_login WHERE Tl = '1' ";
                  $sqlInsertTeamLeader = mysqli_query($db_connection,$sqlTeamLeader);
                ?>

                <!-- All users section -->
                <section class="container" id="con1">
                    <?php 
                     $num = 0;

                     while($allUsers = mysqli_fetch_assoc($sqlInsertAll)){ 
                    ?>
                    <section class="teamBox outside" <?php if($allUsers["Tl"] == "1"){ ?> title="<?= strtoupper($allUsers["Team_name"]) ?> Team Leader" <?php } ?> >
                        <section class="imgSec inside">
                            <img src="../../uploads/user-pictures/<?= $allUsers["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($allUsers["Firstname"])." ".ucfirst($allUsers["Lastname"]) ?></h1>
                            <span><?= $allUsers["Specialty"] ?></span>
                        </span>

                        <?php if($allUsers["Team_name"] != "user_login"){ ?>
                            <span class="noButton">
                                <span>Send Request</span>
                            </span>
                        <?php
                            }else{ 
                                $sqlCheck = "SELECT * FROM notify WHERE User_email = '{$allUsers['Email']}' AND Team_name = '{$userDetails['Team_name']}' ";
                                $sqlCheckInsert = mysqli_query($db_connection, $sqlCheck);

                                if(mysqli_num_rows($sqlCheckInsert)){
                        ?>
                                <span class="noButton">
                                    <span>Request Sent &#10003;</span>
                                </span>

                                <?php }else{ ?>

                                <span class="teamButton requestButton">
                                    <span onclick="teamMemberRequest(<?= $num ?>, '<?= $userDetails['Team_name'] ?>','<?= ucwords($userDetails['Firstname'].' '. $userDetails['Lastname']) ?>','<?= $allUsers['Email'] ?>')">Send Request</span>
                                </span>
                        <?php $num++; } }?>

                        <?php if($allUsers["Tl"] == "1"){ ?>
                        <p><i class="fa-solid fa-star"></i></p>
                        <?php } ?>

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

                <!-- Team Leader section -->
                <section class="container" id="con2">
                    <?php while($teamLeaders = mysqli_fetch_assoc($sqlInsertTeamLeader)){ ?>
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="../../uploads/user-pictures/<?= $teamLeaders["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($teamLeaders["Firstname"])." ".ucfirst($teamLeaders["Lastname"]) ?></h1>
                            <span><?= $teamLeaders["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($teamLeaders["Team_name"]) ?>
                        </span>

                        <p><i class="fa-solid fa-star"></i></p>
                    </section>
                    <?php } ?>

                </section>
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

            <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
        </section>
        
        <script src="../../assets/js/dashboard.js"></script>
        <script src="../../assets/libraries/jquery.js"></script>
    </div>
                
    <script>
        var navLine = document.getElementById("navLine")
        var con1 = document.getElementById("con1")
        var con2 = document.getElementById("con2")
        

        function navHandle(num){
            if (num == 1){
                navLine.style.left = "0%"
                con1.style.display = "flex"
                con2.style.display = "none"

            }else if(num == 2){
                navLine.style.left = "50%"
                con1.style.display = "none"
                con2.style.display = "flex"
            }
        }


        async function teamMemberRequest(num, leaderTeam, leaderName, userEmail){

            var result = await fetch(`../../scripts/async.php?action=teamMemberRequest&leaderTeam=${leaderTeam}&leaderName=${leaderName}&userEmail=${userEmail}`);

            var requestButton = document.getElementsByClassName("requestButton")
            requestButton[num].firstElementChild.onclick = ""
            requestButton[num].firstElementChild.textContent = "Request Sent ✓"
            requestButton[num].firstElementChild.style.backgroundColor = "silver"
            requestButton[num].firstElementChild.style.border = "1px solid silver"
            requestButton[num].firstElementChild.style.color = "grey"

        }
    </script>

</body>
</html>