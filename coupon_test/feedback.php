<?php 
include '../connexion.php';

$req = "SELECT * FROM `panier` WHERE ID = 174";
$exec = mysqli_query($conn,$req);
$array = mysqli_num_rows($exec);

if($array != 0){
    echo "exist";
}else{
    echo "doesn't exist";
}

