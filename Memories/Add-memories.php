<?php 
require '../config.php';

session_start();

if(!isset($_COOKIE["login"]))
    header("location: ../login.php");


if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
    header("Location: ../login.php");
}

$user_id = $_SESSION["id"];
$id_child = $_GET['id'];

if(isset($_POST['submit'])){
    $date = $_POST['date'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (isset($_FILES['picture'])) {
        $file = $_FILES['picture'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileData = file_get_contents($fileTmpName);

        $sql = "INSERT INTO memory(id_user, id_child, date, title, description, picture) VALUES(?,?,?,?,?,?)";
        $stmtinsert = $mysql->prepare($sql);
        $stmtinsert->bind_param('iissss', $user_id, $id_child, $date, $title, $description, $fileData);
        $rez= $stmtinsert->execute();
        
        if($rez){
                $_SESSION["message"] = "Memory added succesfully to the acount!";
                }    
        else {
                echo"<script>alert('Error. Memory could not be added!');</script>";
            }
    }
    else echo "Nope!";
}

$sql_name = mysqli_query($mysql, "SELECT * FROM child where id='$id_child'");
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="Add-memories-style.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
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
                <?php
                    $row = mysqli_fetch_assoc($sql_name);
                    $name = $row['firstname'];
                ?>
                <h1> Add a new memory for <?php echo $name; ?> </h1>
                <?php if(isset($_SESSION["message"])){
                        echo "<h1 style='text-decoration:none;'>" . $_SESSION["message"] . "</h1>";
                    }
                    unset($_SESSION["message"]);
                ?>
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
                        <input type="file" accept="image/*" value="" id="picture" name="picture" placeholder="Add picture">
                    </li>
                <div class="buttons-kid1">
                    <input type="submit" name="submit" value="Save">
                </div>
            </form>
            </div>
        </div>
</body>
</html>
