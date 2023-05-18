<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="../admin-topbar.css" rel="stylesheet" />
    <link href="ch-pass-save.css" rel="stylesheet" />
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
                        <a href="general.html">General</a></li>
                    <li id="manage-kids">
                        <a href="kids-settings.html">Manage your kids</a></li>
                    <li id="ch-pass">
                        <a href="ch-pass.html">Change password</a></li>
                </ul>
            </div>
            <div class="pass-container">
                <h2>Change your password</h2>
                <p> Your password was successfully changed!!!</p>
                <form id="pass-form" method="post" action="ch-pass-save.html">
                    <li id="repeatpassword">
                        <label>Repeat Password</label>
                        <input type="password" id="repeatpassword" name="repeatpassword" placeholder="Enter your password" required>
                    </li>
                    <li  id="password">
                        <label>Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </li>

                    <li id="repeatpassword">
                        <label>Repeat Password</label>
                        <input type="password" id="repeatpassword" name="repeatpassword" placeholder="Enter your password" required>
                    </li>
                    <input type="submit" value="Save">
                </form>
            </div>
        </div>
</body>
</html>
