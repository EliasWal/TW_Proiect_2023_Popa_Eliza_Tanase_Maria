<?php 
    require '../config.php';
    require 'medical-service.php';

    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");


    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }

    $user_id = $_SESSION["id"];
    $id_child = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="../admin-topbar.css" rel="stylesheet" />
    <link href="Add-medical.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('add-form');
        var button = document.getElementById('myButton');
        var messageContainer = document.getElementById('message-container');
        var childId = "<?php echo $id_child; ?>"; 
        var userId = "<?php echo $user_id; ?>"; 

        button.addEventListener('click', function(event) {
          event.preventDefault(); 

          var formData = new FormData(form);
          
          formData.append('id_child', childId);
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria-main/api/medical/');
          xhr.onload = function() {
            if (xhr.status === 201) {
              console.log('Medical report added successfully');
              var successMessage = 'Medical report created successfully';
              showMessage(successMessage);
            } else {
              var errorMessage = 'Error creating the report';
              showMessage(errorMessage);
            }
          };
          xhr.onerror = function() {
            console.log('Request error');
          };
          console.log(formData, convertFormDataToObject(formData));

          console.log('Sending POST request...');

          xhr.send(formData);
        });

        function showMessage(message) {
          messageContainer.textContent = message;
        }
        function convertFormDataToObject(formData) {
            const object = {};
            for (const [key, value] of formData.entries()) {
                object[key] = value;
            }
            return object;
        }
        
      });
    </script>
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
                <h1> Add a new medical report for <?php echo getNameChild($id_child); ?> </h1>
                <h1 id="message-container"></h1>

                <?php if(isset($_SESSION["message"])){
                        echo "<h1 style='text-decoration:none;'>" . $_SESSION["message"] . "</h1>";
                    }
                    unset($_SESSION["message"]);
                ?>
                <form id="add-form" method="post" action="">
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
                <div class="buttons-kid1">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="id_child" value="<?php echo $child_id; ?>">
                    <input type="submit" id="myButton" name="submit" value="Save">
                </div>
            </form>
            </div>
        </div>
</body>
</html>
