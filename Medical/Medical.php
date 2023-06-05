<?php
    require "../config.php";

    session_start();
    
    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");
    
    
    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="style-medical.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <?php require "../login-topbar.php"; ?> 
        <div class="page">
            <?php require "leftbar-medical.php"; ?> 
            <div class="right">
                <h3> 
                    <img src="../Photos/Medical.png" alt="medical">
                    Medical history
                </h3>
                <p> The <i>"Medical"</i> feature offers you a way to organise your child's medical history.  </p>
                <p> After you select from the <i> left side menu </i> the child you want to see the medical history of, you can edit to add 
                your child's  medical conditions or special needs (alergies, medications) and doctor visits. </p>
                <p> You can also add documents, like examinations, blood analyses, and have them all in a safe place. </p>
            </div>
        </div>
</body>
</html>
