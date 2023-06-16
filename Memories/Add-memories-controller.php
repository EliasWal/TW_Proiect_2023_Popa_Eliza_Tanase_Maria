<?php
require '../config.php';
require 'memories-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $id_child = $_POST['id_child'];

    if (isset($_FILES['picture'])) {
        $file = $_FILES['picture'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileData = file_get_contents($fileTmpName);

        if(addMemory($_SESSION["id"], $id_child, $date, $title, $description, $fileData)) {
            //header("Location: Add-memories.php?id=$id_child");
            http_response_code(201); 
            header('HTTP/1.1 201 Friend updated succesfully!');
            echo json_encode(array('message' => 'Memory added successfully.'));
        } else {
            http_response_code(500); 
            echo json_encode(array('message' => 'Failed to add memory.'));
        }
    }
}
?>