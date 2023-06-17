<?php
require '../config.php';
require 'calendars-service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_child = $_POST['id_child'];
    $calendar = getCalendar($_SESSION["id"], $id_child);
    $length = count($calendar);

    $time_ = $_POST['time'];
    if(isset($_POST['sleep']))
        $sleep_ = $_POST['sleep'];
    else
        $sleep_ = array_fill(0, $length, 0);
    if(isset($_POST['feed']))
        $feed_ = $_POST['feed'];
    else
        $feed_ = array_fill(0, $length, 0);
    $notes_ = $_POST['notes'];
    
    $i = -1;

    foreach($calendar as $row)
    {
        $i = $i + 1;
        $id = $row['id'];
        
        $time = $time_[$i];
        if(in_array($id, $sleep_))
            $sleep = 1;
        else
            $sleep = 0;
        if(in_array($id, $feed_))
            $feed = 1;
        else
            $feed = 0;
        $notes = $notes_[$i];

        if(updateCalendar($id, $time, $sleep, $feed, $notes)) {
            //header("Location: Edit-calendars.php?id=$id");
            http_response_code(201); 
            header('HTTP/1.1 201 Calendar updated succesfully!');
            echo json_encode(array('message' => 'Calendar updated successfully.'));
        } else {
            http_response_code(500); 
            echo json_encode(array('message' => 'Failed to update calendar.'));
        }
    }
}
?>