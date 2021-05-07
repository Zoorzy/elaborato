<?php

if (isset($_POST["submit"])) {
  //Correct way to access the page

  $username = $_POST['username'];
  $email = $_POST['email'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $password = $_POST['password'];
  $passwordrepeat = $_POST['passwordrepeat'];

  require_once 'db_connect.inc.php';
  require_once 'functions.inc.php';

  /*
  if(emptyInputSignup($username, $email, $name, $surname, $password, $passwordrepeat) !== false){
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  */

  if(invalidUsername($username) !== false){
    header("location: ../signup.php?error=invalidusername");
    exit();
  }

  if(invalidEmail($email) !== false){
    header("location: ../signup.php?error=invalidemail");
    exit();
  }

  if(passwordMatch($password, $passwordrepeat) !== false){
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }

  if(usernameExists($conn, $username, $email) !== false){
    header("location: ../signup.php?error=usernameexists");
    exit();
  }

  createUser($conn, $username, $email, $name, $surname, $password);

} else {
  header("location: ../signup.php");
}


/*
$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO users(username, password) VALUES(?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $username, $password);
// 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();
*/