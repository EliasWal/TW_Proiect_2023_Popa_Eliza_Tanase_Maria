<?php
require '../config.php';
require 'friend-service.php';

if (!isset($_COOKIE["login"]))
    header("location: ../login.php");

if (!isset($_SESSION["login"]) || $_SESSION['login'] === false) {
    header("Location: ../login.php");
}

$user_id = $_SESSION["id"];


?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="../admin-topbar.css" rel="stylesheet" />
    <link href="add-friend.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        function previewPhoto(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewImage').src = e.target.result;
                    document.getElementById('previewImage').style.display = 'block'; // Show the image element
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                document.getElementById('previewImage').style.display = 'none'; // Hide the image element
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('friend-form');
        var button = document.getElementById('myButton');
        var messageContainer = document.getElementById('message-container');

        button.addEventListener('click', function(event) {
          event.preventDefault(); 

          var formData = new FormData(form);

          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/api/friends/');
          xhr.onload = function() {
            if (xhr.status === 201) {
              console.log('Friend added successfully');
              var successMessage = 'Friend added successfully';
              showMessage(successMessage);
            } else {
              var errorMessage = 'Error adding friend';
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
    <div class="container">
        <div class="leftbar">
            <h2>Friends</h2>
            <ul class="set-menu">
                <li id="prieten">
                    <a href="friends.php">Friends</a>
                </li>
                <li id="add-friend">
                    <a href="add-friend.php">Add friend</a>
                </li>
            </ul>
        </div>
        <div class="friend-container">
            <h2>Add friend</h2>
            <h2 id="message-container"></h2>
            <form id="friend-form" method="post" enctype="multipart/form-data">
                <li id="Name">
                    <label>Name</label>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="text" value="" id="name" name="name" placeholder="Full name" required>
                </li>
                <li id="Relation">
                    <label>Relation</label>
                    <input type="text" value="" id="relation" name="relation" placeholder="Type of friend" required>
                </li>
                <li id="Photo">
                    <label>Photo</label>
                    <img id="previewImage" src="" style="display: none;">
                    <input type="file" id="photo" name="photo" accept="image/*" onchange="previewPhoto(event)">
                </li>
                <input type="submit" id="myButton" name="submit" value="Save">
            </form>
        </div>
    </div>
</body>
</html>