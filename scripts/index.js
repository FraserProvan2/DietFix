//Fraser Provan 26/02/2018
//index.js - sign in and sign up script

//Sign Up function - Signs user up
function signup() {

    // Create the XMLHttpRequest variable.
    var xhr2 = new XMLHttpRequest();

    // Gets user input
    var c = document.getElementById("username").value;
    var d = document.getElementById("password").value;
    var e = document.getElementById("password2").value;
    var f = document.getElementById("email").value;

    // Specify the CALLBACK function. 
    xhr2.addEventListener("load", SignUpResponse);
    xhr2.open('GET', 'signup.php?username=' + c + '&password=' + d + '&password2=' + e + '&email=' + f);
    xhr2.send();
}

// Gets response from sign up and sends back error (To div)
function SignUpResponse(e) {
    document.getElementById('signup-response').innerHTML = e.target.responseText;
}