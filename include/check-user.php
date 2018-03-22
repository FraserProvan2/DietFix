<!--
Fraser Provan 22/03/2018
include/check-user.php - Checks if user is signed in to view restricted pages
-->

<?php 

if (!isset($_SESSION["gatekeeper"])) {
   header('location: index.php');
}

?>