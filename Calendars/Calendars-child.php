<?php
    require "../config.php";
    require "calendars-service.php";
    
    if(!isset($_COOKIE["login"]))
        header("location: ../login.php");
    
    
    if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
        header("Location: ../login.php");
    }

    $user_id = $_SESSION["id"];
    $id_child = $_GET['id'];
    
    $calendar = getCalendar($user_id, $id_child);
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
                <h1> <?php echo getNameChild($id_child); ?>'s timetable</h1>
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
                           foreach($calendar as $row) {
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
                                    <form method="post" action="Delete-calendars-controller.php">
                                        <input type="hidden" name="id_calendar" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="id_child" value="<?php echo $id_child; ?>">
                                        <div class="delete-buttons">
                                            <a class="table-value" href="Calendars-child.php?id=<?php echo $id_child; ?>&idc=<?php echo $row['id']; ?>">
                                                <img src="../Photos/bin.png" alt="bin">
                                            </a>
                                        </div>
                                    </form>
                                </td>
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
