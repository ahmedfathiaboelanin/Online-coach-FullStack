<?php 
    include './connection.php';

// get blogs from database
    $blogQ="SELECT * FROM blogs ORDER BY date desc";
    $blogResult=mysqli_query($con,$blogQ);
    $blogRow=mysqli_fetch_all($blogResult,MYSQLI_ASSOC);
// -----------------------

// Search for blog
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST["search"])){
        if(empty($_POST['term'])){
            $q="SELECT * FROM blogs ORDER BY date desc";
            $result=mysqli_query($con,$q);
            $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
        }else{
            $term=$_POST['term'];
            $q="SELECT * FROM blogs WHERE title LIKE '%$term%' or author LIKE '%$term%' ORDER BY date desc";
            $result=mysqli_query($con,$q);
            $blogRow=mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
    }
// ----------------------
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <?php
    include './css.php';
    ?>
    <style>
        <?php include './css/blog.css' ?>
    </style>
</head>

<body>
    <?php include './nav.php'?>
    <section class='blogSec'>
        <div class="container-fluid">
            <div class="row justify-content-center gap-5">
                <!-- side -->
                    <div class="side col-10 col-md-3 left">
                        <div class='side1 side'>
                            <img class='d-none d-md-inline' src="./img/logo2_optimized.jpg" alt="logo">
                            <!-- search form -->
                                <form action="" method='POST' class='form d-flex justify-content-start'>
                                    <input type="search" name='term' placeholder='Search by title ro author'>
                                    <button name='search' class='btn-submit btn' style='background-color: #C12222; color:white;'><i
                                            class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                                </form>
                                
                            <!-- end search form -->
                            <!-- Social -->
                                <div class="social">
                                    <a class='btn' style='background-color: #1380EB;' href=""><i class="fa-brands fa-facebook"></i></a>
                                    <a class='btn' style='background-color: #2CC64E;' href=""><i class="fa-brands fa-whatsapp"></i></a>
                                    <a class='btn' style='background-color: #CE0880;' href=""><i class="fa-brands fa-instagram"></i></a>
                                    <a class='btn' style='background-color: #1380EB;' href=""><i class="fa-brands fa-telegram"></i></a>
                                </div>
                            <!-- end social -->
                        </div>
                        <hr>
                    </div>
                <!-- end side -->
                <!-- blogs -->
                    <div class="col-10 p-0 col-md-7 right">
                        <?php foreach($blogRow as $data):?>
                            <div class="article row g-0">
                                <div dir='rtl' class="text bg-light col-12 col-md-7">
                                    <p>العنوان : <?php echo $data['title']?></p>
                                    <p>المؤلف : <?php echo $data['author']?></p>
                                    <p>التاريخ : <?php echo $data['date']?></p>
                                    <a href="./article.php?id=<?php echo $data['id']?>" class='btn'>أقرأ المزيد</a>
                                </div>
                                <img src='<?php
                                    if(empty($data['img'])){
                                        echo './img/logo2_optimized.jpg';
                                    }else{
                                        echo $data['img'];
                                    }
                                ?>' class="col-12 col-md-5 mb-1" alt='<?php echo $data['title']?>'>
                            </div>
                        <?php endforeach;?>
                    </div>
                <!-- end blogs -->
            </div>
        </div>
    </section>
    <?php include './footer.php'?>
    <?php include './js.php'?>
</body>

</html>