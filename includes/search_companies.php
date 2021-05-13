<?php

require("db_connect.inc.php");

$name_param = $_POST['name_param'];

$sql = "SELECT * FROM company WHERE name LIKE '$name_param%' ORDER BY name LIMIT 5";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
?>
    <a href="./company_info.php?id=<?php echo $row['id']; ?>">
      <section>
        <h2>
          <?php echo $row['name']; ?>
        </h2>

        <?php echo "("; ?>
        <?php echo $row['region'] . ", "; ?>
        <?php echo $row['city'] . ", "; ?>
        <?php echo $row['street']; ?>
        <?php echo $row['street number']; ?>
        <?php echo ")"; ?>

        <p>
          <?php echo $row['category']; ?><br>
          <?php echo $row['description']; ?>
        </p>
      </section>
    </a>
<?php
  }
} else {
  echo '<p>';
  echo 'No matches found!';
  echo '</p>';
}
