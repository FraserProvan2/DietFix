<?php

// First session start
session_start();

// Fraser Provan 23/02/2018
// signin.php - Signs user in

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container" style="padding-top:10px;">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type='text/javascript' src='scripts/goback.js'></script>

<?php

//Connects to Database
$conn = new PDO("mysql:host=localhost;dbname=medotusc_dietfix;", "medotusc_fraser", "NHD4?oWU5Bpo");

// Gets users login info (in prepared statement)
$username  = htmlentities($_GET["user"]);
$password  = htmlentities($_GET["pass"]);
$statement = $conn->prepare("SELECT * FROM df_users WHERE username=:theusername AND password=:thepassword");
$statement->bindParam(":theusername", $username);
$statement->bindParam(":thepassword", $password);
$statement->execute();
$row = $statement->fetch();

// Checks theres a username
if ($username == false) {
    header("HTTP/1.1 400 BAD REQUEST");
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Please enter a Username";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";
    echo "</div>";
}

// Checks theres a password
else if ($password == false) {
    header("HTTP/1.1 400 BAD REQUEST");
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Please enter a Password";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";
    echo "</div>";
}

// If username is valid assign to session + open homepage
else if ($row != false) {
    header("HTTP/1.1 200 OK");
    $session_array = array(
        'id'       => $row['id'],
        'username' => $row['username'],
    );
    $_SESSION['gatekeeper'] = $session_array;
    echo "<script> window.location='main.php'</script>";
}

// If details are incorrect
else
if ($row == false) {
    header("HTTP/1.1 400 BAD REQUEST");
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Username or Password is Incorrect";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";
    echo "</div>";
}