<?php
// connect
    include './connection.php';
// --------------------

// Get packages from database
    $q="SELECT * FROM packages";
    $result=mysqli_query($con,$q);
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
// --------------------

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Coaching</title>
    <?php include './css.php'?>
    <style>
        <?php include './css/index.css' ?><?php include './css/online.css' ?>
    </style>

</head>

<body>
    <?php include './nav.php'?>
    <!-- <section class='' style='padding:80px 0px;'>
        
    </section> -->
    <section class="about d-lg-none sec2" style='padding:80px 0px;'>
        <h3 class="fs-2">Nutrition & Workout</h3>
        <div class="container-fluid">
            <div class="owl-carousel container owl-theme">
                <?php for($i=1;$i<4;$i++):?>
                    <div class="col-md-3 swiper-slide p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                        <div class="icon text-center ">
                            <i class="fa-brands fa-telegram"></i>
                        </div>
                        <h4 class='text-center'><?php echo $row[$i]['name']?></h4>
                        <div class="disc text-center">
                            <?php echo $row[$i]['discrebtion']?>
                        </div>
                        <a href="https://t.me/START2o23" class='btn' style='background-color:#c12; color:white'>Take a
                            Look</a>
                    </div>
                <?php endfor;?>
            </div>
        </div>
    </section>
    <section class='sec2 d-none d-lg-flex about' style='padding:80px 0px;'>
        <h3 class="fs-2">Nutrition & Workout</h3>
        <div class="container">
            <div class="row justify-content-center pricing g-3">
                <?php for($i=1;$i<4;$i++):?>
                <div class="col-md-3  p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                    <div class="icon text-center ">
                        <?php echo $row[$i]['name']?>
                    </div>
                    <h4 class='text-center'><?php echo $row[$i]['duration']." "."Months"?></h4>
                    <div class="disc text-center">
                        <?php echo $row[$i]['discrebtion']?>
                    </div>
                    <a href="./onlineCoach.php" class='btn' style='background-color:#c12; color:white'>Take a Look</a>
                </div>
                <?php endfor;?>
            </div>
        </div>
    </section>
    <section class="about d-lg-none sec2" style='padding:80px 0px;'>
        <h3 class="fs-2">Nutrition</h3>
        <div class="container-fluid">
            <div class="owl-carousel container owl-theme">
                <div class="col-md-3 swiper-slide p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                    <div class="icon text-center ">
                        <i class="fa-brands fa-telegram"></i>
                    </div>
                    <h4 class='text-center'>Telegram</h4>
                    <div class="disc text-center">
                        Get expert answers to your questions with our Telegram response service.
                    </div>
                    <a href="https://t.me/START2o23" class='btn' style='background-color:#c12; color:white'>Take a
                        Look</a>
                </div>
                <div class="col-md-3 swiper-slide p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                    <div class=" icon text-center ">
                        <i class="fa-solid fa-dumbbell"></i>
                    </div>
                    <h4 class='text-center'>Exercises</h4>
                    <div class="disc text-center">
                        Personalized workouts: Expert guidance for achieving your fitness goals.
                    </div>
                    <a href="./exercise.php" class='btn' style='background-color:#c12; color:white'>Take a Look</a>
                </div>
                <div class="col-md-3 swiper-slide p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                    <div class="icon text-center ">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                    <h4 class='text-center'>Blogs</h4>
                    <div class="disc text-center">
                        High-quality articles on fitness, nutrition, health and workout.
                    </div>
                    <a href="./blog.php" class='btn' style='background-color:#c12; color:white'>Take a Look</a>
                </div>
            </div>
        </div>
    </section>
    <section class='sec2 d-none d-lg-flex about' style='padding:80px 0px;'>
        <h3 class="fs-2">Nutrition</h3>
        <div class="container">
            <div class="row justify-content-center pricing g-3">
                <div class="col-md-3  p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                    <div class="icon text-center ">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <h4 class='text-center'>Online Coaching</h4>
                    <div class="disc text-center">
                        Achieve your goals with the help of professional online coaching service.
                    </div>
                    <a href="./onlineCoach.php" class='btn' style='background-color:#c12; color:white'>Take a Look</a>
                </div>
                <div class="col-md-3  p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                    <div class="icon text-center ">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <h4 class='text-center'>Online Coaching</h4>
                    <div class="disc text-center">
                        Achieve your goals with the help of professional online coaching service.
                    </div>
                    <a href="./onlineCoach.php" class='btn' style='background-color:#c12; color:white'>Take a Look</a>
                </div>
                <div class="col-md-3  p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                    <div class="icon text-center ">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <h4 class='text-center'>Online Coaching</h4>
                    <div class="disc text-center">
                        Achieve your goals with the help of professional online coaching service.
                    </div>
                    <a href="./onlineCoach.php" class='btn' style='background-color:#c12; color:white'>Take a Look</a>
                </div>
            </div>
        </div>
    </section>
    <?php include './footer.php'?>

    <?php include './js.php'?>

</body>

</html>