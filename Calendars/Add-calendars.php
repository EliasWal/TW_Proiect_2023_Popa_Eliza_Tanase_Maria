<?php
    require "../config.php";
    require "calendars-service.php";
    
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
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="Add-calendars.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('add-form');
            var button = document.getElementById('saveButton');
            var message = document.getElementById('message');
            var user_id = "<?php echo $user_id; ?>";

            button.addEventListener('click', function(event) {
                event.preventDefault();
                var formData = new FormData(form);

                var request = new XMLHttpRequest();
                request.open('POST', 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/api/calendars/');
                request.onload = function() {
                    if (request.status === 201) {
                        console.log('Calendar entry added successfully');
                        var successMessage = 'Calendar entry created successfully';
                        showMessage(successMessage);
                    } else {
                        var errorMessage = 'Error adding calendar entry';
                        showMessage(errorMessage);
                    }
                };
                request.onerror = function() {
                    console.log('Request error');
                };
                request.send(formData);
            });

            function showMessage(message) {
                message.textContent = message;
            }
        });
    </script>
</head>
<body>
    <?php require "../login-topbar.php"; ?> 
        <div class="page">
            <?php require "leftbar-calendars.php"; ?> 
            <div class="right">
                <a href="Calendars-child.php?id=<?php echo $id_child; ?>">
                    <button>
                        <img src="../Photos/Back.png" alt="back">
                        Back 
                    </button>
                </a>
                <h1> Add a new calendar time for <?php echo getNameChild($id_child); ?></h1>
                <h1 id="message"> </h1>
                <form id="add-form" method="post" enctype="multipart/form-data">
                    <li id="time">
                        <label >Time</label>
                        <input name="time" type="time"  value="" id="timecalendar">
                    </li>
                    <li id="notes">
                        <label>Notes</label>
                        <input name="notes" type="text" value="" id="notes" name="notes" placeholder="Add extra notes">
                    </li>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="id_child" value="<?php echo $id_child; ?>">
                <div href="Calendars-child.php" class="buttons-kid1">
                    <input type="submit" name="submit" id="saveButton" value="Save">
                </div>
            </form>
            </div>
        </div>
</body>
</html>
