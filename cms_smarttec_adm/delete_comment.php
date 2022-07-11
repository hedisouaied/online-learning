<?php 

    
    include 'connexion.php';

    $id = $_POST['delete_id'];
    
    $req = "DELETE FROM `comment` WHERE comment_id=$id ";
	$exec = mysqli_query($conn,$req);
    
    
