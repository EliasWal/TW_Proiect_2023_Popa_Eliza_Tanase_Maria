<?php 
require '../config.php';

session_start();

if(!isset($_COOKIE["login"]))
    header("location: ../login.php");


if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
    header("Location: ../login.php");
}

$user_id = $_SESSION["id"];
$friend_id= $_GET['id'];

$sql= mysqli_query($mysql, "SELECT * FROM friend where id='$friend_id' and id_user='$user_id'");
$row = mysqli_fetch_assoc($sql);


if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $relationship = $_POST['relation'];
    
    
    $sql_u = "SELECT * FROM friend where id='$friend_id'";
    if ($rez_u = mysqli_query($mysql, $sql_u)) {
        $sql = "UPDATE friend SET name='$name', relationship='$relationship' WHERE id=$friend_id AND id_user=$user_id";
        $rez = mysqli_query($mysql, $sql);
        if ($rez) {
            $_SESSION["message"] = "Friend updated successfully";
        } else {
            echo "<script>alert('Error. Friend could not be updated!');</script>";
        }
    } 
}

if(isset($_POST['delete'])){
    $friend_id = $_POST['id'];
    $sql = "DELETE FROM friend WHERE id='$friend_id' AND id_user='$user_id'";
    $res = mysqli_query($mysql, $sql);
    if($res){
        $_SESSION["message"] = "Entry deleted successfully";
        header("Location: friends.php");
        exit();
    }
    else{
        echo "<script>alert('Error. Entry could not be deleted!');</script>";
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
                <?php 
                if (isset($_SESSION["message"])) {
                    echo "<h2 style=''>" . $_SESSION["message"] . "</h2>";
                    header("Location: friends.php");
                    unset($_SESSION["message"]);
                }
                ?>
                <form id="friend-form" method="post" action="">
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
                        <input type="submit" name="submit" value="Save">
                        <form method="post">
                        <input type="hidden" name="id" value="<?php echo $friend_id; ?>">
                        <input type="submit" name="delete" value="Delete">
                </form>
                    </div>
                    
                </form>
                
            </div>
        </div>
</body>
</html>
