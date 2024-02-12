
<?php

session_start();
require("dbConnect.php");
include("functions.php");

$_SESSION["userMenu"] = "leader";

identity();


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $documentName = "";

    if(isset($_POST["upload"])){

        if($_FILES["teamDocument"]["size"] == 0){
            $_SESSION["documentUploadFalse"] = "Yes";
        }else{
            $teamDocumentFile = $_FILES["teamDocument"];
            $allowedTypes = ["application/x-zip-compressed", "application/octet-stream"];

            // Check for file type
            if(!in_array($teamDocumentFile["type"], $allowedTypes)) {
                $_SESSION["fileSupport"] = "Yes";
            }  
            else {
                $documentName = explode(".", $teamDocumentFile["name"])[0];
                $ext = explode(".", $teamDocumentFile["name"])[1];

                $documentName .= time();
                $documentName .= "." . $ext;

                $fileDestination = "./teamDocument/";
                $tmpFile = $teamDocumentFile['tmp_name'];

                
                $sqlDocument = "SELECT Document FROM teams WHERE Team_name = '{$userDetails['Team_name']}' ";
                $sqlInsertDocument = mysqli_query($db_connection, $sqlDocument);
                $documentCheck = mysqli_fetch_assoc($sqlInsertDocument);


                // The function to upload the file to the destination
                if($documentCheck["Document"] != " "){

                    if(file_exists($fileDestination.$documentCheck["Document"]) ){

                        unlink($fileDestination.$documentCheck["Document"]);
                        move_uploaded_file($tmpFile, $fileDestination.$documentName);                        
                    }else{
                        move_uploaded_file($tmpFile, $fileDestination.$documentName);
                    }

                    
                }
                
            }
        }

    }



    if(!empty($documentName)){

        $sql = "UPDATE teams set Document = '$documentName' WHERE Team_name = '{$userDetails['Team_name']}'";

        $sqlInsert = mysqli_query($db_connection, $sql);

        if($sqlInsert){
            $_SESSION["documentUpload"] = "Yes";
        }

    }



}

?>


<?php

include("user_header.php");

if($_SESSION["status"] !== "leader"){
    header("Location: user_dashboard.php");
}

?>



        <section class="mainSection inside" id="mainSection">
            
            <section class="firstSec">
                <section class="Heading">
                    <h1>Team Members</h1>
                    <hr>
                </section>

                <?php

                $sqlAlphaLeader = "SELECT * FROM user_login WHERE Tl = '1' AND Team_name = '{$userDetails['Team_name']}' ";
                $sqlInsertAlphaLeader = mysqli_query($db_connection,$sqlAlphaLeader);
                $alphaLeader = mysqli_fetch_assoc($sqlInsertAlphaLeader);

                $sqlAlphaMembers = "SELECT * FROM user_login WHERE Tl = '0' AND Team_name = '{$userDetails['Team_name']}' ";
                $sqlInsertAlphaMembers = mysqli_query($db_connection,$sqlAlphaMembers);

                ?>

                <!-- Team Members section -->
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
                   

                    <!-- Team Info -->
                    <section class="teamBox outside">
                        <span class="totalMembers"> <?= (mysqli_num_rows($sqlInsertAlphaMembers) + 1) ?> Member(s) <i class="fa fa-users"></i></span>
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
                                                            
                </section>

                                         
            </section>



            <!-- Second Partttttttttttt -->

            <section class="secondSec">
                <section class="Heading">
                    <h1>Project Submission</h1>
                    <hr>
                </section>
                
                <section class="container">
                    
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="myForm">

                        <section class="projectUpload">
                            <label for="teamDocument">Project Upload</label>
                            <input type="file" id="file" name="teamDocument" size="10" class="inside">
                        </section>

                        <input type="submit" name="upload" value="&#8593; Upload">

                    </form>


                </section>
                
            </section>


            <p class="footer">All Rights Reserved @Beta Group 2022</p>

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
        

        
        <script src="general.js"></script>
        <script src="fmworks/jquery.js"></script>
        <script src="fmworks/toastr.min.js"></script>

        <?php
            if(isset($_SESSION["fileSupport"]) && ($_SESSION["fileSupport"] == "Yes")){
                echo "<script> toastr.error('Unsupported file format.', 'File Error', {timeOut: 5000}) </script>";
                $_SESSION["fileSupport"] = "No";
            }

            if(isset($_SESSION["documentUpload"]) && ($_SESSION["documentUpload"] == "Yes")){
                echo "<script> toastr.success('Team project upload was successful.', 'Upload Successful', {timeOut: 5000}) </script>";
                $_SESSION["documentUpload"] = "No";
            }
        ?>
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

            var requestButton = document.getElementsByClassName("requestButton")
            requestButton[num].firstElementChild.onclick = ""
            requestButton[num].firstElementChild.textContent = "Request Sent ✓"
            requestButton[num].firstElementChild.style.backgroundColor = "silver"
            requestButton[num].firstElementChild.style.border = "1px solid silver"
            requestButton[num].firstElementChild.style.color = "grey"

            var result = await fetch(`asynchro.php?action=teamMemberRequest&leaderTeam=${leaderTeam}&leaderName=${leaderName}&userEmail=${userEmail}`);
           

        }
    </script>

</body>
</html>