<?php

//fetch_comment.php


include 'connexion.php';
$tn_query = "SELECT * FROM comment WHERE blog_id = " . $_GET['id'] . " ";
$tnconnect = mysqli_query($conn, $tn_query);
$tncount = mysqli_num_rows($tnconnect);

$query = "SELECT * FROM comment WHERE parent_comment_id = 0 AND blog_id = " . $_GET['id'] . " ORDER BY comment_id ASC";

$statement = mysqli_query($conn, $query);


$result = mysqli_fetch_array($statement);

$output = '<h4>' . $tncount . ' Commentaires</h4>';
while ($row = mysqli_fetch_array($statement)) {

    $output .= '
    <div class="d-flex mb-3 p-3" style="background: white;border: 1px solid #dfe2e6;border-radius: .5rem;">
    
    <a href="" class="avatar avatar-sm mr-12pt">';

    if ($row['user_ID'] !== '0') {
        $stmt = mysqli_query($conn, "SELECT * FROM clients WHERE ID = " . $row['user_ID']);
        $user_fetch = mysqli_fetch_array($stmt);
        if (empty($user_fetch['photo'])) {
            $output .= '<img src="public/images/people/110/guy-3.jpg" alt="people" class="avatar-img rounded-circle">';
        } elseif (!empty($user_fetch['photo'])) {
            $output .= '<img src="uploads/avatars/' . $user_fetch['photo'] . '" alt="people" class="avatar-img rounded-circle">';
        }
    } else {
        $output .= '<img src="public/images/people/256/256_rsz_karl-s-973833-unsplash.jpg" alt="people" class="avatar-img rounded-circle">';
    }
    $output .= '</a>
    
    <div class="flex">
        <a href="" class="text-body"><strong>' . $row["comment_sender_name"] . '</strong></a><br>
        <p class="mt-1 text-70">' . $row["comment"] . '</p>
        <button type="button" class="btn btn-outline-secondary yesbor reply" style="float: right;width: max-content;" id="' . $row["comment_id"] . '">' . "Répondre" . '</button>
    </div>
</div>';

    $output .= get_reply_comment($conn, $row["comment_id"]);
}

echo $output;

function get_reply_comment($conn, $parent_id = 0, $marginleft = 0)
{
    $query = "SELECT * FROM comment WHERE parent_comment_id = '" . $parent_id . "' ";
    $output = '';
    $statement = mysqli_query($conn, $query);
    $count = mysqli_num_rows($statement);
    if ($parent_id == 0) {
        $marginleft = 0;
    } else {
        $marginleft = $marginleft + 48;
    }
    if ($count > 0) {
        while ($row = mysqli_fetch_array($statement)) {

            $sttc = mysqli_query($conn, 'SELECT * FROM comment WHERE comment_id =  ' . $row['parent_comment_id']);
            $pow = mysqli_fetch_array($sttc);

            $output .= '<div class="ml-sm-32pt mt-3 card p-3" style="margin-left:' . $marginleft . 'px !important;">
            <div class="d-flex">
                <a href="#" class="avatar avatar-sm mr-12pt">';
            if ($row['user_ID'] !== '0') {
                $stmt = mysqli_query($conn, "SELECT * FROM clients WHERE ID =  " . $row['user_ID']);
                $user_fetch = mysqli_fetch_array($stmt);
                if (empty($user_fetch['photo'])) {
                    $output .= '<img src="public/images/people/110/guy-3.jpg" alt="people" class="avatar-img rounded-circle">';
                } elseif (!empty($user_fetch['photo'])) {
                    $output .= '<img src="uploads/avatars/' . $user_fetch['photo'] . '" alt="people" class="avatar-img rounded-circle">';
                }
            } else {
                $output .= '<img src="public/images/people/256/256_rsz_karl-s-973833-unsplash.jpg" alt="people" class="avatar-img rounded-circle">';
            }
            $output .= '</a>
                <div class="flex">
                    <div class="d-flex align-items-center">
                        <a href="" class="text-body"><strong>' . $row["comment_sender_name"] . '</strong></a>
                    </div>
                    <p class="mt-1 text-70">@' . $pow['comment_sender_name'] . " <br> " . $row["comment"] . '</p>
                    <button  type="button" style="float: right;width: max-content;" class="btn btn-outline-secondary yesbor reply" id="' . $row["comment_id"] . '">' . "Répondre" . '</button>
                </div>
            </div>
        </div>';

            $output .= get_reply_comment($conn, $row["comment_id"], 80);
        }
    }
    return $output;
}
