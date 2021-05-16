<?php
// connect to database
require "./db_connect.inc.php";
require "./functions.inc.php";
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$user_id = $_SESSION['id'];

// if user clicks like or dislike button
if (isset($_POST['action'])) {

  $post_id = $_POST['post_id'];
  $action = $_POST['action'];
  switch ($action) {
    case 'like':
      $sql = "INSERT INTO rating_info (user_id, post_id, rating_action) 
         	   VALUES ($user_id, $post_id, 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
      break;
    case 'dislike':
      $sql = "INSERT INTO rating_info (user_id, post_id, rating_action) 
               VALUES ($user_id, $post_id, 'dislike') 
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
      break;
    case 'unlike':
      $sql = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
      break;
    case 'undislike':
      $sql = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
      break;
    default:
      break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);
  echo getRating($post_id);
  exit(0);
}