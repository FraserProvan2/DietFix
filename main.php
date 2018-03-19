<?php require 'include/user_auth.php';?>

<!--
Fraser Provan 28/02/2018
main.php - homepage
-->

<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="icon" type="image/png" href="img/logo/favicon.png" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script type='text/javascript' src='scripts/search.js'></script>
      <title>DietFix - Home</title>
</head>

<div class="container-fluid background">
      <!-- Logo with link to index -->
      <a href="main.php">
            <img src="img/logo/dietfix.png" class="logo">
      </a>
</div>

<?php include 'include/nav.php';?>

<body onload="carouselStart()" class="body">
      <div class="container">

            <div class="row">
                  <div class="col-sm-12">

                        <!-- Jumbotron -->
                        <div class="jumbotron" id="jumbo-top">
                              <h1 class="display-4">Hello
                                    <?php echo $_SESSION['gatekeeper']['username']; ?>!
                              </h1>
                              <p class="lead">DietFix is a community-driven recipe sharing website. Explore the catalogue of user-contributed
                                    recipes. Upload your own and receive feedback from other users through comments.</p>
                        </div>

                  </div>
            </div>

            <div class="section-main">

                  <!-- Most Favouirted recipes -->
                  <div class="col-sm" id="homemodules">
                        <h6 id="infotext">Most Favourited - All Time</h6>

                        <?php
                        //Query that searches all time most favourites recipes
                        $most_favourited = $conn->query("SELECT r.title, r.username, r.image, f.recipeid, count(*) as fav_total FROM df_favourites f LEFT JOIN df_recipes r ON r.id = f.recipeid GROUP BY f.recipeid ORDER BY fav_total DESC LIMIT 3");
                        ?>

                              <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">

                                        <?php
                                        //Fetches 3 records for carousel
                                        while ($most_fav = $most_favourited->fetch()) {
                                        ?>

                                                <div class="carousel-item" id="myCarousel">
                                                      <a href="recipepage.php?id=<?php echo $most_fav['recipeid']; ?>">
                                                            <img class="d-block" src="<?php echo $most_fav['image']; ?>">
                                                      </a>
                                                      <div class="carousel-caption">
                                                            <h2>
                                                                  <a href="recipepage.php?id=<?php echo $most_fav['recipeid']; ?>" id="Carouseltext">
                                                                        <?php echo $most_fav['title']; ?>
                                                                  </a>
                                                            </h2>
                                                            <p id="Carouseltext-small">Contributed by
                                                                  <?php echo $most_fav['username']; ?>
                                                            </p>
                                                      </div>
                                                </div>

                                            <?php }; //list or recipes loop ends ?>
                                    </div>

                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true" style="color:red;"></span>
                                          <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="sr-only">Next</span>
                                    </a>
                              </div>
                  </div>

                  <div class="col-sm" id="homemodules">

                        <!-- List of recipes -->
                        <h2 class="section-title">Recipe List</h2>
                        <h6 id="infotext">All Recipes</h6>
                        <input class="form-control form-control-lg" id="myInput" onkeyup="searchRecipe()" type="text" placeholder="Search...">
                        <div class="recipelist">

                            <?php
                            //Selects all from df_recipes
                            $results = $conn->query("SELECT * from df_recipes ORDER BY RAND()");
                            ?>

                                    <table class='table table-hover' id='myTable'>
                                          <thead>
                                                <tr>
                                                      <th scope='col' id='table-heading'>Title</th>
                                                      <th scope='col' id='table-heading' class='table-user'>User</th>
                                                      <th scope='col' id='table-heading'>Cooking Time</th>
                                                      <th scope='col' id='table-heading'>Calories
                                                            <a id='font-weight-normal'> (kcal)</a>
                                                      </th>
                                                </tr>
                                          </thead>
                                          <tbody>

                                                <?php
                                                //Echos results in table
                                                while ($row = $results->fetch()) {
                                                $id = $row['id'];
                                                ?>

                                                      <tr>
                                                            <td>
                                                                  <a href='recipepage.php?id=<?php echo $id; ?>' class='title'>
                                                                        <?php echo $row['title']; ?>
                                                                  </a>
                                                            </td>
                                                            <td class='table-user'>
                                                                  <?php echo $row['username']; ?>
                                                            </td>
                                                            <td>
                                                                  <?php echo $row['cookingtime']; ?>
                                                            </td>
                                                            <td>
                                                                  <?php echo $row['calories']; ?>
                                                            </td>
                                                      </tr>

                                                    <?php }; //list or recipes loop ends ?>
                                          </tbody>
                                    </table>
                        </div>
                        <div class="col-sm" id="homemodules">

                            <!-- Most Favourited Recipes -->
                            <?php
                            //Query to count favourite and create new row (most_fav), order by most_fav and JOIN with df_recipes to get recipe information
                            $trending = $conn->query("SELECT f.recipeid, r.title, r.username, r.image, count(*) as fav_total FROM df_favourites f JOIN df_recipes r ON r.id = f.recipeid WHERE f.datetime >=  DATE(NOW()) - INTERVAL 7 DAY GROUP BY f.recipeid ORDER BY fav_total DESC LIMIT 3");
                            ?>

                                    <h2 class="section-title">Trending Recipes</h2>
                                    <h6 id="infotext">Most Favourited - Last 7 Days</h6>
                                    <div class="card-deck" id="small-pad">

                                        <?php
                                        //Loops 3 times creating 3 most favourited cards
                                        while ($recipe_trends = $trending->fetch()) {
                                        ?>

                                                <div class="card">
                                                      <a href="recipepage.php?id=<?php echo $recipe_trends['recipeid']; ?>">
                                                            <img class="card-img-top" src="<?php echo $recipe_trends['image']; ?>" alt="Card image cap">
                                                      </a>
                                                      <div class="card-body">
                                                            <h5 class="card-title">
                                                                  <a href="recipepage.php?id=<?php echo $recipe_trends['recipeid']; ?>">
                                                                        <?php echo $recipe_trends['title']; ?>
                                                                  </a>
                                                            </h5>
                                                            <p class="card-text">
                                                                  <small class="text-muted">Submitted by
                                                                        <?php echo $recipe_trends['username']; ?>
                                                                  </small>
                                                            </p>
                                                      </div>
                                                </div>

                                            <?php } ; //Most favourited loop ends ?>

                                    </div>
                        </div>
                        <div class="col-sm" id="homemodules">

                            <!-- Random Selection Of Recipes -->
                            <?php
                            //Query to randomly select 3 recipes from df_recipes
                            $random_results = $conn->query("SELECT * FROM df_recipes ORDER BY RAND() LIMIT 3");
                            ?>

                                    <h2 class="section-title">Random Selection of Recipes</h2>
                                    <h6 id="infotext">Random Selection of Recipes</h6>
                                    <div class="card-deck" id="small-pad">

                                        <?php
                                        //Loops 3 times creating 3 randomized recipe cards
                                        while ($random = $random_results->fetch()) {
                                        ?>

                                                <div class="card">
                                                      <a href="recipepage.php?id=<?php echo $random['id']; ?>">
                                                            <img class="card-img-top" src="<?php echo $random['image']; ?>" alt="Card image cap">
                                                      </a>
                                                      <div class="card-body">
                                                            <h5 class="card-title">
                                                                  <a href="recipepage.php?id=<?php echo $random['id']; ?>">
                                                                        <?php echo $random['title']; ?>
                                                                  </a>
                                                            </h5>
                                                            <p class="card-text">
                                                                  <small class="text-muted">Submitted by
                                                                        <?php echo $random['username']; ?>
                                                                  </small>
                                                            </p>
                                                      </div>
                                                </div>

                                            <?php }; //randomized recipe loop ends ?>
                                    </div>
                        </div>
                  </div>

            </div>
</body>

<?php include 'include/footer.php';?>

</div>

</div>

</html>

<script>
    
      // Carousel Options
      //Add actice class to carousel
      function carouselStart() {
            var element = document.getElementById("myCarousel");
            element.classList.add("active");
      }

      //Carousel Interval timer
      $('.carousel').carousel({
            interval: 5000
      })

</script>