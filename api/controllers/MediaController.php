<?php
require '../config.php';
require '../media/media-service.php';

class MediaController{
    public function get($id)
    {
        if($id){
            $media = getOneMedia($id);
            if($media){
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([$media['title']]);
            }
            else{
                http_response_code(404);
                echo json_encode(array('message' => 'Media not found'));
            }
        }
        
    }

    public function getAll()
    {
        $media = getMedia(6);
        if($media){
            header('Content-Type: application/json');  
            http_response_code(200);
            foreach($media as $media){
                echo "id: " . $media['id'] . " title: " . $media['title'] . "<br>";
            }
        } else {
            http_response_code(404); 
            echo json_encode(['message' => 'No friends found']);
        }       
        

    }

    public function post(){
        $name = $_POST['title'];

        if(isset($_FILES['picture'])){
            $file = $_FILES['picture'];
    
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
    
            $fileData = file_get_contents($fileTmpName);
    
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'mp4', 'avi', 'mov', 'mpeg'); // Add any other allowed extensions here
    
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
            if(in_array($fileExtension, $allowedExtensions)){
                if(addMedia(6, $name, $fileData)){
                    http_response_code(201);
                    echo json_encode(array('message' => 'Media added successfully.'));
                }
                else{
                    http_response_code(500);
                    echo json_encode(array('message' => 'Failed to add media.'));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array('message' => 'Invalid file type.'));
            }
        }
    }

    public function put($id){
        $putData = file_get_contents('php://input');
        parse_str($putData, $requestData);

        $media_id = $id;
        $name = $requestData['title'];

        $media = getOneMedia($media_id);
        if(!$media){
            http_response_code(404);
            echo json_encode(array('message' => 'Media not found.'));
            return;
        }elseif(updateMedia($media_id, $name)){
            http_response_code(200);
            echo json_encode(array('message' => 'Media updated successfully.'));
        }else {
            http_response_code(500);
            echo json_encode(array('message' => 'Failed to update media.'));
        }

    } 
    

    public function delete($id)
    {
        $media = getOneMedia($id);
        if(!$media){
            http_response_code(404);
            echo json_encode(array('message' => 'Media not found.'));
            return;
        }

        if(deleteMedia($id)){
            http_response_code(200);
            echo json_encode(array('message' => 'Media deleted successfully.'));
        }
        else{
            http_response_code(500);
            echo json_encode(array('message' => 'Failed to delete media.'));
        }
    }
}



?>