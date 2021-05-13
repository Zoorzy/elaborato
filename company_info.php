<?php

//if 'id' GET param isn't set OR it is set and it is not an int value, then...
if (!isset($_GET['id']) || (isset($_GET['id']) && !ctype_digit(strval($_GET['id'])))) {

  header("location: ./index.php");
  exit();
}

require("includes/header.php");

$sql = "SELECT * FROM company WHERE id=" . $_GET['id'];

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)) {
  //se trovo corrispondenza nel db allora ...
  $row = mysqli_fetch_assoc($result);
} else {
  //se l'id non corrisponde a nessuna azienda nel database allora ...
  header("location: ./company_search.php");
}

?>

<!-- Content -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-3 col-12-medium">

        <!-- Sidebar -->
        <section>
          <header>
            <h2>Dati Generali</h2>
          </header>
          <ul class="link-list">
            <!-- Dati che devo richiedere a MySQL -->
            <li>Indirizzo :
              <?php echo $row['region'] . ", "; ?>
              <?php echo $row['city'] . ", "; ?>
              <?php echo "via " . $row['street']; ?>
              <?php echo $row['street number']; ?>
            </li>
            <!-- <li>Valutazione Media :</li>-->
            <!-- <li>Commenti : </li> -->
            <li>Dipendenti :
              <?php echo $row['employees']; ?>
            </li>
            <li>Telefono :
              <?php echo $row['phone']; ?>
            </li>
            <li>E-Mail :
              <?php echo $row['email']; ?>
            </li>
          </ul>
        </section>

      </div>
      <div class="col-9 col-12-medium imp-medium">

        <!-- Main Content -->
        <!-- Valori da inserire dopo query con parametro GET -->
        <section>
          <header>
            <h2><?php echo $row['name']; ?></h2>
            <?php if(isset($row['description'])) echo "<h3>'" . $row['description'] . "'</h3>"; ?>
          </header>
          
          <p>Qui ci andranno i commenti dalla tabella commenti</p>
        </section>

      </div>
    </div>
  </div>
</section>

<?php
require('includes/footer.php');
?>