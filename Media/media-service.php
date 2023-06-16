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

function getOneMedia($media_id){
    global $mysql;
    $stmt = $mysql->prepare("SELECT * FROM media where id=?");
    $stmt->bind_param("i", $media_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $media = $result->fetch_assoc();
    return $media;
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

function deleteMedia($media_id){
    global $mysql;
    $sql = "DELETE FROM media WHERE id='$media_id'";
    $res = mysqli_query($mysql, $sql);
    if($res){
        return true;
    }
    else {
        return false;
    }
}


// if($_SERVER['REQUEST_METHOD'] === 'POST'){
//     $name = $_POST['title'];

//     if(isset($_FILES['picture'])){
//         $file = $_FILES['picture'];

//         $fileName = $file['name'];
//         $fileTmpName = $file['tmp_name'];
//         $fileSize = $file['size'];
//         $fileError = $file['error'];

//         $fileData = file_get_contents($fileTmpName);

//         $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'mp4', 'avi', 'mov', 'mpeg'); // Add any other allowed extensions here

//         $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

//         if(in_array($fileExtension, $allowedExtensions)){
//             if(addMedia($_SESSION["id"], $name, $fileData)){
//                 http_response_code(201);
//                 echo json_encode(array('message' => 'Media added successfully.'));
//             }
//             else{
//                 http_response_code(500);
//                 echo json_encode(array('message' => 'Failed to add media.'));
//             }
//         }
//         else{
//             http_response_code(400);
//             echo json_encode(array('message' => 'Invalid file type.'));
//         }
//     }
// }

?>