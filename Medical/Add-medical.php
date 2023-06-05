<?php 
    require '../config.php';

    session_start();

    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");


    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }

    $user_id = $_SESSION["id"];
    $id_child = $_GET['id'];

    if(isset($_POST['submit'])){
        $date = $_POST['date'];
        $doctor = $_POST['doctor'];
        $symptoms = $_POST['symptoms'];
        $diagnosis = $_POST['diagnosis'];
        $medication = $_POST['medication'];
        $document = $_POST['document'];

        $sql = "INSERT INTO medical_report(id_user, id_child, date, doctor, symptoms, diagnosis, medication, document) VALUES(?,?,?,?,?,?,?,?)";
        $stmtinsert = $mysql->prepare($sql);
        $stmtinsert->bind_param("iidsssss", $user_id, $id_child, $date, $doctor, $symptoms, $diagnosis, $medication, $document);
        $rez= $stmtinsert->execute();
        if($rez){
                $_SESSION["message"] = "Entry added succesfully to the medical report!";
                }    
        else {
                echo"<script>alert('Error. Entry could not be added!');</script>";
            }
    }

    $sql_name = mysqli_query($mysql, "SELECT * FROM child where id='$id_child'");
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="Add-medical.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <?php require "../login-topbar.php"; ?> 
        <div class="page">
            <?php require "leftbar-medical.php"; ?> 
            <div class="right">
                <a href="Medical-child.php?id=<?php echo $id_child; ?>">
                    <button>
                        <img src="../Photos/Back.png" alt="back">
                        Back 
                    </button>
                </a>
                <?php
                    $row = mysqli_fetch_assoc($sql_name);
                    $name = $row['firstname'];
                ?>
                <h1> Add a new medical report for <?php echo $name; ?> </h1>
                <?php if(isset($_SESSION["message"])){
                        echo "<h1 style='text-decoration:none;'>" . $_SESSION["message"] . "</h1>";
                    }
                    unset($_SESSION["message"]);
                ?>
                <form id="add-form" method="post">
                    <li id="date">
                        <label >Date</label>
                        <input type="date"  value="" id="date" name="date">
                    </li>
                    <li id="doctor">
                        <label>Doctor</label>
                        <input type="text" value="" id="doctor" name="doctor" placeholder="Doctor's name">
                    </li>
                    <li id="symptoms">
                        <label >Symptoms</label>
                        <input type="text" value="" id="symptoms" name="symptoms" placeholder="Describe symptoms">
                    </li>
                    <li id="diagnosis">
                        <label >Diagnosis</label>
                        <input type="text" value="" id="diagnosis" name="diagnosis" placeholder="Doctor's diagnosis">
                    </li>
                    <li id="medication">
                        <label >Medication</label>
                        <input type="text" value="" id="medication" name="medication" placeholder="Needed medication">
                    </li>
                    <li id="document">
                        <label >Document</label>
                        <input type="file" value="" id="document" name="document" placeholder="Add document">
                    </li>
                <div href="Medical-child.php"class="buttons-kid1">
                    <input type="submit" name="submit" value="Save">
                </div>
            </form>
            </div>
        </div>
</body>
</html>
