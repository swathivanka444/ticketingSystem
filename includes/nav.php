<?php 

session_start();
$user = $_SESSION['user'];
$userType = $_SESSION['type'];

?>

<style>
    .navbar{
        padding: 1em;
        margin-bottom: 3em;
        border-bottom: 1px solid #ffffff87;
    }
    .navbar-expand-lg .navbar-collapse {
        justify-content: flex-end !important;
    }
    .navbar-toggler{
        /* background-color: #5e5252 !important; */
        background-color: #ffffffc4 !important;
    }
    .logo, .nav-link{
        color: white !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light">
  <h5 class='logo'><a href='index.php'>SRC</a></h5>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <?php 
      
        if($userType=='admin'){
          echo "<a class='nav-item nav-link' href='admin.php'>Home</a>";
          echo "<a class='nav-item nav-link' href='createMovie.php'>Add</a>";
          echo "<a class='nav-item nav-link' href='searchTicket.php'>Search</a>";
          echo "<a class='nav-item nav-link' href='logout.php'>Logout</a>";
        }
        else{
          echo "<a class='nav-item nav-link' href='index.php'>Home</a>";
          echo "<a class='nav-item nav-link' href='#'>About us</a>";

          ?>

          <?php 
            if($user){ echo "<a class='nav-item nav-link' href='profile.php'>Profile</a>";}
            else{
              echo "<a class='nav-item nav-link' href='login.php'>Login</a>";
            }
        }
      
      ?>
      
    </div>
  </div>
</nav>