<?php require 'include/user_auth.php'; 

//Users ID to locate recipe data
$id      = $_GET["id"];
$results = $conn->query("SELECT * from df_recipes WHERE id = '$id'");
$row     = $results->fetch();

//recipe ID to gather the steps
$countsteps = $conn->query("SELECT * from df_steps2 WHERE recipeid = '$id' ORDER BY id ASC");
                           
?>

<!--
Fraser Provan 18/03/2018
updaterecipe.php - update form for recipes
-->

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="img/logo/favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type='text/javascript' src='scripts/search.js'></script>
    <script type='text/javascript' src='scripts/calories.js'></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>DietFix - Edit Recipe</title>
</head>

<div class="container-fluid background">
    <!-- Logo with link to index -->
    <a href="main.php">
        <img src="img/logo/dietfix.png" class="logo">
    </a>
</div>

<?php include 'include/nav.php';?>

<body class="body">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-main">
                    <div class="section-heading">
                        <h1>Edit Recipe</h1>
                        <h6>
                            <a id="red-asterisk">*</a>indicates required fields
                            <br>
                        </h6>
                    </div>

                    <!-- Update Recipe Image -->
                    <form method='post' action='updateimage.php' enctype="multipart/form-data" class='upload-recipe'>
                        <?php echo "<img src='$row[image]' class='img-update '/>"; ?>
                        <input type="hidden" name="id" value="<?php echo $row[id]; ?>">
                        <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['gatekeeper']['username']; ?>" />
                        <div class="form-group">
                            <label>(Max 500KB)</label>
                            <div class="custom-file">
                                <input type="file" name="upload" id="upload" class='imageuploader'>
                                <button type="submit" class="btn" id="btn">Update Image</button>
                            </div>
                    </form>

                    <!-- Update Meal Information -->
                    <br>
                    <h4 class="section-title">Meal Information</h4>
                    <form method='post' action='updateinfo.php' enctype="multipart/form-data" class='upload-recipe'>
                        <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['gatekeeper']['username']; ?>" />
                        <input type="hidden" name="recipe_id" id="recipe_id" value="<?php echo $row[id]; ?>">
                        <div class="form-group">
                            <label>Recipe Title
                                <a id="red-asterisk">*</a>
                            </label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $row[title]; ?>">
                        </div>
                        <div class="form-group">
                            <label id="description-top">Description
                                <a id="red-asterisk">*</a>
                            </label>
                            <textarea class="form-control" rows="4" name="description" id="description"><?php echo $row[description]; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ingredients
                                <a id="red-asterisk">*</a>
                            </label>
                            <textarea class="form-control" rows="4" name="ingredients" id="ingredients" /><?php echo $row[ingredients]; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Total Cooking Time
                                <a id="red-asterisk">*</a> (00:00)</label>
                            <input type="text" class="form-control" name="cookingtime" id="cookingtime" placeholder="00:00" value="<?php echo $row[cookingtime]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Calories
                                <a id="red-asterisk">*</a> (kcal)</label>
                            <input type="text" class="form-control" name="calories" id="calories" onkeypress="return isNumberKey(event)" value="<?php echo $row[calories]; ?>">
                        </div>

                        <!-- Update Cooking Instructions-->
                        <h4 class="section-title">Cooking Instructions</h4>

                        <?php while ($steps = $countsteps->fetch()) { ?>

                        <div class="form-group">
                            <label style="padding-left:10px;" name="stepid" id="stepid">Step
                                <?php echo $steps[stepid]; ?>
                            </label>
                            <textarea class="form-control" rows="2" name="step<?php echo $steps[stepid]; ?>"><?php echo $steps[instruction]; ?></textarea>
                        </div>

                        <?php } ?>

                        <button type="submit" class="btn" id="btn">Update Recipe</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'include/footer.php';?>
</body>

</html>