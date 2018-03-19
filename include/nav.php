<!--
Fraser Provan 28/02/2018
include/nav.php - navbar for website
-->

<nav class="navbar navbar-expand-lg navbar-light navbar-center" id="nav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto navbar-center">
            <li class="nav-item">
                <a class="nav-link" href="main.php">Home
                    <span class="sr-only">"</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="myaccount.php"><?php echo $_SESSION['gatekeeper']['username']; ?>'s Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="uploadrecipe.php">Upload Recipe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pull-right" href="signout.php">Sign Out</a>
            </li>
        </ul>


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

</script>