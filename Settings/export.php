<?php 
require '../config.php';

session_start();

if(!isset($_COOKIE["login"]))
    header("location: ../login.php");


if(!isset($_SESSION["login"]) || $_SESSION['login']===false){
    header("Location: ../login.php");
}

$user_id = $_SESSION["id"];

if (isset($_POST["exportCSV"])) {
    $tableColumnMapping = array(
        "user_registred" => "id",
        "child" => "id_parent",
        "calendar" => "id_user",
        "memory" => "id_user",
        "medical_report" => "id_user",
        "media" => "id_user",
        "friend" => "id_user",
    );

    $allData = array();

    foreach ($tableColumnMapping as $table => $userIdColumn) {

        $queryColumns = "SHOW COLUMNS FROM $table";
        $resultColumns = mysqli_query($mysql, $queryColumns);

        if (!$resultColumns) {
            die("Query failed: " . mysqli_error($mysql));
        }

        $columns = array();
        while ($columnRow = mysqli_fetch_assoc($resultColumns)) {
            $columnName = $columnRow['Field'];
            
            if (stripos($columnName, 'photo') === false && stripos($columnName, 'picture') === false) {
                $columns[] = $columnName;
            }
        }
        $columnList = implode(", ", $columns);

        $queryData = "SELECT $columnList  FROM $table WHERE $userIdColumn = '$user_id'";
        $resultData = mysqli_query($mysql, $queryData);

        if (!$resultData) {
            die("Query failed: " . mysqli_error($mysql));
        }

        $tableData = array();
        while ($rowData = mysqli_fetch_assoc($resultData)) {
            $tableData[] = $rowData;
        }

        $allData[$table] = $tableData;
    }

$file = fopen('export.csv', 'w');

foreach ($allData as $tableName => $tableData) {
    fwrite($file, "Table: $tableName\n");

    $columns = array_keys($tableData[0]);
    fputcsv($file, $columns);

    foreach ($tableData as $rowData) {
        fputcsv($file, $rowData);
    }

    fwrite($file, "\n");
}

fclose($file);

$filename = 'export.csv';

header('Content-Description: File Transfer');
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

readfile($filename);

exit();
}




if (isset($_POST["exportJSON"])) {
    $tableColumnMapping = array(
        "user_registred" => "id",
        "child" => "id_parent",
        "calendar" => "id_user",
        "memory" => "id_user",
        "medical_report" => "id_user",
        "media" => "id_user",
        "friend" => "id_user",
    );

    $allData = array();

    foreach ($tableColumnMapping as $table => $userIdColumn) {

        $queryColumns = "SHOW COLUMNS FROM $table";
        $resultColumns = mysqli_query($mysql, $queryColumns);

        if (!$resultColumns) {
            die("Query failed: " . mysqli_error($mysql));
        }

        $columns = array();
        while ($columnRow = mysqli_fetch_assoc($resultColumns)) {
            $columnName = $columnRow['Field'];
            
            if (stripos($columnName, 'photo') === false && stripos($columnName, 'picture') === false) {
                $columns[] = $columnName;
            }
        }
        $columnList = implode(", ", $columns);

        $queryData = "SELECT $columnList  FROM $table WHERE $userIdColumn = '$user_id'";
        $resultData = mysqli_query($mysql, $queryData);

        if (!$resultData) {
            die("Query failed: " . mysqli_error($mysql));
        }

        $tableData = array();
        while ($rowData = mysqli_fetch_assoc($resultData)) {
            $tableData[] = $rowData;
        }

        $allData[$table] = $tableData;
    }

    $json_data = json_encode($allData, JSON_PRETTY_PRINT);

    $filename = 'export.json';

    header('Content-Description: File Transfer');
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    echo $json_data;

    mysqli_close($mysql);

    exit;
}?>
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
