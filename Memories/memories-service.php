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
    $sql= "SELECT * FROM memory where id_user=? and id_child=? order by date desc";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('ii', $user_id, $id_child);
    $stmt->execute();
    $result = $stmt->get_result();
    $memories = array();
    while($row = $result->fetch_assoc()) {
        $memories[] = $row;
    }
    return $memories;
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

function getMemory($id_memory) {
    global $mysql;
    $sql= "SELECT * FROM memory where id=?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('i', $id_memory);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
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