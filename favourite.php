<?php
session_start();
include 'include/db.php';

// Fraser Provan 04/03/2018
// favourite.php - Favourites recipes

// Gets user and recipe information
$userid    = $_GET['userid_favourite'];
$recipe_id = $_GET['recipe_id_favourite'];

// Searches df_favourites to see if recipe is already favourited
$selectrecipes = $conn->prepare("SELECT * from df_favourites WHERE ? = userid AND ? = recipeid");
$selectrecipes->bindParam(1, $userid);
$selectrecipes->bindParam(2, $recipe_id);
$selectrecipes->execute();
$row = $selectrecipes->fetch();

// Checks if already favourited
if ($row !== true) {

    // Inserts favourite into table
    $insert_comment = $conn->prepare("INSERT INTO df_favourites (userid, recipeid) VALUES (?, ?)");
    $insert_comment->bindParam(1, $userid);
    $insert_comment->bindParam(2, $recipe_id);
    $insert_comment->execute();
}
