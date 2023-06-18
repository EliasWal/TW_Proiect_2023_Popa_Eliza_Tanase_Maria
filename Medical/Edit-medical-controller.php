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
    $id_child = $_POST['id_child'];

    if(updateMedicalReport($id_medical, $date, $doctor, $symptoms, $diagnosis, $medication)) {
        header("Location: Medical-child.php?id=$id_child");
    } else {
        http_response_code(500); 
        echo json_encode(array('message' => 'Failed to update medical report.'));
    }
}
?>