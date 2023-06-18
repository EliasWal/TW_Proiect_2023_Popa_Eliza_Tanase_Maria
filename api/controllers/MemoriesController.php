<?php
require '../config.php';
require '../Memories/memories-service.php';

class MemoriesController {
    public function get($id) {
        if($id) {
            $memory = getMemory($id);
            if($memory) {
                header('Content-Type: application/json');
                http_response_code(200);
                echo " title: " . $memory['title'] . " description: " . $memory['description'] ."<br>";
            }
            else{
                http_response_code(404);
                echo json_encode(array('message' => 'Memory not found'));
            }
        }
    }

    public function getAll() {
        $memories = getMemories(6, 1);
        if($memories){
            header('Content-Type: application/json');  
            http_response_code(200);
            foreach($memories as $memory){
                echo "id: " . $memory['id'] . " title: " . $memory['title'] . " description: " . $memory['description'] ."<br>";
            }
        } else {
            http_response_code(404); 
            echo json_encode(['message' => 'No memories found']);
        }       
    }

    public function post() {
        $date = $_POST['date'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $id_child = $_POST['id_child'];
        $user_id = $_POST['user_id'];

        if (isset($_FILES['picture'])) {
            $file = $_FILES['picture'];
    
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
    
            $fileData = file_get_contents($fileTmpName);

            if(addMemory($user_id, $id_child, $date, $title, $description, $fileData)){
                http_response_code(201);
                echo json_encode(array('message' => 'Memory added successfully.'));
            }
            else{
                http_response_code(500);
                echo json_encode(array('message' => 'Failed to add memory.'));
            }
        }
    }

    public function put($id) {
        $putData = file_get_contents('php://input');
        parse_str($putData, $requestData);

        $memory_id = $id;
        $date = $requestData['date'];
        $title = $requestData['title'];
        $description = $requestData['description'];

        if (isset($_FILES['picture'])) {
            $file = $_FILES['picture'];
    
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
    
            $fileData = file_get_contents($fileTmpName);

            $allowedExtensions = array('jpg', 'jpeg', 'png');
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if(in_array($fileExtension, $allowedExtensions)){
                if(updateMemory($memory_id, $date, $title, $description, $fileData)){
                    http_response_code(201);
                    echo json_encode(array('message' => 'Memory updated successfully.'));
                }
                else{
                    http_response_code(500);
                    echo json_encode(array('message' => 'Failed to update memory.'));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array('message' => 'Invalid file type.'));
            }
        }
    }

    public function delete($id)
    {
        $memory = getMemory($id);
        if(!$memory){
            http_response_code(404);
            echo json_encode(array('message' => 'Memory not found.'));
            return;
        }

        if(deleteMemory($id)){
            http_response_code(200);
            echo json_encode(array('message' => 'Memory deleted successfully.'));
        }
        else{
            http_response_code(500);
            echo json_encode(array('message' => 'Failed to delete memory.'));
        }
    }
}
?>