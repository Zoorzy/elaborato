<?php
include_once "includes/header.php";
?>

<!-- Content -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <!-- Main Content -->
        <form action="includes/signup.inc.php" method="post" id="SignupForm">
          <section>

            <header>
              <h2>Sign Up</h2>
              <h3>Please fill in all the fields to create an account</h3>
            </header>

            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="text" name="name" id="name" placeholder="Name" required>
            <input type="text" name="surname" id="surname" placeholder="Surname" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="text" name="email" id="email" placeholder="Email" required>
            <input type="password" name="passwordrepeat" id="passwordrepeat" placeholder="Retype password" required>

            <h3 id="error"></h3>

            <button name="submit">Sign Up</button>
            <br>Already have an account? <a href="./login.php">Log In!</a>
          </section>
        </form>
        <script>
          function checksubmit() {
            var pwd = document.getElementById('password').value;
            var pwdrepeat = document.getElementById('passwordrepeat').value;
            var error = document.getElementById('error');


            if (pwd == pwdrepeat) {
              error.innerHTML = "";
              document.getElementById('SignupForm').submit();
            } else {
              error.innerHTML = "Error! Password MUST corrispond!"
            }
          }
        </script>

      </div>
    </div>
  </div>
</section>

<?php
include_once "includes/footer.php";
?>