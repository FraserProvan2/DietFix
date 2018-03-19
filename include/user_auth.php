<?php

//Keeps session
session_start();

// Fraser Provan 24/02/2018
// include/user_auth - This makes sure only users can view the site AND the session is kept

//Connects to Database
$conn = new PDO("mysql:host=localhost;dbname=medotusc_dietfix;", "medotusc_fraser", "NHD4?oWU5Bpo");

// Test that the authentication session variable exists
if (!isset($_SESSION["gatekeeper"])) {
    echo "<div class='alert alert-danger' role='alert'>";
    header("HTTP/1.1 401 UNAUTHORIZED");
    echo "You are not logged in, ";
    echo "<a style='margin-top:10px' href='index.php'>Return to Login</a>";
    echo "</div>";
    die();
}