<?php session_start();
include 'include/db.php';?>

<!--
Fraser Provan 23/02/2018
upload.php - Uploads users recipe
-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container" style="padding-top:10px;">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type='text/javascript' src='scripts/goback.js'></script>

<?php

// Gets users recipe info for df_recipes
$username    = $_SESSION['gatekeeper']['username'];
$userid      = $_SESSION['gatekeeper']['id'];
$title       = htmlentities(ucfirst($_POST["title"]));
$description = htmlentities(ucfirst($_POST["description"]));
$ingredients = htmlentities(ucfirst($_POST["ingredients"]));
$cookingtime = htmlentities($_POST["cookingtime"]);
$calories    = htmlentities($_POST["calories"]);

// Gets users steps for df_steps
$step1  = htmlentities(ucfirst($_POST["step1"]));
$step2  = htmlentities(ucfirst($_POST["step2"]));
$step3  = htmlentities(ucfirst($_POST["step3"]));
$step4  = htmlentities(ucfirst($_POST["step4"]));
$step5  = htmlentities(ucfirst($_POST["step5"]));
$step6  = htmlentities(ucfirst($_POST["step6"]));
$step7  = htmlentities(ucfirst($_POST["step7"]));
$step8  = htmlentities(ucfirst($_POST["step8"]));
$step9  = htmlentities(ucfirst($_POST["step9"]));
$step10 = htmlentities(ucfirst($_POST["step10"]));
$step11 = htmlentities(ucfirst($_POST["step11"]));
$step12 = htmlentities(ucfirst($_POST["step12"]));
$step13 = htmlentities(ucfirst($_POST["step13"]));
$step14 = htmlentities(ucfirst($_POST["step14"]));
$step15 = htmlentities(ucfirst($_POST["step15"]));
$error  = 0;

// Checks for title
if ($title == false) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Title is Required";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
    $error = 1;
}

// Checks for description
else if ($description == false) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Description is Required";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
    $error = 1;
}

// Checks for ingredients
else if ($ingredients == false) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Ingredients is Required";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
    $error = 1;
}

// Checks for cookingtime
else if ($cookingtime == false) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Cooking Time is Required";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
    $error = 1;
}

