<?php

if ((!isset($_SESSION["adminEmail"]) || !isset($_SESSION["status"])) && $_SESSION["status"] != "admin") {
   header("Location: ../../sign-in.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard - ApTrack</title>
   <link rel="stylesheet" href="../../assets/fontawesome-free-6.1.1-web/css/all.css">
   <link rel="stylesheet" href="../../assets/css/user/header.css">

   <?php

   if ($_SESSION["adminMenu"] == "dashboard") {
      echo " <link rel='stylesheet' href='../../assets/css/admin/dashboard.css'> ";
   } else if ($_SESSION["adminMenu"] == "create_task") {
      echo " <link rel='stylesheet' href='../../assets/css/admin/create-task.css'> ";
   } else if ($_SESSION["adminMenu"] == "teams") {
      echo " <link rel='stylesheet' href='../../assets/css/admin/teams-page.css'> ";
   } else if ($_SESSION["adminMenu"] == "winners") {
      echo " <link rel='stylesheet' href='../../assets/css/admin/winners-page.css'> ";
   }

   ?>
</head>

<body>
   <div class="mainDiv">
      <header class="mainHeader" id="mainHeader">
         <section class="logoSec">
            <section>
               <section>
                  <img src="../../assets/images/dark.png" alt="Logo image">
               </section>

               <span>ApTrack</span>
            </section>

            <span class="outside" id="hamburgerIcon" onclick="menu()">
               <i class="fa-solid fa-bars"></i>
            </span>
         </section>


         <section class="navSec">
            <section class="searchSec">
               <h1>Welcome Admin</h1>
               <!-- <input type="search" name="" id="" placeholder="Search" class="inside">
                    <button><i class="fa fa-search"></i></button> -->
            </section>

            <section class="iconSec">
               <a href="create-task.php" class="icon outside" title="Create Task"><i class="fas fa-tasks-alt"></i></a>

               <a href="winners-page.php" class="icon outside" title="Choose Winner"><i class="fa-solid fa-award"></i></a>

               <a href="#" class="profilePic outside">
                  <img src="../../uploads/user-pictures/admin.png" alt="Profile picture">
               </a>

            </section>

         </section>

      </header>

      <section class="leftSection" id="leftSection">

         <section class="menuSec">

            <?php

            if ($_SESSION["adminMenu"] == "dashboard") {
               echo ' <span class="inside"> <a href="dashboard.php" ><i class="fa fa-cubes"></i> Dashboard</a></span> ';
            } else {
               echo ' <span> <a href="dashboard.php" ><i class="fa fa-cubes"></i> Dashboard</a></span> ';
            }

            if ($_SESSION["adminMenu"] == "create_task") {
               echo ' <span class="inside"> <a href="create-task.php" ><i class="fas fa-tasks-alt"></i> Create Task</a></span> ';
            } else {
               echo ' <span> <a href="create-task.php" ><i class="fas fa-tasks-alt"></i> Create Task</a></span> ';
            }

            if ($_SESSION["adminMenu"] == "teams") {
               echo ' <span class="inside"> <a href="teams-page.php" ><i class="fa fa-users"></i> Teams</a></span> ';
            } else {
               echo ' <span> <a href="teams-page.php" ><i class="fa fa-users"></i> Teams</a></span> ';
            }

            if ($_SESSION["adminMenu"] == "winners") {
               echo ' <span class="inside"> <a href="winners-page.php" ><i class="fa-solid fa-award"></i> Winner Team</a></span> ';
            } else {
               echo ' <span> <a href="winners-page.php" ><i class="fa-solid fa-award"></i> Winner Team</a></span> ';
            }

            ?>


         </section>


         <section class="otherSec">
            <span> <a href="../../scripts/logout.php"><i class="fa fa-sign-out"></i> Logout</a></span>
         </section>

      </section>