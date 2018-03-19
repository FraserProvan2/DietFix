//Fraser Provan 26/02/2018
//print.js -Print script

//Print function - Opens print preview
function printRecipe() {
    window.print();
}

//Comment function - user comments on recipe
function comment() {

    // Create the XMLHttpRequest variable.
    var xhr2 = new XMLHttpRequest();

    // Gets user input
    var a = document.getElementById("recipe_id").value;
    var b = document.getElementById("comment").value;
    var c = document.getElementById("userid").value;

    if (b == false) {
        return;
    } else {
        // Specify the CALLBACK function. 
        xhr2.addEventListener("load", commentResponse);
        xhr2.open('GET', 'comment.php?recipeid=' + a + '&comment=' + b + '&userid=' + c);
        xhr2.send();
    }    
}

// Gets response from sign up attempt
function commentResponse(e) {
    document.getElementById('comment-response').innerHTML = e.target.responseText;
    window.location.reload();
}

//Favourite function - Favouries recipe
function favourite() {

    // Create the XMLHttpRequest variable.
    var xhr2 = new XMLHttpRequest();

    // Gets user input
    var y = document.getElementById("recipe_id_favourite").value;
    var x = document.getElementById("userid_favourite").value;

    // Specify the CALLBACK function. 
    xhr2.addEventListener("load", favouriteResponse);
    xhr2.open('POST', 'favourite.php?userid_favourite=' + x + '&recipe_id_favourite=' + y);
    xhr2.send();
}

// Gets response from sign up attempt
function favouriteResponse(e) {
    document.getElementById('favourite-resposne').innerHTML = e.target.responseText;
}

//Delete comment function - Deletes comment
function deletecomment() {

    // Create the XMLHttpRequest variable.
    var xhr2 = new XMLHttpRequest();

    // Gets user input
    var p = document.getElementById("comment_id").value;

    if (p == false) {
        return;
    } else {
        // Specify the CALLBACK function. 
        xhr2.addEventListener("load", deleteCommentResponse);
        xhr2.open('POST', 'deletecomment.php?comment_id=' + p);
        xhr2.send();
    }
}

// Gets response from sign up attempt
function deleteCommentResponse(e) {
    document.getElementById('deletecomment-response').innerHTML = e.target.responseText;
    window.location.reload();
}