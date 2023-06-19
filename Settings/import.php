<?php 
require '../config.php';

session_start();

if(!isset($_COOKIE["login"]))
    header("location: ../login.php");


if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
    header("Location: ../login.php");
}

$user_id = $_SESSION["id"];

if (isset($_POST["import-form"])) {
// Numele fișierului JSON exportat
$filename = $_FILES["importFile"];

// Citește conținutul fișierului JSON
$jsonData = file_get_contents($filename);

// Verifică dacă conținutul a fost citit cu succes
if ($jsonData !== false) {
    echo "Error reading file";

    // Decodează JSON-ul într-un array asociativ
    $data = json_decode($jsonData, true);

    // Iterează prin array-ul de date
    foreach ($data as $tableName => $tableData) {
        foreach ($tableData as $rowData) {
            // Construiește query-ul de inserare
            $columns = implode(', ', array_keys($rowData));
            $values = "'" . implode("', '", $rowData) . "'";

            $query = "INSERT INTO $tableName ($columns) VALUES ($values)";

            // Execută query-ul de inserare
            $result = mysqli_query($mysql, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($mysql));
            }
        }
    }
} else {
    die("Error reading file: $filename");
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
                <h2>Import data</h2>
                <form id="import-form" method="post" enctype="multipart/form-data">
                    <input type="file" name="importFile" accept=".json, .csv">    
                    <input type="submit" name="import" value="Import">
                </div>
                </form>
                </div>
            </div>
        </div>
</body>
</html>
