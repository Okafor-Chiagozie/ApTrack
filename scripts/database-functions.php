<?php

/**
 * Check if the given email exists in the specified table and returns it's 
 * encrypted password
 *
 * @param  string $email
 * @param  string $table
 * @return string
 */
function emailChecker(string $email, string $table) : ?string
{
   global $connection;
   
   $query = "SELECT `password` FROM $table WHERE `email` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("s", $email);
   $stmt->execute();
   $stmt->bind_result($password);

   if($stmt->fetch())
      return $password;

   return null;
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
function addNewUserToDatabase(string $firstname, string $lastname, 
string $email, string $password) : ?bool
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
 * @param  string $email
 * @return array
 */
function getUserDetails(string $email) : ?array
{
   global $connection;
   
   $query_1 = "SELECT * FROM `users` WHERE `email` = ?";
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


/**
 * Get all members of a team
 *
 * @param  int $team_id
 * @param  int $team_leader_id
 * @return array
 */
function getTeamMembers(int $team_id, int $team_leader_id) : ?array
{
   global $connection;
   
   $query = "SELECT * FROM `users` WHERE `team_id` = ? AND `id` != ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("ii", $team_id, $team_leader_id);
   $stmt->execute();
   $result = $stmt->get_result();
   $data = $result->fetch_all(MYSQLI_ASSOC);
   
   return $data;
}


/**
 * Get the Id of a team's team leader
 *
 * @param  int $team_id
 * @return int
 */
function getTeamLeaderId(int $team_id) : ?int
{
   global $connection;
   
   $query = "SELECT `leader_id` FROM `teams` WHERE `id` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("i", $team_id);
   $stmt->execute();
   $stmt->bind_result($team_leader_id);

   if($stmt->fetch())
      return $team_leader_id;

   return null;
}


/**
 * Get the details of a team's team leader
 *
 * @param  int $id
 * @return array
 */
function getTeamLeaderDetails(int $id) : ?array
{
   global $connection;
   
   $query = "SELECT * FROM `users` WHERE `id` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("i", $id);
   $stmt->execute();
   $result = $stmt->get_result();
   $data = $result->fetch_assoc();

   return $data;
}


/**
 * Get all available tasks in descinding order
 *
 * @param  int $limit
 * @return array
 */
function getAllTask(int $limit = 0) : ?array
{
   global $connection;
   
   $query = "SELECT * FROM `tasks` ORDER BY `id` DESC";
   if($limit != 0)
      $query = "SELECT * FROM `tasks` ORDER BY `id` DESC LIMIT $limit";
   
   $stmt = $connection->prepare($query);
   $stmt->execute();
   $result = $stmt->get_result();
   $data = $result->fetch_all(MYSQLI_ASSOC);
   
   return $data;
}


/**
 * Update the profile a given user
 *
 * @param  string $picture_name
 * @param  string $firstname
 * @param  string $lastname
 * @param  string $specialty
 * @param  string $email
 * @return bool
 */
function updateUserProfile(string $picture_name, string $firstname, 
string $lastname, string $specialty, string $email) : ?bool
{
   global $connection;
   
   $query = "UPDATE `users` set picture = ?, firstname = ?, 
   lastname = ?, specialty = ? WHERE email = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("sssss", $picture_name, $firstname, $lastname, $specialty, $email);
   $result = $stmt->execute();
   
   return $result;
}

