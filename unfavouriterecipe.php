<?php session_start();
include 'include/db.php';?>

<!--
Fraser Provan 08/03/2018
unfavouriterecipe.php - unfavourites recipe (My Account)
-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type='text/javascript' src='scripts/goback.js'></script>
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="container" style="padding-top:10px;">
<div class='alert alert-success' role='alert'>

<?php

// Gets recipes id and user id
$id     = $_GET['recipeid'];
$userid = $_GET['userid'];

// Query to delete from df_favourites
$conn->query("DELETE FROM df_favourites WHERE recipeid = '$id' AND userid = '$userid'");

// Link to return to my account
echo "Recipe unfavourited!";
echo "<br><br>";
echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";

?>

</div>
</div>