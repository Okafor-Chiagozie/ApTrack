
<?php

session_start();
require("../../scripts/config.php");
include("../../scripts/functions.php");

$_SESSION["adminMenu"] = "teams";

// identity();

?>


<?php

include("header.php");

?>


<section class="mainSection inside" id="mainSection">
            
            <section class="firstSec">
                <section class="Heading">
                    <h1>All Teams</h1>
                    <hr>
                </section>

                <nav>
                    <span onclick="navHandle(1)">Alpha</span>
                    <span onclick="navHandle(2)">Beta</span>
                    <span onclick="navHandle(3)">Gama</span>
                    <span onclick="navHandle(4)">Sigma</span>
                    <span onclick="navHandle(5)">Zeta</span>
                    <span onclick="navHandle(6)">Omega</span>
                    <span onclick="navHandle(7)">Delta</span>
                    <hr id="navLine">
                </nav>

                <?php
                // Alpha
                $sqlAlphaLeader = "SELECT * FROM user_login WHERE Tl = '1' AND Team_name = 'Alpha' ";
                $sqlInsertAlphaLeader = mysqli_query($db_connection,$sqlAlphaLeader);
                $alphaLeader = mysqli_fetch_assoc($sqlInsertAlphaLeader);

                $sqlAlphaMembers = "SELECT * FROM user_login WHERE Tl = '0' AND Team_name = 'Alpha' ";
                $sqlInsertAlphaMembers = mysqli_query($db_connection,$sqlAlphaMembers);


                // Beta
                $sqlBetaLeader = "SELECT * FROM user_login WHERE Tl = '1' AND Team_name = 'Beta' ";
                $sqlInsertBetaLeader = mysqli_query($db_connection,$sqlBetaLeader);
                $betaLeader = mysqli_fetch_assoc($sqlInsertBetaLeader);

                $sqlBetaMembers = "SELECT * FROM user_login WHERE Tl = '0' AND Team_name = 'Beta' ";
                $sqlInsertBetaMembers = mysqli_query($db_connection,$sqlBetaMembers);

                
                // Gama
                $sqlGamaLeader = "SELECT * FROM user_login WHERE Tl = '1' AND Team_name = 'Gama' ";
                $sqlInsertGamaLeader = mysqli_query($db_connection,$sqlGamaLeader);
                $gamaLeader = mysqli_fetch_assoc($sqlInsertGamaLeader);

                $sqlGamaMembers = "SELECT * FROM user_login WHERE Tl = '0' AND Team_name = 'Gama' ";
                $sqlInsertGamaMembers = mysqli_query($db_connection,$sqlGamaMembers);


                // Sigma
                $sqlSigmaLeader = "SELECT * FROM user_login WHERE Tl = '1' AND Team_name = 'Sigma' ";
                $sqlInsertSigmaLeader = mysqli_query($db_connection,$sqlSigmaLeader);
                $sigmaLeader = mysqli_fetch_assoc($sqlInsertSigmaLeader);

                $sqlSigmaMembers = "SELECT * FROM user_login WHERE Tl = '0' AND Team_name = 'Sigma' ";
                $sqlInsertSigmaMembers = mysqli_query($db_connection,$sqlSigmaMembers);


                // Zeta
                $sqlZetaLeader = "SELECT * FROM user_login WHERE Tl = '1' AND Team_name = 'Zeta' ";
                $sqlInsertZetaLeader = mysqli_query($db_connection,$sqlZetaLeader);
                $zetaLeader = mysqli_fetch_assoc($sqlInsertZetaLeader);

                $sqlZetaMembers = "SELECT * FROM user_login WHERE Tl = '0' AND Team_name = 'Zeta' ";
                $sqlInsertZetaMembers = mysqli_query($db_connection,$sqlZetaMembers);


                // Omega
                $sqlOmegaLeader = "SELECT * FROM user_login WHERE Tl = '1' AND Team_name = 'Omega' ";
                $sqlInsertOmegaLeader = mysqli_query($db_connection,$sqlOmegaLeader);
                $omegaLeader = mysqli_fetch_assoc($sqlInsertOmegaLeader);

                $sqlOmegaMembers = "SELECT * FROM user_login WHERE Tl = '0' AND Team_name = 'Omega' ";
                $sqlInsertOmegaMembers = mysqli_query($db_connection,$sqlOmegaMembers);


                // Delta
                $sqlDeltaLeader = "SELECT * FROM user_login WHERE Tl = '1' AND Team_name = 'Delta' ";
                $sqlInsertDeltaLeader = mysqli_query($db_connection,$sqlDeltaLeader);
                $deltaLeader = mysqli_fetch_assoc($sqlInsertDeltaLeader);

                $sqlDeltaMembers = "SELECT * FROM user_login WHERE Tl = '0' AND Team_name = 'Delta' ";
                $sqlInsertDeltaMembers = mysqli_query($db_connection,$sqlDeltaMembers);

                ?>


                <?php
                $alpha = "SELECT * FROM teams WHERE Team_name = 'Alpha' ";
                $alphaInsert = mysqli_query($db_connection,$alpha);
                $alphaDownload = mysqli_fetch_assoc($alphaInsert);
                
                ?>
                <!-- Alpha -->
                <section class="container" id="alphaCon">
                    <?php if(mysqli_num_rows($sqlInsertAlphaLeader) == "0"){  ?>
                    <p class="info"> <span>No Team Leader</span> </p>
                    <?php }else{ ?>
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $alphaLeader["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($alphaLeader["Firstname"])." ".ucfirst($alphaLeader["Lastname"]) ?></h1>
                            <span><?= $alphaLeader["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($alphaLeader["Team_name"]) ?>
                        </span>

                        <p><i class="fa-solid fa-star"></i></p>

                    </section> 
                   

                    <!-- Alpha Info -->
                    <section class="teamBox outside">
                        <span class="totalMembers"> <?= (mysqli_num_rows($sqlInsertAlphaMembers) + 1) ?> Member(s) <i class="fa fa-users"></i></span>

                        <span class="disqualify" onclick="disqualify('Alpha')">Disqalify team</span>

                        <?php if($alphaDownload["Document"] == "Nothing"){ ?>
                        <a class="noButton" href="#">Download task</a>
                        <?php }else{ ?>
                        <a class="download" href="teamDocument/<?= $alphaDownload['Document'] ?>"  download="alpha">Download task</a>
                        <?php } ?>

                    </section>

                    <?php } ?>


                    <hr>

                    <?php if(mysqli_num_rows($sqlInsertAlphaMembers) == "0"){  ?>
                    <p class="info"> <span>No Team Members</span> </p>
                    <?php }else{ while($alphaMembers = mysqli_fetch_assoc($sqlInsertAlphaMembers)){ ?>
                    
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $alphaMembers["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($alphaMembers["Firstname"])." ".ucfirst($alphaMembers["Lastname"]) ?></h1>
                            <span><?= $alphaMembers["Specialty"] ?></span>
                        </span>

                    </section>
                    <?php }} ?>

                    <?php if($alphaDownload["Disqualify"] == "1"){ ?>
                    <div class="removed"> 
                        <p>Disqualified</p> 
                        <span onclick="pardon('Alpha')">Pardon</span>
                    </div>
                    <?php } ?>
                                                            
                </section>



                <?php
                $beta = "SELECT * FROM teams WHERE Team_name = 'Beta' ";
                $betaInsert = mysqli_query($db_connection,$beta);
                $betaDownload = mysqli_fetch_assoc($betaInsert);
                
                ?>
                <!-- Beta -->
                <section class="container" id="betaCon">
                    <?php if(mysqli_num_rows($sqlInsertBetaLeader) == "0"){  ?>
                    <p class="info"> <span>No Team Leader</span> </p>
                    <?php }else{ ?>
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $betaLeader["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($betaLeader["Firstname"])." ".ucfirst($betaLeader["Lastname"]) ?></h1>
                            <span><?= $betaLeader["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($betaLeader["Team_name"]) ?>
                        </span>

                        <p><i class="fa-solid fa-star"></i></p>

                    </section> 

                    <!-- Beta Info -->
                    <section class="teamBox outside">
                        <span class="totalMembers"> <?= (mysqli_num_rows($sqlInsertBetaMembers) + 1) ?> Member(s) <i class="fa fa-users"></i></span>

                        <span class="disqualify" onclick="disqualify('Beta')">Disqalify team</span>

                        <?php if($betaDownload["Document"] == "Nothing"){ ?>
                        <a class="noButton" href="#">Download task</a>
                        <?php }else{ ?>
                        <a class="download" href="teamDocument/<?= $betaDownload['Document'] ?>"  download="beta">Download task</a>
                        <?php } ?>

                    </section>


                    <?php } ?>

                    <hr>

                    <?php if(mysqli_num_rows($sqlInsertBetaMembers) == "0"){  ?>
                    <p class="info"> <span>No Team Members</span> </p>
                    <?php }else{ while($betaMembers = mysqli_fetch_assoc($sqlInsertBetaMembers)){ ?>
                    
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $betaMembers["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($betaMembers["Firstname"])." ".ucfirst($betaMembers["Lastname"]) ?></h1>
                            <span><?= $betaMembers["Specialty"] ?></span>
                        </span>

                    </section>
                    <?php }} ?>

                    <?php if($betaDownload["Disqualify"] == "1"){ ?>
                    <div class="removed"> 
                        <p>Disqualified</p> 
                        <span onclick="pardon('Beta')">Pardon</span>
                    </div>
                    <?php } ?>
                                        
                </section>


                <?php
                $gama = "SELECT * FROM teams WHERE Team_name = 'Gama' ";
                $gamaInsert = mysqli_query($db_connection,$gama);
                $gamaDownload = mysqli_fetch_assoc($gamaInsert);
                
                ?>
                <!-- Gama -->
                <section class="container" id="gamaCon">
                    <?php if(mysqli_num_rows($sqlInsertGamaLeader) == "0"){  ?>
                    <p class="info"> <span>No Team Leader</span> </p>
                    <?php }else{ ?>
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $gamaLeader["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($gamaLeader["Firstname"])." ".ucfirst($gamaLeader["Lastname"]) ?></h1>
                            <span><?= $gamaLeader["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($gamaLeader["Team_name"]) ?>
                        </span>

                        <p><i class="fa-solid fa-star"></i></p>

                    </section> 

                    <section class="teamBox outside">
                        <span class="totalMembers"> <?= (mysqli_num_rows($sqlInsertGamaMembers) + 1) ?> Member(s) <i class="fa fa-users"></i></span>

                        <span class="disqualify" onclick="disqualify('Gama')">Disqalify team</span>

                        <?php if($gamaDownload["Document"] == "Nothing"){ ?>
                        <a class="noButton" href="#">Download task</a>
                        <?php }else{ ?>
                        <a class="download" href="teamDocument/<?= $gamaDownload['Document'] ?>"  download="gama">Download task</a>
                        <?php } ?>

                    </section>                    

                    <?php } ?>

                    <hr>

                    <?php if(mysqli_num_rows($sqlInsertGamaMembers) == "0"){  ?>
                    <p class="info"> <span>No Team Members</span> </p>
                    <?php }else{ while($gamaMembers = mysqli_fetch_assoc($sqlInsertGamaMembers)){ ?>
                    
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $gamaMembers["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($gamaMembers["Firstname"])." ".ucfirst($gamaMembers["Lastname"]) ?></h1>
                            <span><?= $gamaMembers["Specialty"] ?></span>
                        </span>

                    </section>
                    <?php }} ?>

                    <?php if($gamaDownload["Disqualify"] == "1"){ ?>
                    <div class="removed"> 
                        <p>Disqualified</p> 
                        <span onclick="pardon('Gama')">Pardon</span>
                    </div>
                    <?php } ?>              
                </section>


                <?php
                $sigma = "SELECT * FROM teams WHERE Team_name = 'Sigma' ";
                $sigmaInsert = mysqli_query($db_connection,$sigma);
                $sigmaDownload = mysqli_fetch_assoc($sigmaInsert);
                
                ?>
                <!-- Sigma -->
                <section class="container" id="sigmaCon">
                    <?php if(mysqli_num_rows($sqlInsertSigmaLeader) == "0"){  ?>
                    <p class="info"> <span>No Team Leader</span> </p>
                    <?php }else{ ?>
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $sigmaLeader["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($sigmaLeader["Firstname"])." ".ucfirst($sigmaLeader["Lastname"]) ?></h1>
                            <span><?= $sigmaLeader["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($sigmaLeader["Team_name"]) ?>
                        </span>

                        <p><i class="fa-solid fa-star"></i></p>
                    </section> 

                    <section class="teamBox outside">
                        <span class="totalMembers"> <?= (mysqli_num_rows($sqlInsertSigmaMembers) + 1) ?> Member(s) <i class="fa fa-users"></i></span>

                        <span class="disqualify" onclick="disqualify('Sigma')">Disqalify team</span>

                        <?php if($sigmaDownload["Document"] == "Nothing"){ ?>
                        <a class="noButton" href="#">Download task</a>
                        <?php }else{ ?>
                        <a class="download" href="teamDocument/<?= $sigmaDownload['Document'] ?>"  download="sigma">Download task</a>
                        <?php } ?>
                    </section>

                    <?php } ?>

                    <hr>

                    <?php if(mysqli_num_rows($sqlInsertSigmaMembers) == "0"){  ?>
                    <p class="info"> <span>No Team Members</span> </p>
                    <?php }else{ while($sigmaMembers = mysqli_fetch_assoc($sqlInsertSigmaMembers)){ ?>
                    
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $sigmaMembers["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($sigmaMembers["Firstname"])." ".ucfirst($sigmaMembers["Lastname"]) ?></h1>
                            <span><?= $sigmaMembers["Specialty"] ?></span>
                        </span>
                    </section>
                    <?php }} ?>

                    <?php if($sigmaDownload["Disqualify"] == "1"){ ?>
                    <div class="removed"> 
                        <p>Disqualified</p> 
                        <span onclick="pardon('Sigma')">Pardon</span>
                    </div>
                    <?php } ?>          
                </section>


                <?php
                $zeta = "SELECT * FROM teams WHERE Team_name = 'Zeta' ";
                $zetaInsert = mysqli_query($db_connection,$zeta);
                $zetaDownload = mysqli_fetch_assoc($zetaInsert);
                
                ?>
                <!-- Zeta -->
                <section class="container" id="zetaCon">
                    <?php if(mysqli_num_rows($sqlInsertZetaLeader) == "0"){  ?>
                    <p class="info"> <span>No Team Leader</span> </p>
                    <?php }else{ ?>
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $zetaLeader["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($zetaLeader["Firstname"])." ".ucfirst($zetaLeader["Lastname"]) ?></h1>
                            <span><?= $zetaLeader["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($zetaLeader["Team_name"]) ?>
                        </span>

                        <p><i class="fa-solid fa-star"></i></p>

                    </section> 

                    <section class="teamBox outside">
                        <span class="totalMembers"> <?= (mysqli_num_rows($sqlInsertZetaMembers) + 1) ?> Member(s) <i class="fa fa-users"></i></span>

                        <span class="disqualify" onclick="disqualify('Zeta')">Disqalify team</span>

                        <?php if($zetaDownload["Document"] == "Nothing"){ ?>
                        <a class="noButton" href="#">Download task</a>
                        <?php }else{ ?>
                        <a class="download" href="teamDocument/<?= $zetaDownload['Document'] ?>"  download="zeta">Download task</a>
                        <?php } ?>

                    </section>

                    <?php } ?>

                    <hr>

                    <?php if(mysqli_num_rows($sqlInsertZetaMembers) == "0"){  ?>
                    <p class="info"> <span>No Team Members</span> </p>
                    <?php }else{ while($zetaMembers = mysqli_fetch_assoc($sqlInsertZetaMembers)){ ?>
                    
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $zetaMembers["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($zetaMembers["Firstname"])." ".ucfirst($zetaMembers["Lastname"]) ?></h1>
                            <span><?= $zetaMembers["Specialty"] ?></span>
                        </span>

                    </section>
                    <?php }} ?>

                    <?php if($zetaDownload["Disqualify"] == "1"){ ?>
                    <div class="removed"> 
                        <p>Disqualified</p> 
                        <span onclick="pardon('Zeta')">Pardon</span>
                    </div>
                    <?php } ?>            
                </section>


                <?php
                $omega = "SELECT * FROM teams WHERE Team_name = 'Omega' ";
                $omegaInsert = mysqli_query($db_connection,$omega);
                $omegaDownload = mysqli_fetch_assoc($omegaInsert);
                
                ?>
                <!-- Omega -->
                <section class="container" id="omegaCon">
                    <?php if(mysqli_num_rows($sqlInsertOmegaLeader) == "0"){  ?>
                    <p class="info"> <span>No Team Leader</span> </p>
                    <?php }else{ ?>
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $omegaLeader["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($omegaLeader["Firstname"])." ".ucfirst($omegaLeader["Lastname"]) ?></h1>
                            <span><?= $omegaLeader["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($omegaLeader["Team_name"]) ?>
                        </span>

                        <p><i class="fa-solid fa-star"></i></p>

                    </section> 

                    <section class="teamBox outside">
                        <span class="totalMembers"> <?= (mysqli_num_rows($sqlInsertOmegaMembers) + 1) ?> Member(s) <i class="fa fa-users"></i></span>

                        <span class="disqualify" onclick="disqualify('Omega')">Disqalify team</span>

                        <?php if($omegaDownload["Document"] == "Nothing"){ ?>
                        <a class="noButton" href="#">Download task</a>
                        <?php }else{ ?>
                        <a class="download" href="teamDocument/<?= $omegaDownload['Document'] ?>"  download="omega">Download task</a>
                        <?php } ?>
                    </section>

                    <?php } ?>

                    <hr>

                    <?php if(mysqli_num_rows($sqlInsertOmegaMembers) == "0"){  ?>
                    <p class="info"> <span>No Team Members</span> </p>
                    <?php }else{ while($omegaMembers = mysqli_fetch_assoc($sqlInsertOmegaMembers)){ ?>
                    
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $omegaMembers["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($omegaMembers["Firstname"])." ".ucfirst($omegaMembers["Lastname"]) ?></h1>
                            <span><?= $omegaMembers["Specialty"] ?></span>
                        </span>

                    </section>
                    <?php }} ?>

                    <?php if($omegaDownload["Disqualify"] == "1"){ ?>
                    <div class="removed"> 
                        <p>Disqualified</p> 
                        <span onclick="pardon('Omega')">Pardon</span>
                    </div>
                    <?php } ?>                   
                </section>


                <?php
                $delta = "SELECT * FROM teams WHERE Team_name = 'Delta' ";
                $deltaInsert = mysqli_query($db_connection,$delta);
                $deltaDownload = mysqli_fetch_assoc($deltaInsert);
                
                ?>
                <!-- Delta -->
                <section class="container" id="deltaCon">
                    <?php if(mysqli_num_rows($sqlInsertDeltaLeader) == "0"){  ?>
                    <p class="info"> <span>No Team Leader</span> </p>
                    <?php }else{ ?>
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $deltaLeader["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($deltaLeader["Firstname"])." ".ucfirst($deltaLeader["Lastname"]) ?></h1>
                            <span><?= $deltaLeader["Specialty"] ?></span>
                        </span>

                        <span class="teamName">
                        <?= strtoupper($deltaLeader["Team_name"]) ?>
                        </span>

                        <p><i class="fa-solid fa-star"></i></p>
                    </section> 

                    <section class="teamBox outside">
                        <span class="totalMembers"> <?= (mysqli_num_rows($sqlInsertDeltaMembers) + 1) ?> Member(s) <i class="fa fa-users"></i></span>

                        <span class="disqualify" onclick="disqualify('Delta')">Disqalify team</span>

                        <?php if($deltaDownload["Document"] == "Nothing"){ ?>
                        <a class="noButton" href="#">Download task</a>
                        <?php }else{ ?>
                        <a class="download" href="teamDocument/<?= $deltaDownload['Document'] ?>"  download="delta">Download task</a>
                        <?php } ?>
                    </section>

                    <?php } ?>

                    <hr>

                    <?php if(mysqli_num_rows($sqlInsertDeltaMembers) == "0"){  ?>
                    <p class="info"> <span>No Team Members</span> </p>
                    <?php }else{ while($deltaMembers = mysqli_fetch_assoc($sqlInsertDeltaMembers)){ ?>
                    
                    <section class="teamBox outside">
                        <section class="imgSec inside">
                            <img src="user_pictures/<?= $deltaMembers["Picture"] ?>" alt="Profile picture" class="outside">
                        </section>

                        <span class="infoSec">
                            <h1><?= ucfirst($deltaMembers["Firstname"])." ".ucfirst($deltaMembers["Lastname"]) ?></h1>
                            <span><?= $deltaMembers["Specialty"] ?></span>
                        </span>
                    </section>
                    <?php }} ?>

                    <?php if($deltaDownload["Disqualify"] == "1"){ ?>
                    <div class="removed"> 
                        <p>Disqualified</p> 
                        <span onclick="pardon('Delta')">Pardon</span>
                    </div>
                    <?php } ?>             
                </section>
            </section>

            <p class="footer">All Rights Reserved @ApTrack <?= date("Y") ?></p>
        </section>
        
        <script src="../../assets/js/dashboard.js"></script>
        <script src="../../assets/libraries/jquery.js"></script>
    </div>


    <script>
        var navLine = document.getElementById("navLine")
        var alphaCon =  document.getElementById("alphaCon")
        var betaCon =  document.getElementById("betaCon")
        var gamaCon =  document.getElementById("gamaCon")
        var sigmaCon =  document.getElementById("sigmaCon")
        var zetaCon =  document.getElementById("zetaCon")
        var omegaCon =  document.getElementById("omegaCon")
        var deltaCon =  document.getElementById("deltaCon")

        function navHandle(num){
            if (num == 1){
                navLine.style.left = "0%"
                alphaCon.style.display = "flex"
                betaCon.style.display = "none"
                gamaCon.style.display = "none"
                sigmaCon.style.display = "none"
                zetaCon.style.display = "none"
                omegaCon.style.display = "none"
                deltaCon.style.display = "none"                

            }else if(num == 2){
                navLine.style.left = "14.29%"
                alphaCon.style.display = "none"
                betaCon.style.display = "flex"
                gamaCon.style.display = "none"
                sigmaCon.style.display = "none"
                zetaCon.style.display = "none"
                omegaCon.style.display = "none"
                deltaCon.style.display = "none"
                
            }else if(num == 3){
                navLine.style.left = "28.56%"
                alphaCon.style.display = "none"
                betaCon.style.display = "none"
                gamaCon.style.display = "flex"
                sigmaCon.style.display = "none"
                zetaCon.style.display = "none"
                omegaCon.style.display = "none"
                deltaCon.style.display = "none"
                
            }else if(num == 4){
                navLine.style.left = "42.84%"
                alphaCon.style.display = "none"
                betaCon.style.display = "none"
                gamaCon.style.display = "none"
                sigmaCon.style.display = "flex"
                zetaCon.style.display = "none"
                omegaCon.style.display = "none"
                deltaCon.style.display = "none"
                
            }else if(num == 5){
                navLine.style.left = "57.12%"
                alphaCon.style.display = "none"
                betaCon.style.display = "none"
                gamaCon.style.display = "none"
                sigmaCon.style.display = "none"
                zetaCon.style.display = "flex"
                omegaCon.style.display = "none"
                deltaCon.style.display = "none"
                
            }else if(num == 6){
                navLine.style.left = "71.4%"
                alphaCon.style.display = "none"
                betaCon.style.display = "none"
                gamaCon.style.display = "none"
                sigmaCon.style.display = "none"
                zetaCon.style.display = "none"
                omegaCon.style.display = "flex"
                deltaCon.style.display = "none"
                
            }else if(num == 7){
                navLine.style.left = "85.68%"
                alphaCon.style.display = "none"
                betaCon.style.display = "none"
                gamaCon.style.display = "none"
                sigmaCon.style.display = "none"
                zetaCon.style.display = "none"
                omegaCon.style.display = "none"
                deltaCon.style.display = "flex"
                
            }
        }

        async function disqualify(name){
            var result = await fetch(`../../scripts/async.php?action=disqualifyTeam&teamName=${name}`);
            
            window.location.href = 'admin_teams.php';
        }


        async function pardon(name){
            var result = await fetch(`../../scripts/async.php?action=pardonTeam&teamName=${name}`);
            
            window.location.href = 'teams-page.php';
        }
    </script>

</body>
</html>