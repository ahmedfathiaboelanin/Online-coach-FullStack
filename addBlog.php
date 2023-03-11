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
    
    // get categories from database
        $catQ="SELECT * from category";
        $catRes=mysqli_query($con,$catQ);
        $catRow=mysqli_fetch_all($catRes,MYSQLI_ASSOC);
    // -----------------------

    // get the draft content
        if($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['draftId']) && !empty($_GET['draftId']) && is_numeric($_GET['draftId'])){
            $draftId = (int) $_GET['draftId'];
            $stmt="SELECT * from draft WHERE id=$draftId";
            $Res=mysqli_query($con,$stmt);
            $draft=mysqli_fetch_assoc($Res);
            if(empty($draft)){
                header("location: ./admin.php");
                exit();
            }
        }
    // --------------------

    // get the content of the editor
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['publish'])){
            $title=mysqli_real_escape_string($con,$_POST['title']);
            $content=htmlspecialchars($_POST['description']);
            $category=$_POST['cat'];
        if(empty($title)){
            $titleError="<span class='alert alert-danger'>The Title can't be empty</span>";
        }elseif(empty($content)){
            $contentError="<span class='alert alert-danger'>The Content can't be empty</span>";
        }else{
            $q="SELECT * from blogs WHERE title='$title'";
            $res=mysqli_query($con,$q);
            $row=mysqli_fetch_assoc($res);
            if(!empty($row)){
                $titleError="<span class='alert alert-danger'>This title is already used</span>";
            }
            else{
                $author=$_SESSION['info']['fname']." ". $_SESSION['info']['lname'];
                $q="INSERT INTO blogs (title,author,content,cat_id) Values ('$title','$author','$content',$category)";
                $res=mysqli_query($con,$q);
            }
        }
        }elseif($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['draft'])){
            $title=mysqli_real_escape_string($con,$_POST['title']);
            $content=htmlspecialchars($_POST['description']);
            $category=$_POST['cat'];
        if(empty($title)){
            $titleError="<span class='alert alert-danger'>The Title can't be empty</span>";
        }elseif(empty($content)){
            $contentError="<span class='alert alert-danger'>The Content can't be empty</span>";
        }else{
            $q="SELECT * from draft WHERE title='$title'";
            $res=mysqli_query($con,$q);
            $row=mysqli_fetch_assoc($res);
            if(!empty($row)){
                $titleError="<span class='alert alert-danger'>This title is already used</span>";
            }
            else{
                $q="INSERT INTO draft (title,content) Values ('$title','$content')";
                $res=mysqli_query($con,$q);
            }
        }
        }
    // ---------------------
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <!-- Bootstrap 5 CDN Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Summernote CSS - CDN Link -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->

    <!-- css.php -->
        <?php include './css.php'?>
    <!-- ----- -->

    <!-- css -->
        <style>
            <?php include './css/addBlog.css' ?>
        </style>
    <!-- -------- -->
</head>
<body>
    <?php
        include "./nav.php"
    ?>
    <section class='addBlog' style=''>
        <div class="container">
            <div class="row">
                <form action="" class='justify-content-center align-items-center d-flex flex-column' method='POST'>
                    <div class="disc">
                        <input type="text" required class='form-control' placeholder='Title' value='<?php echo !empty($draft['title'])? $draft['title'] :@$title?>' name='title'>
                        <?php 
                            if(!empty($titleError)){
                                echo $titleError;
                            }
                        ?>
                        <select class='form-control' name="cat" id="">
                            <?php foreach($catRow as $data):?>
                            <option value="<?php echo $data['id']?>"><?php echo $data['title']?></option>
                            <?php endforeach;?>
                        </select>
                        <textarea name="description" id="your_summernote" class="form-control" value='' rows="4">
                            <?php echo !empty($draft['content'])? $draft['content'] : @$content?>
                        </textarea>
                        <?php 
                            if(!empty($contentError)){
                                echo $contentError;
                            }
                        ?>
                    </div>
                    <div class="side row">
                        <!-- <input type="text" placeholder='Title' name='title'> -->
                        <button class='btn col-md-2 col-10 btn-info'  type='submit' name='publish'>Publish</button>
                        <button class='btn col-md-2 col-10 btn-warning'  type='submit' name='draft'>Draft</button>
                        <a  class='btn col-md-2 col-10 btn-danger' href="./admin.php?sec=blog">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php print_r($_SESSION['info']['fname']." ".$_SESSION['info']['lname'])?>
    <?php include './footer.php'?>

<!-- js -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote JS - CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    
    <script src="./js/summernote-ext-rtl.js"></script>

    <script>
        
        $(document).ready(function() {
            var options =  {
                height: 300,                
                placeholder: 'Start typing ...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert',['ltr','rtl']],
                    ['insert', ['link','picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            };
            $("#your_summernote").summernote(options);
            $('.dropdown-toggle').dropdown();
        });

        window.onload=()=>{
            setTimeout(() => {
                document.getElementById("preload").setAttribute("style", "display:none");
                document.getElementById("preloadImg").setAttribute("style", "display:none");
            }, 000);
        }

    </script>

    <!-- //Summernote JS - CDN Link -->
<!-- ---------- -->
</body>
</html>