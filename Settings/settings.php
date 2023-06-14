<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="settings.css" rel="stylesheet" />
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
            <div class="text">
                <p>
                    Here you can administrate your account settings, add or edit the info for your kids and change your password.
                </p>
                <br>
                <p> Click any option in the left panel.
                </p>
            </div>
        </div>
</body>
</html>
