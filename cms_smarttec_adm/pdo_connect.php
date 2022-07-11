<?php

   
    $dsn = 'mysql:host=localhost;dbname=smarttec';
    $user= 'smarttec';
    $pass='8UBPKq]aZ+?P';




    $option= array(
    
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    
    );


    try{
        $con = new PDO($dsn,$user,$pass,$option);
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
    }


    catch(PDOException $e){
        
    }