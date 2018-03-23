<?php session_start();
include 'include/db.php';
?>

<!--
Fraser Provan 18/03/2018
updateinfo.php - Updates general information and cooking instructions
-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container" style="padding-top:10px;">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type='text/javascript' src='scripts/goback.js'></script>

<?php

// Gets users recipe info for df_recipes
$id          = $_POST['recipe_id'];
$username    = $_SESSION['gatekeeper']['username'];
$userid      = $_SESSION['gatekeeper']['id'];
$title       = htmlentities(ucfirst($_POST["title"]));
$description = htmlentities(ucfirst($_POST["description"]));
$ingredients = htmlentities(ucfirst($_POST["ingredients"]));
$cookingtime = htmlentities($_POST["cookingtime"]);
$calories    = htmlentities($_POST["calories"]);

// Gets users steps for df_steps
$stepid = $_POST['stepid'];
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
} else {

    // Updates recipe information (Using prepared statement)
    $updateinfo = $conn->prepare("UPDATE df_recipes SET username = ?, userid = ?, title = ?, description = ?, ingredients = ?, cookingtime = ?, calories = ? WHERE id = '$id'");
    $updateinfo->bindParam(1, $username);
    $updateinfo->bindParam(2, $userid);
    $updateinfo->bindParam(3, $title);
    $updateinfo->bindParam(4, $description);
    $updateinfo->bindParam(5, $ingredients);
    $updateinfo->bindParam(6, $cookingtime);
    $updateinfo->bindParam(7, $calories);
    $updateinfo->execute();

    // Updates each step instruction (Using prepared statements)
    if ($step1 != "") {
        $update_step1 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '1' ");
        $update_step1->bindParam(1, $step1);
        $update_step1->execute();
    }
    if ($step2 != "") {
        $update_step2 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '2' ");
        $update_step2->bindParam(1, $step2);
        $update_step2->execute();
    }
    if ($step3 != "") {
        $update_step3 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '3' ");
        $update_step3->bindParam(1, $step3);
        $update_step3->execute();
    }
    if ($step4 != "") {
        $update_step4 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '4' ");
        $update_step4->bindParam(1, $step4);
        $update_step4->execute();
    }
    if ($step5 != "") {
        $update_step5 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '5' ");
        $update_step5->bindParam(1, $step5);
        $update_step5->execute();
    }
    if ($step6 != "") {
        $update_step6 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '6' ");
        $update_step6->bindParam(1, $step6);
        $update_step6->execute();
    }
    if ($step7 != "") {
        $update_step7 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '7' ");
        $update_step7->bindParam(1, $step7);
        $update_step7->execute();
    }
    if ($step8 != "") {
        $update_step8 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '8' ");
        $update_step8->bindParam(1, $step8);
        $update_step8->execute();
    }
    if ($step9 != "") {
        $update_step9 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '9' ");
        $update_step9->bindParam(1, $step9);
        $update_step9->execute();
    }
    if ($step10 != "") {
        $update_step10 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '10' ");
        $update_step10->bindParam(1, $step10);
        $update_step10->execute();
    }
    if ($step11 != "") {
        $update_step11 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '11' ");
        $update_step11->bindParam(1, $step11);
        $update_step11->execute();
    }
    if ($step12 != "") {
        $update_step12 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '12' ");
        $update_step12->bindParam(1, $step12);
        $update_step12->execute();
    }
    if ($step13 != "") {
        $update_step13 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '13' ");
        $update_step13->bindParam(1, $step13);
        $update_step13->execute();
    }
    if ($step14 != "") {
        $update_step14 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '14' ");
        $update_step14->bindParam(1, $step14);
        $update_step14->execute();
    }
    if ($step15 != "") {
        $update_step15 = $conn->prepare("UPDATE df_steps2 SET instruction = ? WHERE recipeid = '$id' AND stepid = '15' ");
        $update_step15->bindParam(1, $step15);
        $update_step15->execute();
    }

    // Success alert
    echo "<div class='alert alert-success' role='alert'>";
    echo "Meal Updated!";
    echo "<br><br>";
    echo "<form action='index.php'><input type='submit' value='Return Home' class='btn btn-outline-success' id='btn'/></form>";
    echo "</div>";
}

?>

</div>