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

$sql= mysqli_query($mysql, "SELECT * FROM user_registred where id='$user_id'");
$row = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="../admin-topbar.css" rel="stylesheet" />
    <link href="general.css" rel="stylesheet" />
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
                    <li id="export">
                        <a href="export.php">Export data</a></li> 
                    <li id="import">
                        <a href="import.php">Import data</a></li>     
                </ul>
            </div>
            <div class="general-container">
                <h2>General settings</h2>
                <form id="general-form" method="post" action="general-edit.php">
                    <div id="col1">
                        <li id="name1">
                            <label >First name</label>
                            <input type="text" value="<?php echo $row["firstname"] ?>" id="name1" name="name1" placeholder="First name" readonly>
                        <li id="name2">
                            <label >Second name</label>
                            <input type="text" value="<?php echo $row["lastname"] ?>" id="name2" name="name2" placeholder="Second name" readonly>
                        </li>
                        </li>
                        <li id="phone">
                            <label >Phone number</label>
                            <input type="tel"  value="<?php echo $row["phone"] ?>" id="phone" name="phone" placeholder="ex: 07xxxxxxxx" readonly>
                        </li>
                        <li id="email">
                            <label>Email</label>
                            <input type="email"  value="<?php echo $row["email"] ?>" id="email-adress" name="email" placeholder="ex: name@example.com" readonly>
                        </li>
                    </div>
                    <div id="col2">
                        <li id="username">
                            <label>Username</label>
                            <input type="text" value="<?php echo $username;?>" id="username" name="username" placeholder="Enter your username" readonly>
                        </li>
                        <li id="address">
                            <label >Address</label>
                            <input type="text" value="<?php echo $row["address"] ?>" id="address" name="address" placeholder="Enter your address" readonly>
                        </li>
                        <li id="gender">
                            <label id="gender">Gender</label>
                            
                            <select id="genderSelect">
                                <option value="female" <?php if ($row["gender"] == 'female') echo 'selected'; else echo 'disabled'; ?> >Female</option>
                                <option value="male" <?php if ($row["gender"] == 'male') echo 'selected'; else echo 'disabled'; ?>>Male</option>
                                <option value="non-binary"<?php if ($row["gender"] == 'non-binary') echo 'selected'; else echo 'disabled'; ?>>Non-binary</option>
                                <option value="nospecify" <?php if ($row["gender"] == 'n/a') echo 'selected'; else echo 'disabled'; ?>>Don't specify</option>
                            </select>
                        </li>
                        <li id="pronouns">
                            <label >Pronouns</label>
                            <input type="text" value="<?php echo $row["pronouns"] ?>" id="pronouns" name="pronouns" placeholder="ex: she/her" readonly>
                        </li>
                    <input type="submit" value="Edit">
                </div>
                </form>
                </div>
            </div>
        </div>
</body>
</html>
