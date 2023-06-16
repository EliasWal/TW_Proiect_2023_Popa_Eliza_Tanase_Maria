<?php 

require '../config.php';

session_start();

function addMemory($user_id, $id_child, $date, $title, $description, $fileData) {
    global $mysql;
    $sql = "INSERT INTO memory(id_user, id_child, date, title, description, picture) VALUES(?,?,?,?,?,?)";
    $stmtinsert = $mysql->prepare($sql);
    $stmtinsert->bind_param('iissss', $user_id, $id_child, $date, $title, $description, $fileData);
    if($stmtinsert->execute()) {
        return true;
    }
    else{
        return false;
    }
}

function getMemories($user_id, $id_child) {
    global $mysql;
    $sql= "SELECT * FROM memory where id_user=? and id_child=?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('ii', $user_id, $id_child);
    $memories = array();
    while($row = mysqli_fetch_assoc($sql)) {
        $memories[] = $row;
    }
    return $memories;
}

function updateMemory($id_memory, $date, $title, $description, $fileData) {
    global $mysql;
    $sql = "UPDATE memory SET date=?, title=?, description=?, picture=? WHERE id=?";
    $stmtupdate = $mysql->prepare($sql);
    $stmtupdate->bind_param('ssssi', $date, $title, $description, $fileData, $id_memory);
    if($stmtupdate->execute()) {
        return true;
    }
    else{
        return false;
    }
}

function updateMemoryWithoutPhoto($id_memory, $date, $title, $description) {
    global $mysql;
    $sql = "UPDATE memory SET date=?, title=?, description=? WHERE id=?";
    $stmtupdate = $mysql->prepare($sql);
    $stmtupdate->bind_param('sssi', $date, $title, $description, $id_memory);
    if($stmtupdate->execute()) {
        return true;
    }
    else{
        return false;
    }
}

function deleteMemory($id_memory) {
    global $mysql;
    $sql = "DELETE FROM memory WHERE id=$id_memory";
    $rez = mysqli_query($mysql, $sql);
    if($rez) {
        return true;
    }
    else{
        return false;
    }
}
?>