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
    
    $sql= mysqli_query($mysql, "SELECT * FROM calendar where id_user='$user_id' and id_child='$id_child' ORDER BY time");

    $sql_name = mysqli_query($mysql, "SELECT * FROM child where id='$id_child'");

    $array = array();
    $contor = -1;

    
    if(isset($_POST['submit'])){
        $time_ = $_POST['time'];
        $sleep_ = $_POST['sleep'];
        $feed_ = $_POST['feed'];
        $notes_ = $_POST['notes'];
        $i = -1;

        while ($row = mysqli_fetch_assoc($sql)) {
            $i = $i + 1;
            $id = $row['id'];
            
            $time = $time_[$i];
            if(in_array($id, $sleep_))
                $sleep = 1;
            else
                $sleep = 0;
            if(in_array($id, $feed_))
                $feed = 1;
            else
                $feed = 0;
            $notes = $notes_[$i];

            $sql_c = "UPDATE calendar SET time='$time', sleep='$sleep', feed='$feed', notes='$notes' WHERE id=$id";
            $rez = mysqli_query($mysql, $sql_c);
            if($rez){
                $_SESSION["message"] = "Calendars updated succesfully to the account!";
            }    
            else {
                echo"<script>alert('Error. Calendars could not be updated!');</script>";
            }
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
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="Style-calendars-child2.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require "../login-topbar.php"; ?> 
        <div class="page">
            <?php require "leftbar-calendars.php"; ?> 
            <div class="container">
                <?php
                    $row = mysqli_fetch_assoc($sql_name);
                    $name = $row['firstname'];
                ?>
                <h1> Edit <?php echo $name; ?>'s timetable</h1>
                <?php if(isset($_SESSION["message"])){
                        echo "<h2 style=''>" . $_SESSION["message"] . "</h2>";
                    }
                    unset($_SESSION["message"]);
                ?>
                <div class="buttons">
                    <a href="Calendars-child.php?id=<?php echo $id_child; ?>">
                        <button>
                            <img src="../Photos/Back2.png" alt="back">
                            Back 
                        </button>
                    </a>
                <form method="post"  action="">
                    <input type="submit" name="submit" value="Save">
                </div>
                    <div id="table-calender" >
                    <table id="table">
                        <div class="labels">
                            <tr>
                                <th><label for="time">Time</label></th>
                                <th><label for="Sleep">Sleep</label></th>
                                <th><label for="Feed">Feed</label></th>
                                <th><label for="notes">Notes</label></th>
                            </tr>
                        </div>
                        <?php
                            while ($row = mysqli_fetch_assoc($sql)) {
                        ?>
                        <tr>
                            <div class="valori">
                                <div class="time-inp">
                                    <td><input type="time" value="<?php echo $row['time']; ?>" id="time" name="time[]"></td>
                                </div>
                                <div class="sleep-chk">
                                    <?php 
                                        if($row['sleep'] == 1)
                                        {
                                    ?>
                                        <td><input type="checkbox" id="sleep" value="<?php echo $row['id']; ?>" name="sleep[]" checked></td>
                                    <?php
                                        } else {
                                    ?>
                                        <td><input type="checkbox" id="sleep" value="<?php echo $row['id']; ?>" name="sleep[]"></td>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="feed-chk">
                                    <?php 
                                        if($row['feed'] == 1)
                                        {
                                    ?>
                                        <td><input type="checkbox" id="feed" value="<?php echo $row['id']; ?>" name="feed[]" checked></td>
                                    <?php
                                        } else {
                                    ?>
                                        <td><input type="checkbox" id="feed" value="<?php echo $row['id']; ?>" name="feed[]"></td>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="note-in">
                                    <td><input type="text" id="notes" name="notes[]" value="<?php echo $row['notes']; ?>"></td>
                                </div>
                            </div>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>
