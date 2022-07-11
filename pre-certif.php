<?php
header('content-type:image/jpeg');
$font = "certificate/BRUSHSCI.TTF";
$image = imagecreatefromjpeg("images/certificate.jpg");
$color = imagecolorallocate($image, 19, 21, 22);
$name = $_GET['name'];
imagettftext($image, 50, 0, 365, 420, $color, $font, $name);
$date = "15 april 2021";
imagettftext($image, 20, 0, 450, 595, $color, "certificate/AGENCYR.TTF", $date);
imagejpeg($image);
$file = time();
imagejpeg($image, "uploads/certificate/" . $file . ".jpg");
imagedestroy($image);
