
<?php

session_start();
require("dbConnect.php");
include("functions.php");

$_SESSION["adminMenu"] = "dashboard";

// identity();

?>


<?php

include("admin_header.php");

?>


<section class="mainSection inside" id="mainSection">
            
            <section class="firstSec">
                <section class="Heading">
                    <h1>My Users</h1>
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

                <section class="container" id="con1">
                    <?php while($allUsers = mysqli_fetch_assoc($sqlInsertAll)){ ?>
                    <section class="teamBox outside" <?php if($allUsers["Tl"] == "1"){ ?> title="<?= strtoupper($allUsers["Team_name"]) ?> Team Leader" <?php } ?> >
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $allUsers["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($allUsers["Firstname"])." ".ucfirst($allUsers["Lastname"]) ?></h1>
                            <span><?= $allUsers["Specialty"] ?></span>
                        </span>

                        <span class=" <?php if($allUsers["Tl"] == "1"){ ?> noButton <?php }else{ ?> teamButton <?php } ?> ">
                            <span <?php if($allUsers["Tl"] == "0"){ ?> onclick="dialog('<?= ucwords($allUsers['Firstname'].' '. $allUsers['Lastname']) ?>','<?= $allUsers['Email'] ?>')" <?php } ?> >Make Leader</span>
                        </span>

                        <?php if($allUsers["Tl"] == "1"){ ?>
                        <p><i class="fa-solid fa-star"></i></p>
                        <?php } ?>

                    </section>
                    <?php } ?>
                    
                </section>

                

                <section class="container" id="con2">

                    <?php while($teamLeaders = mysqli_fetch_assoc($sqlInsertTeamLeader)){ ?>
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $teamLeaders["Picture"] ?>" alt="Profile picture" class="outside">
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



            <p class="footer">All Rights Reserved @Beta Group 2022</p>

        </section>

        <div class="alertBox" id="alertBox" >
            <section>
                <span class="exit" onclick="exit()">
                    <i class="fa fa-times"></i>
                </span>

                <section>
                    <span class="leaderInfo">
                        <span id="leader_name"></span>
                        <span id="leader_email"></span>
                    </span>
                    
                    <span class="choose">
                        <span>Choose team:</span>
                        <select class="inside" id="leader_team">
                            <option value="Alpha">Alpha</option>
                            <option value="Beta">Beta</option>
                            <option value="Gama">Gama</option>
                            <option value="Sigma">Sigma</option>
                            <option value="Zeta">Zeta</option>
                            <option value="Omega">Omega</option>
                            <option value="Delta">Delta</option>
                        </select>
                    </span>
                    
                    <span class="button" onclick="makeLeader()">OK</span>
                </section>
                

                
            </section>
            
        </div>

        
        <script src="general.js"></script>
        <script src="fmworks/jquery.js"></script>
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


        // Alert function
        var leader_name = document.getElementById("leader_name")
        var leader_email = document.getElementById("leader_email")
        var leader_team = document.getElementById("leader_team")
        var alertBox = document.getElementById("alertBox")

        function dialog(name, email){
            leader_name.textContent = name
            leader_email.textContent = email
            alertBox.style.display = "flex"
        }

        function exit(){
            alertBox.style.display = "none"
        }


        // Make leader function
        async function makeLeader(email){

            var main_email = leader_email.textContent
            var main_teamName = leader_team.value

            var result = await fetch(`asynchro.php?action=makeLeader&email=${main_email}&teamName=${main_teamName}`);
            

            window.location.href = 'admin_dashboard.php';
        }
    </script>

</body>
</html>