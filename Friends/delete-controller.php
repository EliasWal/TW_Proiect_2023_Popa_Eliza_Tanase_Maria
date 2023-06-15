<?php 
require '../config.php';
require 'friend-service.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
            $friend_id=$_POST['id'];
            if(deleteFriend($friend_id)){
                http_response_code(204); 
                echo json_encode(array('message' => 'Friend deleted successfully.'));
                header("Location: friends.php");
            }
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'Failed to add friend.'));

            exit();
        }
    
}

?>