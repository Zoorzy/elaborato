<?php
include_once "includes/header.php";
?>

<!-- Content -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <!-- Main Content -->
        <section>

          <header>
            <h2>Sign Up</h2>
            <h3>Please fill in all the fields to create an account</h3>
          </header>

          <form action="includes/signup.inc.php" method="post" id="SignupForm">


            <div class="input-field">
              <input type="text" name="username" id="username" required>
              <label for="username">Username</label>
            </div>

            <div class="input-field">
              <input type="text" name="name" id="name" required>
              <label for="name">Nome</label>
            </div>

            <div class="input-field">
              <input type="text" name="surname" id="surname" required>
              <label for="surname">Cognome</label>
            </div>

            <div class="input-field">
              <input type="text" name="email" id="email" required>
              <label for="email">Email</label>
            </div>

            <div class="input-field">
              <input type="password" name="password" id="password" required>
              <label for="password">Password (Lettere e numeri, tra gli 8 e i 20 caratteri)</label>
            </div>

            <div class="input-field">
              <input type="password" name="passwordrepeat" id="passwordrepeat" required>
              <label for="passwordrepeat">Conferma Password</label>
            </div>

            <button name="submit">Registrati</button>
            <br>Hai già un account? <a href="./login.php">Accedi!</a>

          </form>

          <?php
          if (isset($_GET['error'])) {

            if ($_GET['error'] == 'invalidusername') {
              echo '<div class="alert erroralert">';
              echo '<strong>Username</strong> permette solo i caratteri [a-zA-Z0-9]';
              echo '</div>';
            }
            if ($_GET['error'] == 'invalidemail') {
              echo '<div class="alert erroralert">';
              echo '<strong>Email</strong> non valida';
              echo '</div>';
            }
            if ($_GET['error'] == 'passworddontmatch') {
              echo '<div class="alert erroralert">';
              echo 'Le <strong>password</strong> devono corrispondere';
              echo '</div>';
            }
            if ($_GET['error'] == 'usernametaken') {
              echo '<div class="alert erroralert">';
              echo 'Questo <strong>username</strong> è gia stato preso';
              echo '</div>';
            }
            if ($_GET['error'] == 'emailtaken') {
              echo '<div class="alert erroralert">';
              echo 'Questa <strong>email</strong> è già associata ad un account';
              echo '</div>';
            }
            if ($_GET['error'] == 'passwordlength') {
              echo '<div class="alert erroralert">';
              echo 'La <strong>password</strong> deve essere lunga minimo 8 e massimo 20 caratteri';
              echo '</div>';
            }
            if ($_GET['error'] == 'passwordnumbers') {
              echo '<div class="alert erroralert">';
              echo 'La <strong>password</strong> deve contenere almeno 1 cifra';
              echo '</div>';
            }
            if ($_GET['error'] == 'passwordletters') {
              echo '<div class="alert erroralert">';
              echo 'La <strong>password</strong> deve contenere al minimo 1 lettera ([a-zA-Z])';
              echo '</div>';
            }
            if ($_GET['error'] == 'passwordspecialchars') {
              // non attivo per ora
              echo '<div class="alert erroralert">';
              echo "La <strong>password</strong> deve contenere al minimo 1 carattere speciale";
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