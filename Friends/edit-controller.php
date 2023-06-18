<?php 
require '../config.php';
require 'friend-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
    $name = $_POST['name'];
    $relationship = $_POST['relation'];
    if (isset($_FILES['photo'])) {
        $file = $_FILES['photo'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileData = file_get_contents($fileTmpName);
        var_dump($name, $relationship);

        if (updateFriend($_SESSION["id"], $name, $relationship)) {
           // header("Location: friends.php");
           http_response_code(201); 
           header('HTTP/1.1 201 Friend updated succesfully!');
           echo json_encode(array('message' => 'Friend added successfully.'));
            
            
        } else {
            http_response_code(500); 
            echo json_encode(array('message' => 'Failed to update friend.'));
        }
    }
?>