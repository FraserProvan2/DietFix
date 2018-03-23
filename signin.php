<?php

// First session start
session_start();

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type='text/javascript' src='scripts/goback.js'></script>
<div class="container" style="padding-top:10px;">
<?php

// Fraser Provan 23/02/2018
// signin.php - Signs user in

// Connects to Database
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
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Please enter a Username";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";
    echo "</div>";
}
// Checks theres a password
else if ($password == false) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Please enter a Password";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";
    echo "</div>";
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
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Username or Password is Incorrect";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";
    echo "</div>";
}

?>

</div>