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
              <input type="search" name="company_search" id="company_search">
              <label for="company_search">Search for a company name</label>
            </div>
          </header>

          <div id="search_results">
            <p>I risultati saranno visualizzati qui</p>
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
        <section>
          <header>
            <h2>Ipsum Dolor</h2>
          </header>
          <p>
            Vehicula fermentum ligula at pretium. Suspendisse semper iaculis eros, eu aliquam
            iaculis. Phasellus ultrices diam sit amet orci lacinia sed consequat.
          </p>
          <ul class="link-list">
            <li><a href="#">Sed dolore viverra</a></li>
            <li><a href="#">Ligula non varius</a></li>
            <li><a href="#">Dis parturient montes</a></li>
            <li><a href="#">Nascetur ridiculus</a></li>
          </ul>
        </section>

      </div>
    </div>
  </div>
</section>


<?php
include_once 'includes/footer.php';
?>