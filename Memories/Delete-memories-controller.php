<?php
require '../config.php';
require 'memories-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_memory = $_POST['id_memory'];
    $id_child = $_POST['id_child'];

    if(deleteMemory($id_memory)){
        http_response_code(204); 
        echo json_encode(array('message' => 'Memory deleted successfully.'));
        header("Location: Memories-child.php?id=$id_child");
    }
    else {
        http_response_code(500);
        echo json_encode(array('message' => 'Failed to delete memory.'));

        exit();
    }
    
}
?>