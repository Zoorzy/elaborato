<?php
include_once "includes/header.php";
?>

<!-- Content -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <section>

          <header>
            <h2>Accedi</h2>
            <h3>Usa le tue credenziali per accedere</h3>
          </header>

          <!-- Main Content -->
          <form action="includes/login.inc.php" method="post" id="LoginForm">

            <div class="input-field">
              <input type="text" name="usernameemail" id="usernameemail" required>
              <label for="usernameemail">Username o Email</label>
            </div>

            <div class="input-field">
              <input type="password" name="password" id="password" required>
              <label for="password">Password</label>
            </div>


            <button name="submit">Accedi</button>

            <br>Non hai ancora un account? <a href="./signup.php">Registrati!</a>
            <!-- Non serve che lo sviluppi, è solo per implementare il server mail nella parte di sistemi -->
            <br>Non ricordi la password? <a href="#">Inviami una email per resettarla!</a>

          </form>

          <?php
          if (isset($_GET['error'])) {

            if ($_GET['error'] == 'wronglogin') {
              echo '<div class="alert erroralert">';
              echo 'Le <strong>credenziali</strong> usate non corrispondono a nessun account nel nostro database';
              echo '</div>';
            }
            if ($_GET['error'] == 'none') {
              echo '<div class="alert confirmalert">';
              echo 'Registrato con successo!';
              echo '</div>';
            }
          }

          ?>

        </section>

      </div>
    </div>
  </div>
</section>

<?php
include_once "includes/footer.php";
?>