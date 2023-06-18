<?php 

require '../config.php';

session_start();

function addCalendarEntry($user_id, $id_child, $time, $notes) {
    global $mysql;
    $sql = "INSERT INTO calendar(id_user, id_child, time, notes) VALUES(?,?,?,?)";
    $stmtinsert = $mysql->prepare($sql);
    $stmtinsert->bind_param("iiss", $user_id, $id_child, $time, $notes);
    if($stmtinsert->execute()) {
        return true;
    }
    else{
        return false;
    }
}

function getCalendar($user_id, $id_child) {
    global $mysql;
    $sql= "SELECT * FROM calendar where id_user=? and id_child=? order by time asc";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('ii', $user_id, $id_child);
    $stmt->execute();
    $result = $stmt->get_result();
    $calendar = array();
    while($row = $result->fetch_assoc()) {
        $calendar[] = $row;
    }
    return $calendar;
}

function getCalendarEntry($id_calendar) {
    global $mysql;
    $sql= "SELECT * FROM calendar where id=?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('i', $id_calendar);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
}


function getNameChild($id_child) {
    global $mysql;
    $sql = "SELECT firstname FROM child where id=?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('i', $id_child);
    $stmt->execute();
    $name= $stmt->get_result();
    $res=$name->fetch_assoc();
    return $res['firstname'];
}

function updateCalendar($id_calendar, $time, $sleep, $feed, $notes) {
    global $mysql;
    $sql = "UPDATE calendar SET time=?, sleep=?, feed=?, notes=? WHERE id=?";
    $stmtupdate = $mysql->prepare($sql);
    $stmtupdate->bind_param('siisi', $time, $sleep, $feed, $notes, $id_calendar);
    if($stmtupdate->execute()) {
        return true;
    }
    else{
        return false;
    }
}

function deleteCalendarEntry($id_calendar) {
    global $mysql;
    $sql = "DELETE FROM calendar WHERE id=$id_calendar";
    $rez = mysqli_query($mysql, $sql);
    if($rez) {
        return true;
    }
    else{
        return false;
    }
}
?>