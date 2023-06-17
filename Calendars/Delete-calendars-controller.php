<?php
require '../config.php';
require 'calendars-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_calendar = $_POST['id_calendar'];
    $id_child = $_POST['id_child'];

    if(deleteCalendarEntry($id_calendar)){
        http_response_code(204); 
        echo json_encode(array('message' => 'Calendar entry deleted successfully.'));
        header("Location: Calendars-child.php?id=$id_child");
    }
    else {
        http_response_code(500);
        echo json_encode(array('message' => 'Failed to delete calendar entry.'));

        exit();
    }
    
}
?>