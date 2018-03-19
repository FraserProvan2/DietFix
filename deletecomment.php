<?php

require 'include/user_auth.php';

// Fraser Provan 18/03/2018
// deletecomment.php - deletes comments from recipe page

//Gets id of chosen recipe
$id = $_GET['comment_id'];

// Queries to delete recipe from df_recipes and relevent ties
$conn->query("DELETE FROM df_comments WHERE id = '$id'");