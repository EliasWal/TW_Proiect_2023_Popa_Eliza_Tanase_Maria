<?php
require '../config.php';
require '../Calendars/calendars-service.php';

class CalendarsController {
    public function get($id) {
        if($id) {
            $calendarEntry = getCalendarEntry($id);
            if($calendarEntry) {
                header('Content-Type: application/json');
                http_response_code(200);
                echo " time: " . $calendarEntry['time'] . " sleep: " . $calendarEntry['sleep'] . " feed: " . $calendarEntry['feed'] . " notes: " . $calendarEntry['notes'] ."<br>";
            }
            else{
                http_response_code(404);
                echo json_encode(array('message' => 'Calendar entry not found'));
            }
        }
    }

    public function getAll() {
        $user_id= $_POST['user_id'];
        $id_child = $_POST['id_child'];

        $calendar = getCalendar($user_id, $id_child);
        if($calendar){
            header('Content-Type: application/json');  
            http_response_code(200);
            foreach($calendar as $row){
                echo "id: " . $row['id'] . " time: " . $row['time'] . " sleep: " . $row['sleep'] . " feed: " . $row['feed'] . " notes: " . $row['notes'] ."<br>";
            }
        } else {
            http_response_code(404); 
            echo json_encode(['message' => 'No calendar found']);
        }       
    }

    public function post() {
        $time = $_POST['time'];
        $notes = $_POST['notes'];
        $id_child = $_POST['id_child'];
        $user_id = $_POST['user_id'];

        if(addCalendarEntry($user_id, $id_child, $time, $notes)){
            http_response_code(201);
            echo json_encode(array('message' => 'Calendar entry added successfully.'));
        }
        else{
            http_response_code(500);
            echo json_encode(array('message' => 'Failed to add calendar entry.'));
        }
    }

    public function put() {
        
        $id_child = $_POST['id_child'];
        $user_id = $_POST['user_id'];
        $calendar = getCalendar($user_id, $id_child);
        $length = count($calendar);

        $time_ = $_POST['time'];
        $sleep_ = $_POST['sleep'];
        $feed_ = $_POST['feed'];
        $notes_ = $_POST['notes'];
        
        $i = -1;

        foreach($calendar as $row)
        {
            $i = $i + 1;
            $id = $row['id'];
            
            $time = $time_[$i];
            $sleep = $sleep_[$i];
            $feed = $feed_[$i];
            $notes = $notes_[$i];

            if(updateCalendar($id, $time_, $sleep_, $feed_, $notes_)) {
                http_response_code(204);
                echo json_encode(array('message' => 'Calendar updated successfully.'));
            }
            else{
                http_response_code(500);
                echo json_encode(array('message' => 'Failed to update calendar.'));
            }
        }
    }

    public function delete($id)
    {
        $calendarEntry = getCalendarEntry($id);
        if(!$calendarEntry){
            http_response_code(404);
            echo json_encode(array('message' => 'Calendar entry not found.'));
            return;
        }

        if(deleteCalendarEntry($id)){
            http_response_code(200);
            echo json_encode(array('message' => 'Calendar entry deleted successfully.'));
        }
        else{
            http_response_code(500);
            echo json_encode(array('message' => 'Failed to delete calendar entry.'));
        }
    }
}

?>