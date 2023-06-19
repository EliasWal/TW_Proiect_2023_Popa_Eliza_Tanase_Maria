<?php 
require '../config.php';
require 'friend-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
    $name = $_POST['name'];
    $relationship = $_POST['relation'];
    $id = $_POST['id'];

    

    if (isset($_FILES['photo'])) {
        $file = $_FILES['photo'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        if($fileTmpName) {
            $fileData = file_get_contents($fileTmpName);

            if (updateFriend1($id, $name, $relationship, $fileData)) {
                header("Location: friends.php");
            //http_response_code(201); 
            //header('HTTP/1.1 201 Friend updated succesfully!');
            // echo json_encode(array('message' => 'Friend added successfully.'));
                
                
            } else {
                http_response_code(500); 
                echo json_encode(array('message' => 'Failed to update friend.'));
            }
            
        }
    }
    else {
        if (updateFriend($id, $name, $relationship)) {
            header("Location: friends.php");
           //http_response_code(201); 
           //header('HTTP/1.1 201 Friend updated succesfully!');
          // echo json_encode(array('message' => 'Friend added successfully.'));
            
            
        } else {
            http_response_code(500); 
            echo json_encode(array('message' => 'Failed to update friend.'));
        }

    }
?>