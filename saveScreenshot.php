<?php 

    $data = $_POST['base64data'];
    $image = explode('base64', $data);
    file_put_contents('img.jpg', base64_decode($image[1]));
?>