<?php
    require "../config.php";
    require "medical-service.php";
    
    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");
    
    
    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }

    $user_id = $_SESSION["id"];
    $id_child = $_GET['id'];
    $contor = 0;

    $medicalReports = getMedicalReports($user_id, $id_child);
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="../admin-topbar.css" rel="stylesheet" />
    <link href="Style-medical-child1.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('input[name="delete"]');
        var messageContainer = document.getElementById('message-container');

        deleteButtons.forEach(function(button) {
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
                <h1> <?php echo getNameChild($id_child); ?>'s medical report </h1>
                <h2 id="message-container"></h2>
                <div class="medical-buttons">
                    <a href="Add-medical.php?id=<?php echo $id_child; ?>">
                        <button>
                            <img src="../Photos/Add.png" alt="add">
                            Add 
                        </button>
                    </a>
                </div>
                <table class="table">
                    <tr class="labels"> 
                        <th class="column"> <a class="table-header"> Record </a> </th>
                        <th class="column-optional"> <a class="table-header"> Date </a> </th>
                        <th class="column-optional"> <a class="table-header"> Doctor </a> </th>
                        <th class="column-optional2"> <a class="table-header"> Symptoms </a> </th>
                        <th class="column"> <a class="table-header"> Diagnosis </a> </th>
                        <th class="column-optional"> <a class="table-header"> Medication </a> </th>
                        <th class="column-more"> <a class="table-header"> More </a> </th>
                        <th class="column-optional"> <a class="edit"> Edit </a> </th>
                        <th class="column-optional"> <a class="delete"> D </a> </th>
                    </tr>
                <?php
                    foreach($medicalReports as $row) {
                        $contor = $contor + 1;
                ?>
                <tr class="valori">
                    <td class="column"> <a class="table-value"> #<?php echo $contor; ?> </a> </td>
                    <td class="column-optional"><a class="table-value"> <?php echo $row['date'];?> </a> </td>
                    <td class="column-optional"> <a class="table-value"> <?php echo $row['doctor'];?> </a> </td>
                    <td class="column-optional2"> <a class="table-value"> <?php echo $row['symptoms'];?> </a> </td>
                    <td class="column"> <a class="table-value"> <?php echo $row['diagnosis'];?> </a> </td>
                    <td class="column-optional"> <a class="table-value"> <?php echo $row['medication'];?> </a> </td>  
                    <td class="column-more"> <a class="table-value" href="More.php?id=<?php echo $row['id'];?>&contor=<?php echo $contor;?>"> ... </a> </td>
                    <td> <div class="column-optional">
                        <div class="edit-buttons">
                            <a class="table-value" href="EditMedical.php?id=<?php echo $row['id'];?>">
                                <button>
                                    <img src="../Photos/Edit.png" alt="edit">
                                    Edit 
                                </button>
                            </a>
                        </div>
                    </div> <td>
                    <td> <div class="column-optional"> 
                            <form method="post" action="">
                             
                            <div class="delete-buttons">
                                <a class="table-value" >
                                    <button name="delete">
                                        <input type="hidden" name="id_medical" value="<?php echo $row['id']; ?>">
                                        <input type="submit" name='delete' value="Delete" id="delete">
                                        <!-- <img src="../Photos/bin.png" name='delete' alt="delete" > -->
                                    </button>
                                </a>
                            </div>
                        </form>
                    </div> <td>
                </tr>
                <?php
                    }
                ?>
                </table>
            </div>
        </div>
</body>
</html>
