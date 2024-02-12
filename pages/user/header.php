<?php

if((!isset($_SESSION["userEmail"]) || !isset($_SESSION["status"])) && ($_SESSION["status"] != "user" || $_SESSION["status"] != "leader")){
    header("Location: sign_in.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="fmworks/toastr.css">
    
    <?php

    if($_SESSION["userMenu"] == "dashboard"){
        echo " <link rel='stylesheet' href='user_dashboard.css'> ";
    }else if($_SESSION["userMenu"] == "profile"){
        echo " <link rel='stylesheet' href='user_profile.css'> ";
    }else if($_SESSION["userMenu"] == "profile_edit"){
        echo " <link rel='stylesheet' href='user_profile_edit.css'> ";
    }else if($_SESSION["userMenu"] == "task"){
        echo " <link rel='stylesheet' href='user_task.css'> ";
    }else if($_SESSION["userMenu"] == "notifications"){
        echo " <link rel='stylesheet' href='user_notifications.css'> ";
    }else if($_SESSION["userMenu"] == "winner"){
        echo " <link rel='stylesheet' href='user_winnerPage.css'> ";
    }else if($_SESSION["userMenu"] == "leader"){
        echo " <link rel='stylesheet' href='teamLeader_page.css'> ";
    }else if($_SESSION["userMenu"] == "leader_dash"){
        echo " <link rel='stylesheet' href='teamLeader_dashboard.css'> ";
    }
    
    ?>

</head>

<body>
    
    <div class="mainDiv">

    <?php 
        $sqlNotifyCheck = "SELECT * FROM notify WHERE User_email = '{$userDetails['Email']}' ";
        $sqlNotifyCheckInsert = mysqli_query($db_connection, $sqlNotifyCheck);
    ?>

        <header class="mainHeader" id="mainHeader">

            <section class="logoSec">
                <section>
                    <section>
                        <img src="photos/dark.png" alt="Logo image">
                    </section>

                    <span>Aptech</span>
                </section>

                <span class="outside" id="hamburgerIcon" onclick="menu()">
                    <i class="fa-solid fa-bars"></i>
                </span>
            </section>


            <section class="navSec">
                <section class="searchSec">
                    <h1>Welcome <?= " ".ucfirst($userDetails["Firstname"])." ".ucfirst($userDetails["Lastname"]); ?></h1>
                    <!-- <input type="search" name="" id="" placeholder="Search" class="inside">
                    <button><i class="fa fa-search"></i></button> -->
                </section>

                <section class="iconSec">
                    <a href="user_task.php" class="icon outside" title="Tasks"><i class="fas fa-tasks"></i></a>

                    <a href="user_notifications.php" class="icon outside" title="Notifications"><i class="fas fa-bell"></i> <?php if(mysqli_num_rows($sqlNotifyCheckInsert)){?> <span>.</span> <?php } ?> </a>

                    <a href="user_profile.php" class="profilePic outside">
                        <img src="user_pictures/<?= $userDetails["Picture"] ?>" alt="Profile picture">
                    </a>

                </section>

            </section>

        </header>

        <section class="leftSection" id="leftSection">

            <section class="menuSec">

                

                <?php if($_SESSION["userMenu"] == "dashboard" || $_SESSION["userMenu"] == "leader_dash"){ ?>
                    <span class="inside"> <a href="<?php if($userDetails["Tl"] == "0"){echo 'user_dashboard.php';}else{echo 'teamLeader_dashboard.php';} ?> " ><i class="fa fa-cubes"></i> Dashboard</a></span> 
                <?php }else{ ?>
                    <span> <a href="<?php if($userDetails["Tl"] == "0"){echo 'user_dashboard.php';}else{echo 'teamLeader_dashboard.php';} ?>" ><i class="fa fa-cubes"></i> Dashboard</a></span> 
                <?php } ?>

                <?php
                
                if($_SESSION["userMenu"] == "profile" || $_SESSION["userMenu"] == "profile_edit"){
                    echo ' <span class="inside"> <a href="user_profile.php" ><i class="fa fa-user"></i> Profile</a></span> ';
                }else{
                    echo ' <span> <a href="user_profile.php" ><i class="fa fa-user"></i> Profile</a></span> ';
                }
                
                if($_SESSION["userMenu"] == "task"){
                    echo ' <span class="inside"> <a href="user_task.php" ><i class="fa fa-tasks"></i> Task</a></span> ';
                }else{
                    echo ' <span> <a href="user_task.php" ><i class="fa fa-tasks"></i> Task</a></span> ';
                } 

                ?>
                
                <?php
                if($_SESSION["userMenu"] == "notifications"){ ?>
                    <span class="inside"> <a href="user_notifications.php" > <i class="fas fa-bell"></i> Notifications <?php if(mysqli_num_rows($sqlNotifyCheckInsert)){?> <span class="dot">.</span> <?php } ?> </a></span>
                <?php }else{ ?>
                    <span> <a href="user_notifications.php" > <i class="fas fa-bell"></i> Notifications <?php if(mysqli_num_rows($sqlNotifyCheckInsert)){?> <span class="dot">.</span> <?php } ?> </a></span>
                <?php } ?>
                
                <?php
                if($userDetails["Winner"] == "1"){
                    if($_SESSION["userMenu"] == "winner"){
                        echo ' <span class="inside"> <a href="user_winnerPage.php" ><i class="fa-solid fa-award"></i> Winners</a></span> ';
                    }else{
                        echo ' <span> <a href="user_winnerPage.php" ><i class="fa-solid fa-award"></i> Winners</a></span> ';
                    }
                }

                if(($userDetails["Tl"] == "1") && ($userDetails["Winner"] == "0")){
                    if($_SESSION["userMenu"] == "leader"){
                        echo ' <span class="inside"> <a href="teamLeader_page.php" ><i class="fa-solid fa-star"></i> TL Page</a></span> ';
                    }else{
                        echo ' <span> <a href="teamLeader_page.php" ><i class="fa-solid fa-star"></i> TL Page</a></span> ';
                    }

                }

                ?>
                

            </section>


            <section class="otherSec">
                <span> <a href="logout.php" ><i class="fa fa-sign-out"></i> Logout</a></span>
            </section>

            <script>
                // function teamLeaderRequest(email){
                //     var teamLeaderButton = document.getElementById("teamLeaderButton")
                //     teamLeaderButton.style.display = "none"

                //     $.post(`./asynchro.php?action=teamLeader&email=${email}`,(res)=>{
                //             if(res == "successful"){
                                
                //                 console.log("Working")
                //             }
                //     })

                //     // toastr.success('Request sent', {timeOut: 5000})
                //     alert("Request sent")

                // }
            </script>

        </section>
        















