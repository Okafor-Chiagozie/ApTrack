<?php
   if ((!isset($_SESSION["userEmail"]) || !isset($_SESSION["status"])) 
   && ($_SESSION["status"] != "user" || $_SESSION["status"] != "leader")) 
   {
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
      <link rel="stylesheet" href="../../assets/libraries/toastr.css">

      <?php
         if ($_SESSION["userMenu"] == "dashboard") {
            echo " <link rel='stylesheet' href='../../assets/css/user/dashboard.css'> ";
         } else if ($_SESSION["userMenu"] == "profile") {
            echo " <link rel='stylesheet' href='../../assets/css/user/profile.css'> ";
         } else if ($_SESSION["userMenu"] == "profile_edit") {
            echo " <link rel='stylesheet' href='../../assets/css/user/profile-edit.css'> ";
         } else if ($_SESSION["userMenu"] == "task") {
            echo " <link rel='stylesheet' href='../../assets/css/user/task-page.css'> ";
         } else if ($_SESSION["userMenu"] == "notifications") {
            echo " <link rel='stylesheet' href='../../assets/css/user/notifications.css'> ";
         } else if ($_SESSION["userMenu"] == "winner") {
            echo " <link rel='stylesheet' href='../../assets/css/user/winner-page.css'> ";
         } else if ($_SESSION["userMenu"] == "leader_page") {
            echo " <link rel='stylesheet' href='../../assets/css/user/team-leader/team-page.css'> ";
         } else if ($_SESSION["userMenu"] == "leader_dashboard") {
            echo " <link rel='stylesheet' href='../../assets/css/user/team-leader/dashboard.css'> ";
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
                  <h1>
                     Welcome <?= ucwords($user_details["firstname"] . " " . $user_details["lastname"]); ?>
                  </h1>

                  <!-- <section>
                     <input type="search" name="" id="" placeholder="Search" class="inside">
                     <button><i class="fa fa-search"></i></button>
                  </section> -->
               </section>

               <section class="iconSec">
                  <a href="task-page.php" class="icon outside" title="Tasks">
                     <i class="fas fa-tasks"></i>
                  </a>

                  <a href="notifications.php" class="icon outside" title="Notifications">
                     <i class="fas fa-bell"></i> 
                     <span>.</span> 
                  </a>

                  <a href="profile.php" class="profilePic outside">
                     <img src="../../uploads/user-pictures/<?= $user_details["picture"] ?>" alt="Profile picture">
                  </a>
               </section>
            </section>
         </header>

         <section class="leftSection" id="leftSection">
            <section class="menuSec">
               <span class="<?php if($_SESSION['userMenu'] == 'dashboard'): ?> inside <?php endif; ?>"> 
                  <a href="dashboard.php">
                  <i class="fa fa-cubes"></i> Dashboard</a>
               </span>

               <span class="<?php if($_SESSION['userMenu'] == 'profile'): ?> inside <?php endif; ?>"> 
                  <a href="profile.php">
                  <i class="fa fa-user"></i> Profile</a>
               </span>

               <span class="<?php if($_SESSION['userMenu'] == 'task'): ?> inside <?php endif; ?>"> 
                  <a href="task-page.php">
                  <i class="fa fa-tasks"></i> Task</a>
               </span>

               <span class="<?php if($_SESSION['userMenu'] == 'notifications'): ?> inside <?php endif; ?>"> 
                  <a href="notifications.php">
                  <i class="fas fa-bell"></i> Notifications <span class="dot">.</span></a>
               </span>

               <span class="<?php if($_SESSION['userMenu'] == 'winner'): ?> inside <?php endif; ?>"> 
                  <a href="winner-page.php">
                  <i class="fa-solid fa-award"></i> Winners</a>
               </span>

               <span class="<?php if($_SESSION['userMenu'] == 'leader_page'): ?> inside <?php endif; ?>"> 
                  <a href="team-leader-team-page.php">
                  <i class="fa-solid fa-users"></i> Team Page</a>
               </span>
            </section>

            <section class="otherSec">
               <span> <a href="../../scripts/logout.php"><i class="fa fa-sign-out"></i> Logout</a></span>
            </section>
         </section>