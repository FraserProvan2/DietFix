<?php 

//Fraser Provan 22/03/2018
//include/nav-user.php - navbar for users

?>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light navColor" id="nav">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

 <div class="container">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myaccount.php">My Account<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="uploadrecipe.php">Upload Recipe</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a class="link-normal" style="padding-right:10px;" href="myaccount.php"><?php echo $_SESSION['gatekeeper']['username']; ?></a>
      <button class="btn btn-outline-success my-2 my-sm-0" href="signout.php" id="btn"><a class="btn-text" href="signout.php">Sign Out</a></button>
    </form>
  </div>
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