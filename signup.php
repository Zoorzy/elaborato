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
              <label for="name">Name</label>
            </div>

            <div class="input-field">
              <input type="text" name="surname" id="surname" required>
              <label for="surname">Surname</label>
            </div>

            <div class="input-field">
              <input type="text" name="email" id="email" required>
              <label for="email">Email</label>
            </div>

            <div class="input-field">
              <input type="password" name="password" id="password" required>
              <label for="password">Password (Letters, numbers, 8-20 chars long)</label>
            </div>

            <div class="input-field">
              <input type="password" name="passwordrepeat" id="passwordrepeat" required>
              <label for="passwordrepeat">Repeat Password</label>
            </div>

            <button name="submit">Sign Up</button>
            <br>Already have an account? <a href="./login.php">Log In!</a>

          </form>

          <?php
          if (isset($_GET['error'])) {

            if ($_GET['error'] == 'invalidusername') {
              echo '<div class="alert erroralert">';
              echo '<strong>Username</strong> allows only [a-zA-Z0-9] characters';
              echo '</div>';
            }
            if ($_GET['error'] == 'invalidemail') {
              echo '<div class="alert erroralert">';
              echo '<strong>Email</strong> not valid';
              echo '</div>';
            }
            if ($_GET['error'] == 'passworddontmatch') {
              echo '<div class="alert erroralert">';
              echo '<strong>Passwords</strong> must corrispond';
              echo '</div>';
            }
            if ($_GET['error'] == 'usernametaken') {
              echo '<div class="alert erroralert">';
              echo 'This <strong>username</strong> has been already taken';
              echo '</div>';
            }
            if ($_GET['error'] == 'emailtaken') {
              echo '<div class="alert erroralert">';
              echo 'This <strong>email</strong> has been already taken';
              echo '</div>';
            }
            if ($_GET['error'] == 'passwordlength') {
              echo '<div class="alert erroralert">';
              echo 'This <strong>password</strong> must be 8 to 20 chars long';
              echo '</div>';
            }
            if ($_GET['error'] == 'passwordnumbers') {
              echo '<div class="alert erroralert">';
              echo 'This <strong>password</strong> must contain at least 1 number';
              echo '</div>';
            }
            if ($_GET['error'] == 'passwordletters') {
              echo '<div class="alert erroralert">';
              echo 'This <strong>password</strong> must contain at least 1 letter ([a-zA-Z])';
              echo '</div>';
            }
            if ($_GET['error'] == 'passwordspecialchars') {
              echo '<div class="alert erroralert">';
              echo "This <strong>password</strong> must contain at least 1 special char";
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