<?php
require("db_connect.inc.php");
require("session.inc.php");

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = ? AND password = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $username, $password);

$stmt->execute();

$result = $stmt->get_result();

$_SESSION = $result->fetch_assoc();

header('location: ../index.php');
