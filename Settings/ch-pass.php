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
$sql_u = mysqli_query($mysql,"SELECT * FROM user_registred where id='$user_id'");
$row = mysqli_fetch_assoc($sql_u);

if(isset($_POST['submit'])){
    $oldpass = $_POST['password-old'];
    $newpass = $_POST['password'];
    $repass = $_POST['repeatpassword'];
    if($row['password'] != $oldpass) 
    {
        echo "<script>alert('Error. Incorrect old password!');</script>";
    }
    else 
    if($row['password'] == $newpass)
    {
        echo "<script>alert('Error. This is the same password!');</script>";
    }
    else 
    if($newpass != $repass){
        echo "<script>alert('Error. The passwords does not match!');</script>";
    }
    else 
    {
        $sql = "UPDATE user_registred SET password='$newpass' WHERE id=$user_id";
        $rez = mysqli_query($mysql, $sql);
        if ($rez) 
        {   
            $_SESSION["message"] = "Password updated successfully";
        } else 
        {
            echo "<script>alert('Error. Password could not be updated!');</script>";
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
    <link href="../admin-topbar.css" rel="stylesheet" />
    <link href="ch-pass.css" rel="stylesheet" />
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
            <div class="pass-container">
                <h2>Change your password</h2>
                <?php if(isset($_SESSION["message"])){
                        echo "<h2 style=''>" . $_SESSION["message"] . "</h2>";
                    }
                    unset($_SESSION["message"]);
                ?>
                <form id="pass-form" method="post" >
                    <li  id="old-password">
                        <label>Old password</label>
                        <input type="password" id="password-old" name="password-old" placeholder="Enter your old password" required>
                    </li>
                    
                    <li  id="password">
                        <label>Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </li>

                    <li id="repeatpassword">
                        <label>Repeat Password</label>
                        <input type="password" id="repeatpassword" name="repeatpassword" placeholder="Enter your password" required>
                    </li>
                    <input type="submit" name="submit" value="Save">
                </form>
                </div>
            </div>
        </div>
</body>
</html>
