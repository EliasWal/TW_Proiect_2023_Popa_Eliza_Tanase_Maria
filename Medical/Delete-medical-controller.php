<?php
require '../config.php';
require 'medical-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_medical = $_POST['id_medical'];
    $id_child = $_POST['id_child'];

    if(deleteMedicalReport($id_medical)){
        http_response_code(204); 
        echo json_encode(array('message' => 'Medical report input deleted successfully.'));
        header("Location: Medical-child.php?id=$id_child");
    }
    else {
        http_response_code(500);
        echo json_encode(array('message' => 'Failed to delete medical report input.'));

        exit();
    }
    
}
?>