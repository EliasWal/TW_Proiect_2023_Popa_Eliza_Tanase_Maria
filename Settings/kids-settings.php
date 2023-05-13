<?php 
require "../config.php";

session_start();

if(!isset($_COOKIE["login"]))
    header("location: ../login.php");


if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
    header("Location: ../login.php");
}

$user_id = $_SESSION["id"];
$username = $_SESSION["username"];

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="../admin-topbar.css" rel="stylesheet" />
    <link href="kids-settings.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <?php require "../login-topbar.php"; ?>
        <div class="container">
            <div class="leftbar">
                <h2>Settings</h2>
                <ul class="set-menu">
                    <li id="general">
                        <a href="general.php">General</a></li>
                    <li id="manage-kids">
                        <a href="kids-settings.php">Manage your kids</a></li>
                    <li id="ch-pass">
                        <a href="ch-pass.php">Change password</a></li>
                </ul>
            </div>
            <div class="kids-container">
                <h2>Manage kids</h2>
                <div class="child1">
                    <div class="kids">
                        <!-- <label id="sel-kid">
                                <select id="select-kid" name="kid-select">
                                    <option value="Eric" selected>Eric</option>
                                    <option value="Lucy">Lucy</option>
                                </select>
                        </label> -->
                        <form action="manage-kids-add.php">
                            <button class="add-kid">
                                Add kid
                            </button>
                        </form>
                    </div>
                    <?php 
                        $sql= mysqli_query($mysql, "SELECT * FROM child where id_parent='$user_id'");
                        while ($row = mysqli_fetch_assoc($sql)) {
                        $child_id = $row['id'];
                    ?>
                    <form id="kids-form" method="post" action="kids-settings-edit.php">
                            <li id="name1">
                                <label >First name</label>
                                <input type="text" value="<?php echo $row["firstname"] ?>" id="name1" name="name1" placeholder="First name" readonly>
                            </li>

                            <li id="name2">
                                <label >Second name</label>
                                <input type="text" value="<?php echo $row["lastname"] ?>" id="name2" name="name2" placeholder="Second name" readonly>
                            </li>
    
                            <li id="age">
                                <label >Birthday</label>
                                <input type="date"  value="<?php echo $row["birthday"] ?>" id="birthdate" readonly>
                            </li>
                            <li id="gender">
                            <label id="gender">Gender</label>
                            <select id="genderSelect" name="gender">
                                <option value="female" <?php if ($row["gender"] == 'female') echo 'selected'; ?> >Female</option>
                                <option value="male" <?php if ($row["gender"] == 'male') echo 'selected';?>>Male</option>
                                <option value="non-binary"<?php if ($row["gender"] == 'non-binary') echo 'selected'; ?>>Non-binary</option>
                                <option value="nospecify" <?php if ($row["gender"] == 'n/a') echo 'selected';?>>Don't specify</option>
                            </select>
                        </li>
                        <div class="buttons-kid1">
                            <input type="submit" value="Edit">
                            <input type="submit" value="Delete">
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
</body>
</html>