// Checks for calories
else if ($calories == false) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Calories is Required";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
    $error = 1;
} else if (isset($_FILES)) {

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
        echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
        echo "</div>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["upload"]["size"] > 500000) {
        echo "<div class='alert alert-danger' role='alert'>";
        echo "Sorry, your file is too large.";
        echo "<br><br>";
        echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
        echo "</div>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {

        //Only allows these file types
        echo "<div class='alert alert-danger' role='alert'>";
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        echo "<br><br>";
        echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
        echo "</div>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<div class='alert alert-danger' role='alert'>";
        echo "Sorry, your file was not uploaded.";
        echo "<br><br>";
        echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
        echo "</div>";

        // if everything is ok, try to upload file
    } else if (move_uploaded_file($_FILES["upload"]["tmp_name"], $file_target)) {

        // Inserts recipe details into df_recipes (Using prepard statement)
        $insert_recipeinfo = $conn->prepare("INSERT INTO df_recipes (username, userid, title, image, description, ingredients, cookingtime, calories) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_recipeinfo->bindParam(1, $username);
        $insert_recipeinfo->bindParam(2, $userid);
        $insert_recipeinfo->bindParam(3, $title);
        $insert_recipeinfo->bindParam(4, $file_target);
        $insert_recipeinfo->bindParam(5, $description);
        $insert_recipeinfo->bindParam(6, $ingredients);
        $insert_recipeinfo->bindParam(7, $cookingtime);
        $insert_recipeinfo->bindParam(8, $calories);
        $insert_recipeinfo->execute();

        // get recipeid from df_recipes (Selects the last entry)
        $results  = $conn->query("SELECT * FROM df_recipes ORDER BY id DESC LIMIT 1");
        $lastrow  = $results->fetch();
        $recipeid = $lastrow["id"];

        // Inserts steps into df_steps2
        if ($step1 != "") {
            $value1        = "1";
            $prepare_step1 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step1->bindParam(1, $recipeid);
            $prepare_step1->bindParam(2, $value1);
            $prepare_step1->bindParam(3, $step1);
            $prepare_step1->execute();
        }
        if ($step2 != "") {
            $value2        = "2";
            $prepare_step2 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step2->bindParam(1, $recipeid);
            $prepare_step2->bindParam(2, $value2);
            $prepare_step2->bindParam(3, $step2);
            $prepare_step2->execute();
        }
        if ($step3 != "") {
            $value3        = "3";
            $prepare_step3 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step3->bindParam(1, $recipeid);
            $prepare_step3->bindParam(2, $value3);
            $prepare_step3->bindParam(3, $step3);
            $prepare_step3->execute();
        }
        if ($step4 != "") {
            $value4        = "4";
            $prepare_step4 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step4->bindParam(1, $recipeid);
            $prepare_step4->bindParam(2, $value4);
            $prepare_step4->bindParam(3, $step4);
            $prepare_step4->execute();
        }
        if ($step5 != "") {
            $value5        = "5";
            $prepare_step5 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step5->bindParam(1, $recipeid);
            $prepare_step5->bindParam(2, $value5);
            $prepare_step5->bindParam(3, $step5);
            $prepare_step5->execute();
        }
        if ($step6 != "") {
            $value6        = "6";
            $prepare_step6 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step6->bindParam(1, $recipeid);
            $prepare_step6->bindParam(2, $value6);
            $prepare_step6->bindParam(3, $step6);
            $prepare_step6->execute();
        }
        if ($step7 != "") {
            $value7        = "7";
            $prepare_step7 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step7->bindParam(1, $recipeid);
            $prepare_step7->bindParam(2, $value7);
            $prepare_step7->bindParam(3, $step7);
            $prepare_step7->execute();
        }
        if ($step8 != "") {
            $value8        = "8";
            $prepare_step8 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step8->bindParam(1, $recipeid);
            $prepare_step8->bindParam(2, $value8);
            $prepare_step8->bindParam(3, $step8);
            $prepare_step8->execute();
        }
        if ($step9 != "") {
            $value9        = "9";
            $prepare_step9 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step9->bindParam(1, $recipeid);
            $prepare_step9->bindParam(2, $value9);
            $prepare_step9->bindParam(3, $step9);
            $prepare_step9->execute();
        }
        if ($step10 != "") {
            $value10        = "10";
            $prepare_step10 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step10->bindParam(1, $recipeid);
            $prepare_step10->bindParam(2, $value10);
            $prepare_step10->bindParam(3, $step10);
            $prepare_step10->execute();
        }
        if ($step11 != "") {
            $value11        = "11";
            $prepare_step11 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step11->bindParam(1, $recipeid);
            $prepare_step11->bindParam(2, $value11);
            $prepare_step11->bindParam(3, $step11);
            $prepare_step11->execute();
        }
        if ($step12 != "") {
            $value12        = "12";
            $prepare_step12 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step12->bindParam(1, $recipeid);
            $prepare_step12->bindParam(2, $value12);
            $prepare_step12->bindParam(3, $step12);
            $prepare_step12->execute();
        }
        if ($step13 != "") {
            $value13        = "13";
            $prepare_step13 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step13->bindParam(1, $recipeid);
            $prepare_step13->bindParam(2, $value13);
            $prepare_step13->bindParam(3, $step13);
            $prepare_step13->execute();
        }
        if ($step14 != "") {
            $value14        = "14";
            $prepare_step14 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step14->bindParam(1, $recipeid);
            $prepare_step14->bindParam(2, $value14);
            $prepare_step14->bindParam(3, $step14);
            $prepare_step14->execute();
        }
        if ($step15 != "") {
            $value15        = "15";
            $prepare_step15 = $conn->prepare("INSERT INTO df_steps2 (recipeid, stepid, instruction) VALUES (?, ?, ?)");
            $prepare_step15->bindParam(1, $recipeid);
            $prepare_step15->bindParam(2, $value15);
            $prepare_step15->bindParam(3, $step15);
            $prepare_step15->execute();
        }
        echo "<div class='alert alert-success' role='alert'>";
        echo "Meal Uploaded!";
        echo "<br><br>";
        echo "<form action='index.php'><input type='submit' value='Return Home' class='btn btn-outline-success' id='btn'/></form>";
        echo "</div>";
    }

// Catches any other errors
} else {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Sorry, there was an error uploading your file.";
    echo "<br><br>";
    echo "<button onclick='goBack()' class='btn btn-outline-success' id='btn'>Go Back</button>";
    echo "</div>";
}

?>

</div>