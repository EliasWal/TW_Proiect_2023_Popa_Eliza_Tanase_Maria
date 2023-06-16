<?php 

require '../config.php';

session_start();
function addFriend($user_id, $name, $relationship, $fileData){
    global $mysql;

    $stmt = $mysql->prepare("INSERT INTO friend (id_user, name, relationship, photo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $name, $relationship, $fileData);

    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }
}


function getFriends($user_id){
    global $mysql;
    $stmt = $mysql->prepare("SELECT * FROM friend WHERE id_user = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $friends = array();
    while($row = $result->fetch_assoc()){
        $friends[] = $row;
    }
    return $friends;
}

function getOneFriend($friend_id){
    global $mysql;
    $stmt = $mysql->prepare("SELECT * FROM friend where id=?");
    $stmt->bind_param("i", $friend_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $friend = $result->fetch_assoc();
    return $friend;
}

function updateFriend($friend_id, $name, $relationship, $fileData) {
    global $mysql;

    $stmt = $mysql->prepare("UPDATE friend SET name=?, relationship=?, photo=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $relationship, $fileData, $friend_id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function deleteFriend($friend_id){
    global $mysql;
    $sql = "DELETE FROM friend WHERE id='$friend_id'";
    $res = mysqli_query($mysql, $sql);
    if($res){
        return true;
    }
    else {
        return false;
    }
}

?>