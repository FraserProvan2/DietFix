<?php
session_start();
include 'include/db.php';

// Fraser Provan 08/03/2018
// deleterecipe.php - deletes recipe (My Account)

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container" style="padding-top:10px;">
<div class='alert alert-success' role='alert'>

<?php

// Gets id of chosen recipe
$id = $_GET['id'];

//deletes recipe from df_recipes
$delete_recipes = $conn->prepare("DELETE FROM df_recipes WHERE id = ?");
$delete_recipes->bindParam(1, $id);
$delete_recipes->execute();

//deletes recipe from df_steps2
$delete_steps = $conn->prepare("DELETE FROM df_steps2 WHERE recipeid = ?");
$delete_steps->bindParam(1, $id);
$delete_steps->execute();

//deletes recipe from df_favourites
$delete_favourites = $conn->prepare("DELETE FROM df_favourites WHERE recipeid = ?");
$delete_favourites->bindParam(1, $id);
$delete_favourites->execute();

//Link to return to my account
echo "Recipe Deleted, return to <a href='myaccount.php'>My Account</a>";

?>

</div>
</div>