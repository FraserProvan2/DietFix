<?php session_start();
include 'include/db.php';?>

<!--
Fraser Provan 18/03/2018
updateimage.php - Updates recipe image
-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container" style="padding-top:10px;">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type='text/javascript' src='scripts/goback.js'></script>

<?php

$id       = $_POST['id'];
$username = $_SESSION['gatekeeper']['username'];

// Upload Script
$check = getimagesize($_FILES["upload"]["tmp_name"]);
$dir   = "img/upload/"; //Location to be saved
@mkdir($dir, 0777, true); //Makes folder, 0777 = not read only
$original_filename = basename($_FILES['upload']['name']); //Gets original filename
$ext               = substr($original_filename, strrpos($original_filename, '.')); //Gets extentsion
$file_target       = $dir . $username . time() . '-' . uniqid() . $ext; //Gives image a new name
$uploadOk          = 1;
$imageFileType     = strtolower(pathinfo($file_target, PATHINFO_EXTENSION)); //Makes sure its image

// If file is image
if ($check !== false) {
    $uploadOk = 1;
} else {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "File is not an image.";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";
    echo "</div>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["upload"]["size"] > 500000) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Sorry, your file is too large.";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";
    echo "</div>";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {

    // Only allows these file types
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn' id='notifcation-btn'>Go Back</button>";
    echo "</div>";
    $uploadOk = 0;
}

// Upload file + Update table
if (move_uploaded_file($_FILES["upload"]["tmp_name"], $file_target)) {

    // Updates image location in df_recipes table
    $conn->query("UPDATE df_recipes SET image = '$file_target' WHERE id = '$id'");
    echo "<div class='alert alert-success' role='alert'>";
    echo "Image Updated";
    echo "<br><br>";
    echo "<form action='index.php'><input type='submit' value='Return Home' class='btn' id='btn'/></form>";
    echo "</div>";
}

?>

</div>