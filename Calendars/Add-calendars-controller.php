<?php
require '../config.php';
require 'calendars-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $time = $_POST['time'];
    $notes = $_POST['notes'];
    $id_child = $_POST['id_child'];

    if(addCalendarEntry($_SESSION["id"], $id_child, $time, $notes)) {
        //header("Location: Add-calendars.php?id=$id_child");
        http_response_code(201); 
        header('HTTP/1.1 201 Calendar entry added succesfully!');
        echo json_encode(array('message' => 'Calendar entry added successfully.'));
    } else {
        http_response_code(500); 
        echo json_encode(array('message' => 'Failed to add calendar entry.'));
    }
}
?>