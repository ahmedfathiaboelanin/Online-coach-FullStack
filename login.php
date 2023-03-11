<?php
    include './connection.php';
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $email=$_POST["email"];
        $pass=$_POST["pass"];
        $query = "SELECT * FROM users WHERE email='$email' && pass='$pass'";
        $res = mysqli_query($con,$query);
        if(mysqli_num_rows($res)>0){
            $info=mysqli_fetch_assoc($res);
            $_SESSION['info']=$info;
            if($_SESSION['info']['admin']!=1){
                header('location: profile.php');
            }else{
                header('location: admin.php');
                die;
            }
        }else{
            $error="Email/Password is invalid";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include './css.php';
    ?>
    <style>
        <?php include './css/login.css'?>
    </style>
</head>
<body>
    <?php include './nav.php'?>
    <section class='sec'>
        <div class="container">
            <div class="row justify-content-around align-items-center gap-5">
                <form method='POST' action='' class="login col-md-4 col-10">
                    <img src="./img/new/undraw_Male_avatar_re_nyu5.png" class='' alt="">
                    <input name='email' type="email" placeholder='Email'>
                    <input name='pass' type="password" placeholder='Password'>
                    <?php if(!empty($error)){
                        echo "<div class='alert alert-danger' style='width:90%'>$error</div>";
                    }?>
                    <button>Submit</button>
                </form>
                <img src="./img/new/undraw_Fingerprint_login_re_t71l.png" class='col-md-5 d-none d-md-inline' alt="">
            </div>
        </div>
    </section>
    <?php include './footer.php'?>
    <?php include './js.php'?>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

</body>
</html>