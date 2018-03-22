<?php
session_start();
include 'include/db.php';

// Fraser Provan 18/03/2018
// deletecomment.php - deletes comments from recipe page

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container" style="padding-top:10px;">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type='text/javascript' src='scripts/goback.js'></script>

<?php

//Gets id of chosen recipe
$id = (int)$_POST['comment_id'];

// Queries to delete recipe from df_recipes and relevent ties
$sql = $conn->prepare("DELETE FROM df_comments WHERE id = :id");
$sql->bindParam(':id', $id);
$sql->execute();

echo "<div class='alert alert-success' role='alert'>";
echo "Comment Deleted";
echo "<br><br>";
echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";

echo "</div>";
