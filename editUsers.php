<?php
    // connect to database
      include './connection.php';
    // ----------------------

    // make sure he is admin
      if(empty($_SESSION["info"]) || $_SESSION["info"]['admin']!=1){
          header("location: index.php");
          die;
      }
    // ---------------------

    // get the id from url
      if($_SERVER["REQUEST_METHOD"]==="GET" && !empty($_GET['id'])){
        $id=(int) $_GET['id'];
        $q="SELECT * FROM users WHERE id=$id";
        $res=mysqli_query($con,$q);
        $row=mysqli_fetch_assoc($res);
        if(empty($row)){
          header("location: ./admin.php?sec=users");
          exit();
        }else{
          $pId=$row['package_id'];
          $q="SELECT * FROM packages WHERE id=$pId";
          $res=mysqli_query($con,$q);
          $packRow=mysqli_fetch_assoc($res);
          $pack=$packRow['name']. " (" .$packRow['duration']." Months)";
        }
      }else{
        header("location: ./admin.php?sec=users");
        exit();
      }
    // ====================== 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
                  <form action="edit.php?id=<?php echo $id?>" enctype="multipart/form-data" method="POST" class="col-10 text-center">
                    <div class='img'>
                      <img src="
                      <?php
                        if(empty($row['img'])){
                          if($row['gender']==='male'){
                            echo "./img/new/AvatarMaker.png";
                          }else{
                            echo './img/new/AvatarMaker2.png';
                          }
                        }else{
                          echo $row['img'];
                        };
                      ?>
                      " style='width:200px;border-radius:50%;' class='mb-3 img-fluid' alt="">
                    </div>
                      <div class="row mx-4 justify-content-center">
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input readonly type="text" id="form0" value='<?php echo $row['fname']?>' name='fname' class="form-control order-form-input" />
                                  <label class="form-label" for="form0">First Name</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input readonly type="text" value='<?php echo $row['lname']?>' id="form1" name='lname' class="form-control order-form-input" />
                                  <label class="form-label" for="form1">Last Name</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="tel" value='<?php echo $row['phone']?>' id="form3" name='phone' class="form-control order-form-input" />
                                  <label class="form-label" for="form3">Phone</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input readonly type="number" value='<?php echo $row['age']?>' id="form8" name='age' class="form-control order-form-input" />
                                  <label class="form-label" for="form8">Age</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="password"  value='<?php echo $row['pass']?>' id="form2" name='pass' class="form-control order-form-input" />
                                  <label class="form-label" for="form2">Password</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="password"  value='<?php echo $row['pass']?>' id="form3" name='repass' class="form-control order-form-input" />
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
                                  <input required type="number" id="form4" value='<?php echo $row['currentWeight']?>' name='weight' class="form-control order-form-input" />
                                  <label class="form-label" for="form4">weight</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="text" id="form5" value='<?php echo $row['currentFat']?>' name='fat' class="form-control order-form-input" />
                                  <label class="form-label" for="form5">Fat Percentage</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form6" value='<?php echo $row['currentMuscle']?>' name='muscle' class="form-control order-form-input" />
                                  <label class="form-label" for="form6">Muscle mass</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input required type="number" id="form7" value='<?php echo $row['BMR']?>' name='BMR' class="form-control order-form-input" />
                                  <label class="form-label" for="form7">BMR</label>
                              </div>
                          </div>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input  value='<?php echo $row['diteImg']?>' type="file" id="form9" name='diet' class="form-control d-none order-form-input" />
                                  <label class=" m-y py-2 justify-content-center align-items-center" style='cursor: pointer;display:flex; gap:10px;' for="form9"><span>Diet plan</span><i class="fa-sharp fa-solid fa-upload"></i></label>
                              </div>
                          </div>
                          <?php if($row['package_id']==1 || $row['package_id']==2 || $row['package_id']==3):?>
                          <div class="col-sm-5 mt-2">
                              <div class="form-outline">
                                  <input  value='<?php echo $row['trainImg']?>' type="file" id="form10" name='workout' class="form-control d-none order-form-input" />
                                  <label class=" m-y py-2 justify-content-center align-items-center" style='cursor: pointer;display:flex; gap:10px;' for="form10"><span>Workout plan</span><i class="fa-sharp fa-solid fa-upload"></i></label>
                              </div>
                          </div>
                          <?php endif;?>
                      </div>
                      <div class="row mt-3 gap-0 ">
                          <a href='./editUsers.php?id=<?php echo $id?>' id="btnSubmit" class="btn fs-5 col-sm-3 btn-danger d-block mx-auto btn-submit">cancel</a>
                          <button type="submit" id="btnSubmit" class="btn fs-5 col-sm-3 mt-2 btn-primary d-block mx-auto btn-submit" name='editUser'>Submit</button>
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
                        if(empty($row['img'])){
                          if($row['gender']==='male'){
                            echo "./img/new/AvatarMaker.png";
                          }else{
                            echo './img/new/AvatarMaker2.png';
                          }
                        }else{
                          echo $row['img'];
                        };
                      ?>
                    " alt="avatar"
                      class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3"> <?php echo $row["fname"]." ".$row["lname"]?></h5>
                    <p class="text-muted mb-1"><?php echo $row["email"]?></p>
                    <div class="d-flex justify-content-center mb-2">
                      <a href="./editUsers.php?id=<?php echo $id?>&edit=edit"  class="btn btn-primary">Edit Profile</a>
                    </div>
                  </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                  <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-3">
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        Diet Plan
                        <a href='<?php
                          if(empty($row['diteImg'])){
                            echo "no.php";
                          }else{
                            echo $row['diteImg'];
                          }
                        ?>' 
                        <?php
                          if(!empty($row['diteImg'])){
                            echo "download='Diet Plan'";
                          }
                        ?>
                        class="mb-0 btn-warning btn">Pdf</a>
                      </li>
                      <?php if($row['package_id']==1 || $row['package_id']==2 || $row['package_id']==3):?>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                          Workout Plan
                        <a href='<?php
                          if(empty($row['trainImg'])){
                            echo "no.php";
                          }else{
                            echo $row['trainImg'];
                          }
                        ?>'
                        <?php
                          if(!empty($row['trainImg'])){
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
                        <p class="text-muted mb-0"><?php echo $row["fname"]." ".$row["lname"]?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Gender</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $row["gender"]?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $row["email"]?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Password</p>
                      </div>
                      <div class="col-sm-9">
                        <input class="text-muted mb-0" id="pass" required type='password' value='<?php echo $row["pass"]?>' style='border:none; outline:none;'/>
                        <i class="fa-solid fa-eye" id='show' style="cursor: pointer;"></i>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Phone</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $row["phone"]?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Package</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $pack?></p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Enroll date</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0"><?php echo $row["enrollDate"]?></p>
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
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;"><?php echo $row['tall']?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Weight</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;"><?php echo $row['weight']?> Kg</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Fat Percentage</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;"><?php echo $row['fat']?> %</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Muscle Mass</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php if(!empty($row['muscle'])) {
                            echo $row['muscle']; 
                            }else{
                              echo "??";
                              };?> Kg</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Chest-الصدر</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['chest']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Neck-الرقبة</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['neck']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Arm-الذراع</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['arm']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Waist-الوسط</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['waist']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Thigh-الفخذ</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['thigh']; ?> cm</p>
                        </div>
                        <?php if($row['gender']==='female'):?>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Hip-الحوض</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['hip']; ?> cm</p>
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
                            if(empty($row['currentWeight'])){
                                if(empty($row['weight'])){
                                  echo "??";
                                }else{
                                  echo $row['weight'];
                                }
                            }else{
                              echo $row['currentWeight'];
                            }
                          ?> Kg</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Fat Percentage</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php 
                            if(empty($row['currentFat'])){
                                if(empty($row['fat'])){
                                  echo "??";
                                }else{
                                  echo $row['fat'];
                                }
                            }else{
                              echo $row['currentFat'];
                            }
                          ?> %</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Muscle Mass</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php 
                            if(empty($row['currentMuscle'])){
                                if(empty($row['muscle'])){
                                  echo "??";
                                }else{
                                  echo $row['muscle'];
                                }
                            }else{
                              echo $row['currentMuscle'];
                            }
                          ?> Kg</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">BMR</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php 
                            if(empty($row['BMR'])){
                                echo "??";
                            }else{
                              echo $row['BMR'];
                            }
                          ?> kcl</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Chest-الصدر</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['c_chest']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Neck-الرقبة</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['c_neck']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Arm-الذراع</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['c_arm']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Waist-الوسط</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['c_waist']; ?> cm</p>
                        </div>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Thigh-الفخذ</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['c_thigh']; ?> cm</p>
                        </div>
                        <?php if($row['gender']==='female'):?>
                        <hr>
                        <div class=" d-flex justify-content-between">
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">Hip-الحوض</p>
                          <p class="mt-2 mb-1 py-0 fs-6" style="font-size: .77rem;">
                          <?php echo $row['c_hip']; ?> cm</p>
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