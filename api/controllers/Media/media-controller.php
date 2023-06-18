<?
require_once '../config.php';
require_once 'media-service.php';
session_start();

if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])){
    $media_id = $_POST['id'];
    echo $media_id;
    if(deleteMedia($media_id)){
        $response = [
            'status' => 'success',
            'message' => 'Prietenul a fost șters cu succes.'
        ];
        http_response_code(201);
        //header('Content-Type: application/json');
        //echo json_encode($response);
        header("Location: media.php");
        
    }
    else {
        http_response_code(400); // Setează codul de răspuns HTTP la 400 Bad Request
        $response = [
            'status' => 'error',
            'message' => 'Cerere invalidă.'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
}

?>