<?php 

    
    include 'connexion.php';

    $id = $_POST['delete_id'];
    
    $req = "DELETE FROM `team` WHERE ID=$id ";
	$exec = mysqli_query($conn,$req);
    
    
