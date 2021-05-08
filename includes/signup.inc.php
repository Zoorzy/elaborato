<?php

if (isset($_POST["submit"])) {
  //Correct way to access the page

  $username = $_POST['username'];
  $email = $_POST['email'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $pwd = $_POST['password'];
  $passwordrepeat = $_POST['passwordrepeat'];

  require_once 'db_connect.inc.php';
  require_once 'functions.inc.php';

  // check if the username is written in a standard way
  if (invalidUsername($username)) {
    header("location: ../signup.php?error=invalidusername");
    exit();
  }

  //check in the db if the username already exists
  if (usernameExists($conn, $username)) {
    header("location: ../signup.php?error=usernametaken");
    exit();
  }

  //check in the db if the email already exists
  if (emailExists($conn, $email)) {
    header("location: ../signup.php?error=emailtaken");
    exit();
  }

  //check if the email is written in a standard way
  if (invalidEmail($email)) {
    header("location: ../signup.php?error=invalidemail");
    exit();
  }

  //check if passwords match
  if (!passwordMatch($pwd, $passwordrepeat)) {
    header('location: ../signup.php?error=passworddontmatch');
    exit();
  }

  //check if password is long enough
  if (!longEnough($pwd)) {
    header("location: ../signup.php?error=passwordlength");
    exit();
  }

  //check if password contains special characters
  if (!containsNumbers($pwd)) {
    header("location: ../signup.php?error=passwordnumbers");
    exit();
  }

  //check if password contains letters ([a-zA-Z])
  if(!containsLetters($pwd)){
    header("location: ../signup.php?error=passwordletters");
    exit();
  }

  /*
  //check if password contains special chars 
  if(!containsSpecialChars($pwd)){
    header("location: ../signup.php?error=passwordspecialchars");
    exit();
  }
  */

  //if everything is ok, then create the user record in the db
  createUser($conn, $username, $email, $name, $surname, $pwd);
} else {
  header("location: ../signup.php");
}
