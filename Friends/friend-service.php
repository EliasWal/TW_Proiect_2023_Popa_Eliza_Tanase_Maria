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
    $stmt = $mysql->prepare("SELECT * FROM friend where id_user=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $friends = array();
    while($row = $result->fetch_assoc()){
        $friends[] = $row;
    }
    return $friends;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $relationship = $_POST['relation'];

    if (isset($_FILES['photo'])) {
        $file = $_FILES['photo'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileData = file_get_contents($fileTmpName);

        if (addFriend($_SESSION["id"], $name, $relationship, $fileData)) {
            http_response_code(201); 
            echo json_encode(array('message' => 'Friend added successfully.'));
        } else {
            http_response_code(500); 
            echo json_encode(array('message' => 'Failed to add friend.'));
        }
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_SESSION["id"])){
        $user_id = $_SESSION["id"];
        $friends = getFriends($user_id);

        if(empty($friends)){
            http_response_code(404);
            echo json_encode(array('message' => 'Add some friends from the leftbar'));
        }
        else {
            http_response_code(200);
            echo json_encode($friends);
        }
    } else{
        http_response_code(401);
        header("Location: ../login.php");
        exit();
    }
}
else {
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed.'));
}

?>