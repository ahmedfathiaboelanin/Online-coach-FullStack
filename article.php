<?php
    include './connection.php';
    // get the article from database
        if($_SERVER["REQUEST_METHOD"]==='GET' && !empty($_GET['id'])){
            $id=(int)$_GET['id'];
            $q="SELECT * FROM blogs WHERE id=$id;";
            $result=mysqli_query($con,$q);
            $row= mysqli_fetch_assoc($result);
            if(empty($row)){
                header("location: ./blog.php");
                die;
            }
        }else{
            header("location: ./blog.php");
            die;
        }
    // -----------------------------
    // get latest articles
        $q="SELECT * FROM blogs ORDER BY date desc limit 6;";
        $result=mysqli_query($con,$q);
        $latest=mysqli_fetch_all($result,MYSQLI_ASSOC);
    // ------------------------------
    // get comments for the article
        $q="SELECT * FROM comments WHERE blog_id=$id ORDER BY date desc , id desc limit 5;";
        $result=mysqli_query($con,$q);
        $comments=mysqli_fetch_all($result,MYSQLI_ASSOC);
    // -----------------------------
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['title']?></title>
    <?php include './css.php'?>
    <style>
    <?php include './css/article.css' ?>
    </style>

</head>
<body>
    <?php include "./nav.php"?>

    <section class='content container-fluid'>
        <div class="row div1 justify-content-center align-items gap-5" >
                <!-- side -->
                    <div class="side col-10 col-md-3 left">
                        <div class='side1 side'>
                            <img class='d-none d-md-inline' src="./img/logo2_optimized.jpg" alt="logo">
                            <!-- Social -->
                                <div class="social">
                                    <a class='btn' style='background-color: #1380EB;' href=""><i class="fa-brands fa-facebook"></i></a>
                                    <a class='btn' style='background-color: #2CC64E;' href=""><i class="fa-brands fa-whatsapp"></i></a>
                                    <a class='btn' style='background-color: #CE0880;' href=""><i class="fa-brands fa-instagram"></i></a>
                                    <a class='btn' style='background-color: #1380EB;' href=""><i class="fa-brands fa-telegram"></i></a>
                                </div>
                            <!-- end social -->
                            <!-- comments -->
                                <h4><i class="text-danger fa-solid fa-comment"></i> التعليقات</h4>
                                <!-- search form -->
                                    <form action="./addComment.php?id=<?php echo $id?>" method='POST' class='form d-flex justify-content-start mt-0'>
                                        <textarea placeholder='أكتب تعليقاً...' name="comment" id="" cols="30" rows="10"></textarea>
                                        <button name='send' class='btn-submit btn' style='background-color: #C12222; color:white;'>إرسال</button>
                                    </form>
                                <!-- end search form -->
                                <?php foreach($comments as $data):?>
                                    <div class="comment border-warning border p-3 gap-2">
                                        <div class="text">
                                            <?php echo $data['content']?>
                                        </div>
                                        <img src="<?php
                                            $q="SELECT * FROM users WHERE id={$data['user_id']} limit 1;";
                                            $result=mysqli_query($con,$q);
                                            $commentUser=mysqli_fetch_assoc($result);
                                            if(empty($commentUser['img'])){
                                                echo "./img/new/AvatarMaker.png";
                                            }else{
                                                echo $commentUser['img'];
                                            }
                                        ?>
                                        " alt="comment" class="">
                                    </div>
                                <?php endforeach;?>
                            <!-- end comments -->
                        </div>
                        <hr>
                    </div>
                <!-- end side -->
                <!-- article -->
                    <div dir='rtl' class=" article col-10 col-md-7">
                        <?php echo htmlspecialchars_decode($row['content']);?>
                        <hr>
                        <!-- info -->
                            <div class="info mt-3">
                                <p>Date : <?php echo $row['date']?></p>
                                <p>Author : <?php echo $row['author']?></p>
                            </div>
                        <!-- end info -->
                        <hr>
                        <!-- latest article -->
                            <h2>أخر المقالات :</h2>
                            <div class="row latest">
                                <?php foreach($latest as $data):?>
                                <div class="col-10 col-md-3 p-0 lateArticle">
                                    <a class='p-0' href="./article.php?id=<?php echo $data['id']?>">
                                        <div class="layer"><i class="fa-sharp fa-solid fa-arrow-up-right-from-square"></i><span style='font-size: 18px !important;'><?php echo $data['title']?></span></div>
                                        <img src="
                                        <?php if(empty($data['img'])){
                                            echo "./img/logo2_optimized.jpg";
                                        }
                                        else{
                                            echo $data['img'];
                                        }
                                        ?>"
                                        class='img-fluid' alt="">
                                    </a>
                                </div>
                                <?php endforeach;?>
                            </div>
                        <!-- -------------- -->
                        <hr>
                        <!-- Social -->
                            <div class="social d-none d-sm-flex">
                                <a class='btn' style='background-color: #1380EB;' href=""><i class="fa-brands fa-facebook"></i></a>
                                <a class='btn' style='background-color: #2CC64E;' href=""><i class="fa-brands fa-whatsapp"></i></a>
                                <a class='btn' style='background-color: #CE0880;' href=""><i class="fa-brands fa-instagram"></i></a>
                                <a class='btn' style='background-color: #1380EB;' href=""><i class="fa-brands fa-telegram"></i></a>
                                <a class='btn' style='background-color: #c12;' href=""><i class="fa-solid fa-envelope"></i></a>
                            </div>
                        <!-- end social -->
                    </div>
                <!-- end article -->
        </div>
    </section>

    <?php echo $id?>
    <?php include "./footer.php"?>
    <?php include './js.php'?>
</body>
</html>