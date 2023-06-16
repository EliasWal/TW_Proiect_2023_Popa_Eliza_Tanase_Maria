<?php
require '../config.php';
require '../friends/friend-service.php';


class FriendsController
{
    public function get($id)
    {
        if ($id) {
            $friend = getOneFriend($id);
            if ($friend) {
                echo json_encode($friend);
            } else {
                http_response_code(404); 
                echo json_encode(['message' => 'Friend not found']);
            }
        } else{

           echo json_encode([
            ['id' => 1, 'name' => 'Example 1'],
            ['id' => 2, 'name' => 'Example 2']
        ]);
        }
    }

    public function getAll()
{
    
    $friends = getFriends(6);
    if ($friends) {
        echo json_encode($friends);
    } else {
        http_response_code(404); 
        echo json_encode(['message' => 'No friends found']);
    }
}

    public function post()
    {
        $name = $_POST['name'];
        $relationship = $_POST['relationship'];
        if (isset($_FILES['photo'])) {
            $file = $_FILES['photo'];
    
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
    
            $fileData = file_get_contents($fileTmpName);
            
            $friendId = addFriend(6,$name, $relationship, $fileData);

        if ($friendId) {
            http_response_code(201); 
            echo json_encode(['id' => $friendId, 
                              'message' => 'Friend created',
                              'name' => $name,
                              'relationship' => $relationship,]);
        } else {
            http_response_code(500); 
            echo json_encode(['message' => 'Failed to create friend']);
        }
    
    }
    }
    public function put($id)
    {
        parse_str(file_get_contents('php://input'), $_PUT);
    
        $name = $_PUT['name'];
        $relationship = $_PUT['relation'];
        
        if (isset($_FILES['photo'])) {
            $file = $_FILES['photo'];

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileData = file_get_contents($fileTmpName);
        }
        
        if (updateFriend(6, $name, $relationship, $fileData)) {
            http_response_code(200); 
            echo json_encode(['message' => 'Friend updated successfully']);
        } else {
            http_response_code(500); 
            echo json_encode(['message' => 'Failed to update friend']);
        }
    }
    public function delete($id)
    {   $friend = getOneFriend($id);
        if (!$friend) {
            http_response_code(404); 
            echo json_encode(['message' => 'Friend not found']);
            return;
        }
        if (deleteFriend($id)) {
            http_response_code(200);
            echo json_encode(['message' => 'Friend deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to delete friend']);
        }
        
    }
}
?>
