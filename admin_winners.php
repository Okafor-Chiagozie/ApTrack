
<?php

session_start();
require("dbConnect.php");
include("functions.php");

$_SESSION["adminMenu"] = "winners";

?>


<?php

include("admin_header.php");

?>


<section class="mainSection inside" id="mainSection">
            
            <section class="firstSec">
                <section class="Heading">
                    <h1>Winners Page</h1>
                    <hr>
                </section>

                <nav>
                    <span onclick="navHandle(1)">Make Winner</span>
                    <span onclick="navHandle(2)">View Winners</span>
                    <hr id="navLine">
                </nav>

                <section class="container" id="con1">
                    <form action="admin_makeWinner_handler.php" method="post" class="myForm">

                        <label>Choose Winner Team:</label>

                        <select class="inside" id="leader_team" name="teamName" required>
                            <option></option>
                            <option value="Alpha">Alpha</option>
                            <option value="Beta">Beta</option>
                            <option value="Gama">Gama</option>
                            <option value="Sigma">Sigma</option>
                            <option value="Zeta">Zeta</option>
                            <option value="Omega">Omega</option>
                            <option value="Delta">Delta</option>
                        </select>

                        <input type="submit" value="Make Winner" name="chooseWinner">

                    </form>

                    <span onclick="showAlert()">Reset</span>
                    
                    
                </section>
                
                
                <section class="container" id="con2">


                    <?php
                    $sqlHeros = "SELECT * FROM winners ORDER BY Id DESC ";
                    $sqlInsertHeros = mysqli_query($db_connection, $sqlHeros);

                    if(mysqli_num_rows($sqlInsertHeros)){
                        while($heroDetails = mysqli_fetch_assoc($sqlInsertHeros)){
                    ?>

                    <section class="outside">
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

            </section>


            <p class="footer">All Rights Reserved @Beta Group 2022</p>

        </section>


        <div class="alertBox" id="alertBox" >
                
            <section>
                <span class="leaderInfo">
                    Are you sure you want to Reset everything?
                </span>

                <section>
                    <span class="first" onclick="reset(1)">
                        Yes
                    </span>

                    <span onclick="reset(2)">
                        No
                    </span>

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


        var alertBox = document.getElementById("alertBox")

        function showAlert(){
            alertBox.style.display = "flex"
        }

        async function reset(num){

            if(num == 1){
                alertBox.style.display = "none"
                var result = await fetch(`asynchro.php?action=reset`);

            }else{
                alertBox.style.display = "none"
            }
            

        }


        
    </script>

</body>
</html>