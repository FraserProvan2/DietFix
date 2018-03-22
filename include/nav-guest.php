<?php 

//Fraser Provan 22/03/2018
//include/nav-guest.php - navbar for guests

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light navColor" id="nav">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" style="color:	#606060;">My Account<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" style="color:	#606060;">Upload Recipe</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method='get' action='signin.php'>
      <input class="form-control mr-sm-1 textlogin" type="search" name="user" placeholder="Username">
      <input class="form-control mr-sm-2" type="search" name="pass" placeholder="Password">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="btn" style="margin-left:-3.5px;">Login</button>
    </form>
  </div>
</nav>

<script>

//Script to make navbar stick when scrolled passed
$(document).ready(function() {
  
  $(window).scroll(function () {
      console.log($(window).scrollTop())
    if ($(window).scrollTop() > 205) {
      $('#nav').addClass('navbar-fixed');
    }
    if ($(window).scrollTop() < 206) {
      $('#nav').removeClass('navbar-fixed');
    }
  });
});

$(document).ready(function () {
    $('.dropdown-toggle').dropdown();
});

</script>