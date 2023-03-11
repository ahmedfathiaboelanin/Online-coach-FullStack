<?php
    include './connection.php';
    if(empty($_SESSION["info"]) || $_SESSION["info"]['admin']!=1){
        header("location: ./index.php");
        die;
    }
    
    if($_SERVER["REQUEST_METHOD"]==='GET' && !empty($_GET['id'])){
        $id=$_GET['id'];
        $q="DELETE FROM blogs WHERE id=$id;";
        $result=mysqli_query($con,$q);
        header("location: ./admin.php?sec=blog");
        exit();
    }
?>