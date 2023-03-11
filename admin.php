<?php
// connect
    include './connection.php';
// --------------------

// make sure he is admin
    if(empty($_SESSION["info"]) || $_SESSION["info"]['admin']!=1){
        header("location: index.php");
        die;
    }
// ---------------------

// logout
    if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["out"])){
        session_destroy();
        header("location: index.php");
        die;
      }
// --------------------

// Get users from data base
    $q="SELECT * FROM users WHERE id != 12 ORDER BY admin desc";
    $result=mysqli_query($con,$q);
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
// --------------------

// get blogs from database
    $blogQ="SELECT * FROM blogs ORDER BY date desc";
    $blogResult=mysqli_query($con,$blogQ);
    $blogRow=mysqli_fetch_all($blogResult,MYSQLI_ASSOC);
// -----------------------

// get drafts from database
    $draftQ="SELECT * FROM draft ORDER BY date desc";
    $draftResult=mysqli_query($con,$draftQ);
    $draftRow=mysqli_fetch_all($draftResult,MYSQLI_ASSOC);
// -----------------------

// search
    if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["search"])){
      $sec=$_GET['sec'];
      switch ($sec) {
        case 'users':
          # code...
            if(empty($_POST['term'])){
              $q="SELECT * FROM users ORDER BY admin desc";
              $result=mysqli_query($con,$q);
              $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
            }else{
              $term=$_POST['term'];
              $q="SELECT * FROM users WHERE fname LIKE '%$term%' or lname LIKE '%$term%' or email LIKE '%$term%' ORDER BY admin desc";
              $result=mysqli_query($con,$q);
              $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
            }
          break;
        case 'blog':
          # code...
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
          break;
      }
    }
// ---------------------

// get comments from database
    $commentQ="SELECT * FROM comments ORDER BY id ";
    $commentResult=mysqli_query($con,$commentQ);
    $commentsRow=mysqli_fetch_all($commentResult,MYSQLI_ASSOC);
// --------------------------

// get packages from database
    $packQ="SELECT * FROM packages WHERE id != 0 ORDER BY id ";
    $packResult=mysqli_query($con,$packQ);
    $packRow=mysqli_fetch_all($packResult,MYSQLI_ASSOC);
// --------------------------

// get categories from database
    $categoryQ="SELECT * FROM category  ORDER BY id ";
    $categoryResult=mysqli_query($con,$categoryQ);
    $categoryRow=mysqli_fetch_all($categoryResult,MYSQLI_ASSOC);
// --------------------------
// Add Category
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['addCat'])){
      $cattitle=$_POST['catName'];
      if(!empty($cattitle)){
        $Q="SELECT * FROM category  WHERE title='$cattitle' ";
        $result=mysqli_query($con,$Q);
        $row=mysqli_fetch_assoc($result);
        if(empty($row)){
          $Q="INSERT INTO category (title) VALUES ('$cattitle')";
          $result=mysqli_query($con,$Q);
          header("location: ./admin.php?sec=categories");
          exit();
        }else{
          $catErr="<p class='alert alert-danger'>This Category is already exist</p>";
        }
      }else{
        $catErr="<p class='alert alert-danger'>This field is required to add category</p>";
      }
    }
// ---------------

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <?php include './css.php'?>
  <style>
    <?php include './css/admin.css' ?>
  </style>

</head>

