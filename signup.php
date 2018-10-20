<?php

// Fraser Provan 03/02/2018
// signup.php - Signs user up

// Connects to Database
$conn = new PDO();

?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<script type='text/javascript' src='scripts/goback.js'></script>

<?php

// Gets users sign up info
$username  = htmlentities(ucfirst($_GET["username"]));
$password  = htmlentities($_GET["password"]);
$password2 = htmlentities($_GET["password2"]);
$email     = htmlentities($_GET["email"]);

// Used later to check if user already exists
$check_username = $conn->prepare("SELECT * FROM df_users WHERE username = ?");
$check_username->bindParam(1, $username);
$check_username->execute();
$rows_username = $check_username->fetch();

// Used later to check if email is in use
$check_email = $conn->prepare("SELECT * FROM df_users WHERE email = ?");
$check_email->bindParam(1, $email);
$check_email->execute();
$rows_email = $check_email->fetch();

// Checks theres a Username
if ($username == false) {
    echo "Please enter a Username";
}

// To check if user exists
else if ($rows_username['username'] === $username) {
    echo "User already exists";
}

// To check if email exists
else if ($rows_email['email'] === $email) {
    echo "Email already registered";
}

// Checks theres a Password
else if ($password == false) {
    echo "Please enter a Password";
}

// Checks if Passwords match
else if ($_GET["password"] != $_GET["password2"]) 
{
    echo ("Passwords do not match!");
}

// Checks theres a Email
else if ($email == false) 
{
    echo "Please enter Email";
} 
else 
{
    // Hashes password
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    // Query to insert new email into df_users
    $statement = $conn->prepare("INSERT INTO df_users (username, password, email) VALUES (?, ?, ?)");
    $statement->bindParam(1, $username);
    $statement->bindParam(2, $hashed_pass);
    $statement->bindParam(3, $email);
    $statement->execute();
    echo "<a style='color:#4CAF50'>Account Created</a>";
}
