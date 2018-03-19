<?php require 'include/user_auth.php'; ?>
<!--
Fraser Provan 04/03/2018
MyAccount.php - Users Manage uploaded and favourited recipes (bootstrap remake)
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
    <title>DietFix - <?php echo ucfirst($_SESSION['gatekeeper']['username']); ?>'s Account</title>
</head>

<div class="container-fluid background">
    <!-- Logo with link to index -->
    <a href="main.php">
        <img src="img/logo/dietfix.png" class="logo">
    </a>
</div>

<?php include 'include/nav.php';?>

<body class="body">
    <div class="container">
        <div class="section-main">
            <div class="row">
                <div class="col-sm-12">

                    <div class="section-heading">

                        <h1>
                            <?php echo ucfirst($_SESSION['gatekeeper']['username']); ?>'s Account
                            <h1>
                                <h6>Manage your uploaded and favourited recipes</h6>
                    </div>
                </div>
                <div class="col-sm">
                    <!-- My Recipes -->
                    <h4 class="section-title">My Recipes</h4>

                        <?php
                        //Selects all from recipes when username is the same
                        $username = $_SESSION['gatekeeper']['username'];
                        $results = $conn->query("SELECT * from df_recipes WHERE '$username' = username"); 
                        ?>

                        <table class='table table-hover' id='myTable'>
                            <col>
                            <thead>
                                <tr>
                                    <th scope='col' id='table-heading' width="60%;">Recipe Title</th>
                                    <th scope='col' id='table-heading' width="20%;"></th>
                                    <th scope='col' id='table-heading' width="20%;"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                //Looped data
                                while ($row = $results->fetch()) {
                                $id = $row['id']; //Used for deleting recipes
                                ?>

                                <tr>
                                    <td>
                                        <a href='recipepage.php?id=<?php echo $id; ?>' class='title'>
                                            <?php echo $row['title']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='deleterecipe.php?id=<?php echo $id; ?>' onclick='return deleteRecipe()'>Delete Recipe</a>
                                    </td>
                                    <td>
                                        <a href='updaterecipe.php?id=<?php echo $id; ?>'>Edit Recipe</a>
                                    </td>
                                </tr>

                                <?php } //My recipes table end (Outside of loop) ?>

                            </tbody>
                        </table>

                        <!-- My Favourites -->
                        <h4 class="section-title">My Favourites</h4>

                            <?php
                            //Gets user ID
                            $userid = $_SESSION['gatekeeper']['id'];

                            //Left Join to select data from df_recipes and df_favourites
                            $favourites = $conn->query("SELECT f.*, r.id,r.username, r.title FROM df_favourites f JOIN df_recipes r ON r.id = f.recipeid WHERE f.userid = $userid"); 
                            ?>

                            <table class='table table-hover' id='myTable'>
                                <col>
                                <thead>
                                    <tr>
                                        <th scope='col' id='table-heading' width="60%;">Recipe Title</th>
                                        <th scope='col' id='table-heading' width="40%;"> </th>
                                    </tr>
                                </thead>
                                <tbody>

                                        <?php
                                        //Looped data
                                        while ($favourited = $favourites->fetch()) {
                                                      
                                        $userid = $_SESSION['gatekeeper']['id'];
                                        $id = $favourited['id']; //used for unfavouriting
                                        ?>

                                        <tr>
                                            <td>
                                                <a href='recipepage.php?id=<?php echo $id; ?>' class='title'>
                                                    <?php echo $favourited['title']; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href='unfavouriterecipe.php?recipeid=<?php echo $id; ?>&amp;userid=<?php echo $userid; ?>' onclick='return unfavouriteRecipe()'>Unfavourite Recipe</a>
                                            </td>
                                        </tr>

                                        <?php } //my favourites loop ends ?>

                                </tbody>
                            </table>
                </div>
            </div>
        </div>

        <?php include 'include/footer.php';?>

    </div>
    <script>

        //Confirmation for deleting recipes
        function deleteRecipe() {
            var unFavourite = confirm("Are you sure you want to delete this recipe?");
            if (unFavourite) {
                return true;

                //Runs delete recipe script
                window.location.replace("deleterecipe.php?id=" + <?php echo $id; ?> +"");
            }
            else {
                return false;
            }
        }

        //Confirmation for unfavouriting
        function unfavouriteRecipe() {
            var unFavourite = confirm("Are you sure you want to unfavourite this recipe?");
            if (unFavourite) {
                return true;

                //Runs unfavourite recipe script
                window.location.replace("unfavouriterecipe.php?recipeid=" + <?php echo $id; ?> + "&amp;userid=" + <?php echo $userid; ?> +"");
            }
            else {
                return false;
            }
        }
    </script>

</body>

</html>