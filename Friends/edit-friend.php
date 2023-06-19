<?php 
require '../config.php';
require 'friend-service.php';

if(!isset($_COOKIE["login"]))
    header("location: ../login.php");


if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
    header("Location: ../login.php");
}

$user_id = $_SESSION["id"];
$friend_id= $_GET['id'];

$sql= mysqli_query($mysql, "SELECT * FROM friend where id='$friend_id' and id_user='$user_id'");
$row = mysqli_fetch_assoc($sql);


?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="../admin-topbar.css" rel="stylesheet" />
    <link href="edit-friend.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <script>
        function previewPhoto(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('input[name="delete"]');
            var messageContainer = document.getElementById('message-container');

            deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); 

            var friendId = button.previousElementSibling.value;

            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/api/friends/' + friendId);
            xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Friend deleted successfully');
                var successMessage = 'Friend deleted successfully';
                showMessage(successMessage);
            } else {
                var errorMessage = 'Error deleting friend';
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

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('friend-form');
        var button = document.getElementById('myButton');
        var messageContainer = document.getElementById('message-container');

        button.addEventListener('click', function(event) {
          event.preventDefault(); 

          var formData = new FormData(form); -->
          <!-- var friendId = ""; -->

          <!-- var xhr = new XMLHttpRequest();
          xhr.open('PUT', 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/api/friends/' + friendId);
          
          xhr.onload = function() {
            if (xhr.status === 201) {
              console.log('Friend updated successfully');
              var successMessage = 'Friend updated successfully';
              showMessage(successMessage);
            } else {
              var errorMessage = 'Error updating friend';
              showMessage(errorMessage);
            }
          };
          xhr.onerror = function() {
            console.log('Request error');
          };
          console.log(formData, convertFormDataToObject(formData));
          console.log('Sending PUT request...');

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

    </script> -->
</head>
<body>
    <?php require "../login-topbar.php"; ?> 
        <div class="container">
            <div class="leftbar">
                <h2>Friends</h2>
                <ul class="set-menu">
                    <li id="prieten">
                        <a href="friends.php">Friends</a></li>
                    <li id="add-friend">
                        <a href="add-friend.php">Add friend</a>
                    </li>
                </ul>

            </div>
            <div class="friend-container">
                <h2>Edit info about friends</h2>
                
                <h2 id="message-container"></h2>
                
                <form id="friend-form" method="post" action="edit-controller.php" enctype="multipart/form-data">
                    <li id="Name">
                        <label >Name</label>
                        <input type="text" value="<?php echo $row["name"] ?>" id="name" name="name" placeholder="Full name">
                    </li>
                    <li id="Relation">
                        <label >Relation</label>
                        <input type="text" value="<?php echo $row["relationship"] ?>" id="relation" name="relation" placeholder="Type of friend">
                    </li>
                    <li id="Photo">
                        <label> Photo</label>
                        <?php
                            $imageData = base64_encode($row['photo']);
                            $src = 'data:image;base64,' . $imageData;
                        ?>
                        <img id="previewImage" src="<?php echo $src; ?>">
                        <input type="file" value="" id="photo" name="photo" accept="image/*" onchange="previewPhoto(event)">
                    </li>
                    <div class="buttons">
                        <input type="submit" name="submit" value="Save" id="myButton"> 
                        <input type="hidden" name="id" value="<?php echo $friend_id ?>">
                        <input type="submit" name="delete" value="Delete">
                    </div>
                    
                </form>
                
            </div>
        </div>
</body>
</html>
