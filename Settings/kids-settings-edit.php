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
                <h2>Edit info about your kid</h2>
                <div class="child1">
                    <div class="kids">
                        <label id="sel-kid">
                                <select id="select-kid">
                                    <option value="Eric" selected>Eric</option>
                                    <option value="Lucy" disabled>Lucy</option>
                                </select>
                        </label>
                    </div>
                    <form id="kids-form" method="post" action="kids-settings.php">
                            <li id="name1">
                                <label >First name</label>
                                <input type="text" value="Damian" id="name1" name="name1" placeholder="First name">
                            </li>

                            <li id="name2">
                                <label >Second name</label>
                                <input type="text" value="Eric" id="name2" name="name2" placeholder="Second name">
                            </li>
    
                            <li id="age">
                                <label >Birthday</label>
                                <input type="date"  value="2021-06-15" id="birthdate">
                            </li>
                            <li id="gender">
                                <label id="gender">Gender</label>
                                    <select id="genderSelect" >
                                        <option value="female">Female</option>
                                        <option value="male" selected>Male</option>
                                        <option value="non-binary">Non-binary</option>
                                        <option value="nospecify">Don't specify</option>
                                    </select>
                            </li>
                        <div class="buttons-kid1">
                            <input type="submit" value="Save">
                            <input type="reset" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>

