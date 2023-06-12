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

    if (isset($_GET['idc'])) {
        $idc = $_GET['idc'];
        $delete = mysqli_query($mysql, "DELETE FROM calendar WHERE id=$idc");
        if($delete){
            header("Location: Calendars-child.php?id=$id_child");
            exit();
        }
    }
    
    $sql= mysqli_query($mysql, "SELECT * FROM calendar where id_user='$user_id' and id_child='$id_child' ORDER BY time");

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
    <link href="Style-calendars-child1.css" rel="stylesheet" />
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
                <h1> <?php echo $name; ?>'s timetable</h1>
                <div class="buttons">
                        <a href="Add-calendars.php?id=<?php echo $id_child; ?>">
                            <button>
                                <img src="../Photos/Add.png" alt="add">
                                Add 
                            </button>
                        </a>
                        <a href="Edit-calendars.php?id=<?php echo $id_child; ?>">
                            <button>
                                <img src="../Photos/Edit.png" alt="edit">
                                Edit 
                            </button>
                        </a>
                </div>
                <form id="table-calender" method="post"  action="">
                    <table>
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
                                    <td><input type="time" value="<?php echo $row['time']; ?>" id="time" name="time" readonly></td>
                                </div>
                                <div class="sleep-chk">
                                    <?php 
                                        if($row['sleep'] == 1)
                                        {
                                    ?>
                                        <td><input type="checkbox" id="sleep" name="sleep" onclick="return false;"  checked></td>
                                    <?php
                                        } else {
                                    ?>
                                        <td><input type="checkbox" id="sleep" name="sleep" onclick="return false;" ></td>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="feed-chk">
                                    <?php 
                                        if($row['feed'] == 1)
                                        {
                                    ?>
                                        <td><input type="checkbox" id="feed" name="feed" onclick="return false;" checked></td>
                                    <?php
                                        } else {
                                    ?>
                                        <td><input type="checkbox" id="feed" name="feed" onclick="return false;"></td>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="note-in">
                                    <td><input type="text" id="note" name="note" value="<?php echo $row['notes']; ?>" readonly></td>
                                </div>
                                <td> 
                                    <div class="delete-buttons">
                                        <a class="table-value" href="Calendars-child.php?id=<?php echo $id_child; ?>&idc=<?php echo $row['id']; ?>">
                                            <img src="../Photos/bin.png" alt="edit">
                                        </a>
                                    </div>
                                <td>
                            </div>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </form>
            </div>
        </div>
</body>
</html>
