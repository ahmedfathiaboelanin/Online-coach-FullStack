<?php include './connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercises</title>
    <?php
    include './css.php';
    ?>
    <style>
        <?php include 'css/exe.css'?>
    </style>
</head>
<body>
    <?php include "./nav.php"?>
    <section class='exe'>
        <select name="" id="select" class='col-11'>
            <option value="" disabled selected>Choose Target Muscle</option>
            <option value="abs">Abs</option>
            <option value="calves">Calves</option>
            <option value="delts">Delts</option>
            <option value="forearms">Forearms</option>
            <option value="glutes">Glutes</option>
            <option value="hamstrings">Hamstrings</option>
            <option value="lats">Lats</option>
            <option value="pectorals">Pectorals</option>
            <option value="quads">quads</option>
            <option value="spine">Spine</option>
            <option value="traps">Traps</option>
            <option value="triceps">Triceps</option>
        </select>
        <div class="container-fluid">
            <div class="row justify-content-center gap-3" id='content'>
                
            </div>
        </div>
        <div class="pagination">
            
        </div>
    </section>
    <?php include "./footer.php"?>
    <?php
    include './js.php';
    ?>
    <script>
        <?php include './js/exe.js'?>
    </script>
</body>
</html>