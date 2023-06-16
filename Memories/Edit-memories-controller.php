<?php
require '../config.php';
require 'memories-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $id_memory = $_POST['id_memory'];

    if (isset($_FILES['picture'])) {
        $file = $_FILES['picture'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        if($fileTmpName) {
            $fileData = file_get_contents($fileTmpName);

            if(updateMemory($id_memory, $date, $title, $description, $fileData)) {
                //header("Location: Edit-memories.php?id=$id_memory");
                http_response_code(201); 
                header('HTTP/1.1 201 Friend updated succesfully!');
                echo json_encode(array('message' => 'Memory updated successfully.'));
            } else {
                http_response_code(500); 
                echo json_encode(array('message' => 'Failed to update memory.'));
            }
        }
        else {
            if(updateMemoryWithoutPhoto($id_memory, $date, $title, $description)) {
                //header("Location: Edit-memories.php?id=$id_memory");
                http_response_code(201); 
                header('HTTP/1.1 201 Friend updated succesfully!');
                echo json_encode(array('message' => 'Memory updated successfully.'));
            } else {
                http_response_code(500); 
                echo json_encode(array('message' => 'Failed to update memory.'));
            }
        }
    }
}

?>