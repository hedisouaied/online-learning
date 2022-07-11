<?php

//add_comment.php
include 'connexion.php';
if (isset($_SESSION['id'])) {
    $id_session = $_SESSION['id'];
} else {
    $id_session = 0;
}
$error = '';
$comment_name = '';
$comment_content = '';

if (empty($_POST["comment_name"])) {
    $error .= '<p class="text-danger">Le nom est requis</p>';
} else {
    $comment_name = $_POST["comment_name"];
}

if (empty($_POST["comment_content"])) {
    $error .= '<p class="text-danger">Un commentaire est requis</p>';
} else {
    $comment_content = $_POST["comment_content"];
}
$blog_id = $_POST["blog_id"];

if ($error == '') {
    $query = "INSERT INTO comment (parent_comment_id, comment, comment_sender_name,blog_id,user_ID) VALUES ('" . $_POST["comment_id"] . "', '" . $comment_content . "', '" . $comment_name . "','" . $blog_id . "','" . $id_session . "')";
    $statement = mysqli_query($conn, $query);

    $error = '<label class="text-success">Commentaire ajoutée</label>';
}

$data = array(
    'error'  => $error
);

echo json_encode($data);
