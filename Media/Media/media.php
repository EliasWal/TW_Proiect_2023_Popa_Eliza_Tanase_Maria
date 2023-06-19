<?php 
require '../config.php';
require 'media-service.php';

session_start();

if(!isset($_COOKIE["login"]))
    header("location: ../login.php");


if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
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
    <link href="media.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('input[name="delete"]');
        var messageContainer = document.getElementById('message-container');

        deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

        var mediaId = button.previousElementSibling.value;

        var xhr = new XMLHttpRequest();
        xhr.open('DELETE', 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/api/media/' + mediaId);
        xhr.onload = function() {
          if (xhr.status === 200) {
            console.log('Media deleted successfully');
            var successMessage = 'Media deleted successfully';
            showMessage(successMessage);
          } else {
            var errorMessage = 'Error deleting media';
            showMessage(errorMessage);
          }
        };
        xhr.onerror = function() {
          console.log('Request error');
        };
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
        <div class="container">
            <div class="info">
                <p>Here you can upload any type of file, in order to keep them organized and to have them in a single place. </p>
                <p>Feel free to upload any kind of content!</p>
            </div>
            <div class="content">
                <div class="upload">
                    <h2> Upload file</h2>
                    <h2 id="message-container"></h2>
                    <a href="upload-media.php">
                        <input type="submit" value="Upload">
                    </a>
                </div>
                <div class="files">
                    <h2> Your files</h2>
                    <div class="files-upl">
                        <?php 
                            $sql = mysqli_query($mysql, "SELECT * FROM media WHERE id_user = $user_id");
                            if(mysqli_num_rows($sql) == 0){
                                echo "Add some files first!";
                            }
                            else
                            {
                                while($row = mysqli_fetch_assoc($sql))
                                {
                        ?>
                        <div class="f1">
                            <?php 
                            $imageData = base64_encode($row['picture']);
                            $src = 'data:image;base64,' . $imageData;
                            ?>
                            <p><?php echo $row['title']; ?></p>
                            <img id="photo" src="<?php echo $src; ?>">
                            <div id="edit">
                                <a href="edit-media.php?id=<?php echo $row['id'] ?>">
                                    <input type="submit" value="Edit">
                                </a>
                                <a href="">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="submit" value="Delete" name='delete'>
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                        
                    </div>
                </div>
            </div>

        </div>
        
</body>
</html>
