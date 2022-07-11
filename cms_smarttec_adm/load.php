<?php

//load.php
include 'pdo_connect.php';

$connect = $con;

$data = array();

$query = "SELECT * FROM events WHERE ID_f = " . $_GET['id'] . " ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach ($result as $row) {
    $data[] = array(
        'id'   => $row["id"],
        'title'   => $row["title"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"]
    );
}

echo json_encode($data);
