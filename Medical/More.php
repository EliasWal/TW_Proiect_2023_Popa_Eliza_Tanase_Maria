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
    $contor = $_GET['contor'];

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
    <link href="../admin-topbar.css" rel="stylesheet" />
    <link href="More1.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var button = document.getElementById('delete');
        var messageContainer = document.getElementById('message-container');

        button.addEventListener('click', function(event) {
        event.preventDefault();

        var medicalId = button.previousElementSibling.value;

        var xhr = new XMLHttpRequest();
        xhr.open('DELETE', 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/api/medical/' + medicalId);
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Report deleted successfully');
                var successMessage = 'Report deleted successfully';
                showMessage(successMessage);
            } else {
                var errorMessage = 'Error deleting report';
                showMessage(errorMessage);
            }
        };
        xhr.onerror = function() {
            console.log('Request error'); 
        };    
        console.log(medicalId); 
        xhr.send();
        });


        function showMessage(message) {
            messageContainer.textContent = message;
        }
    });
    </script>
</head>
<body>
    <?php require "../login-topbar.php"; ?> 
        <div class="page">
            <?php require "leftbar-medical.php"; ?>
            <div class="right">
                <h1 id="message-container"> </h1>
                <a class="buttons">
                    <a href="Medical-child.php?id=<?php echo $id_child; ?>">
                        <button>
                            <img src="../Photos/Back2.png" alt="back">
                            Back 
                        </button>
                    </a>
                    <a href="EditMedical.php?id=<?php echo $id_medical; ?>">
                        <button>
                            <img src="../Photos/Edit.png" alt="edit">
                            Edit 
                        </button>
                    </a>
                    <!--<form method="post" action="Delete-medical-controller.php">
                        <input type="hidden" name="id_medical" value="<?php echo $id_medical; ?>">
                        <input type="hidden" name="id_child" value="<?php echo $id_child; ?>">
                        <a href="More.php?idm=<?php echo $id_medical;?>&contor=<?php echo $contor;?>&idc=<?php echo $id_child; ?>">
                            <button>
                                <img src="../Photos/bin.png" alt="edit">
                                Delete
                            </button>
                        </a>
                    </form>-->
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $id_medical; ?>">
                        <input type="submit" name="delete" value="Delete" id="delete">
                    </form>
                </a>
                <div class="table">
                    <div class="row">
                        <a class="table-header"> Record </a>
                        <a class="table-value"> #<?php echo $contor; ?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Date </a>
                        <a class="table-value"> <?php echo $date;?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Doctor </a>
                        <a class="table-value"> <?php echo $doctor;?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Symptoms </a>
                        <a class="table-value"> <?php echo $symptoms;?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Diagnosis </a>
                        <a class="table-value"> <?php echo $diagnosis;?> </a>
                    </div>
                    <div class="row">
                        <a class="table-header"> Medication </a>
                        <a class="table-value"> <?php echo $medication;?> </a>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
