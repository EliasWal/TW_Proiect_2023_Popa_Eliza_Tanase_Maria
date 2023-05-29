<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="upload-media.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <?php require "../login-topbar.php"; ?>
        <div class="container">
            <div class="info">
                <p>Here you can upload any type of file, in order to keep them organized and to have them in a single place. </p>
                <p>Feel free to upload any kind of content!</p>
            </div>
            <div class="upload-container">
                <h2>Upload</h2>
                <form id="upload-form" method="post" action="media.php">
                            <li id="name">
                                <label >Title</label>
                                <input type="text" value="" id="name" name="name" placeholder="Title of file">
                            </li>
                            <li id="Photo">
                                <label> Photo</label>
                                <input type="file" id="photo" name="photo" accept="image/*">
                            </li>
                            <input type="submit" value="Save">
                        </div>
                    </form>
                </div>

        </div>
        
</body>
</html>
