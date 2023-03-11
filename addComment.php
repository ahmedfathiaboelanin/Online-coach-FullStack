<?php
    include './connection.php';
    // make comment
        if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['send'])){
            $cont=$_POST['comment'];
            if(!empty($cont)){
                if(empty($_SESSION['info'])){
                    $user_id=12;
                }else{
                    $user_id=$_SESSION['info']['id'];
                }
                $blog_id=(int) $_GET['id'];
                $q1="INSERT INTO comments (content,blog_id,user_id) VALUES ('$cont',$blog_id,$user_id);";
                $result=mysqli_query($con,$q1);
                header("location: ./article.php?id=$blog_id");
                die;
            }
            else{
                $blog_id=(int) $_GET['id'];
                header("location: ./article.php?id={$blog_id}");
                exit();
            }
        }
    // -----------------------------
?>