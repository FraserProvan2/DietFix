<?php

// First session start
session_start();

// Fraser Provan 23/02/2018
// signin.php - Signs user in

//Connects to Database
$conn = new PDO("mysql:host=localhost;dbname=medotusc_dietfix;", "medotusc_fraser", "NHD4?oWU5Bpo");

// Gets users login info (in prepared statement)
$username  = htmlentities($_GET["user"]);
$password  = htmlentities($_GET["pass"]);

// Rehash 
$hashedPwdInDb = password_hash($password, PASSWORD_DEFAULT);

// Query to check username
$statement = $conn->prepare("SELECT * FROM df_users WHERE username=:theusername");
$statement->bindParam(":theusername", $username);
$statement->execute();
$row = $statement->fetch();

// Checks theres a username
if ($username == false) {
}
// Checks theres a password
else if ($password == false) {
    echo "Please enter a Password";
}
// If username is valid assign to session + open homepage
    // Check if password matches hashed PW (algorithm to see if it corresponds to the given hash)
    else if (password_verify($password, $row['password'])) {
    $session_array          = array('id' => $row['id'], 'username' => $row['username']);
    $_SESSION['gatekeeper'] = $session_array;
    header('location: index.php');
    
}
// If details are incorrect
else {
    echo "Username or Password is Incorrect";
}