<body>
<!-- START -->
  <section>
    <div class="row justify-content-center">
      <!-- start sidebar -->
        <div class="col-lg-2 col-sm-3 d-none d-sm-flex side" id='lg-side'>
          <a href="./index.php"><i class="fa-sharp fa-solid fa-house"></i> Home </a>
          <a href="./admin.php"><i class="fa-sharp fa-solid fa-chart-pie"></i> Charts</a>
          <a href="./admin.php?sec=users"><i class="fa-sharp fa-solid fa-users"></i></i>Users</a>
          <a href="./admin.php?sec=blog"><i class="fa-solid fa-feather"></i>Blogs</a>
          <a href="./admin.php?sec=draft"><i class="fa-solid fa-eye-slash"></i>Drafts</a>
          <a href="./admin.php?sec=comments"><i class="fa-solid fa-comment"></i>Comments</a>
          <a href="./admin.php?sec=categories"><i class="fa-sharp fa-solid fa-code-branch"></i>Categories</a>
          <a href="./admin.php?sec=packages"><i class="fa-solid fa-tags"></i>Packages</a>
          <form action="" class='d-flex' method='POST'>
            <button name='out'><i class="fa-sharp fa-solid fa-right-from-bracket"></i>Logout</button>
          </form>
        </div>
        <div class="d-flex d-sm-none side xsm-side" id='xsm-side'>
          <i class="fa-sharp fa-solid fa-xmark" id='xsm-close'></i>
          <a href="./index.php"><i class="fa-sharp fa-solid fa-house"></i> Home </a>
          <a href="./admin.php"><i class="fa-sharp fa-solid fa-chart-pie"></i> Charts</a>
          <a href="./admin.php?sec=users"><i class="fa-sharp fa-solid fa-users"></i></i>Users</a>
          <a href="./admin.php?sec=blog"><i class="fa-solid fa-feather"></i>Blogs</a>
          <a href="./admin.php?sec=draft"><i class="fa-solid fa-eye-slash"></i>Drafts</a>
          <a href="./admin.php?sec=comments"><i class="fa-solid fa-comment"></i>Comments</a>
          <a href="./admin.php?sec=categories"><i class="fa-sharp fa-solid fa-code-branch"></i>Categories</a>
          <a href="./admin.php?sec=packages"><i class="fa-solid fa-tags"></i>Packages</a>
          <form action="" method='POST'>
            <button name='out'><i class="fa-sharp fa-solid fa-right-from-bracket"></i>Logout</button>
          </form>
        </div>
      <!-- end sidebar -->

      <!-- start content -->
      <div class="col-sm col-10 content container">
        <i class="fa-solid fa-bars" id='lg-bar'></i>

        <?php if(!empty($_GET["sec"])):?>

        <!-- users -->
          <?php if($_GET['sec']==='users'):?>
            
            <!-- search form -->
              <form action="" method='POST' class='form d-flex justify-content-start'>
                <input type="search" name='term'>
                <button name='search' class='btn-submit btn' style='background-color: #C12222; color:white;'><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
              </form>
            <!-- end search form -->

            <div class="table-responsive">
              <table class="table table-striped table-dark">
                <thead class='bg-secondary'>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Package</th>
                    <th scope="col">Enroll Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($row as $data):?>
                  <tr class="">
                    <td><?php echo $data['fname']." ".$data['lname'];?></td>
                    <td><?php echo $data['email'];?></td>
                    <td><?php echo $data['phone'];?></td>
                    <td>
                      <?php
                        if($data['admin']==1) {
                          echo '<span class="text-primary fs-6 p-2">Admin</span>';
                        } else {
                          echo 'Client';
                        }
                      ?></td>
                    <td>
                      <?php 
                        $pID=$data['package_id'];
                        $pQ="SELECT * From packages WHERE id=$pID";
                        $r=mysqli_query($con,$pQ);
                        $pName=mysqli_fetch_assoc($r)['name'];
                        echo $pName;
                      ?>
                    </td>
                    <td><?php echo $data['enrollDate'];?></td>
                    <td><a class='btn btn-sm text-light bg-success' href="./editUsers.php?id=<?php echo $data['id']?>">Edit</a></td>
                    <td>
                      
                      <?php
                        if($data!==$_SESSION['info']):
                      ?>
                      <a class='btn btn-sm text-light bg'  style='background-color: #C12222; color:white;' href="./deleteUser.php?id=<?php echo $data['id']?>">delete</a>
                      <?php endif;?>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  <tr>
                    <td colspan='8' class='fs-6 text-start'>
                          <span  style='font-size:20px; color: white;' class=''>Total : <?php echo count($row)?></span>
                          <a href="addUser.php" class='btn mx-5 mt-1 px-5 py-2  btn-primary'>add</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        <!-- end user -->

          <!-- blog -->
            <?php elseif($_GET['sec']==='blog'):?>
              <!-- search form -->
                <form action="" method='POST' class='form d-flex justify-content-start'>
                  <input type="search" name='term'>
                  <button name='search' class='btn-submit btn' style='background-color: #C12222; color:white;'><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                </form>
              <!-- end search form -->
            <div class="table-responsive">
              <table class="table border border-info table-striped table-dark">
                <thead class='bg-secondary'>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Category</th>
                    <th scope="col">Date</th>
                    <th scope="col">Image</th>
                    <th scope="col">Delete</th>
                    <th scope="col">See</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($blogRow as $data):?>
                  <tr class="">
                    <td class=''><?php echo $data['title'];?></td>
                    <td class=''><?php echo $data['author'];?></td>
                    <td class=''>
                      <?php
                        $catId=$data['cat_id'];
                        $catQ="SELECT * FROM category WHERE id=$catId";
                        $catResult=mysqli_query($con,$catQ);
                        $catRow=mysqli_fetch_assoc($catResult);
                        echo $catRow['title'];
                      ?>
                    </td>
                    <td class=''><?php echo $data['date'];?></td>
                    <td class=''><img src="
                    <?php
                      if(empty($data['img'])){
                        echo "./img/logo2_optimized.jpg";
                      }else{
                        echo $data['img'];
                      }
                    ?>" class='img-fluid' style='width:50px;height:50px' alt=""></td>
                    <td class=''>
                      <a class='btn btn-sm text-light bg'  style='background-color: #C12222; color:white;' href="./deleteBlog.php?id=<?php echo $data['id']?>">delete</a>
                    </td>
                    <td class=''>
                      <a class='btn btn-sm text-light btn-success' href="./article.php?id=<?php echo $data['id']?>"><i class="fa-regular fa-eye"></i></a>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  <tr>
                    <td colspan='8' class='fs-6 text-start'>
                          <span  style='font-size:20px; color: white;' class=''>Total : <?php echo count($blogRow)?></span>
                          <a href="addBlog.php" class='btn mx-5 mt-1 px-5 py-2  btn-primary'>add</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          <!--end blog -->
          
          <!-- Draft -->
            <?php elseif($_GET['sec']==='draft'):?>
            <div class="table-responsive">
              <table class="table border border-info table-striped table-dark">
                <thead class='bg-secondary'>
                  <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($draftRow as $data):?>
                  <tr class="">
                    <td class=''><?php echo $data['id'];?></td>
                    <td class=''><?php echo $data['title'];?></td>
                    <td class=''><?php echo $data['date'];?></td>
                    <td class=''>
                      <a class='btn btn-sm text-light bg'  style='background-color: #C12222; color:white;' href="./deleteDraft.php?id=<?php echo $data['id']?>">delete</a>
                    </td>
                    <td class=''>
                      <a class='btn btn-sm text-light btn-success' href="./addBlog.php?draftId=<?php echo $data['id']?>"><i class="fa-regular fa-edit"></i></a>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  <tr>
                    <td colspan='8' class='fs-6 text-start'>
                          <span  style='font-size:20px; color: white;' class=''>Total : <?php echo count($draftRow)?></span>
                          <a href="addBlog.php" class='btn mx-5 mt-1 px-5 py-2  btn-primary'>add</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          <!--end Draft -->

        <!-- packages -->
          <?php elseif($_GET['sec']==='packages'):?>
            <div class="table-responsive">
              <table class="table border border-info table-striped table-dark">
                <thead class='bg-secondary'>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($packRow as $data):?>
                  <tr class="">
                    <td class=''><?php echo $data['name'];?></td>
                    <td class=''><?php echo $data['duration'];?> Months</td>
                    <td class=''><?php echo $data['price'];?> EGP</td>
                    <td class='' dir='rtl'><?php echo $data['discrebtion'];?></td>
                    <td class=''>
                      <a class='btn btn-sm text-light btn-success' href="#"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Edit</a>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  <tr>
                    <td colspan='8' class='fs-6 text-start'>
                          <span  style='font-size:20px; color: white;' class=''>Total : <?php echo count($packRow)?></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        <!-- end packages -->

        <!-- comments -->
          <?php elseif($_GET['sec']==='comments'):?>
          <div class="table-responsive">
              <table class="table table-striped table-dark">
                <thead class='bg-secondary'>
                  <tr>
                    <th scope="col">Comment</th>
                    <th scope="col">Article</th>
                    <th scope="col">User</th>
                    <th scope="col">Date</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($commentsRow as $data):?>
                  <tr class="">
                    <td dir='rtl'><?php echo $data['content'];?></td>
                    <td dir='rtl'>
                      <?php 
                        $blog_id=$data['blog_id'];
                        $commentQ="SELECT * FROM blogs WHERE id=$blog_id";
                        $commentResult=mysqli_query($con,$commentQ);
                        $commentsUsrRow=mysqli_fetch_assoc($commentResult);
                        echo $commentsUsrRow['title'];
                        ?>
                    </td>
                    <td>
                      <?php
                        $user_id=$data['user_id'];
                        $commentQ="SELECT * FROM users WHERE id=$user_id";
                        $commentResult=mysqli_query($con,$commentQ);
                        $commentsUsrRow=mysqli_fetch_assoc($commentResult);
                        echo $commentsUsrRow['fname']." ".$commentsUsrRow['lname'];
                      ?>
                    </td>
                    <td><?php echo $data['date'];?></td>
                    <td>
                      <a class='btn btn-sm text-light bg'  style='background-color: #C12222; color:white;' href="./deleteComment.php?id=<?php echo $data['id']?>">delete</a>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  <tr>
                    <td colspan='8' class='fs-6 text-start'>
                          <span  style='font-size:20px; color: white;' class=''>Total : <?php echo count($commentsRow)?></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        <!-- end comments -->

        <!-- categories -->
          <?php elseif($_GET['sec']==='categories'):?>
          <div class="table-responsive">
              <table class="table table-striped table-dark">
                <thead class='bg-secondary'>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($categoryRow as $data):?>
                  <tr class="">
                    <td><?php echo $data['id'];?></td>
                    <td><?php echo $data['title'];?></td>
                    <td>
                      <a class='btn btn-sm text-light bg'  style='background-color: #C12222; color:white;' href="./deleteCategory.php?id=<?php echo $data['id']?>">delete</a>
                    </td>
                  <?php endforeach;?>
                  <tr>
                    <td colspan='8' class='fs-6 text-start'>
                          <span  style='font-size:20px; color: white;' class=''>Total : <?php echo count($categoryRow)?></span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <form class="row g-3 m-auto" action='' method='POST'>
                <div class="col-auto">
                  <label for="inputPassword2" class="visually-hidden">Category Name</label>
                  <input type="text" class="form-control" name='catName' id="inputPassword2" placeholder="Category Name">
                  <?php if(!empty($catErr)){
                    echo $catErr;
                  } ?>
                </div>
                <div class="col-auto">
                  <button type="submit" name='addCat' class="btn btn-primary mb-3">Confirm</button>
                </div>
              </form>
            </div>
        <!-- end categories -->

          <!-- if sec = something else-->
            <?php else:?>
              <div class="charts row gap-2">
                <div class="stats col-11 col-md-3">
                    <i class="fa-sharp fa-solid fa-users"></i>
                    <a href="./admin.php?sec=users" class='btn' style='background-color:#c12; color:white;'>Total users : <?php echo count($row)?></a>
                </div>
                <div class="stats col-11 col-md-3">
                    <i class="fa-solid fa-feather"></i>
                    <a href="./admin.php?sec=blog" class='btn' style='background-color:#c12; color:white;'>Total Articles : <?php echo count($blogRow)?></a>
                </div>
                <div class="stats col-11 col-md-3">
                    <i class="fa-solid fa-tags"></i>
                    <a href="./admin.php?sec=packages" class='btn' style='background-color:#c12; color:white;'>Total Packages : <?php echo count($packRow)?></a>
                </div>
                <div class="stats col-11 col-md-3">
                    <i class="fa-sharp fa-solid fa-code-branch"></i>
                    <a href="./admin.php?sec=categories" class='btn' style='background-color:#c12; color:white;'>Total Categories : <?php echo count($categoryRow)?></a>
                </div>
                <div class="stats col-11 col-md-3">
                    <i class="fa-solid fa-eye-slash"></i>
                    <a href="./admin.php?sec=draft" class='btn' style='background-color:#c12; color:white;'>Total Drafts : <?php echo count($draftRow)?></a>
                </div>
                <div class="stats col-11 col-md-3">
                    <i class="fa-solid fa-comment"></i>
                    <a href="./admin.php?sec=comments" class='btn' style='background-color:#c12; color:white;'>Total Comments : <?php echo count($commentsRow)?></a>
                </div>
              </div>
            <?php endif;?>
          <!-- end if sec = something else -->

        <!-- charts -->
          <?php else:?>
            <div class="charts row gap-2">
              <div class="stats col-11 col-md-3">
                  <i class="fa-sharp fa-solid fa-users"></i>
                  <p class='fs-4 text-light m-0 p-0' data-goal='<?php echo count($row)?>'>0</p>
                  <a href="./admin.php?sec=users" class='btn' style='background-color:#c12; color:white;'>Total users : <?php echo count($row)?></a>
              </div>
              <div class="stats col-11 col-md-3">
                  <i class="fa-solid fa-feather"></i>
                  <p class='fs-4 text-light m-0 p-0' data-goal='<?php echo count($blogRow)?>'>0</p>
                  <a href="./admin.php?sec=blog" class='btn' style='background-color:#c12; color:white;'>Total Articles : <?php echo count($blogRow)?></a>
              </div>
              <div class="stats col-11 col-md-3">
                  <i class="fa-solid fa-tags"></i>
                  <p class='fs-4 text-light m-0 p-0' data-goal='<?php echo count($packRow)?>'>0</p>
                  <a href="./admin.php?sec=packages" class='btn' style='background-color:#c12; color:white;'>Total Packages : <?php echo count($packRow)?></a>
              </div>
              <div class="stats col-11 col-md-3">
                  <i class="fa-sharp fa-solid fa-code-branch"></i>
                  <p class='fs-4 text-light m-0 p-0' data-goal='<?php echo count($categoryRow)?>'>0</p>
                  <a href="./admin.php?sec=categories" class='btn' style='background-color:#c12; color:white;'>Total Categories : <?php echo count($categoryRow)?></a>
              </div>
              <div class="stats col-11 col-md-3">
                  <i class="fa-solid fa-eye-slash"></i>
                  <p class='fs-4 text-light m-0 p-0' data-goal='<?php echo count($draftRow)?>'>0</p>
                  <a href="./admin.php?sec=draft" class='btn' style='background-color:#c12; color:white;'>Total Drafts : <?php echo count($draftRow)?></a>
              </div>
              <div class="stats col-11 col-md-3">
                  <i class="fa-solid fa-comment"></i>
                  <p class='fs-4 text-light m-0 p-0' data-goal='<?php echo count($commentsRow)?>'>0</p>
                  <a href="./admin.php?sec=comments" class='btn' style='background-color:#c12; color:white;'>Total Comments : <?php echo count($commentsRow)?></a>
              </div>
            </div>
          <?php endif;?>  
        <!-- end charts -->
      </div>
      <!-- end content -->
    </div>
  </section>
<!-- END -->

  <?php include './js.php'?>
  <script>
    document.getElementById('lg-bar').onclick = function () {
      document.getElementById('lg-side').classList.toggle('wide');
      document.getElementById('xsm-side').classList.add('show');
    }
    document.getElementById('xsm-close').onclick = function () {
      document.getElementById('xsm-side').classList.remove('show');
    }

    document.getElementById('addCat').onclick = function () {
      
    }
  </script>
  <script src="./js/admin.js"></script>
</body>

</html>