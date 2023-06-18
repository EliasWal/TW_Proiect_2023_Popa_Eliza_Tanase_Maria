<?php
    require '../config.php';
    require "signup-service.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <title> Baby manager </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../guest-topbar.css" rel="stylesheet" />
    <link href="SignUp1.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <header>
        <nav>
            <ul class='nav-bar'>
                <div class='logo'>
                        <img src='..\Photos\Baby manager.png'/> 
                        <span class='logo-name'>BABY MANAGER</span>
                </div>
                <input type='checkbox' id='check' />
                <span class="menu">
                    <li><a href="../Welcome.html">Home</a></li>
                    <li><a href="../AboutUs.html">About us</a></li>
                    <a href="../SignUp/SignUp.php">
                    <button  class="sign"> Sign up </button></a>
                    <a href="../Login.php">
                    <button class="login"> Log in </button></a>
                    <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
                </span>
                <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
            </ul>
        </nav>
    </header>    
        </div> 
        <div class="signup-container">
            <h2>Create a new account</h2>
            <form id="signup-form" method="post" action="Add-SignUp-controller.php">
                
                <div class="col1">
                    <li  id="name1">
                        <label>Name</label>
                        <input type="text" id="name1" name="name1" placeholder="First name" required>
                    </li>
                    <li id="name2">
                        <input type="text" id="name2" name="name2" placeholder="Second name" required>
                    </li>
                    <li id="email">
                        <label>Email</label>
                        <input type="email" id="email-adress" name="email" placeholder="ex: name@example.com" required>
                    </li>
                    <li id="username">
                        <label>Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </li>
                </div>
                <div class="col2">   
                    <li  id="password">
                        <label>Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </li>

                    <li id="repeatpassword">
                        <label>Repeat Password</label>
                        <input type="password" id="repeatpassword" name="repeatpassword" placeholder="Enter your password" required>
                    </li>
                    <li id="gender">
                        <label >Gender</label>
                        <select id="genderSelect" name='gender' required>
                            <option value="" disabled selected>Choose option</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                            <option value="non-binary">Non-binary</option>
                            <option value="nospecify">Don't specify</option>
                        </select>
                    </li>
                    <li id="pronouns">
                        <label >Pronouns</label>
                        <input type="text" id="pronouns" name="pronouns" placeholder="ex: she/her" required>
                    </li>
                    <input type="submit" name ="submit" value="Create">
                </div>
            </form>
        </div>
</body>
</html>
