<?php
    require "../config.php";
    require "memories-service.php";
    
    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");
    
    
    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }

    $user_id = $_SESSION["id"];
    $id_memory = $_GET['id'];

    $row = getMemory($id_memory);
    $id_child = $row['id_child'];

    $date = $row['date'];
    $title = $row['title'];
    $description = $row['description'];
    $picture = $row['picture'];
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="edit-memories-style.css" rel="stylesheet" />
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
                <a href="Memories-child.php?id=<?php echo $row['id_child']; ?>">
                    <button>
                        <img src="../Photos/Back.png" alt="back">
                        Back 
                    </button>
                </a>
                <h1> Edit <?php echo getNameChild($id_child); ?>'s memory</h1>
                <h1>
                <?php if(isset($_SESSION["message"])){
                        echo "<h2 style=''>" . $_SESSION["message"] . "</h2>";
                    }
                    unset($_SESSION["message"]);
                ?>
                </h1>
                <form id="add-form" method="post" action="Edit-memories-controller.php" enctype="multipart/form-data">
                    <li id="date">
                        <label >Date</label>
                        <input type="date"  value="<?php echo $date; ?>" id="memorydate" name="date">
                    </li>
                    <li id="title">
                        <label>Title</label>
                        <input type="text" value="<?php echo $title; ?>" id="title" name="title" placeholder="Add a title">
                    </li>
                    <li id="description">
                        <label >Description</label>
                        <textarea name="description" rows="10" cols="100" placeholder="Describe the memory"><?php echo $description; ?></textarea>
                    </li>
                    <li id="picture">
                        <label >Picture</label>
                        <?php
                            $imageData = base64_encode($picture);
                            $src = 'data:image;base64,' . $imageData;
                        ?>
                        <img src="<?php echo $src;?>" id="previewImage">
                        <input type="file" accept="image/*" value="" id="picture" name="picture" placeholder="Add picture" onchange="previewPhoto(event)">
                        <input type="hidden" name="id_memory" value="<?php echo $id_memory; ?>">
                    </li>
                <div class="buttons-kid1">
                    <input type="submit" name="submit" value="Save">
                </div>
                </form>
            </div>
        </div>
</body>
</html>
