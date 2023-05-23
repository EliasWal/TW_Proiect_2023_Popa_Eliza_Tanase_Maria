<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Baby manager </title>
    <link href="admin-topbar.css" rel="stylesheet" />
    <link href="edit-media.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <header>
        <nav>
            <ul class='nav-bar'>
                <div class='logo'>
                        <img src='photos/Baby manager.png'/> 
                        <span class='logo-name'>BABY MANAGER</span>
                  </div>
                <input type='checkbox' id='check' />
                <span class="menu">
                    <li><a href="Memories.html">Memories</a></li>
                    <li><a href="Calendars.html">Calendars</a></li>
                    <li><a href="friends.html">Friends</a></li>
                    <li><a href="Medical.html">Medical</a></li>
                    <li><a href="Welcome-logged-in.html">Home</a></li>
                    <li><a href="media.html">Media</a></li>
                    <li class='settings'>
                        <a href='settings.html'>
                            <img src='Photos\settings.png'/>
                        </a>
                    </li>
                    <a href="Welcome.html" >
                    <button class="logout"> Log out </button></a>
                    <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
                </span>
                <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
            </ul>
        </nav>
        </header>
        <div class="container">
            <div class="info">
                <p>Here you can upload any type of file, in order to keep them organized and to have them in a single place. </p>
                <p>Feel free to upload any kind of content!</p>
            </div>
            <div class="upload-container">
                <h2>Upload</h2>
                <form id="upload-form" method="post" action="media.html">
                            <li id="name">
                                <label >Title</label>
                                <input type="text" value="Jane cleaning the house" id="name" name="name" placeholder="Title of file">
                            </li>
                            <li id="Photo">
                                <label> Photo</label>
                                <input type="file" id="photo" name="photo">
                            </li>
                            <input type="submit" value="Save">
                        </div>
                    </form>
                </div>

        </div>
        
</body>
</html>
