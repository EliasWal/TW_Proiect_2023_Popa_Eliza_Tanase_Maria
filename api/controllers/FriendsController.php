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
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([$friend['name'], $friend['relationship']]);
            } else {
                http_response_code(404); 
                echo json_encode(['message' => 'Friend not found']);
            }
        } 
    }

    public function getAll()
    {   $friends = getFriends(6);
        if ($friends) {
            header('Content-Type: application/json');  
            http_response_code(200);
            foreach ($friends as $friend) {    
                //$imageData = base64_encode($friends['photo']);
                //$src = 'data:image;base64,' . $imageData;
                header('Content-Type: application/json');
                echo "name: " . $friend['name'] . ", relationship: " . $friend['relationship'] . "<br>"; //. "<img src='$src'>" . "<br>";
            }
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
    {   $putData = file_get_contents('php://input');
        parse_str($putData, $requestData);

        $friend_id = $id;
        $name = $requestData['name'];
        $relationship = $requestData['relationship'];
        
        $friend = getOneFriend($id);
        
        if(!$friend){
            http_response_code(404); 
            echo json_encode(['message' => 'Friend not found']);
            return;
        }elseif(updateFriend($friend_id, $name, $relationship)){
            http_response_code(200); 
            echo json_encode(['message' => 'Friend updated successfully']);
        }else{
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
