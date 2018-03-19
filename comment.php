<?php

require 'include/user_auth.php';

// Fraser Provan 02/03/2018
// comment.php - Submits comments

//Gets user info + comment info
$username  = $_SESSION['gatekeeper']['username'];
$userid    = $_SESSION['gatekeeper']['id'];
$comment   = htmlentities(ucfirst($_GET['comment']));
$recipe_id = htmlentities($_GET['recipeid']);

$statement = $conn->prepare("INSERT INTO df_comments (recipeid, comment, userid) VALUES (?, ?, ?)");
$statement->bindParam(1, $recipe_id);
$statement->bindParam(2, $comment);
$statement->bindParam(3, $userid);
$statement->execute();

?>

<link rel="stylesheet" type="text/css" href="css/style.css">
