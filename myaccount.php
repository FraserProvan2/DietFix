<?php session_start();
include 'include/db.php';
require 'include/check-user.php';
?>


<!--
Fraser Provan 04/03/2018
MyAccount.php - Users Manage uploaded and favourited recipes (bootstrap remake)
-->

<!doctype html>
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
    <a href="index.php">
        <img src="img/logo/dietfix-logo.png" class="logo">
    </a>
</div>

<?php include 'include/nav-user.php';?>

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

                        $username = $_SESSION['gatekeeper']['username'];

                        //Selects all from recipes when username is the same (for error "you have no uploaded meals")
                        $check = $conn->prepare("SELECT * from df_recipes WHERE ? = username"); 
                        $check->bindParam(1, $username);
                        $check->execute();
                        $check_fetched = $check->fetch();
                        
                        //Selects all from recipes when username is the same (for list of meals)
                        $results = $conn->prepare("SELECT * from df_recipes WHERE ? = username"); 
                        $results->bindParam(1, $username);
                        $results->execute();

                        //Checks if they have any uploaded meals yet
                        if ($check_fetched != true) {
                            echo "You have no uploaded recipes yet!";
                        }
                        else {
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
                                        <a href='updaterecipe.php?id=<?php echo $id; ?>'>Edit Recipe</a>
                                    </td>
                                    <td>
                                        <a href='deleterecipe.php?id=<?php echo $id; ?>' onclick='return deleteRecipe()' class='text-red'>Delete Recipe</a>
                                    </td>

                                </tr>
                                <?php } //My recipes table end (Outside of loop) ?>
                            </tbody>
                        </table>
                        <?php } //checks if they have any uploaded meals ends ?>

                        <!-- My Favourites -->
                        <h4 class="section-title">My Favourites</h4>

                        <?php
                            //Gets user ID
                            $userid = $_SESSION['gatekeeper']['id'];

                            //Left Join to select data from df_recipes and df_favourites (For error "you dont have any favourites")
                            $fav_check = $conn->prepare("SELECT f.*, r.id,r.username, r.title FROM df_favourites f JOIN df_recipes r ON r.id = f.recipeid WHERE f.userid = ?");
                            $fav_check->bindParam(1, $userid);
                            $fav_check->execute();
                            $fav_checkfetched = $fav_check->fetch();    

                            //Left Join to select data from df_recipes and df_favourites (For list of favourites)
                            $favourites = $conn->prepare("SELECT f.*, r.id,r.username, r.title FROM df_favourites f JOIN df_recipes r ON r.id = f.recipeid WHERE f.userid = ?"); 
                            $favourites->bindParam(1, $userid);
                            $favourites->execute();
                            
                            //Checks if they have any uploaded recipes yet
                            if ($fav_checkfetched != true) {
                                echo "You have no favourites yet!";
                            }
                            else {
                            
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
                            <?php } //checks if they have any favourites ends ?>

                            <h4 class="section-title">Account Settings</h4>
                            <p>Change Password</p>
                            <form method='POST' action='changepassword.php'>
                                <div class="form-group">
                                    <input class="form-control form-control" type="password" placeholder="Current Password" name="currentpassword" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control" type="password" placeholder="New Password" name="newpassword_1" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control" type="password" placeholder="Confirm New Password" name="newpassword_2" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn btn-outline-success" id="btn">Change Password</button>
                                </div>
                            </form>
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