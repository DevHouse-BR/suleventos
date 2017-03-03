<?php
header ("Content-type: image/jpg");

$im = imagecreate (300, 300);
imageJPEG($im,"img/camera.jpg");
$im = @imagecreatefromjpeg("img/camera.jpg");

    $text_color = imagecolorallocate($im, 233, 14, 91);
    imagestring($im, 1, 5, 5,  "A Simple Text String", $text_color);
    imagepng($im);
    imagedestroy($im);
?>