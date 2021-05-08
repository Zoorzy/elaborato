<?php

if (isset($_POST['submit'])) {

  $usernameemail = $_POST['usernameemail'];
  $pwd = $_POST['password'];

  require_once './db_connect.inc.php';
  require_once './functions.inc.php';

  loginUser($conn, $usernameemail, $pwd);
} else {
  header('location: ../login.php');
  exit();
}
