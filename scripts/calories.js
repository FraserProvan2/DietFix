//Fraser Provan 26/02/2018
//CaloriesINT.js - Makes calories INT only

//Calories INT only function
function isNumberKey(evt) {
    var calories = (evt.which) ? evt.which : event.keyCode
    if (calories > 31 && (calories < 48 || calories > 57))
        return false;

    return true;
}