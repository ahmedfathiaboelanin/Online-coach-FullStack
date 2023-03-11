<?php include './connection.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EL-SUM</title>
    <?php
    include './css.php';
    ?>
    <style>
        <?php include './css/index.css' ?>
    </style>
</head>

<body>
    <?php include './nav.php'?>
    <section class="land" style='background-color:black;'>
        <!-- Carousel wrapper -->
        <div id="carouselMaterialStyle" class="carousel slide " data-mdb-ride="carousel">
            <!-- Inner -->
            <div class="carousel-inner  shadow-4-strong">
                <!-- Single item -->
                <div class="carousel-item active">
                    <img src="img/new/pexels-cesar-galeão-3253501_optimized.jpg" class="d-block w-100"
                        alt="Sunset Over the City" />
                    <div class="layer"></div>
                    <div style='width:70%' class="carousel-caption">
                        <h3>Exercises</h3>
                        <p style='width:100%; font-size:20px;' class='mt-5'>Personalized fitness training through online
                            coaching, providing convenient and professional guidance for achieving your goals.</p>
                    </div>
                </div>

                <!-- Single item -->
                <div class="carousel-item">
                    <img src="./img/new/pexels-thought-catalog-2228559_optimized.jpg" class="d-block w-100"
                        alt="Canyon at Nigh" />
                    <div class="layer"></div>
                    <div style='width:70%' class="carousel-caption">
                        <h3>Article</h3>
                        <p style='width:100%; font-size:20px;' class='mt-5'>Article service, delivering informative and
                            high-quality content on fitness, nutrition, and overall health and wellness.</p>
                    </div>
                </div>

                <!-- Single item -->
                <div class="carousel-item">
                    <img src="./img/new/pexels-jane-doan-1092730_optimized.jpg" class="d-block w-100"
                        alt="Cliff Above a Stormy Sea" />
                    <div class="layer"></div>
                    <div style='width:70%' class="carousel-caption">
                        <h3>Nutrition</h3>
                        <p style='width:100%; font-size:20px;' class='mt-5'>Nutrition service, offering customized meal
                            plans and expert guidance for optimal health and nourishment.</p>
                    </div>
                </div>
            </div>
            <!-- Inner -->

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselMaterialStyle"
                data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#carouselMaterialStyle"
                data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Carousel wrapper -->
    </section>
    <section class="about about1">
        <div class="container-fluid">
            <div class="row gap-5  justify-content-center align-items-center">
                <div class="col-md-5 col-10 textArea">
                    <h2>I'm <span class='writeTyper'></span></h2>
                    <p class="fs-5 text-light">
                        I'm Mohamed El-Sum The body designer , a certified personal trainer here to help you achieve
                        your fitness goals. Let's work together to create a customized training plan and reach your full
                        potential.
                    </p>
                    <div class="btns">
                        <a href="./img/شهادة_optimized.jpg" download class='btn m-1' style='background-color:#c12; color:white'>ISSA Certificate</a>
                        <a href="./contact.php" class='btn m-1' style='background-color:#c12; color:white'>Transformations</a>
                        <a href="./contact.php" class='btn m-1' style='background-color:#c12; color:white'>Contact us</a>
                    </div>
                </div>
                <div class="col-md-5 col-10 d-flex flex-column align-items-center gap-2 imgArea">
                    <img src="./img/logo_optimized.jpg" class='img-fluid' alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="about sec2">
        <h3 class="fs-2">Our Services</h3>
        <div class="container-fluid">
            <div class="owl-carousel container owl-theme">
                <div class="col-md-3 item p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                    <div class="icon text-center ">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <h4 class='text-center'>Online Coaching</h4>
                    <div class="disc text-center">
                        Achieve your goals with the help of professional online coaching service.
                    </div>
                    <a href="./onlineCoach.php" class='btn' style='background-color:#c12; color:white'>Take a Look</a>
                </div>
                <div class="col-md-3 swiper-slide p-3 service col-sm-6 col-10 d-flex flex-column gap-4">
                    <div class="icon text-center ">
                        <i class="fa-brands fa-telegram"></i>
                    </div>
                    <h4 class='text-center'>Telegram</h4>
                    <div class="disc text-center">
                        Get expert answers to your questions with our Telegram response service.
                    </div>
                    <a href="https://t.me/START2o23" class='btn' style='background-color:#c12; color:white'>Take a Look</a>
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
    <?php include './footer.php'?>
    <?php include './js.php'?>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        var typed = new Typed(".writeTyper", {
            strings: ["Mohamed EL-Sum.", "The Body Designer.", "Fitness Trainer.", "Online Coach."],
            typeSpeed: 100,
            backSpeed: 100,
            loop: true,
        })
    </script>
</body>

</html>