<?php
include_once "includes/header.php";
?>


<!-- Content -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-9 col-12-medium">

        <!-- Main Content -->
        <section>
          <header>
            <h2>Ricerca Aziende</h2>
            <div class="input-field">
              <input type="text" name="company_search" id="company_search">
              <label for="company_search">Cerca il nome di un'azienda</label>
            </div>
          </header>

          <div id="search_results">
            <?php

            $sql = "SELECT * FROM company WHERE name LIKE '%' ORDER BY name LIMIT 5";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <a href="./company_info.php?id=<?php echo $row['id']; ?>">
                  <section>
                    <h2>
                      <?php echo "> " . $row['name']; ?>
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
                </a><br>
            <?php
              }
            } else {
              echo '<p>';
              echo 'Empty record!';
              echo '</p>';
            }

            ?>
          </div>

          <script>
            window.onload = function() {

              var search = "";;

              $('#company_search').keyup(function() {

                search = this.value;
                $('#search_results').load('./includes/search_companies.php', {
                  name_param: search
                });

              });
            }
          </script>

        </section>

      </div>
      <div class="col-3 col-12-medium">

        <!-- Sidebar -->
        <section>
          <header>
            <h2>Top 5 aziende negli ultimi 30 giorni</h2>
          </header>
          <!-- Query che prende le 5 aziende con le valutazioni migliori -->
          <ul class="link-list">
            <li><a href="./company_info.php?id=#">Azienda</a></li>
            <li><a href="./company_info.php?id=#">Azienda</a></li>
            <li><a href="./company_info.php?id=#">Azienda</a></li>
            <li><a href="./company_info.php?id=#">Azienda</a></li>
            <li><a href="./company_info.php?id=#">Azienda</a></li>
          </ul>
        </section>

      </div>
    </div>
  </div>
</section>


<?php
include_once 'includes/footer.php';
?>