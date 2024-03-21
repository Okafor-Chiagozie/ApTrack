<?php

/**
 * Check if the given email exists in the specified table and returns it's 
 * encrypted password
 *
 * @param  string $email
 * @param  string $table
 * @return string
 */
function emailChecker(string $email) : ?string
{
   global $connection;
   
   $query = "SELECT `password` FROM `users` WHERE `email` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("s", $email);
   $stmt->execute();
   $stmt->bind_result($password);

   if($stmt->fetch()){

      return $password;
   }else{

      $query = "SELECT `password` FROM `admins` WHERE `email` = ?";
      $stmt = $connection->prepare($query);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->bind_result($password);

      if($stmt->fetch()){

         return $password;
      }
   }

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
      $_SESSION["userId"] = $data_1["id"];
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
 * Get the Id of a user
 *
 * @param  string $user_email
 * @return int
 */
function getUserId(string $user_email) : ?int
{
   global $connection;
   
   $query = "SELECT `id` FROM `users` WHERE `email` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("s", $user_email);
   $stmt->execute();
   $stmt->bind_result($user_id);

   if($stmt->fetch())
      return $user_id;

   return null;
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
   
   $query = "UPDATE `users` set `picture` = ?, `firstname` = ?, 
   `lastname` = ?, `specialty` = ? WHERE `email` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("sssss", $picture_name, $firstname, $lastname, $specialty, $email);
   $result = $stmt->execute();
   
   return $result;
}


/**
 * Get all notifications for a given user
 *
 * @param  string $user_email
 * @return array
 */
function getUserNotifications(string $user_email) : ?array
{
   global $connection;

   $user_id = getUserId($user_email);
   
   $query = "SELECT `notifications`.*, `teams`.* FROM `notifications` 
   JOIN `teams` ON `notifications`.`team_id` = `teams`.`id`
   WHERE `notifications`.`user_id` = ? ORDER BY `notifications`.`id` DESC";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("i", $user_id);
   $stmt->execute();
   $result = $stmt->get_result();
   $data = $result->fetch_all(MYSQLI_ASSOC);
   
   return $data;
}


/**
 * Get all notifications for a user for a given team
 *
 * @param  string $user_email
 * @param  int $team_id
 * @return array
 */
function getTeamUserNotification(string $user_email, int $team_id) : ?array
{
   global $connection;

   $user_id = getUserId($user_email);
   
   $query = "SELECT `notifications`.*, `users`.*, `teams`.* FROM `notifications` 
   JOIN `users` ON `notifications`.`user_id` = `users`.`id`
   JOIN `teams` ON `notifications`.`team_id` = `teams`.`id`
   WHERE `notifications`.`user_id` = ? AND `notifications`.`team_id` = ? ORDER BY `notifications`.`id` DESC";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("ii", $user_id, $team_id);
   $stmt->execute();
   $result = $stmt->get_result();
   $data = $result->fetch_all(MYSQLI_ASSOC);
   
   return $data;
}


/**
 * Get all team leader's Id
 *
 * @return array
 */
function getAllTeamLeadersId() :?array
{
   global $connection;
   
   $query = "SELECT `leader_id` FROM `teams`";  // WHERE `id` NOT IN ($team_leaders_id)
   $stmt = $connection->prepare($query);
   $stmt->execute();
   $result = $stmt->get_result();
   $data = $result->fetch_all(MYSQLI_ASSOC);
   
   return $data;
}


/**
 * Return the details of all the team leaders
 *
 * @return array
 */
function getAllTeamLeaders() : ?array
{
   global $connection;
   
   $team_leaders_id = getAllTeamLeadersId();
   $team_leaders_id = implode(", ", array_filter(array_column($team_leaders_id, 'leader_id')));

   $query = "SELECT `users`.*, `teams`.* FROM `users` 
   JOIN `teams` ON `users`.`team_id` = `teams`.`id` WHERE `users`.`id` IN ($team_leaders_id)";
   $stmt = $connection->prepare($query);
   $stmt->execute();
   $result = $stmt->get_result();
   $data = $result->fetch_all(MYSQLI_ASSOC);
   
   return $data;
}


/**
 * Return the details of all the users
 *
 * @return array
 */
function getAllUsers() : ?array
{
   global $connection;
   
   $team_leaders_id = getAllTeamLeadersId();
   $team_leaders_id = implode(", ", array_filter(array_column($team_leaders_id, 'leader_id')));

   $query = "SELECT * FROM `users` WHERE `id` NOT IN ($team_leaders_id)";
   $stmt = $connection->prepare($query);
   $stmt->execute();
   $result = $stmt->get_result();
   $data = $result->fetch_all(MYSQLI_ASSOC);
   
   return $data;
}


/**
 * Send an team invitation request to a user
 *
 * @param  int $user_id
 * @param  int $team_id
 * @return bool
 */
function userTeamRequest(int $user_id, int $team_id) : ?bool
{
   global $connection;

   $query = "INSERT INTO `notifications` (`user_id`, `team_id`) VALUES (?, ?)";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("ii", $user_id, $team_id);
   $result = $stmt->execute();

   return $result;
}


/**
 * Upload the team's document
 *
 * @param  string $document_name
 * @param  int $id
 * @return bool
 */
function uploadTeamDocument(string $document_name, int $id) : ?bool
{
   global $connection;
   
   $query = "UPDATE `teams` set `document` = ? WHERE `id` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("si", $document_name, $id);
   $result = $stmt->execute();
   
   return $result;
}


/**
 * Accept team membership request
 *
 * @param  int $team_id
 * @param  string $user_email
 * @return bool
 */
function acceptTeamRequest(int $team_id, string $user_email,) : ?bool
{
   global $connection;
   
   $query = "UPDATE `users` set `team_id` = ? WHERE `email` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("is", $team_id, $user_email);
   $result = $stmt->execute();
   
   return $result;
}


/**
 * decline team membership request
 *
 * @param  int $team_id
 * @param  string $user_email
 * @return bool
 */
function declineTeamRequest(int $team_id, string $user_email) : ?bool
{
   return deleteTeamUserNotification($team_id, $user_email);
}


/**
 * Delete all notifications for a given user
 *
 * @param  string $user_email
 * @return bool
 */
function deleteAllUserNotifications(string $user_email) : ?bool
{
   global $connection;

   $user_id = getUserId($user_email);

   $query = "DELETE FROM `notifications` WHERE `user_id` = ?";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("i", $user_id);
   $result = $stmt->execute();
   
   return $result;
}


/**
 * declineTeamRequest
 *
 * @param  int $team_id
 * @param  string $user_email
 * @return bool
 */
function deleteTeamUserNotification(int $team_id, string $user_email) : ?bool
{
   global $connection;

   $user_id = getUserId($user_email);

   $query = "DELETE FROM `notifications` WHERE `team_id` = ? AND `user_id` = ? ";
   $stmt = $connection->prepare($query);
   $stmt->bind_param("ii", $team_id, $user_id);
   $result = $stmt->execute();
   
   return $result;
}

