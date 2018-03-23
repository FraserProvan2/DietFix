<?php session_start();
include 'include/db.php';
require 'include/check-user.php';

//Fraser Provan ??/03/2018
//uploadrecipe.php - uploads recipe form

?>

<!doctype html>
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
    <title>DietFix - Upload Recipe</title>
</head>

<div class="container-fluid background">
    <!-- Logo with link to index -->
    <a href="index.php">
        <img src="img/logo/dietfix.png" class="logo">
    </a>
</div>

<?php include 'include/nav-user.php';?>

<body class="body">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-main">

                    <!-- Upload recipe Form -->
                    <div class="section-heading">
                        <h1>Upload Recipe</h1>
                        <h6>
                            <a id="red-asterisk">*</a>indicates required fields
                            <br>
                        </h6>
                    </div>

                    <!-- Section 1 - Meal information -->
                    <h4 class="section-title">Meal Information</h4>
                    <form method='post' action='upload.php' enctype="multipart/form-data" class='upload-recipe'>
                        <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['gatekeeper']['username']; ?>" />
                        <div class="form-group">
                            <label>Recipe Title
                                <a id="red-asterisk">*</a>
                            </label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <label>Image
                                <a id="red-asterisk">*</a> (Max 500KB)</label>
                            <div class="custom-file">
                                <input type="file" name="upload" id="upload" class='imageuploader'>
                                <br>
                                <br>
                            </div>
                            <div class="form-group">
                                <label id="description-top">Description
                                    <a id="red-asterisk">*</a>
                                </label>
                                <textarea class="form-control" rows="4" name="description" id="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Ingredients
                                    <a id="red-asterisk">*</a>
                                </label>
                                <textarea class="form-control" rows="4" name="ingredients" id="ingredients"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Total Cooking Time
                                    <a id="red-asterisk">*</a> (00:00)</label>
                                <input type="text" class="form-control" name="cookingtime" id="cookingtime" placeholder="00:00">
                            </div>
                            <div class="form-group">
                                <label>Calories
                                    <a id="red-asterisk">*</a> (kcal)</label>
                                <input type="text" class="form-control" name="calories" id="calories" onkeypress="return isNumberKey(event)">
                            </div>

                            <!-- Section 2 - Cooking Instructions -->
                            <h4 class="section-title">Cooking Instructions</h4>
                            <h6>Use up to 15 steps!</h6>
                            <br>

                            <div class="form-group">
                                <label>Step 1</label>
                                <textarea class="form-control" rows="2" name="step1" id="step1"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 2</label>
                                <textarea class="form-control" rows="2" name="step2" id="step2"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 3</label>
                                <textarea class="form-control" rows="2" name="step3" id="step3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 4</label>
                                <textarea class="form-control" rows="2" name="step4" id="step4"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 5</label>
                                <textarea class="form-control" rows="2" name="step5" id="step5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 6</label>
                                <textarea class="form-control" rows="2" name="step6" id="step6"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 7</label>
                                <textarea class="form-control" rows="2" name="step7" id="step7"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 8</label>
                                <textarea class="form-control" rows="2" name="step8" id="step8"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 9</label>
                                <textarea class="form-control" rows="2" name="step9" id="step9"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 10</label>
                                <textarea class="form-control" rows="2" name="step10" id="step10"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 11</label>
                                <textarea class="form-control" rows="2" name="step11" id="step11"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 12</label>
                                <textarea class="form-control" rows="2" name="step12" id="step12"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 13</label>
                                <textarea class="form-control" rows="2" name="step13" id="step13"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 14</label>
                                <textarea class="form-control" rows="2" name="step14" id="step14"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Step 15</label>
                                <textarea class="form-control" rows="2" name="step15" id="step15"></textarea>
                            </div>
                            <button type="submit" class="btn" id="btn btn-outline-success">Upload Recipe</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    <?php include 'include/footer.php';?>

</body>

</html>