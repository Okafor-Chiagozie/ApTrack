<?php

/**
 * Check if the given email exists in the specified table and returns it's 
 * encrypted password
 *
 * @param  string $email
 * @param  string $table
 * @return string
 */
function emailChecker($email, $table) :string
{
   global $connection;
   
   $query = "SELECT `password` FROM $table WHERE `email` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("s", $email);
   $stmt->execute();
   $stmt->bind_result($password);

   if($stmt->fetch())
      return $password;

   return "";
}


/**
 * Add newly registered user to database
 *
 * @param  string $firstname
 * @param  string $lastname
 * @param  string $email
 * @param  string $password
 * @return bool
 */
function addNewUserToDatabase($firstname, $lastname, $email, $password) :bool
{
   global $connection;

   $query = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`) 
   VALUES (?, ?, ?, ?)";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);
   $result = $stmt->execute();

   return $result;
}


/**
 * Fetch user details from the database
 *
 * @param  mixed $email
 * @return void
 */
function fetchUserDetails($email)
{
   global $connection;
   
   $query_1 = "SELECT * FROM `users`  WHERE `email` = ?";
   $stmt = $connection->prepare($query_1);
   $stmt->bind_param("s", $email);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($result->num_rows > 0) {
      $data_1 = $result->fetch_assoc();
   }

   if($data_1["team_id"]){

      $query_2 = "SELECT `users`.*, `teams`.* FROM `users` JOIN `teams` ON `users`.`team_id` = `teams`.`id`  WHERE `email` = ?";
      $stmt = $connection->prepare($query_2);   
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
   
      if ($result->num_rows > 0) {
         $data_2 = $result->fetch_assoc();
         return $data_2;
      }
   }

   return $data_1;
}

