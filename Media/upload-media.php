<?php
require '../config.php';
require 'media-service.php';

session_start();

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
    <link href="../AboutUs.css" rel="stylesheet" />
    <link href="upload-media.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('upload-form');
        var button = document.getElementById('myButton');
        var messageContainer = document.getElementById('message-container');
        var userId = "<?php echo $user_id; ?>"; 

        button.addEventListener('click', function(event) {
          event.preventDefault(); 

          var formData = new FormData(form);
          
            var xhr = new XMLHttpRequest();
          xhr.open('POST', 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria-main/api/media/');
          xhr.onload = function() {
            if (xhr.status === 201) {
              console.log('File uploaded successfully');
              var successMessage = 'Media created successfully';
              showMessage(successMessage);
            } else {
              var errorMessage = 'Error uploading file';
              showMessage(errorMessage);
            }
          };
          xhr.onerror = function() {
            console.log('Request error');
          };
          xhr.send(formData);
        });

        function showMessage(message) {
          messageContainer.textContent = message;
        }
      });
    </script>
</head>
<body>
    <?php require "../login-topbar.php"; ?>
        <div class="container">
            <div class="info">
                <p>Here you can upload any type of file, in order to keep them organized and to have them in a single place. </p>
                <p>Feel free to upload any kind of content!</p>
            </div>

            <div class="upload-container">
                <h2>Upload</h2>
                <h2 id="message-container"></h2>

                <form id="upload-form" method="post" enctype="multipart/form-data">
                  <ul>
                    <li id="name">
                      <label>Title</label>
                      <input type="text" value="" id="name" name="title" placeholder="Title of file" required>
                    </li>
                    <li id="Photo">
                      <label>Photo</label>
                      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                      <input type="file" id="photo" name="picture" required>
                    </li>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="submit" id="myButton" name="submit" value="Save">
                  </ul>
                </form>
            </div>
        </div>
</body>
</html>
