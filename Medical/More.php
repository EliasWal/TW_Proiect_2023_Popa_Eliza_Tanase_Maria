<?php
    require "../config.php";
    session_start();
    
    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");
    
    
    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }

    $user_id = $_SESSION["id"];
    $id_medical = $_GET['id'];
    $contor = $_GET['contor'];

    $sql= mysqli_query($mysql, "SELECT * FROM medical_report where id='$id_medical'");
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="More.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <?php require "../login-topbar.php"; ?> 
        <div class="page">
            <?php require "leftbar-medical.php"; ?>
            <div class="right">
                <?php
                    while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                <a class="buttons">
                    <a href="Medical-child.php?id=<?php echo $row['id_child']; ?>">
                        <button>
                            <img src="../Photos/Back2.png" alt="back">
                            Back 
                        </button>
                    </a>
                    <a href="EditMedicalphp?id=<?php echo $id_medical; ?>">
                        <button>
                            <img src="../Photos/Edit.png" alt="edit">
                            Edit 
                        </button>
                    </a>
                </a>
                <div class="table">
                    <div class="row">
                        <a class="table-header"> Record </a>
                        <a class="table-value"> #<?php echo $contor; ?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Date </a>
                        <a class="table-value"> <?php echo $row['date'];?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Doctor </a>
                        <a class="table-value"> <?php echo $row['doctor'];?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Symptoms </a>
                        <a class="table-value"> <?php echo $row['symptoms'];?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Diagnosis </a>
                        <a class="table-value"> <?php echo $row['diagnosis'];?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Medication </a>
                        <a class="table-value"> <?php echo $row['medication'];?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Document </a>
                        <a class="table-value"> <?php echo $row['document'];?> </a>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
</body>
</html>
