<?php 
    /*$base64image = base64_encode($row['picture']);
    $photo_url = 'data:image/jpeg;base64,' . $base64image;
    $encoded_photo = urlencode($photo_url);
    $encoded_description = urlencode($row['title']);
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='.$encoded_photo.'&quote='.$encoded_description;*/
    $filename = 'photo.jpg';
    $filepath = __DIR__ . '/images/' . $filename;
    file_put_contents($filepath, $row['picture']);
    $photo_url = 'http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/Memories/images/' . $filename;
    $encoded_photo = urlencode($photo_url);
    $encoded_description = urlencode($row['title']);
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='.$encoded_photo.'&quote='.$encoded_description;
    //unlink($filepath);
?>