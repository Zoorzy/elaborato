<?php
include_once "includes/header.php";
?>

<!-- Content -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <!-- Main Content -->
        <form action="includes/login.inc.php" method="post" id="LoginForm">
          <section>
            <header>
              <h2>Log In</h2>
              <h3>Please use your credentials to access</h3>
            </header>
            <input type="text" name="username" id="username" placeholder="Username/Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <button name="submit">Log In</button>
            <br>Still not have an account? <a href="./signup.php">Sign up!</a>
          </section>
        </form>

      </div>
    </div>
  </div>
</section>

<?php
include_once "includes/footer.php";
?>