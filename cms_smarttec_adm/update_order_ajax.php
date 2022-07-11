<?php
$id = $_POST['id'];

$order = $_POST['demo2'];

include 'connexion.php';


$req = "UPDATE `formations_live` SET `ordre_f` = ".$order." WHERE ID_f = ".$id." ";
$exec = mysqli_query($conn,$req);

$error = 'ordre de formation a été modifié';
$data = array(

    'error' => $error

);
echo json_encode($data);