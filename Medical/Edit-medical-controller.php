<?php
require '../config.php';
require 'medical-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $doctor = $_POST['doctor'];
    $symptoms = $_POST['symptoms'];
    $diagnosis = $_POST['diagnosis'];
    $medication = $_POST['medication'];
    $id_medical = $_POST['id_medical'];

    if(updateMedicalReport($id_medical, $date, $doctor, $symptoms, $diagnosis, $medication)) {
        //header("Location: Edit-medical.php?id=$id_medical");
        http_response_code(201); 
        header('HTTP/1.1 201 Medical report updated succesfully!');
        echo json_encode(array('message' => 'Medical report updated successfully.'));
    } else {
        http_response_code(500); 
        echo json_encode(array('message' => 'Failed to update medical report.'));
    }
}
?>