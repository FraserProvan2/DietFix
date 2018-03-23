<?php session_start();
include 'include/db.php';

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type='text/javascript' src='scripts/goback.js'></script>
<div class="container" style="padding-top:10px;">

<?php

// Gets user input
$userid = $_SESSION['gatekeeper']['id'];
$currentpassword  = htmlentities($_POST["currentpassword"]);
$newpassword  = htmlentities($_POST["newpassword_1"]);
$newpassword2 = htmlentities($_POST["newpassword_2"]);

// Selects users data
$users = $conn->query("SELECT * FROM df_users WHERE id = '$userid'");
$checked_users = $users->fetch();

// Checks if the users input matches hashed password
$checked = password_verify($currentpassword, $checked_users['password']);

// Hashes new password
$newhashed_pass = password_hash($newpassword, PASSWORD_DEFAULT);

// Checks if current password is correct
if ($checked == false) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Incorrect Password";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
}

// Checks if new password or new password confirmation is empty
else if ($newpassword == false OR $newpassword2 == false){
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Please enter new password and confirm";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
}

// Checks if new password and password confirmation match
else if ($newpassword !== $newpassword2) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "New password doesn't match confirmation";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
}

// Updates users password information
else {
    // Updates recipe information (Using prepared statement)
    $change_pass = $conn->prepare("UPDATE df_users SET password = ? WHERE id = ?");
    $change_pass->bindParam(1, $newhashed_pass);
    $change_pass->bindParam(2, $userid);
    $change_pass->execute();
    echo "<div class='alert alert-success' role='alert'>";
    echo "Password Updated!";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
}

?>

</div>