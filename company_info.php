<?php

//if 'id' GET param isn't set OR it is set and it is not an int value, then...
if (!isset($_GET['id']) || (isset($_GET['id']) && !ctype_digit(strval($_GET['id'])))) {

  header("location: ./index.php");
  exit();
}

require("includes/header.php");
require("./includes/functions.inc.php");

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
            <!-- Dati che devo richiedere al DBMS -->
            <li>Indirizzo :
              <?php echo $row['region'] . ", "; ?>
              <?php echo $row['city'] . ", "; ?>
              <?php echo "via " . $row['street']; ?>
              <?php echo $row['street number']; ?>
            </li>
            <!-- <li>Valutazione Media :</li>-->
            <!-- <li>Commenti : </li> -->
            <?php if ($row['employees']) { ?>
              <li>Dipendenti :
                <?php echo $row['employees']; ?>
              </li>
            <?php } ?>
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
            <?php if (isset($row['description'])) echo "<h3>'" . $row['description'] . "'</h3>"; ?>

            <?php
            if (isset($_SESSION['id'])) {
            ?>
              <section style="background-color: rgba(0,0,0, 0.02)">

                <form action="./includes/add_post.php" method="post">

                  <input type="checkbox" name="anonymous" id="anonymous" value="1">Pubblica il tuo commento senza mostrare il tuo nome

                  <input type="hidden" name="company_id" value="<?php echo $_GET['id']; ?>">

                  <div class="input-field">
                    <input type="text" name="post" id="post" maxlength="500" required>
                    <label for="post">Aggiungi un tuo commento (500 caratteri) *</label>
                  </div>


                  <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" required />
                    <label for="star5" title="text" class="stars">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" required />
                    <label for="star4" title="text" class="stars">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" required />
                    <label for="star3" title="text" class="stars">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" required />
                    <label for="star2" title="text" class="stars">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" required />
                    <label for="star1" title="text" class="stars">1 star</label>
                  </div>

                  <span>Aggiungi una valutazione *</span>

                  <input type="submit" name="submit" value="Aggiungi il tuo post">

                </form>

              </section>

            <?php
            }
            ?>
          </header>

          <!-- Thumbs up / down -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
          <?php

          $sql = "SELECT posts.*, users.username FROM posts, users WHERE company_id=" . $_GET['id'] . " AND posts.user_id = users.id";

          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result)) {
            //se trovo corrispondenza nel db allora ...
            while ($row = mysqli_fetch_assoc($result)) {
              //var_dump($row);
              //ciclo tutti i commenti dell'azienda
          ?>
              <section>
                <?php
                echo $row['created_at'] . "<br>";
                if ($row['anonymous'] == 0) {
                  echo $row['username'];
                } else {
                  echo "Anonymous";
                }
                echo " [" . $row['rating'] . "/5 stelle]";
                ?>
                <?php
                if (isset($_SESSION['id'])) {
                ?>
                  <div id='likes'>
                    <!-- if user likes post, style button differently -->
                    <i <?php if (userLiked($row['id'])) : ?> class="fa fa-thumbs-up like-btn" <?php else : ?> class="fa fa-thumbs-o-up like-btn" <?php endif ?> data-id="<?php echo $row['id'] ?>"></i>
                    <span class="likes"><?php echo getLikes($row['id']); ?></span>
                    <!-- fine likes -->
                  </div>

                  <div id='dislikes'>
                    <!-- if user dislikes post, style button differently -->
                    <i <?php if (userDisliked($row['id'])) : ?> class="fa fa-thumbs-down dislike-btn" <?php else : ?> class="fa fa-thumbs-o-down dislike-btn" <?php endif ?> data-id="<?php echo $row['id'] ?>"></i>
                    <span class="dislikes"><?php echo getDislikes($row['id']); ?></span>
                    <!-- fine dislikes -->
                  </div>
                <?php
                }

                if ($row['description'] !== NULL) {
                  echo "<h3>- " . $row['description'] . "</h3>";
                }

                ?>

              </section>
          <?php

            }
          } else {
            echo "<p>";
            echo "Sii il primo a commentare! ";
            echo "</p>";
          }

          ?>

        </section>

      </div>
    </div>
  </div>
</section>

<?php
require('includes/footer.php');
?>