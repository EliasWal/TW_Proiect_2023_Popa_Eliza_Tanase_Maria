<?php
    require "../config.php";
    require "medical-service.php";
    
    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");
    
    
    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }

    $user_id = $_SESSION["id"];
    $id_medical = $_GET['id'];

    $row = getMedicalReport($id_medical);
    $id_child = $row['id_child'];

    $date = $row['date'];
    $doctor = $row['doctor'];
    $symptoms = $row['symptoms'];
    $diagnosis = $row['diagnosis'];
    $medication = $row['medication'];
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="Editmedical.css" rel="stylesheet" />
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
                <h1> Edit <?php echo getNameChild($id_child); ?>'s medical report </h1>
                    <?php if(isset($_SESSION["message"])){
                            echo "<h2 style=''>" . $_SESSION["message"] . "</h2>";
                        }
                        unset($_SESSION["message"]);
                    ?>
                <form id="add-form" method="post" action="Edit-medical-controller.php">
                    <li id="date">
                        <label >Date</label>
                        <input type="date"  value="<?php echo $date; ?>" id="examinationdate" name="date">
                    </li>
                    <li id="doctor">
                        <label>Doctor</label>
                        <input type="text" value="<?php echo $doctor; ?>" id="doctor" name="doctor" placeholder="Doctor's name">
                    </li>
                    <li id="symptoms">
                        <label >Symptoms</label>
                        <input type="text" value="<?php echo $symptoms; ?>" id="symptoms" name="symptoms" placeholder="Describe symptoms">
                    </li>
                    <li id="diagnosis">
                        <label >Diagnosis</label>
                        <input type="text" value="<?php echo $diagnosis; ?>" id="diagnosis" name="diagnosis" placeholder="Doctor's diagnosis">
                    </li>
                    <li id="medication">
                        <label >Medication</label>
                        <input type="text" value="<?php echo $medication; ?>" id="medication" name="medication" placeholder="Needed medication">
                    </li>
                    <input type="hidden" name="id_medical" value="<?php echo $id_medical; ?>">
                <div class="buttons-kid1">
                    <input type="submit" name="submit" value="Save">
                </div>
            </form>
            </div>
        </div>
</body>
</html>
