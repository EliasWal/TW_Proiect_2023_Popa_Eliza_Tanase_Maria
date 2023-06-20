<?php
require '../config.php';
require 'media-service.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['name'];
    $id_media = $_POST['id_media'];
    
    if (isset($_FILES['picture'])) {
        $file = $_FILES['picture'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        if($fileTmpName) {
            $fileData = file_get_contents($fileTmpName);

            if(updateMedia($id_media, $name, $fileData)) {
               header("Location: media.php");
               // http_response_code(201); 
                //header('HTTP/1.1 201 Memory updated succesfully!');
               //echo json_encode(array('message' => 'Memory updated successfully.'));
            } else {
                http_response_code(500); 
                echo json_encode(array('message' => 'Failed to update memory.'));
            }
        }
    }
        else {
            if(updateMediaWithoutPhoto($id_media, $title)) {
               header("Location: media.php");
                //http_response_code(201); 
                //header('HTTP/1.1 201 Memory updated succesfully!');
                //echo json_encode(array('message' => 'Memory updated successfully.'));
            } else {
                http_response_code(500); 
                echo json_encode(array('message' => 'Failed to update memory.'));
            }
        }
    
}

?>