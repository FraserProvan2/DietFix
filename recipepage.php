<?php
session_start();
include 'include/db.php';

// Fraser Provan 01/03/2018
// recipepage.php - Opens recipes from database (bootstrap remake)

$id = $_GET["id"];

// recipe ID to locate recipe data
$recipeinfo = $conn->prepare("SELECT * from df_recipes WHERE id = ?");
$recipeinfo->bindParam(1, $id);
$recipeinfo->execute();
$row = $recipeinfo->fetch();  

// recipe ID to gather the steps
$getsteps = $conn->prepare("SELECT * from df_steps2 WHERE recipeid = ? ORDER BY id ASC");
$getsteps->bindParam(1, $id);
$getsteps->execute();

?>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="img/logo/favicon.png" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type='text/javascript' src='scripts/recipepage.js'></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>DietFix - <?php echo "$row[title]"; ?> </title>
    </head>

    <div class="container-fluid background">
        <!-- Logo with link to index -->
        <a href="index.php">
            <img src="img/logo/dietfix-logo.png" class="logo">
        </a>
    </div>

    <?php

// Chooses which nav to use
if (!isset($_SESSION["gatekeeper"])) {
    include 'include/nav-guest.php';
} else {
    include 'include/nav-user.php';
}

?>
        <div class="container">

            <body class="body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-main">

                            <div class="row">
                                <div class="col">
                                    <div class="section-heading">
                                        <h1>
                                            <?php echo "$row[title]"; ?>
                                        </h1>
                                        <h6>By
                                            <?php echo "$row[username]"; ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <?php echo "<img src='$row[image]' class='Image border-secondary' id='recipepage-padding'/>"; 
                           
                            // Chooses whether to pick real favourite button or dummy one
                            if (!isset($_SESSION["gatekeeper"])) {
                                ?>
                                    <button type="button" class="btn btn-outline-success" id="fav_guest" onclick="" style="margin-top:15px">Favourite</button>
                                    
                                    <?php
                            } 
                            else
                            {

                            $idrecipe = $row['id'];
                            $iduser = $_SESSION['gatekeeper']['id'];
                            $check_favs = $conn->query("SELECT * from df_favourites WHERE $iduser = userid AND $idrecipe = recipeid");
                            $checked_favs = $check_favs->fetch();

                            if ($checked_favs != false) {
                                ?>
                                <!-- Unfavourite button -->
                                <input type="hidden" id="unfav_recipeid" value="<?php echo $id; ?>">
                                <input type="hidden" id="unfav_userid" value="<?php echo $_SESSION['gatekeeper']['id']; ?>">
                                <button type="button" class="btn" id="Favourite" onclick="unfavouriteRecipe2()" style="margin-top:15px">Unfavourite</button>
                                 <?php

                            }
                            else {
                            ?>
                                <!-- Favourite button -->
                                <input type="hidden" id="recipe_id_favourite" value="<?php echo $id; ?>">
                                <input type="hidden" id="userid_favourite" value="<?php echo $_SESSION['gatekeeper']['id']; ?>">
                                <button type="button" class="btn btn-outline-success" id="btn" id="Favourite" onclick="favourite()" style="margin-top:15px">Favourite</button>
                                <?php }
                            } ?>

                                     <!-- Print button -->
                                        <button type="button" class="btn btn-outline-success" id="btn" onclick="printRecipe()" style="margin-top:15px">Print</button>

                                        <br>
                                        <br>

                                        <!-- Favouritre response div -->
                                        <a class="success-font">
                                            <div id="favourite-resposne"></div>
                                             <br>
                                        </a>

                                </div>
                                <div class="col-sm">
                                    <div class="section-sub">

                                        <!-- Meal Information-->
                                        <h4>Meal Information</h4>

                                        <h6>Description</h6>
                                        <?php echo "$row[description]" ?>
                                        <br>
                                        <br>

                                        <h6>Ingredients</h6>
                                        <?php echo "$row[ingredients]" ?>
                                        <br>
                                        <br>

                                        <h6>Total Cooking Time</h6>
                                        <?php echo "$row[cookingtime]" ?>
                                        <br>
                                        <br>

                                        <h6>Calories (kcal)</h6>
                                        <?php echo "$row[calories]" ?>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-sm">

                                    <!-- Cooking Instructions -->
                                    <div class="section-sub step-box">
                                        <h4>Cooking Instructions</h4>

                                        <?php 
                                        while ($steps = $getsteps->fetch()) {
                                        echo "<a class='step'>$steps[stepid]. </a>";
                                        echo "$steps[instruction]";
                                        echo "<br><br>";
                                        } ?>
                                    
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <h4 class="section-title">Comments</h4>
                                    <div class="comments">

                                        <?php

                                // If user is signed in show comment box
                                if (isset($_SESSION["gatekeeper"])) {
                                ?>

                                            <!-- Upload Comment -->
                                            <input type="hidden" id="recipe_id" value="<?php echo $id; ?>">
                                            <input type="hidden" id="userid" value="<?php echo $_SESSION['gatekeeper']['id']; ?>">

                                            <div class="form-group">
                                                <textarea class="form-control" rows="3" placeholder="Share your thoughts..." id="comment"></textarea>
                                            </div>
                                            <button type="button" class="btn btn-outline-success" id="btn" onclick="comment()">Submit</button>

                                            <br>
                                            <br>

                                            <!-- Comment response div -->
                                            <div id="comment-response"></div>

                                            <?php } ?>
                                    </div>

                                    <!-- Comments display -->
                                    <?php
                            
                                // Query to find comments
                                $find_comments = $conn->query("SELECT c.*, c.id AS 'comment_id', u.username, u.id FROM df_comments c LEFT JOIN df_users u ON u.id = c.userid WHERE c.recipeid = '$id' ORDER BY 'commentid' DESC");
                                
                                while ($comments = $find_comments->fetch()) {?>

                                        <div id="deletecomment-response">
                                        </div>

                                        <div class="comment-display">

                                            <a style="font-weight: bold;">
                                                <?php echo ucfirst($comments['username']); ?>
                                            </a>

                                            <?php

                                        // If to make delete button appear if its there own comment OR its the users own recipe page
                                        if ($comments['username'] == $_SESSION['gatekeeper']['username'] || $row['userid'] == $_SESSION['gatekeeper']['id']){
                        
                                            // Delete button
                                            ?>
                                                <form method="POST" action="deletecomment.php?comment_id=<?php echo $comments['comment_id']; ?>" style="display: unset;">
                                                    <input type="hidden" name="comment_id" value="<?php echo $comments['comment_id']; ?>">
                                                    <input type="submit" value="Delete" class="btn btn-link button-href"/>
                                                </form>
                                                <?php
                                            
                                        }
                                        echo "<br>";
                                        
                                        // displays comment
                                        echo $comments['comment']; ?>

                                        <br>
                                        <br>
                                        </div>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include 'include/footer.php';?>

            </body>
        </div>

    </html>

    <script>
        document.getElementById("fav_guest").addEventListener("click", function () {
            alert("You need to be signed in to favourite!");
        });
        
        // Script for unfavouriting recipes (Refreshes afterwards)
        function unfavouriteRecipe2() {

            var xhr2 = new XMLHttpRequest();
            var a = document.getElementById("unfav_recipeid").value;
            var b = document.getElementById("unfav_userid").value;

            xhr2.open('POST', 'unfavouriterecipe.php?recipeid=' + a + '&userid=' + b);
            xhr2.send();

            window.location.reload();

                    }
    </script>