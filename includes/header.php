<?php
require("session.inc.php");
require("db_connect.inc.php");
?>
<!DOCTYPE HTML>
<!--
	Halcyonic by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>

  <title>CompanyAdVisor</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="/elaborato/assets/css/main.css" />

</head>

<body>
  <div id="page-wrapper">

    <!-- Header -->
    <section id="header">
      <div class="container">
        <div class="row">
          <div class="col-12">

            <!-- Logo -->
            <h1><a href="./index.php" id="logo">CompanyAdVisor</a></h1>

            <!-- Nav -->
            <nav id="nav">
              <a href="./index.php">HOMEPAGE</a>
              <a href="./blog.php">BLOG</a>
              <a href="./company_search.php">RICERCA AZIENDE</a>
              <!-- A questa pagina si arriva dalla pagina 'Ricerca Aziende' -->
              <!-- <a href="./twocolumn2.php">Two Column #2</a> -->
              <a href="./contact.php">CONTATTI</a>
              <?php
              if (isset($_SESSION['id'])) {
                echo '<a href="includes/logout.inc.php">LOGOUT ' . $_SESSION['username'] . '</a>';
              }
              ?>
            </nav>

          </div>
        </div>
      </div>

      <?php
      if (!isset($_SESSION['id']) && !strpos($_SERVER['REQUEST_URI'], "login") && !strpos($_SERVER['REQUEST_URI'], "signup")) {
      ?>
        <!-- Banner under the nav bar -->
        <div id="banner">
          <div class="container">
            <div class="row">
              <div class="col-6 col-12-medium">

                <!-- Banner Copy -->
                <p>Facciamo qualcosa di veramente utile, importante ed unico. Entra nella community per una migliore esperienza </p>

                <a href="login.php" class="button-large">Accedi</a>
                <a href="signup.php" class="button-large">Registrati</a>

              </div>
              <div class="col-6 col-12-medium imp-medium">

                <!-- Banner Image -->
                <a href="#" class="bordered-feature-image"><img src="images/company.png" alt="" /></a>

              </div>
            </div>
          </div>
        </div>

      <?php
      }
      ?>
    </section>