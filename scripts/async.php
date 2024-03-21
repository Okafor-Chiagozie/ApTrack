<?php

require("config.php");
require("functions.php");
require("database-functions.php");


if ($_REQUEST['action'] === 'teamMemberRequest') {

   $user_id = $_REQUEST["userId"];
   $team_id = $_REQUEST["teamId"];

   if(userTeamRequest($user_id, $team_id)){
      echo "Done";
   }
}


if ($_REQUEST['action'] === 'accept') {

   $team_id = $_REQUEST["teamId"];
   $user_email = $_REQUEST["userEmail"];

   if(acceptTeamRequest($team_id, $user_email) && deleteAllUserNotifications($user_email)){

      echo "Done";
   }
}


if ($_REQUEST['action'] === 'decline') {

   $team_id = $_REQUEST["teamId"];
   $user_email = $_REQUEST["userEmail"];

   if(declineTeamRequest($team_id, $user_email)){

      echo "Done";
   }
}











if ($_REQUEST['action'] === 'makeLeader') {

   $email = $_REQUEST["email"];
   $team_name = $_REQUEST["teamName"];

   // Removing the previous teamLeader if any
   $sql4 = "UPDATE user_login set Tl = '0',Team_name = 'user_login'  WHERE Team_name = '$team_name' AND Tl = '1' ";
   $sqlInsert4 = mysqli_query($connection, $sql4);

   // Making the current person teamLeader
   $sql5 = "UPDATE user_login set Tl = '1',Team_name = '$team_name' WHERE Email = '$email'";
   $sqlInsert5 = mysqli_query($connection, $sql5);


   mysqli_close($connection);
}


if ($_REQUEST['action'] === 'deleteTask') {

   $id = $_REQUEST["id"];

   $sql6 = "DELETE FROM task WHERE Id = '$id' ";
   $sqlInsert6 = mysqli_query($connection, $sql6);

   mysqli_close($connection);
}


if ($_REQUEST['action'] === 'disqualifyTeam') {

   $team_name = $_REQUEST["teamName"];

   $sql7 = "UPDATE teams set Disqualify = '1' WHERE Team_name = '$team_name'";
   $sqlInsert7 = mysqli_query($connection, $sql7);

   mysqli_close($connection);
}


if ($_REQUEST['action'] === 'pardonTeam') {

   $team_name = $_REQUEST["teamName"];

   $sql7 = "UPDATE teams set Disqualify = '0' WHERE Team_name = '$team_name'";
   $sqlInsert7 = mysqli_query($connection, $sql7);

   mysqli_close($connection);
}


if ($_REQUEST['action'] === 'reset') {

   $sql9 = "TRUNCATE notify";
   $sqlInsert9 = mysqli_query($connection, $sql9);

   $sql10 = "UPDATE teams set Disqualify = '0', Document = 'Nothing' ";
   $sqlInsert10 = mysqli_query($connection, $sql10);

   $sql11 = "UPDATE user_login set Team_name = 'user_login', Tl = '0', Winner = '0' ";
   $sqlInsert11 = mysqli_query($connection, $sql11);

   mysqli_close($connection);
}
