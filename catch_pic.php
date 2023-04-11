<?php
if($_POST) {

    $p_w = $_POST['profileImageW'];
    $p_h = $_POST['profileImageH'];
    $x = $_POST['profileImageX'];
    $y = $_POST['profileImageY'];
    
    $url = UP_PATH_FACE.$picturename;
    
    list($w, $h, $type) = getimagesize($url);
    
    $resize_val = 500;
    
    switch($type){
        case IMAGETYPE_JPEG:
            $in = imagecreatefromjpeg($url);
            break;
        case IMAGETYPE_GIF:
            $in = imagecreatefromgif($url);
            break;
        case IMAGETYPE_PNG:
            $in = imagecreatefrompng($url);
            break;
    }
    
    // コピー画像のリソース
    $out = imagecreatetruecolor($resize_val, $resize_val);
    imagealphablending($out, false);
    imagesavealpha($out, true);
    // リサイズ
    ImageCopyResampled($out, $in, 0, 0, $x, $y, $resize_val, $resize_val, $p_w, $p_h);
    
    imagepng($out, UP_PATH_FACE.$picturename);
    
    imagedestroy($out);
    imagedestroy($in);
}