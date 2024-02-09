<?php

session_start();
require("dbConnect.php");
include("functions.php");

$_SESSION["userMenu"] = "profile";

identity();

?>


<?php

include("user_header.php");

?>


        <section class="mainSection inside" id="mainSection">
            
            <section class="firstSec">
                <section class="Heading">
                    <h1>My Profile</h1>
                    <hr>
                </section>
                

                <section class="container">
                    <section class="imgSec inside">
                        <img src="user_pictures/<?= $userDetails["Picture"] ?>" alt="Profile Image" class="outside">
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

                    <a class="edit" href="user_profile_edit.php"><i class="fas fa-edit"></i> Edit</a>
                    
                </section>


            </section>



            <p class="footer">All Rights Reserved @Beta Group 2022</p>

        </section>

        
        <script src="general.js"></script>
        <script src="fmworks/jquery.js"></script>
    </div>


</body>
</html>
