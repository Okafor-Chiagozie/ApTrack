<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");

$_SESSION["userMenu"] = "profile";

identity();

?>


<?php

include("header.php");

?>


        <section class="mainSection inside" id="mainSection">
            
            <section class="firstSec">
                <section class="Heading">
                    <h1>My Profile</h1>
                    <hr>
                </section>
                

                <section class="container">
                    <section class="imgSec inside">
                        <img src="../../uploads/user-pictures/<?= $userDetails["Picture"] ?>" alt="Profile Image" class="outside">
                    </section>

                    <span>
                        <span class="one">Name:</span>
                        <span class="two"><?= $userDetails["Firstname"]." ".$userDetails["Lastname"] ?></span>
                    </span>

                    <span>
                        <span class="one">Email:</span>
                        <span class="two"> <?= $userDetails["Email"] ?> </span>
                    </span>
                    
                    <span>
                        <span class="one">Specialty:</span>
                        <span class="two"> <?= $userDetails["Specialty"] ?> </span>
                    </span>

                    <span>
                        <span class="one">Team:</span>
                        <span class="two">
                            <?php 
                            if($userDetails["Team_name"] == "user_login"){echo "No Team";
                            }else{ echo strtoupper($userDetails["Team_name"]); }
                            ?>
                        </span>
                    </span>

                    <span>
                        <span class="one">Reg Date:</span>
                        <span class="two"> <?= date("D, jS M, Y.", $userDetails["Regdate"]) ?> </span>
                    </span>

                    <a class="edit" href="profile-edit.php"><i class="fas fa-edit"></i> Edit</a>
                    
                </section>


            </section>



            <p class="footer">All Rights Reserved @Beta Group 2022</p>

        </section>

        
        <script src="../../assets/js/dashboard.js"></script>
        <script src="../../assets/libraries/jquery.js"></script>
    </div>


</body>
</html>
