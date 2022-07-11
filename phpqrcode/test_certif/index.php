<?php
header('content-type:image/jpeg');
$font = "CAMBRIAZ.TTF";
$image = imagecreatefromjpeg("smarttec-certificat.jpg");
$png = imagecreatefrompng($_GET['img']);

$color = imagecolorallocate($image, 29, 29, 27);
$color_bleu = imagecolorallocate($image, 0, 49, 80);
$genre = 'mr';
if ($genre == "mr") {
	$mr = "M";
}
if ($genre == "ms") {
	$mr = "Mme";
}
$date_session = "Depuis 1/1/2021 jusqu'à 12/12/2021";



$nom = ucfirst($mr) . ". hedi gthfjhfgjhgjh";
//$nom = wordwrap($name = ucfirst($_GET['genre']) . ". " . $_GET['nom'],20,"\n");
$formations = 'php lessons 2021';
$code = 'smarttec-2021';

// Get image Width and Height
$image_width = imagesx($image);
$image_height = imagesy($image);

// Get Bounding Box Size
$text_box = imagettfbbox(20, 0, $font, $formations);

// Get your Text Width and Height
$text_width = $text_box[2] - $text_box[0];
$text_height = $text_box[7] - $text_box[1];

// Calculate coordinates of the text
$x = ($image_width / 2) - ($text_width / 2);
$y = ($image_height / 2) - ($text_height / 2);


// Get Bounding Box Size
$text_box1 = imagettfbbox(20, 0, $font, $nom);

// Get your Text Width and Height
$text_width1 = $text_box1[2] - $text_box1[0];
$text_height1 = $text_box1[7] - $text_box1[1];

// Calculate coordinates of the text
$x1 = ($image_width / 2) - ($text_width1 / 2);
$y1 = ($image_height / 2) - ($text_height1 / 2);


// Get Bounding Box Size
$text_box2 = imagettfbbox(15, 0, $font, $date_session);

// Get your Text Width and Height
$text_width2 = $text_box2[2] - $text_box2[0];
$text_height2 = $text_box2[7] - $text_box2[1];

// Calculate coordinates of the text
$x2 = ($image_width / 2) - ($text_width2 / 2);
$y2 = ($image_height / 2) - ($text_height2 / 2);


imagettftext($image, 20, 0, $x1, 240, $color, $font, $nom);
imagettftext($image, 20, 0, $x, 340, $color_bleu, $font, $formations);
imagettftext($image, 15, 0, $x2, 390, $color, $font, $date_session);
imagettftext($image, 13, 0, 463, 442, $color, $font, $code);

$date = "12 oct 2021";

imagettftext($image, 13, 0, 135, 517, $color, $font, $date);

list($width, $height) = getimagesize('smarttec-certificat.jpg');
list($newwidth, $newheight) = getimagesize($_GET['img']);


$out = imagecreatetruecolor($width, $height);

imagecopyresampled($out, $image, 0, 0, 0, 0, $width, $height, $width, $height);
imagecopy($out, $png, 390, 470, 0, 0, $newwidth, $newheight);




imagejpeg($out);
$file = time();
imagejpeg($out, "certificate/" . $code . ".jpg");
imagedestroy($out);
