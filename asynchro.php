<?php

require("dbConnect.php");


if($_REQUEST['action'] === 'accept'){

    $email = $_REQUEST["email"];
    $id = $_REQUEST["id"];
    $teamName = $_REQUEST["teamName"];

    
    $sql1 = "UPDATE user_login set Team_name = '$teamName' WHERE Email = '$email'";
    $sqlInsert1 = mysqli_query($db_connection, $sql1);


    $sql2 = "DELETE FROM notify WHERE User_email = '$email';";
    $sqlInsert2 = mysqli_query($db_connection, $sql2);

    echo "user_dashboard.php";
    

    mysqli_close($db_connection);    
    
}


if($_REQUEST['action'] === 'decline'){

    $email = $_REQUEST["email"];
    $id = $_REQUEST["id"];


    $sql3 = "DELETE FROM notify WHERE Id = '$id' ";
    $sqlInsert3 = mysqli_query($db_connection, $sql3);

    mysqli_close($db_connection);
    
}


if($_REQUEST['action'] === 'makeLeader'){

    $email = $_REQUEST["email"];
    $team_name = $_REQUEST["teamName"];

    // Removing the previous teamLeader if any
    $sql4 = "UPDATE user_login set Tl = '0',Team_name = 'user_login'  WHERE Team_name = '$team_name' AND Tl = '1' ";
    $sqlInsert4 = mysqli_query($db_connection, $sql4);

    // Making the current person teamLeader
    $sql5 = "UPDATE user_login set Tl = '1',Team_name = '$team_name' WHERE Email = '$email'";
    $sqlInsert5 = mysqli_query($db_connection, $sql5);


    mysqli_close($db_connection);    
    
}


if($_REQUEST['action'] === 'deleteTask'){

    $id = $_REQUEST["id"];


    $sql6 = "DELETE FROM task WHERE Id = '$id' ";
    $sqlInsert6 = mysqli_query($db_connection, $sql6);

    mysqli_close($db_connection);
    
}


if($_REQUEST['action'] === 'disqualifyTeam'){

    $team_name = $_REQUEST["teamName"];

    
    $sql7 = "UPDATE teams set Disqualify = '1' WHERE Team_name = '$team_name'";
    $sqlInsert7 = mysqli_query($db_connection, $sql7);


    mysqli_close($db_connection);    
    
}


if($_REQUEST['action'] === 'pardonTeam'){

    $team_name = $_REQUEST["teamName"];

    
    $sql7 = "UPDATE teams set Disqualify = '0' WHERE Team_name = '$team_name'";
    $sqlInsert7 = mysqli_query($db_connection, $sql7);


    mysqli_close($db_connection);    
    
}


if($_REQUEST['action'] === 'teamMemberRequest'){

    $leaderTeam = $_REQUEST["leaderTeam"];
    $leaderName = $_REQUEST["leaderName"];
    $userEmail = $_REQUEST["userEmail"];

    
    $sql8 = "INSERT INTO notify(Team_name,Team_leader,User_email)VALUES('$leaderTeam','$leaderName','$userEmail')";
    $sqlInsert8 = mysqli_query($db_connection, $sql8);


    mysqli_close($db_connection);    
    
}


if($_REQUEST['action'] === 'reset'){

    $sql9 = "TRUNCATE notify";
    $sqlInsert9 = mysqli_query($db_connection, $sql9);

    $sql10 = "UPDATE teams set Disqualify = '0', Document = 'Nothing' ";
    $sqlInsert10 = mysqli_query($db_connection, $sql10);

    $sql11 = "UPDATE user_login set Team_name = 'user_login', Tl = '0', Winner = '0' ";
    $sqlInsert11 = mysqli_query($db_connection, $sql11);

    mysqli_close($db_connection);
    
}









?>