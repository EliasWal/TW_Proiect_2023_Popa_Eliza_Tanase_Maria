<?php
    require "../config.php";

    session_start();
    
    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");
    
    
    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }

    $user_id = $_SESSION["id"];
    $id_memory = $_GET['id'];

    $sql= mysqli_query($mysql, "SELECT * FROM memory where id='$id_memory'");

    if(isset($_POST['submit'])){
        $date = $_POST['date'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        if(isset($_FILES['picture'])) {
            $file = $_FILES['picture'];

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileData = file_get_contents($fileTmpName);

            $sql_m = "UPDATE memory SET date='$date', title='$title', description='$description', picture='$fileData' WHERE id=$id_memory";
            $rez = mysqli_query($mysql, $sql_m);
            if($rez){
                $_SESSION["message"] = "Memory updated succesfully to the acount!";
                }    
            else {
                echo"<script>alert('Error. Memory could not be updated!');</script>";
            }
        }
        else {echo "Nope!";}
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="Edit-memories-style.css" rel="stylesheet" />
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
        <div class="page">
            <?php require "leftbar-memories.php"; ?> 
            <div class="right">
                <?php
                    while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                <a href="Memories-child.php?id=<?php echo $row['id_child']; ?>">
                    <button>
                        <img src="../Photos/Back.png" alt="back">
                        Back 
                    </button>
                </a>
                <h1> Edit the memory </h1>
                <h1>
                <?php if(isset($_SESSION["message"])){
                        echo "<h2 style=''>" . $_SESSION["message"] . "</h2>";
                    }
                    unset($_SESSION["message"]);
                ?>
                </h1>
                <form id="add-form" method="post" enctype="multipart/form-data">
                    <li id="date">
                        <label >Date</label>
                        <input type="date"  value="<?php echo $row['date']; ?>" id="memorydate" name="date">
                    </li>
                    <li id="title">
                        <label>Title</label>
                        <input type="text" value="<?php echo $row['title']; ?>" id="title" name="title" placeholder="Add a title">
                    </li>
                    <li id="description">
                        <label >Description</label>
                        <textarea name="description" rows="10" cols="100" placeholder="Describe the memory"><?php echo $row['description']; ?></textarea>
                    </li>
                    <li id="picture">
                        <label >Picture</label>
                        <?php
                            $imageData = base64_encode($row['picture']);
                            $src = 'data:image;base64,' . $imageData;
                        ?>
                        <img src="<?php echo $src;?>" id="previewImage">
                        <input type="file" accept="image/*" value="" id="picture" name="picture" placeholder="Add picture" onchange="previewPhoto(event)">
                    </li>
                <div class="buttons-kid1">
                    <input type="submit" name="submit" value="Save">
                </div>
                </form>
                <?php 
                    }
                ?>
            </div>
        </div>
</body>
</html>
