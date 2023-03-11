<?php
    include './connection.php';
    // get packages from database
        $packQ="SELECT * FROM packages ORDER BY id ";
        $packResult=mysqli_query($con,$packQ);
        $packRow=mysqli_fetch_all($packResult,MYSQLI_ASSOC);
    // --------------------------

    if(empty($_SESSION["info"]) || $_SESSION["info"]['admin']!=1){
        header("location: index.php");
        die;
    }
    if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST['add'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $pass=$_POST['pass'];
        $repass=$_POST['repass'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $admin=$_POST['admin'];
        $gender=$_POST['gender'];
        $age=$_POST['age'];
        date_default_timezone_set("Africa/Cairo");
        $date=date("d/m/Y");
        $package=$_POST['package'];
        $q="SELECT * FROM users WHERE email='$email'";
        $res=mysqli_query($con,$q);
        $r=mysqli_fetch_assoc($res);
        if($_POST['pass']!==$_POST['repass'] || empty($_POST['pass'])){
            $passErr="<P class='text-danger'>The passwords are not the same</P>";
        }elseif(!empty($r)){
            $emailError="<P class='text-danger'>Invalid Email</P>";
        }
        else{
            $query="INSERT INTO users(fname,lname,age,gender,email,pass,phone,package_id,admin)
            VALUES ('$fname','$lname',$age,'$gender','$email','$pass','$phone','$package','$admin')";
            $result=mysqli_query($con,$query);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <?php
    include './css.php';
    ?>
    <style>
        <?php include './css/profile.css'?>
    </style>
</head>
<body>
    <?php 
    // include './nav.php'
    ?>
            <section class="order-form m-4" style="padding:80px 0px">
            <div class="container pt-4">
                <div class="row justify-content-center">
                    <div class="col-10 px-4">
                        <h1>Add user</h1>
                        <hr class="mt-1" />
                    </div>
                    <form action="" method="POST" class="col-10 text-center">
                        <div class="row mx-4 justify-content-center">
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <input required type="text" id="form0" value='' name='fname' class="form-control order-form-input" />
                                    <label class="form-label" for="form0">First Name</label>
                                </div>
                            </div>
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <input required type="text" value='' id="form1" name='lname' class="form-control order-form-input" />
                                    <label class="form-label" for="form1">Last Name</label>
                                </div>
                            </div>
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <input required type="tel" value='' id="form3" name='phone' class="form-control order-form-input" />
                                    <label class="form-label" for="form3">Phone</label>
                                </div>
                            </div>
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <input required type="email" value='' id="form9" name='email' class="form-control order-form-input" />
                                    <label class="form-label" for="form3">Email</label>
                                </div>
                                <?php if(!empty($emailError)){
                                    echo $emailError;
                                }?>

                            </div>
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <input required type="password"  value='' id="form2" name='pass' class="form-control order-form-input" />
                                    <label class="form-label" for="form2">Password</label>
                                </div>
                            </div>
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <input required type="password"  value='' id="form3" name='repass' class="form-control order-form-input" />
                                    <label class="form-label" for="form3">Repassword</label>
                                </div>
                            </div>
                            <?php
                                if(!empty($passErr)){
                                echo $passErr;
                                }
                            ?>
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <input required type="number"  value='' id="form11" name='age' class="form-control order-form-input" />
                                    <label class="form-label" for="form11">Age</label>
                                </div>
                            </div>
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <select class="form-control border border-secondary order-form-input" name="gender" id="">
                                        <option value="male">Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <select class="form-control border border-secondary order-form-input" name="package" id="">
                                        <option value="0">Package</option>
                                        <?php foreach($packRow as $data):?>
                                        <option value="<?php echo $data['id']?>"><?php echo $data['name'] . " " . $data['duration']." Months"?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5 mt-2">
                                <div class="form-outline">
                                    <select class="form-control border border-secondary order-form-input" name="admin" id="">
                                        <option value="0">User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-center gap-0 ">
                            <a href='./admin.php?sec=users' id="btnSubmit" class="btn fs-5 col-sm-9 col-7  btn-danger d-block  btn-submit">cancel</a>
                            <button type="submit" id="btnSubmit" name='add' class="btn fs-5 col-sm-9 col-7 mt-2 btn-primary d-block  btn-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php 
            
            ?>
        </section>
        <?php include './footer.php'?>
        <?php include './js.php'?>
    <script>
      document.getElementById("show").onclick=()=>{
        if(document.getElementById("pass").type==="password"){
            document.getElementById("pass").type="text";
            document.getElementById("show").classList.remove("fa-eye");
            document.getElementById("show").classList.add("fa-eye-slash");
        }else{
            document.getElementById("pass").type="password";
            document.getElementById("show").classList.remove("fa-eye-slash");
            document.getElementById("show").classList.add("fa-eye");
        }
      }
    </script>
</body>
</html>