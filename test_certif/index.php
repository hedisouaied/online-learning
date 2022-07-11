<?php
header('content-type:image/jpeg');
$font = "./CAMBRIAZ.TTF";
$image = imagecreatefromjpeg("smarttec-certificat.jpg");

$png = imagecreatefrompng($_GET['img']);


$color = imagecolorallocate($image, 29, 29, 27);
$color_bleu = imagecolorallocate($image, 0, 49, 80);
$genre = $_GET['genre'];
if($genre == "mr"){
    $mr = "M";
}
if($genre == "ms"){
    $mr = "Mme";
}
$date_session ="";
if(isset($_GET['date_debut'])&&isset($_GET['date_fin'])){
    
    $beg_day = $_GET['date_debut'];
$dt = array();

$dt = explode("-", $beg_day);
$jour = $dt[2];
$year = $dt[0];

if ($dt[1] == "1") {

	$month = "janvier";
} elseif ($dt[1] == "2") {

	$month = "février";
} elseif ($dt[1] == "3") {

	$month = "mars";
} elseif ($dt[1] == "4") {

	$month = "avril";
} elseif ($dt[1] == "5") {

	$month = "mai";
} elseif ($dt[1] == "6") {

	$month = "juin";
} elseif ($dt[1] == "7") {

	$month = "juillet";
} elseif ($dt[1] == "8") {

	$month = "août";
} elseif ($dt[1] == "9") {

	$month = "septembre";
} elseif ($dt[1] == "10") {

	$month = "octobre";
} elseif ($dt[1] == "11") {

	$month = "novembre";
} elseif ($dt[1] == "12") {

	$month = "décembre";
} else {
	$month = "-";
}

$date1 = $jour . " " . $month . " " . $year;

$beg_day = $_GET['date_fin'];
$dt = array();

$dt = explode("-", $beg_day);
$jour = $dt[2];
$year = $dt[0];

if ($dt[1] == "1") {

	$month = "janvier";
} elseif ($dt[1] == "2") {

	$month = "février";
} elseif ($dt[1] == "3") {

	$month = "mars";
} elseif ($dt[1] == "4") {

	$month = "avril";
} elseif ($dt[1] == "5") {

	$month = "mai";
} elseif ($dt[1] == "6") {

	$month = "juin";
} elseif ($dt[1] == "7") {

	$month = "juillet";
} elseif ($dt[1] == "8") {

	$month = "août";
} elseif ($dt[1] == "9") {

	$month = "septembre";
} elseif ($dt[1] == "10") {

	$month = "octobre";
} elseif ($dt[1] == "11") {

	$month = "novembre";
} elseif ($dt[1] == "12") {

	$month = "décembre";
} else {
	$month = "-";
}

$date2 = $jour . " " . $month . " " . $year;
    
    $date_session = "Du ".$date1." au ".$date2;
    
    
    
}
$nom = ucfirst($mr) . ". " . $_GET['nom'];
//$nom = wordwrap($name = ucfirst($_GET['genre']) . ". " . $_GET['nom'],20,"\n");
$formations = $_GET['cours'];
$code = $_GET['certifcode'];
$contenue_text = "";
if(isset($_GET['contenue1'])){
    $contenue_text = "Contenu de la formation:";
}
$contenue1 = "";
if(isset($_GET['contenue1'])){
    if($_GET['contenue1'] !=""){
    $contenue1 = "- ". $_GET['contenue1'];
    }
}
$contenue2 = "";
if(isset($_GET['contenue2'])){
    
    if($_GET['contenue2'] !=""){
    $contenue2 = "- ". $_GET['contenue2'];

    }
}
$contenue3 = "";
if(isset($_GET['contenue3'])){
    
    if($_GET['contenue3'] !=""){
    $contenue3 = "- ". $_GET['contenue3'];

    }
}
$contenue4 = "";
if(isset($_GET['contenue4'])){
    
    if($_GET['contenue4'] !=""){
    $contenue4 = "- ". $_GET['contenue4'];

    }
}
$contenue5 = "";
if(isset($_GET['contenue5'])){
    
    if($_GET['contenue5'] !=""){
    $contenue5 = "- ". $_GET['contenue5'];

    }
}
$contenue6 = "";
if(isset($_GET['contenue6'])){
    
    if($_GET['contenue6'] !=""){
    $contenue6 = "- ". $_GET['contenue6'];

    }
}

