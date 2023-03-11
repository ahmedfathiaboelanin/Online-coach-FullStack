<?php
    include './connection.php';
    if(empty($_SESSION["info"])){
        header("location: index.php");
        die;
    }elseif($_SESSION['info']['admin']==1){
        header("location: admin.php");
        die;
    }
    // print_r($_SESSION['info']);
    $pid = $_SESSION["info"]['package_id'];
    $query ="SELECT name from packages where id='$pid'";
    $res = mysqli_query($con,$query);
    $packId= mysqli_fetch_assoc($res)['name'];
    if($_SERVER["REQUEST_METHOD"]==="POST" && $_GET['edit']==="edit"){
        $email=$_SESSION['info']['email'];
        $password=$_SESSION['info']['pass'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $pass=$_POST['pass'];
        $phone=$_POST['phone'];
        $tall=$_POST['tall'];
        $age=$_POST['age'];
        $weight=$_POST['weight'];
        $fat=$_POST['fat'];
        $muscle=$_POST['muscle'];
        $BMR=$_POST['BMR'];
        $chest=$_POST['chest'];
        $neck=$_POST['neck'];
        $arm=$_POST['arm'];
        $waist=$_POST['waist'];
        $thigh=$_POST['thigh'];
        $imgAdd=false;
        if($_POST['pass']!==$_POST['repass']){
          $passErr="<P class='text-danger'>The passwords are not the same</P>";
        }else{
          if($_SESSION['info']['gender']==='female'){
            $hip=$_POST['hip'];
            $stmt="UPDATE users set fname='$fname', lname='$lname', pass='$pass',phone='$phone',currentWeight=$weight,currentFat=$fat,currentMuscle=$muscle,BMR=$BMR,tall=$tall,age=$age,c_chest=$chest,c_neck=$neck,c_arm=$arm,c_waist=$waist,c_thigh=$thigh,c_hip=$hip WHERE email='$email' && pass='$password';";
          }else{
            $stmt="UPDATE users set fname='$fname', lname='$lname', pass='$pass',phone='$phone',currentWeight=$weight,currentFat=$fat,currentMuscle=$muscle,BMR=$BMR,tall=$tall,age=$age,c_chest=$chest,c_neck=$neck,c_arm=$arm,c_waist=$waist,c_thigh=$thigh WHERE email='$email' && pass='$password';";
          }
          $result = mysqli_query($con,$stmt);
          if(!empty($_FILES['img']['name']) && $_FILES['img']['error'] == 0){
            $folder = "uploaded/$email/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
            }
            $dest=$folder.$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'],$dest);
            if(file_exists($_SESSION['info']['img'])){
                unlink($_SESSION['info']['img']);
            }
            $imgAdd=true;
        }
        if($imgAdd==true){
            $query = "UPDATE users SET img='$dest' WHERE email='$email'";
            $res= mysqli_query($con,$query);
        }
         $q="SELECT * FROM users WHERE email='$email'";
          $res=mysqli_query($con,$q);
          $_SESSION["info"]=mysqli_fetch_assoc($res);
          header('location: profile.php');
          die;
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
        <?php include './css/profile.css'?>
    </style>
</head>
<body>
  
  <!--START CONTENT -->
    <?php if(isset($_GET['edit']) && $_GET['edit']==="edit"):?>
        <section class="order-form m-4" style="">
          <div class="container pt-4">
              <div class="row justify-content-center">
                  <div class="col-10 px-4">
                      <h1>Edit Your Profile</h1>
                      <hr class="mt-1" />
                  </div>
                  <form action="" enctype="multipart/form-data" method="POST" class="col-10 text-center">
                    <div class='img'>
                      <img src="
                      <?php
                        if(empty($_SESSION['info']['img'])){
                          if($_SESSION['info']['gender']==='male'){
                            echo "./img/new/AvatarMaker.png";
                          }else{
                            echo './img/new/AvatarMaker2.png';
                          }
                        }else{
                          echo $_SESSION['info']['img'];
                        };
                      ?>
                      " style='width:200px;border-radius:50%;' class='mb-3 img-fluid' alt="">
                      <input type="file" name='img' id='img' style='display:none;'>
                      <label for="img" class="upload"><i class="fa-solid fa-cloud-arrow-up"></i></label>
                    </div>
                      <div class="row mx-4 justify-content-center">
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="text" id="form0" value='<?php echo $_SESSION['info']['fname']?>' name='fname' class="form-control order-form-input" />
                                  <label class="form-label" for="form0">First Name</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="text" value='<?php echo $_SESSION['info']['lname']?>' id="form1" name='lname' class="form-control order-form-input" />
                                  <label class="form-label" for="form1">Last Name</label>
                              </div>
                          </div>
                          <div class="col-sm-10 mt-2">
                              <div class="form-outline">
                                  <input required type="phone" value='<?php echo $_SESSION['info']['phone']?>' id="form3" name='phone' class="form-control order-form-input" />
                                  <label class="form-label" for="form3">Phone</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="password"  value='<?php echo $_SESSION['info']['pass']?>' id="form2" name='pass' class="form-control order-form-input" />
                                  <label class="form-label" for="form2">Password</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="password"  value='<?php echo $_SESSION['info']['pass']?>' id="form3" name='repass' class="form-control order-form-input" />
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
                                  <input required type="number" id="form20" value='<?php echo $_SESSION['info']['tall']?>' name='tall' class="form-control order-form-input" />
                                  <label class="form-label" for="form20">Tall</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form21" value='<?php echo $_SESSION['info']['age']?>' name='age' class="form-control order-form-input" />
                                  <label class="form-label" for="form21">Age</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form4" value='<?php echo $_SESSION['info']['currentWeight']?>' name='weight' class="form-control order-form-input" />
                                  <label class="form-label" for="form4">weight</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="text" id="form5" value='<?php echo $_SESSION['info']['currentFat']?>' name='fat' class="form-control order-form-input" />
                                  <label class="form-label" for="form5">Fat Percentage</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form6" value='<?php echo $_SESSION['info']['currentMuscle']?>' name='muscle' class="form-control order-form-input" />
                                  <label class="form-label" for="form6">Muscle mass</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form7" value='<?php echo $_SESSION['info']['BMR']?>' name='BMR' class="form-control order-form-input" />
                                  <label class="form-label" for="form7">BMR</label>
                              </div>
                          </div>
                          <!-- ------------------------------------------ -->
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form30" value='<?php echo $_SESSION['info']['c_chest']?>' name='chest' class="form-control order-form-input" />
                                  <label class="form-label" for="form30">chest</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form31" value='<?php echo $_SESSION['info']['c_neck']?>' name='neck' class="form-control order-form-input" />
                                  <label class="form-label" for="form31">neck</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form32" value='<?php echo $_SESSION['info']['c_arm']?>' name='arm' class="form-control order-form-input" />
                                  <label class="form-label" for="form32">arm</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form33" value='<?php echo $_SESSION['info']['c_waist']?>' name='waist' class="form-control order-form-input" />
                                  <label class="form-label" for="form33">waist</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form33" value='<?php echo $_SESSION['info']['c_thigh']?>' name='thigh' class="form-control order-form-input" />
                                  <label class="form-label" for="form33">thigh</label>
                              </div>
                          </div>
                          <?php if($_SESSION['info']['gender']==='female'):?>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form34" value='<?php echo $_SESSION['info']['c_hip']?>' name='hip' class="form-control order-form-input" />
                                  <label class="form-label" for="form34">hip</label>
                              </div>
                          </div>
                          <?php endif;?>
                      </div>
                      <div class="row mt-3 gap-0 ">
                          <a href='./profile.php' id="btnSubmit" class="btn fs-5 col-sm-3 btn-danger d-block mx-auto btn-submit">cancel</a>
                          <button type="submit" id="btnSubmit" class="btn fs-5 col-sm-3 mt-2 btn-primary d-block mx-auto btn-submit">Submit</button>
                      </div>
                  </form>
              </div>
          </div>
        </section>
    <?php else:?>
        <?php include './nav.php'?>
        <section style="background-color: #eee;padding-top:65px;">
          <div class="container py-5">
            <div class="row">
              <div class="col-lg-4">
                <div class="card mb-4">
                  <div class="card-body text-center">
                    <img src="
                    <?php
                        if(empty($_SESSION['info']['img'])){
                          if($_SESSION['info']['gender']==='male'){
                            echo "./img/new/AvatarMaker.png";
                          }else{
                            echo './img/new/AvatarMaker2.png';
                          }
                        }else{
                          echo $_SESSION['info']['img'];
                        };
                      ?>
                    " alt="avatar"
                      class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3"> <?php echo $_SESSION["info"]["fname"]." ".$_SESSION["info"]["lname"]?></h5>
                    <p class="text-muted mb-1"><?php echo $_SESSION["info"]["email"]?></p>
                    <div class="d-flex justify-content-center mb-2">
                      <a href="./profile.php?edit=edit"  class="btn btn-primary">Edit Profile</a>
                    </div>
                  </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                  <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-3">
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        Diet Plan
                        <a href='<?php
                          if(empty($_SESSION['info']['diteImg'])){
                            echo "no.php";
                          }else{
                            echo $_SESSION['info']['diteImg'];
                          }
                        ?>' 
                        <?php
                          if(!empty($_SESSION['info']['diteImg'])){
                            echo "download='Diet Plan'";
                          }
                        ?>
                        class="mb-0 btn-warning btn">Pdf</a>
                      </li>
                      <?php if($packId==1 || $packId==2 || $packId==3):?>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                          Workout Plan
                        <a href='<?php
                          if(empty($_SESSION['info']['trainImg'])){
                            echo "no.php";
                          }else{
                            echo $_SESSION['info']['trainImg'];
                          }
                        ?>'
                        <?php
                          if(!empty($_SESSION['info']['trainImg'])){
                            echo "download='Train Plan'";
                          }
                        ?>
                        class="mb-0 btn-warning btn">Pdf</a>
                      </li>
                      <?php endif;?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card mb-4">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Full Name</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $_SESSION["info"]["fname"]." ".$_SESSION["info"]["lname"]?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Gender</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $_SESSION["info"]["gender"]?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $_SESSION["info"]["email"]?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Password</p>
                      </div>
                      <div class="col-sm-9">
                        <input class="text-muted mb-0" id="pass" readonly type='password' value='<?php echo $_SESSION["info"]["pass"]?>' style='border:none; outline:none;'/>
                        <i class="fa-solid fa-eye" id='show' style="cursor: pointer;"></i>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Phone</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $_SESSION["info"]["phone"]?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Package</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $packId?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Enroll date</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $_SESSION["info"]["enrollDate"]?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="card mb-4 mb-md-0">
                      <div class="card-body">
                        <p class="mb-4"><span class="text-primary font-italic me-1">Start</span>
                        </p>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Tall</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;"><?php echo $_SESSION['info']['tall']?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Weight</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;"><?php echo $_SESSION['info']['weight']?> Kg</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Fat Percentage</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;"><?php echo $_SESSION['info']['fat']?> %</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Muscle Mass</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php if(!empty($_SESSION['info']['muscle'])) {
                            echo $_SESSION['info']['muscle']; 
                            }else{
                              echo "??";
                              };?> Kg</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Chest-الصدر</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['chest']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Neck-الرقبة</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['neck']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Arm-الذراع</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['arm']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Waist-الوسط</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['waist']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Thigh-الفخذ</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['thigh']; ?> cm</p>
                        </div>
                        <?php if($_SESSION['info']['gender']==='female'):?>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Hip-الحوض</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['hip']; ?> cm</p>
                        </div>
                        <?php endif;?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card mb-4 mb-md-0">
                      <div class="card-body">
                        <p class="mb-4"><span class="text-primary font-italic me-1">Current</span>
                        </p>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Weight</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php 
                            if(empty($_SESSION['info']['currentWeight'])){
                                if(empty($_SESSION['info']['weight'])){
                                  echo "??";
                                }else{
                                  echo $_SESSION['info']['weight'];
                                }
                            }else{
                              echo $_SESSION['info']['currentWeight'];
                            }
                          ?> Kg</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Fat Percentage</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php 
                            if(empty($_SESSION['info']['currentFat'])){
                                if(empty($_SESSION['info']['fat'])){
                                  echo "??";
                                }else{
                                  echo $_SESSION['info']['fat'];
                                }
                            }else{
                              echo $_SESSION['info']['currentFat'];
                            }
                          ?> %</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Muscle Mass</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php 
                            if(empty($_SESSION['info']['currentMuscle'])){
                                if(empty($_SESSION['info']['muscle'])){
                                  echo "??";
                                }else{
                                  echo $_SESSION['info']['muscle'];
                                }
                            }else{
                              echo $_SESSION['info']['currentMuscle'];
                            }
                          ?> Kg</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">BMR</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php 
                            if(empty($_SESSION['info']['BMR'])){
                                echo "??";
                            }else{
                              echo $_SESSION['info']['BMR'];
                            }
                          ?> kcl</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Chest-الصدر</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['c_chest']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Neck-الرقبة</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['c_neck']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Arm-الذراع</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['c_arm']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Waist-الوسط</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['c_waist']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Thigh-الفخذ</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['c_thigh']; ?> cm</p>
                        </div>
                        <?php if($_SESSION['info']['gender']==='female'):?>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Hip-الحوض</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $_SESSION['info']['c_hip']; ?> cm</p>
                        </div>
                        <?php endif;?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>    
        <?php include './footer.php'?>
    <?php endif;?>  
    <!-- END CONTENT -->
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