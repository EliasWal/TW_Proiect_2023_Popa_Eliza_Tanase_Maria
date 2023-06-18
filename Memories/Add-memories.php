<?php 
require '../config.php';
require 'memories-service.php';

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
    <link href="Add-memories-style.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <script>
        function previewPhoto(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewImage').src = e.target.result;
                    document.getElementById('previewImage').style.display = 'block'; 
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                document.getElementById('previewImage').style.display = 'none'; 
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('add-form');
        var button = document.getElementById('saveButton');
        var messageContainer = document.getElementById('message');

        button.addEventListener('click', function(event) {
          event.preventDefault(); 

          var formData = new FormData(form);

          var request = new XMLHttpRequest();
          request.open('POST', 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/api/memories/');
          request.onload = function() {
            if (request.status === 201) {
              console.log('Memory added successfully');
              var successMessage = 'Memory added successfully';
              showMessage(successMessage);
            } else {
              var errorMessage = 'Error adding memory';
              showMessage(errorMessage);
            }
          };
          request.onerror = function() {
            console.log('Request error');
          };
          console.log(formData, convertFormDataToObject(formData));
          console.log('Sending POST request...');

          request.send(formData);
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
            <?php require "leftbar-memories.php"; ?> 
            <div class="right">
                <a href="Memories-child.php?id=<?php echo $id_child; ?>">
                    <button>
                        <img src="../Photos/Back.png" alt="back">
                        Back 
                    </button>
                </a>
                <h1> Add a new memory for <?php echo getNameChild($id_child); ?> </h1>
                <h1 id="message"></h1>
                <form id="add-form" method="post" enctype="multipart/form-data">
                    <li id="date">
                        <label >Date</label>
                        <input type="date"  value="" id="memorydate" name="date">
                    </li>
                    <li id="title">
                        <label>Title</label>
                        <input type="text" value="" id="title" name="title" placeholder="Add a title">
                    </li>
                    <li id="description">
                        <label >Description</label>
                        <textarea name="description" rows="10" cols="100" placeholder="Describe the memory"></textarea>
                    </li>
                    <li id="picture">
                        <label >Picture</label>
                        <img id="previewImage" src="" style="display: none;">
                        <input type="file" accept="image/*" value="" id="picture" name="picture" onchange="previewPhoto(event)">
                    </li>
                    <input type="hidden" name="id_child" value="<?php echo $id_child; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <div class="buttons-kid1">
                    <input type="submit" id="saveButton" name="submit" value="Save">
                </div>
            </form>
            </div>
        </div>
</body>
</html>
