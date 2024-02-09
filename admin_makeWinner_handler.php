
<?php

require("dbConnect.php");
include("functions.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Declaring variables
    $The_year = $Start_month = $End_month =  $Team_name = $Team_leader = $Names = "";

    if(isset($_POST["chooseWinner"])){
        
        if(!empty($_POST["teamName"])){

            $Team_name = $_POST["teamName"];


            // Date
            $sqlDate = "SELECT * FROM task ORDER BY Id DESC LIMIT 1";
            $sqlDateInsert = mysqli_query($db_connection, $sqlDate);
            $dateDetails = mysqli_fetch_assoc($sqlDateInsert);

            $The_year = explode("-", $dateDetails["Startdate"])[0];
            $Start_month = explode("-", $dateDetails["Startdate"])[1];
            $End_month = explode("-", $dateDetails["Enddate"])[1];

            // Team Leader
            $sqlLeader = "SELECT Firstname,Lastname FROM user_login WHERE Tl = '1' AND Team_name = '$Team_name' ";
            $sqlInsertLeader = mysqli_query($db_connection,$sqlLeader);
            $leader = mysqli_fetch_assoc($sqlInsertLeader);

            $Team_leader = $leader["Firstname"]." ".$leader["Lastname"];

            // Team Memebers
            $sqlMembers = "SELECT Firstname,Lastname FROM user_login WHERE Tl = '0' AND Team_name = '$Team_name' ";
            $sqlInsertMembers = mysqli_query($db_connection,$sqlMembers);

            while($members = mysqli_fetch_assoc($sqlInsertMembers)){
               $Names .= $members["Firstname"]." ".$leader["Lastname"]."&";
            }
            
        }


    }


    if(!empty($The_year) && !empty($Start_month) && !empty($End_month) && !empty($Team_name) && !empty($Team_leader) && !empty($Names)){

        $sqlWinner = "INSERT INTO winners(The_year, Start_month, End_month, Team_name, Team_leader, Names)
        VALUES('$The_year', '$Start_month', '$End_month', '$Team_name', '$Team_leader', '$Names')";        

        $sqlInsertWinner = mysqli_query($db_connection, $sqlWinner);

        $sqlUpdate = "UPDATE user_login set Winner = '1' ";
        $sqlInsertUpdate = mysqli_query($db_connection, $sqlUpdate);

        header("Location: admin_winners.php");

        mysqli_close($db_connection);
    }



}








?>