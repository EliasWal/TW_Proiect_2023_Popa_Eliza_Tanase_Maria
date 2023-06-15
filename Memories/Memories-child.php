<?php 
    require "../config.php";

    session_start();

    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");


    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }

    $user_id = $_SESSION["id"];
    $id_child = $_GET['id'];

    if (isset($_GET['idm'])) {
        $idm = $_GET['idm'];
        $delete = mysqli_query($mysql, "DELETE FROM memory WHERE id=$idm");
        if($delete){
            $_SESSION["message"] = "Memory deleted successfully";
            header("Location: Memories-child.php?id=$id_child");
            exit();
        }
        else{
            echo "<script>alert('Error. Memory could not be deleted!');</script>";
        }
    }
    

$sql= mysqli_query($mysql, "SELECT * FROM memory where id_user='$user_id' and id_child='$id_child'");

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
    <link href="style-memories-child2.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require "../login-topbar.php"; ?> 
        <div class="page">
            <?php require "leftbar-memories.php"; ?> 
            <div class="right">
                <?php
                    $row = mysqli_fetch_assoc($sql_name);
                    $name = $row['firstname'];
                ?>
                <h5> <?php echo $name; ?>'s memories </h5>
                <div class="add-buttons">
                    <a href="Add-memories.php?id=<?php echo $id_child; ?>">
                        <button>
                            <img src="../Photos/Add.png" alt="add">
                            Add 
                        </button>
                    </a>
                </div>
                <?php
                    while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                <h4> <?php echo $row['date']; ?> </h4>
                <div class="postline">
                    <div class="post">
                        <div>
                            <?php
                                $imageData = base64_encode($row['picture']);
                                $src = 'data:image;base64,' . $imageData;
                            ?>
                            <img src="<?php echo $src;?>">
                            <!-- <img src="https://www.epl.ca/wp-content/uploads/sites/18/2020/11/EPLAroundtheBranch_Kids_2019-5746-X3-670x447.jpg" alt="Post1"> -->
                        </div>
                        <div class="description">
                            <h3> <?php echo $row['title']; ?> </h3>
                            <div class="initial-description">
                                <?php 
                                    $str = substr($row['description'], 0, 200);
                                    $del = "\n";
                                    $token = strtok($str, $del);
                                    while($token !== false)
                                    {
                                ?>
                                    <p> <?php echo $token; ?> </p>
                                <?php
                                        $token = strtok($del);
                                    }
                                ?>
                            </div>
                            <p class="dots"> ... </p>
                            <div class="extra-description"> 
                            <?php 
                                    $str = $row['description'];
                                    $del = "\n";
                                    $token = strtok($str, $del);
                                    while($token !== false)
                                    {
                                ?>
                                    <p> <?php echo $token; ?> </p>
                                <?php
                                        $token = strtok($del);
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="post-buttons">
                        <a href="Edit-memories.php?id=<?php echo $row['id']; ?>">
                            <button>
                                <img src="../Photos/Edit.png" alt="edit">
                                Edit 
                            </button>
                        </a>
                        <a href="Memories-child.php?id=<?php echo $id_child; ?>&idm=<?php echo $row['id']; ?>">
                            <button>
                                <img src="../Photos/Delete.png" alt="delete">
                                Delete 
                            </button>
                        </a>
                        <?php include "share-on-facebook.php"; ?>
                        <a href="<?php echo $facebook_url; ?>">
                            <button>
                                <img src="../Photos/Share.png" alt="share">
                                Share
                            </button>
                        </a>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
</body>
</html>