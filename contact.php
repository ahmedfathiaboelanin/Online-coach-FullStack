<?php include './connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <?php
    include './css.php';
    ?>
    <style>
        <?php include './css/contact.css'?>
    </style>
</head>
<body>
    <?php include './nav.php'?>
    <section class='contact'>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <form class="col-md-4 col-10">
                    <input type="text" placeholder='Full Name' required>
                    <input type="Email" placeholder='Please enter valid email' required>
                    <textarea name="" placeholder='Message' id="" cols="30" rows="5" class='ps-4 pt-4'></textarea>
                    <input type="submit" value='Send'>
                    <div class="social d-flex gap-3 fs-4 justify-content-center mt-3">
                        <a href=""><i class="face fa-brands fa-facebook-f"></i></a>
                        <a href=""><i class="whats fa-brands fa-whatsapp"></i></a>
                        <a href=""><i class="insta fa-brands fa-instagram"></i></a>
                        <a href=""><i class="fa-brands fa-google google"></i></a>
                    </div>
                    <p class='text-center py-0'><i class="fa-solid fa-phone"></i> +20 1234567890</p>
                </form>
                <div class="img d-none d-md-block col-md-5">
                    <img src="./img/new/undraw_Resume_re_hkth.png" class='img-fluid' alt="">
                </div>
            </div>
        </div>
    </section>
    <?php include './footer.php'?>
    <?php include './js.php'?>
</body>
</html>