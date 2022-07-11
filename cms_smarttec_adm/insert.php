<?php

//insert.php
include 'pdo_connect.php';

$connect = $con;

if (isset($_POST["title"])) {
    $query = "
 INSERT INTO events 
 (title, start_event, end_event,ID_f) 
 VALUES (:title, :start_event, :end_event,:id_f)
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end'],
            ':id_f' => $_GET['id']
        )
    );
}
