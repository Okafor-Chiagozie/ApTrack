<?php

require("dbConnect.php");
include("functions.php");

// Declaring variables
$description = $start_date = $end_date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if (isset($_POST["create"])) {
      if (!empty($_POST["description"])) {
         $description = clean($_POST["description"]);
      }

      if (!empty($_POST["start_date"])) {
         $start_date = $_POST["start_date"];
      }

      if (!empty($_POST["end_date"])) {
         $end_date = $_POST["end_date"];
      }
   }
}


if (!empty($description) && !empty($start_date) && !empty($end_date)) {
   $sqlCreateTask = "INSERT INTO task(Description, Startdate, Enddate)
    VALUES('$description', '$start_date', '$end_date')";

   $sqlInsertCreateTask = mysqli_query($db_connection, $sqlCreateTask);

   if ($sqlInsertCreateTask) {
      header("Location: admin_createTask.php");
   }

   mysqli_close($db_connection);
}
