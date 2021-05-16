<?php

// check if the username is written in a standard way
function invalidUsername($username)
{
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

//check if the email is written in a standard way
function invalidEmail($email)
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

//check if passwords match
function passwordMatch($pwd, $pwdRepeat)
{
  if ($pwd !== $pwdRepeat) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

//if it is long enough it returns true
function longEnough($pwd)
{
  if (strlen($pwd) >= 8 && strlen($pwd) <= 20) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

//if it contains numbers returns true
function containsNumbers($pwd)
{

  if (preg_match("#[0-9]+#", $pwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

/*
//if it contains special chars returns true
function containsSpecialChars($pwd)
{

  if(preg_match("", $pwd)){
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}
*/

//if it contains letters returns true
function containsLetters($pwd)
{
  if (preg_match("#[a-zA-Z]+#", $pwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

//check in the db if the username already exists
function usernameExists($conn, $username)
{
  $sql = "SELECT * FROM users WHERE username = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmt1failed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, 's', $username);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($resultData) {
    $result = true;
  } else {
    $result = false;
    return $result;
  }
}

//check in the db if the email already exists
function emailExists($conn, $email)
{
  $sql = "SELECT * FROM users WHERE email = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmt1failed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, 's', $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($resultData) {
    $result = true;
  } else {
    $result = false;
    return $result;
  }
}

function uidExists($conn, $username, $email)
{
  $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmt3failed");
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

//if everything is ok, then create the user record in the db
function createUser($conn, $username, $email, $name, $surname, $password)
{
  $sql = "INSERT INTO users (username, name, surname, email, password) VALUES (?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmt2failed");
    exit();
  }

  $password_hash = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, 'sssss', $username, $name, $surname, $email, $password_hash);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
}




/* FUNCTIONS FOR LOGIN */
function loginUser($conn, $usernameemail, $pwd)
{
  $uidExists = uidExists($conn, $usernameemail, $usernameemail);

  if ($uidExists == false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $password_hash = $uidExists['password'];

  $checkPwd = password_verify($pwd, $password_hash);

  if ($checkPwd === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  } else if ($checkPwd === true) {
    //logged in 
    session_start();

    $_SESSION['id'] = $uidExists['id'];
    $_SESSION['username'] = $uidExists['username'];
    header("location: ../index.php");
    exit();
  }
}

/* FUNCTIONS FOR LIKES - DISLIKES */

// Get total number of likes for a particular post
function getLikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE post_id = $id AND rating_action='like'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE post_id = $id AND rating_action='dislike'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info 
		  			WHERE post_id = $id AND rating_action='dislike'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
    'likes' => $likes[0],
    'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($post_id)
{
  global $conn;
  //global $user_id; ----NON FUNZIONA COSì, RIMANE SEMPRE 1 (non ho ben capito perchè)
  $user_id = $_SESSION['id'];
  $sql = "SELECT * FROM rating_info WHERE user_id='$user_id'
  		  AND post_id='$post_id' AND rating_action='like'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($post_id)
{
  global $conn;
  //global $user_id;
  $user_id = $_SESSION['id'];
  $sql = "SELECT * FROM rating_info WHERE user_id='$user_id' 
  		  AND post_id='$post_id' AND rating_action='dislike'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}
