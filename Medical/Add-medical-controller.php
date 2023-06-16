<?php
require '../config.php';
require 'medical-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $doctor = $_POST['doctor'];
    $symptoms = $_POST['symptoms'];
    $diagnosis = $_POST['diagnosis'];
    $medication = $_POST['medication'];
    $id_child = $_POST['id_child'];

    if(addMedicalReport($_SESSION["id"], $id_child, $date, $doctor, $symptoms, $diagnosis, $medication)) {
        //header("Location: Add-medical.php?id=$id_child");
        http_response_code(201); 
        header('HTTP/1.1 201 Medical report added succesfully!');
        echo json_encode(array('message' => 'Medical report added successfully.'));
    } else {
        http_response_code(500); 
        echo json_encode(array('message' => 'Failed to add medical report.'));
    }
}
?>