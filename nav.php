<?php
  if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["log"])){
      session_destroy();
      header("location: index.php");
      ob_end_flush();
      die;
    }
?>
<section id='preload' style="position:fixed;top:0;left:0;width:100vw;height:100vh;background-color:white; z-index:10000;" class="d-flex justify-content-center align-items-center">
    <img id='preloadImg' src="./img/new/240.gif" sty alt="">
</section>
<nav class="navbar  navbar-expand-lg fixed-top" style="background: linear-gradient(135deg,rgba(255, 255, 255,.1),rgba(255, 255,255, .5)); backdrop-filter: blur(10px) !important; backdrop-filter: blur(10px) !important;-webkit-backdrop-filter: blur(10px) !important;">
  <div class="container">
    <a class="navbar-brand wow bounceInLeft" href="./index.php"><img class='img-fluid bg-light rounded' style='width:40px' src="img/logo-removebg-preview_optimized.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse wow bounceInRight" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fs-6 active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link fs-6 active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Services
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item fs-6" href="./onlineCoach.php">Online Coaching</a></li>
            <li><a class="dropdown-item fs-6" href="./exercise.php">Exercises</a></li>
            <li><a class="dropdown-item fs-6" href="./blog.php">Blogs</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-6 active" aria-current="page" href="./contact.php">Contact</a>
        </li>
        <?php
          if(!empty($_SESSION["info"])):
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link fs-6 active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Account
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item fs-6" href="./profile.php">Profile</a></li>
            
            <li><form class="dropdown-item fs-6" action="" method="POST"><button name="log" class='btn btn-danger' name='logout'>Log out</button></form></li>    
            
          </ul>
        <?php else:?>
          <li class="nav-item">
          <a class="nav-link fs-6 active" aria-current="page" href="./login.php">SIGN IN</a>
        </li>
        <?php endif;?>
      </ul>
    </div>
  </div>
</nav>