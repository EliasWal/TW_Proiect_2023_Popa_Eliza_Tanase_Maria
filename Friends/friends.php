<?php 
require '../config.php';

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
    <link href="friends.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
        <?php require "../login-topbar.php"; ?> 
        <div class="container">
            <div class="leftbar">
                <h2>Friends</h2>
                <ul class="set-menu">
                    <li id="general">
                        <a href="friends.php">Friends</a></li>
                    <li id="add-friend">
                        <a href="add-friend.php">Add friend</a>
                    </li>
                </ul>

            </div>
            <div class="prieteni">
            <?php 
                $sql= mysqli_query($mysql, "SELECT * FROM friend where id_user='$user_id'");
                while ($row = mysqli_fetch_assoc($sql)) {
                $friend_id = $row['id'];
            ?>
            
                <div class="f1">
                    <?php
                    $imageData = base64_encode($row['photo']);
                    $src = 'data:image;base64,' . $imageData;
                    ?>
                    <img src="<?php echo $src; ?>">
                    <li>Name:  <?php echo $row['name']; ?></li>
                    <li>Relation: <?php echo $row['relationship']; ?></li>
                    <li id="edit">
                        <a href="edit-friend.php?id=<?php echo $friend_id; ?>">
                            <input type="submit" value="Edit">
                        </a>
                    </li>
                </div>
                <?php } ?>
                </div>
                
            </div>
        </div>
</body>
</html>