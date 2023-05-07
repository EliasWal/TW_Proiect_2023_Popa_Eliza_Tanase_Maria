<?php 
require 'config.php';

// $_SESSION = [];
// session_unset();
// session_destroy();
setcookie("login","",time()-1);

header("Location: welcome.html");
?>