// Get image Width and Height
$image_width = imagesx($image);  
$image_height = imagesy($image);

// Get Bounding Box Size
$text_box = imagettfbbox(35,0,$font,$formations);

// Get your Text Width and Height
$text_width = $text_box[2]-$text_box[0];
$text_height = $text_box[7]-$text_box[1];

// Calculate coordinates of the text
$x = ($image_width/2) - ($text_width/2);
$y = ($image_height/2) - ($text_height/2);


// Get Bounding Box Size
$text_box1 = imagettfbbox(35,0,$font,$nom);

// Get your Text Width and Height
$text_width1 = $text_box1[2]-$text_box1[0];
$text_height1 = $text_box1[7]-$text_box1[1];

// Calculate coordinates of the text
$x1 = ($image_width/2) - ($text_width1/2);
$y1 = ($image_height/2) - ($text_height1/2);


// Get Bounding Box Size
$text_box2 = imagettfbbox(15,0,$font,$date_session);

// Get your Text Width and Height
$text_width2 = $text_box2[2]-$text_box2[0];
$text_height2 = $text_box2[7]-$text_box2[1];

// Calculate coordinates of the text
$x2 = ($image_width/2) - ($text_width2/2);
$y2 = ($image_height/2) - ($text_height2/2);


imagettftext($image, 35, 0, $x1, 210, $color, $font, $nom);
imagettftext($image, 35, 0, $x, 313, $color_bleu, $font, $formations);
imagettftext($image, 15, 0, $x2, 347, $color, $font, $date_session);
imagettftext($image, 8, 0, 743, 555, $color, $font, $code);

imagettftext($image, 13, 0, 300, 400, $color, $font, $contenue_text);
imagettftext($image, 9, 0, 195, 425, $color, $font, $contenue1);
imagettftext($image, 9, 0, 435, 425, $color, $font, $contenue2);
imagettftext($image, 9, 0, 195, 445, $color, $font, $contenue3);
imagettftext($image, 9, 0, 435, 445, $color, $font, $contenue4);
imagettftext($image, 9, 0, 195, 465, $color, $font, $contenue5);
imagettftext($image, 9, 0, 435, 465, $color, $font, $contenue6);

$beg_day = $_GET['date_certif'];
$dt = array();

$dt = explode("-", $beg_day);
$jour = $dt[2];
$year = $dt[0];

if ($dt[1] == "1") {

	$month = "janvier";
} elseif ($dt[1] == "2") {

	$month = "février";
} elseif ($dt[1] == "3") {

	$month = "mars";
} elseif ($dt[1] == "4") {

	$month = "avril";
} elseif ($dt[1] == "5") {

	$month = "mai";
} elseif ($dt[1] == "6") {

	$month = "juin";
} elseif ($dt[1] == "7") {

	$month = "juillet";
} elseif ($dt[1] == "8") {

	$month = "août";
} elseif ($dt[1] == "9") {

	$month = "septembre";
} elseif ($dt[1] == "10") {

	$month = "octobre";
} elseif ($dt[1] == "11") {

	$month = "novembre";
} elseif ($dt[1] == "12") {

	$month = "décembre";
} else {
	$month = "-";
}

$date = $jour . " " . $month . " " . $year;
imagettftext($image, 8, 0, 679, 542, $color, $font, $date);




list($width, $height) = getimagesize('smarttec-certificat.jpg');
list($newwidth, $newheight) = getimagesize($_GET['img']);


$out = imagecreatetruecolor($width, $height);

imagecopyresampled($out, $image, 0, 0, 0, 0, $width, $height, $width, $height);
imagecopy($out, $png, 50, 450, 0, 0, $newwidth, $newheight);



imagejpeg($out);
$file = time();
imagejpeg($out, "certificate/" . $code . $_GET['id_session'] . $_GET['id_cours'] . ".jpg");
imagedestroy($out);
