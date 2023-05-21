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

    if(isset($_POST['submit'])){
        $time = $_POST['time'];
        $notes = $_POST['notes'];
    
        $sql = "INSERT INTO calendar(id_user, id_child, time, sleep, feed, notes) VALUES(?,?,?,?,?,?)";
        $stmtinsert = $mysql->prepare($sql);
        $rez= $stmtinsert->execute([$user_id, $id_child, $time, 0, 0, $notes]);
        if($rez){
                 $_SESSION["message"] = "Entry added succesfully to the calendar!";
                }    
        else {
                echo"<script>alert('Error. Entry could not be added!');</script>";
             }
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
    <link href="Add-calendars.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <?php require "../login-topbar.php"; ?> 
        <div class="page">
            <?php require "leftbar-calendars.php"; ?> 
            <div class="right">
                <a href="Calendars-child.php?id=<?php echo $id_child; ?>">
                    <button>
                        <img src="../Photos/Back.png" alt="back">
                        Back 
                    </button>
                </a>
                <?php
                    $row = mysqli_fetch_assoc($sql_name);
                    $name = $row['firstname'];
                ?>
                <h1> Add a new calendar time for <?php echo $name; ?></h1>
                <?php if(isset($_SESSION["message"])){
                        echo "<h1 style='text-decoration:none;'>" . $_SESSION["message"] . "</h1>";
                    }
                    unset($_SESSION["message"]);
                ?>
                <form id="add-form" method="post">
                    <li id="time">
                        <label >Time</label>
                        <input name="time" type="time"  value="" id="timecalendar">
                    </li>
                    <li id="notes">
                        <label>Notes</label>
                        <input name="notes" type="text" value="" id="notes" name="notes" placeholder="Add extra notes">
                    </li>
                <div href="Calendars-child.php" class="buttons-kid1">
                    <input type="submit" name="submit" value="Save">
                </div>
            </form>
            </div>
        </div>
</body>
</html>
