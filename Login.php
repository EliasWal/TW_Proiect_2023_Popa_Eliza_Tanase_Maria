<?php 
    require 'config.php';
    session_start();
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql= mysqli_query($mysql, "SELECT * FROM user_registred where username='$username' or email = '$username'");
        $row = mysqli_fetch_assoc($sql);
        if(mysqli_num_rows($sql) > 0){
            if($password == $row["password"]){
                session_start();
                $_SESSION["login"]=true;
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $username;
                
                if(isset($_REQUEST["remember"]))
                {   setcookie("login","1",time()+86400 * 30);}
                else
                {   setcookie("login", "1");}
                    header("Location:Welcome-logged-in.php");
                
            }
            else{
                //echo "<script>alert('Wrong password!');</script>";
                $_SESSION["message"] = "Wrong password!";
            }
        }
        else{
           // echo "<script>alert('User not registered!');</script>";
           $_SESSION["message"] = "User not registered!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <title> Baby manager </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="guest-topbar.css" rel="stylesheet" />
    <link href="login_style.css" rel="stylesheet" />
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
                    <li><a href="Welcome.html">Home</a></li>
                    <li><a href="AboutUs.html">About us</a></li>
                    <a href="SignUp/SignUp.php">
                    <button  class="sign"> Sign up </button></a>
                    <a href="Login.php">
                    <button class="login"> Log in </button></a>
                    <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
                </span>
                <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
            </ul>
        </nav>
        </header>
        
        <div class="login-container">
            <h2>Welcome</h2>
            <form id="login-form" method="post" action="">
                <label id="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                <label id="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <div id="remember-check">
                    <label>
                    Remember me <input type="checkbox" value="1" name="remember">
                    </label>
                </div>
                <input type="submit" name="submit" value="Log in">
            </form>
            <span >
                <?php if(isset($_SESSION["message"])){
                        echo $_SESSION["message"];
                    }
                    unset($_SESSION["message"]);
                ?>
            </span>
        </div>
</body>
</html>
