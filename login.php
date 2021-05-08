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
            <h2>Log In</h2>
            <h3>Please use your credentials to access</h3>
          </header>

          <!-- Main Content -->
          <form action="includes/login.inc.php" method="post" id="LoginForm">

            <div class="input-field">
              <input type="text" name="usernameemail" id="usernameemail" required>
              <label for="usernameemail">Username or Email</label>
            </div>

            <div class="input-field">
              <input type="password" name="password" id="password" required>
              <label for="password">Password</label>
            </div>


            <button name="submit">Log In</button>

            <br>Still not have an account? <a href="./signup.php">Sign up!</a>
            <!-- Non serve che lo sviluppi, è solo per implementare il server mail nella parte di sistemi -->
            <br>Forgot your password? <a href="#">Send me an email to reset it now!</a>

          </form>

          <?php
          if (isset($_GET['error'])) {

            if ($_GET['error'] == 'wronglogin') {
              echo '<div class="alert erroralert">';
              echo 'The <strong>credentials</strong> used don\'t match our records';
              echo '</div>';
            }
            if ($_GET['error'] == 'none') {
              echo '<div class="alert confirmalert">';
              echo 'Signed up!';
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