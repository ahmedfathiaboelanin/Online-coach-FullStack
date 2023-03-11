<?php
    include "./connection.php";

    // make sure he is admin
        if(empty($_SESSION["info"]) || $_SESSION["info"]['admin']!=1){
            header("location: index.php");
            die;
        }
    // ---------------------

    if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST['editUser']) && !empty($_GET['id'])){
        $id=(int)$_GET['id'];
        $q="SELECT * FROM users WHERE id=$id";
        $res=mysqli_query($con,$q);
        $row=mysqli_fetch_assoc($res);
        $email=$row['email'];
        $phone=$_POST['phone'];
        $age=$_POST['age'];
        $pass=$_POST['pass'];
        $repass=$_POST['repass'];
        $weight=$_POST['weight'];
        $fat=$_POST['fat'];
        $muscle=$_POST['muscle'];
        $BMR=$_POST['BMR'];
        $diet=$_FILES['diet'];
        // $workout=$_FILES['workout'];
        if($pass !== $repass){
            $passErr="<p class='text-danger'>Password not the same</p>";
        }else{
            $q="UPDATE  users SET phone=$phone,age=$age,pass=$pass,currentWeight=$weight,currentFat=$fat,currentMuscle=$muscle,BMR=$BMR WHERE id=$id";
            $res=mysqli_query($con,$q);
        
        // upload diet    
            if(!empty($_FILES['diet']['name']) && $_FILES['diet']['error'] == 0){
                $folder = "uploaded/$email/diet/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                $dest=$folder.$_FILES['diet']['name'];
                move_uploaded_file($_FILES['diet']['tmp_name'],$dest);
                if(file_exists($row['diteImg'])){
                    unlink($row['diteImg']);
                }
                // $imgAdd=true;
                $q="UPDATE  users SET diteImg='$dest' WHERE id=$id";
                $res=mysqli_query($con,$q);
            }
        // upload diet
        
        // upload workout
            if(isset($_FILES['workout']) && !empty($_FILES['workout']['name']) && $_FILES['workout']['error'] == 0){
                $folder = "uploaded/$email/workout/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                $dest=$folder.$_FILES['workout']['name'];
                move_uploaded_file($_FILES['workout']['tmp_name'],$dest);
                if(file_exists($row['trainImg'])){
                    unlink($row['trainImg']);
                }
                // $imgAdd=true;
                $q="UPDATE  users SET trainImg='$dest' WHERE id=$id";
                $res=mysqli_query($con,$q);
            }
        // upload workout
        
            header("location: ./editUsers.php?id=$id");
            exit();
        }
    }