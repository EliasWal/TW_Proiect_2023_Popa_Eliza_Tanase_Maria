<?php 
require '../config.php';

session_start();

if(!isset($_COOKIE["login"]))
    header("location: ../login.php");


if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
    header("Location: ../login.php");
}

$user_id = $_SESSION["id"];

if(isset($_POST["exportCSV"])) {
    // $query = "
    // SELECT *
    // FROM calendar c
    // JOIN child ch ON c.id_child = ch.id
    // LEFT JOIN friend f ON c.id_user = f.id_user
    // LEFT JOIN media m ON c.id_user = m.id_user
    // LEFT JOIN medical_report mr ON c.id_user = mr.id_user AND c.id_child = mr.id_child
    // LEFT JOIN memory mem ON c.id_user = mem.id_user AND c.id_child = mem.id_child
    // WHERE c.id_user = '$user_id'
    // ";
    $query = "Select * from user_registred where id='$user_id'";

    $result= mysqli_query($mysql, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($mysql));
    }

    $data = array();

    while ($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    
    var_dump($data);

    $filename = 'export.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $fp = fopen('php://output', 'w');
    foreach ($data as $row) {
        fputcsv($fp, $row);
    }
    fclose($fp);   
    exit(); 
}

if(isset($_POST['submit'])){
    $firstname = $_POST['name1'];
    $lastname = $_POST['name2'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pronouns = $_POST['pronouns'];
    $gender = $_POST['gender'];
    
    $sql_u = "SELECT * FROM user_registred where id='$user_id'";
    if ($rez_u = mysqli_query($mysql, $sql_u)) {
        $sql = "UPDATE user_registred SET firstname='$firstname', lastname='$lastname', email='$email', username='$username', gender='$gender' , pronouns='$pronouns', phone='$phone', address='$address' WHERE id=$user_id";
        $rez = mysqli_query($mysql, $sql);
        if ($rez) {
            $_SESSION["message"] = "Settings updated successfully";
        } else {
            echo "<script>alert('Error. settings could not be updated!');</script>";
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
    <link href="export.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2102/2102805.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
</head>
<body>
    <?php require "../login-topbar.php"?>
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
            <div class="kids-container">
                <h2>Export your data</h2>
                <form id="export-form" method="post">
                    <input type="submit" name="exportCSV" value="CSV">
                    <input type="submit" name="exportJSON" value="JSON">
                </div>
                </form>
                </div>
            </div>
        </div>
</body>
</html>
