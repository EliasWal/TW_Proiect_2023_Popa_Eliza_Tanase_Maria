<?php
$user_id = $_SESSION["id"];
if(isset($_POST['delete'])){
    $media_id = $_POST['id'];
    $url = "http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria-main/Media/media-controller.php" . $media_id;    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
    }
    
    curl_close($ch);
    
    echo $response;
}



?>