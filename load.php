<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=smarttec', 'smarttec', '8UBPKq]aZ+?P');

$data = array();

$query = "SELECT * FROM events WHERE ID_f = " . $_GET['id_1'] . " AND (end_event > now() ) ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$ur = 'enroll-direct.php';
foreach ($result as $row) {
    $data[] = array(
        'id'   => $row["id"],
        'title'   => utf8_encode($row["title"]),
        'start'   => $row["start_event"],
        'end'   => $row["end_event"],
        'url'   => "seances.php?id=" . $row["id"]

    );
}

echo json_encode($data);
