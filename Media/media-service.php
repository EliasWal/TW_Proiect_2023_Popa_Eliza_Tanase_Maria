<?php

require '../config.php';

session_start();

function addMedia($user_id, $name, $fileData){
    global $mysql;

    $stmt = $mysql->prepare("INSERT INTO media (id_user, title, picture) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $name, $fileData);

    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }
}

function getMedia($user_id){
    global $mysql;
    $stmt = $mysql->prepare("SELECT * FROM media where id_user=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $media = array();
    while($row = $result->fetch_assoc()){
        $media[] = $row;
    }
    return $media;
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['title'];


    if(isset($_FILES['picture'])){
        $file = $_FILES['picture'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileData = file_get_contents($fileTmpName);

        if(addMedia($_SESSION["id"], $name, $fileData)){
            http_response_code(201); 
            echo json_encode(array('message' => 'Media added successfully.'));
        }
        else{
            http_response_code(500); 
            echo json_encode(array('message' => 'Failed to add media.'));
        }
    }
}

?>