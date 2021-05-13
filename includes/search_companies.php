<?php

require("db_connect.inc.php");

$name_param = $_POST['name_param'];

$sql = "SELECT * FROM company WHERE name LIKE '$name_param%' ORDER BY name LIMIT 5";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<p>';
    echo $row['name'];
    echo '</p>';
  }
} else {
  echo '<p>';
  echo 'No matches found!';
  echo '</p>';
}
