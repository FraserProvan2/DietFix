<?php

// Keeps session
session_start();

// Fraser Provan 23/02/2018
// signout.php - Signs user out

// Destroys the session
session_destroy();
unset($_SESSION['gatekeeper']);

// Sends user back to homepage
header('location: index.php');
