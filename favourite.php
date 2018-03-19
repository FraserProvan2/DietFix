<?php

require 'include/user_auth.php';

// Fraser Provan 04/03/2018
// favourite.php - Favourites recipes

//Gets user and recipe information
$userid    = $_GET['userid_favourite'];
$recipe_id = $_GET['recipe_id_favourite'];

//Searches df_favourites to see if recipe is already favourited
$results = $conn->query("SELECT * from df_favourites WHERE $userid = userid AND $recipe_id = recipeid");
$row     = $results->fetch();

//Checks if already favourited
if ($row == true) {
    echo "<a id='error-font'>Recipe Already Favourited! Manage Favourites on <a href='myaccount.php'>My Account</a></a>";
}

//Favourites Recipe
else {
    $insert_comment = $conn->query("INSERT INTO df_favourites (userid, recipeid) VALUES ('$userid', '$recipe_id')");
    echo "<a id='success-font'>Recipe Favourited</a>";
}

?>

<link rel="stylesheet" type="text/css" href="css/style.css">
