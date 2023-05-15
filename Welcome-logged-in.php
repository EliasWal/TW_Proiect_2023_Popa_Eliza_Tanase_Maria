<?php
require "config.php";
if(!isset($_COOKIE["login"]))
    header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="style-welcome-logged.css" rel="stylesheet" />
    <link href="admin-topbar.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <header>
        <nav>
            <ul class='nav-bar'>
                <div class='logo'>
                        <img src='Photos\Baby manager.png'/> 
                        <span class='logo-name'>BABY MANAGER</span>
                  </div>
                <input type='checkbox' id='check' />
                <span class="menu">
                    <li><a href="Memories/Memories.php">Memories</a></li>
                    <li><a href="Calendars.html">Calendars</a></li>
                    <li><a href="friends.html">Friends</a></li>
                    <li><a href="Medical.html">Medical</a></li>
                    <li><a href="Welcome-logged-in.php">Home</a></li>
                    <li><a href="media.html">Media</a></li>
                    <li class='settings'><a href='Settings\settings.php'><img src='Photos\settings.png'/></a></li>
                    <a href="logout.php">
                    <button class="logout"> Log out </button></a>
                    <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
                </span>
                <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
            </ul>
        </nav>
        </header>
        
        <div class="hello">
            <div class="greeting">
                <?php 
                session_start();
                if(isset($_SESSION['username'])){
                    $username = $_SESSION['username'];
                    echo "Hello, $username!";
                }
                else{
                    header('Location:login.php');
                }
                ?>
            </div>
        </div>           
        <div class="info">
            <p>On this page you can see some resources and informations that can help to make your life a little bit easier, because we know how hard it must be to take care of babies and pubers.</p>
            <p>You can access the Food & Sleep calendar, the Medical history, the Media section,  some memories with your children and the relationship with others from the menu, in top of the page. Also you can manage all of your account settings and add your children by pressing the Setting Icon.</p>
        </div>
</body>
</html>
