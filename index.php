<?php
session_start();
include 'include/db.php';

//Fraser Provan - 22/03/18 (New version)
//index.php - homepage (formally main.php (index was login THEN homepage)

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="img/logo/favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type='text/javascript' src='scripts/search.js'></script>
    <script type='text/javascript' src='scripts/index.js'></script>
    <title>DietFix - Home</title>
</head>

<div class="container-fluid background">
    <!-- Logo with link to index -->
    <a href="index.php">
        <img src="img/logo/dietfix-logo.png" class="logo">
    </a>
</div>

<?php 
// Chooses which nav to use
if (!isset($_SESSION["gatekeeper"])) {
    include 'include/nav-guest.php';
}

else {
    include 'include/nav-user.php';
}
?>

<body onload="carouselStart()" class="body">
    <div class="container">

        <div class="section-main">
            <div class="row">
                <div class="col-sm-8">

                    <!-- Most Favouirted recipes -->
                    <h6 id="infotext">Most Favourited - All Time</h6>

                    <?php
                        // Query that searches all time most favourites recipes
                        $most_favourited = $conn->query("SELECT r.title, r.username, r.image, f.recipeid, count(*) as fav_total FROM df_favourites f LEFT JOIN df_recipes r ON r.id = f.recipeid GROUP BY f.recipeid ORDER BY fav_total DESC LIMIT 3");
                        ?>

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">

                                <?php
                                        // Fetches 3 records for carousel
                                        while ($most_fav = $most_favourited->fetch()) {
                                        ?>

                                    <div class="carousel-item" id="myCarousel" style="max-height: 357px;" >
                                        <a href="recipepage.php?id=<?php echo $most_fav['recipeid']; ?>">
                                            <img class="d-block" src="<?php echo $most_fav['image']; ?>">
                                        </a>
                                        <div class="carousel-caption">
                                            <h3>
                                                <a href="recipepage.php?id=<?php echo $most_fav['recipeid']; ?>" id="Carouseltext">
                                                    <?php echo $most_fav['title']; ?>
                                                </a>
                                            </h3>
                                            <p id="Carouseltext-small">Contributed by
                                                <?php echo $most_fav['username']; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <?php }; // list or recipes loop ends ?>
                            </div>

                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>

                </div>

                <?php

                    // Chooses which content to display (Sign Up or welcome message)
                    if (!isset($_SESSION["gatekeeper"])) {
                    ?>
                    <!-- Sign Up -->
                    <div class="col-sm-4">
                    <div class="section-sub" style="background-color: #e9ecef">
                        <h3 class="section-title">Sign Up</h3>
                        <form class="signup">
                            <div class="form-group">
                                <input class="form-control form-control" type="text" placeholder="Username" id="username" />
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control" type="password" placeholder="Password" id="password" />
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control" type="password" placeholder="Confirm Password" id="password2" />
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control" type="email" placeholder="Email Address" id="email" />
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-outline-success" onclick="signup()" id="btn">Create Account</button>
                            </div>
                            <div id='signup-response'><br></div>
                            
                        </form>
                    </div>
                    </div>
                    <?php    
                    } else {
                    ?>
                    <!-- Welcome Message -->
                    <div class="col-sm-4">
                        <div class="jumbotron jumbotron-fluid">
                            <h2 class="display-4">Hello
                                <?php echo $_SESSION['gatekeeper']['username']; ?>! </h2>
                            <p class="lead">DietFix is a community-driven recipe sharing website. Explore the catalogue of user-contributed
                                recipes. Upload your own and receive feedback from other users through comments.</p>
                            <p class="lead">Disclaimer: The content on this website is for demonstration purposes only.</p>
                        </div>
                    </div>

                    <?php } ?>

            </div>
            <div class="row">

                <!-- Recipe List -->
                <div class="col">
                    <h3 class="section-title">Recipe List</h3>
                    <h6 id="infotext">All Recipes</h6>
                    <input class="form-control form-control-lg" id="myInput" onkeyup="searchRecipe()" type="text" placeholder="Search...">
                    <div class="recipelist">

                        <?php
                            // Selects all from df_recipes
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
                                        // Displays results in table
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

                                        <?php }; // list or recipes loop ends ?>
                                </tbody>
                            </table>

                    </div>

                </div>

            </div>

            <!-- Most Favourited Recipes -->
            <div class="row">
                <div class="col">
                    <?php
                            // Query to count favourite and create new row (most_fav), order by most_fav and JOIN with df_recipes to get recipe information
                            $trending = $conn->query("SELECT f.recipeid, r.title, r.username, r.image, count(*) as fav_total FROM df_favourites f JOIN df_recipes r ON r.id = f.recipeid WHERE f.datetime >=  DATE(NOW()) - INTERVAL 7 DAY GROUP BY f.recipeid ORDER BY fav_total DESC LIMIT 3");
                            ?>

                        <h3 class="section-title">Trending Recipes</h3>
                        <h6 id="infotext">Most Favourited - Last 7 Days</h6>
                        <div class="card-deck" id="small-pad">

                                <?php
                                // Loops 3 times creating 3 most favourited cards
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

                                <?php } ; // Most favourited loop ends ?>

                        </div>

                </div>
            </div>

            <!-- Random Selection Of Recipes -->
            <div class="row">
                <div class="col">

                        <?php
                        // Query to randomly select 3 recipes from df_recipes
                        $random_results = $conn->query("SELECT * FROM df_recipes ORDER BY RAND() LIMIT 3");
                        ?>

                        <h3 class="section-title">Random Selection of Recipes</h3>
                        <h6 id="infotext">Random Selection of Recipes</h6>
                        <div class="card-deck" id="small-pad">

                                <?php
                                // Loops 3 times creating 3 randomized recipe cards
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
        <?php include 'include/footer.php'; ?>

</body>

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