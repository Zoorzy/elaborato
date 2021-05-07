<?php

function invalidUsername($username)
{
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function invalidEmail($email)
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function passwordMatch($password, $passwordrepeat)
{
  if ($password !== $passwordrepeat) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function usernameExists($conn, $username, $email)
{
  $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
  $stmt = mysqli_stmt_init($conn, $sql);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ..signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }
}

function createUser($conn, $username, $email, $name, $surname, $password)
{
}
