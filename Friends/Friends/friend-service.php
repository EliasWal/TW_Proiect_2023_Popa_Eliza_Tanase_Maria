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

function deleteFriend($user_id, $friend_id){
    global $mysql;
    $stmt= $mysql->prepare("DELETE FROM friend WHERE id=? AND id_user=?");
    $stmt->bind_param("ii", $friend_id, $user_id);
    $stmt->execute();
    if($stmt->execute()){
        return true;
    }
    else {
        return false;
    }
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
elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){


}
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_SESSION["id"])) {
        $user_id = $_SESSION["id"];
        $friend_id = $_POST['id'];

        $url = 'http://example.com/friends/' . $friend_id;  // Replace with your actual API endpoint

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set any additional headers if required
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('HeaderName: HeaderValue'));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode === 200) {
            echo "Friend deleted successfully.";
        } elseif ($httpCode === 404) {
            echo "Friend could not be deleted. Please try again later.";
        } else {
            echo "An error occurred while deleting the friend.";
        }
    } else {
        http_response_code(401);
        header("Location: ../login.php");
        exit();
    }
} else {
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed.'));
}


?>