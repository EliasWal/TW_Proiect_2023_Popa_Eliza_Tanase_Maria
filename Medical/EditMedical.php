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

    $sql= mysqli_query($mysql, "SELECT * FROM medical_report where id='$id_medical'");

    if(isset($_POST['submit'])){
        $date = $_POST['date'];
        $doctor = $_POST['doctor'];
        $symptoms = $_POST['symptoms'];
        $diagnosis = $_POST['diagnosis'];
        $medication = $_POST['medication'];
        $document = $_POST['document'];

        $sql_m = "UPDATE medical_report SET date='$date', doctor='$doctor', symptoms='$symptoms', diagnosis='$diagnosis', medication='$medication', document='$document' WHERE id=$id_medical";
        $rez = mysqli_query($mysql, $sql_m);
        if($rez){
            $_SESSION["message"] = "Medical report updated succesfully to the acount!";
        }    
        else {
            echo"<script>alert('Error. Medical report could not be updated!');</script>";
        }
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
    <link href="Editmedical.css" rel="stylesheet" />
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
                <a href="Medical-child.php?id=<?php echo $row['id_child']; ?>">
                    <button>
                        <img src="../Photos/Back.png" alt="back">
                        Back 
                    </button>
                </a>
                <h1> Edit medical report </h1>
                    <?php if(isset($_SESSION["message"])){
                            echo "<h2 style=''>" . $_SESSION["message"] . "</h2>";
                        }
                        unset($_SESSION["message"]);
                    ?>
                <form id="add-form" method="post">
                    <li id="date">
                        <label >Date</label>
                        <input type="date"  value="<?php echo $row['date']; ?>" id="examinationdate" name="date">
                    </li>
                    <li id="doctor">
                        <label>Doctor</label>
                        <input type="text" value="<?php echo $row['doctor']; ?>" id="doctor" name="doctor" placeholder="Doctor's name">
                    </li>
                    <li id="symptoms">
                        <label >Symptoms</label>
                        <input type="text" value="<?php echo $row['symptoms']; ?>" id="symptoms" name="symptoms" placeholder="Describe symptoms">
                    </li>
                    <li id="diagnosis">
                        <label >Diagnosis</label>
                        <input type="text" value="<?php echo $row['diagnosis']; ?>" id="diagnosis" name="diagnosis" placeholder="Doctor's diagnosis">
                    </li>
                    <li id="medication">
                        <label >Medication</label>
                        <input type="text" value="<?php echo $row['medication']; ?>" id="medication" name="medication" placeholder="Needed medication">
                    </li>
                    <li id="document">
                        <label >Document</label>
                        <input type="file" value="<?php echo $row['document']; ?>" id="document" name="document" placeholder="Add document">
                    </li>
                <div class="buttons-kid1">
                    <input type="submit" name="submit" value="Save">
                </div>
            </form>
            <?php 
                    }
            ?>
            </div>
        </div>
</body>
</html>
