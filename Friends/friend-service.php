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
    $sql = "SELECT * FROM friend where id=$friend_id";
    $result = mysqli_query($mysql, $sql);
    if($result){
        $friend = mysqli_fetch_assoc($result);
        return $friend;
    }
    else {
        return null;
    }
}

function updateFriend($friend_id, $name, $relationship) {
    global $mysql;

    $stmt = $mysql->prepare("UPDATE friend SET name='$name', relationship='$relationship' WHERE id='$friend_id'");

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