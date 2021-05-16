<?php

require("./session.inc.php");

if (isset($_POST['submit']) && isset($_SESSION['id'])) {

  require("db_connect.inc.php");

  $user_id = $_SESSION['id'];
  $rating = $_POST['rate'];
  $company_id = $_POST['company_id'];
  $description = $_POST['post'];
  if(isset($_POST['anonymous']) && $_POST['anonymous'] == 1){
    $anonymous = $_POST['anonymous'];
  } else {
    $anonymous = 0;
  }

  $sql = "INSERT INTO `posts`(`user_id`, `company_id`, `description`, `anonymous`, `rating`) VALUES ('$user_id', '$company_id', '$description', '$anonymous', '$rating');";

  mysqli_query($conn, $sql) or die ("Impossibile inserire il record");
  header('location: ../company_info.php?id=' . $_POST['company_id']);
  exit();
} else {
  //se non è arrivato qui con il form apposito (settato il parametro submit) ritorna ad index
  header('location: ../index.php');
}
